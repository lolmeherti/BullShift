@php
    use Carbon\Carbon;
@endphp
<x-app-layout>
    <x-slot name="header" class="p-2">

    </x-slot>
    <style>
        dialog[open] {
            overflow: hidden;
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }
        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
        }
        @keyframes appear {
            from {
                opacity: 0;
                transform: translateX(-3rem);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .dataTables_filter {
            display: none;
        }
    </style>
    <dialog id="myModal"
            class="h-1/4 w-1/4  bg-gray-100 dark:bg-dark-eval-1 rounded-md border border-neutral-700 dark:border-neutral-700">
        <div class="flex flex-col w-full h-auto">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div
                    class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold text-gray-600 dark:text-gray-100"
                    id="deletion_warning">
                    Modal Header
                </div>
                <!--Header End-->
            </div>
            <!-- Modal Content-->
            <div class="justify-center items-center rounded text-center dark:text-gray-400 text-gray-400"
                 id="deletion_warning_message">
                This action is permanent. Are you sure you want to proceed?
            </div>
            <div class="flex w-full h-auto py-10 px-2 justify-center items-center rounded text-center text-gray-500">
                <div>
                    <div role="status" id="deletion_spinner" class="hidden" style="padding-bottom: 2em;">
                        <svg aria-hidden="true"
                             class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 dark:fill-red-600 fill-purple-500"
                             viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor"/>
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <a href="#" id="consent_to_deletion_button" data-modal-hide="popup-modal" type="button"
                       onclick="deleteRequest('/invitation/delete')"
                       class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-purple-500 dark:bg-red-500 text-purple-50 inline-block">
                            <span
                                class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-purple-400 dark:bg-red-400 group-hover:h-full opacity-90"></span>
                        <span class="relative group-hover:text-white" id="deletion_confirmation_button_text"> Yes, I'm sure</span>
                    </a>
                    <a href="#" data-modal-hide="popup-modal" id="deletion_cancel_button" type="button"
                       onclick="closeModal()"
                       class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-neutral-600 dark:bg-gray-600 text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-neutral-500 dark:bg-gray-500 group-hover:h-full opacity-90"></span>
                        <span id="cancel_button_text" class="relative group-hover:text-white">No, cancel</span>
                    </a>
                </div>
            </div>
            <!-- End of Modal Content-->
        </div>
    </dialog>
    <!-- this is the hidden input storing the id for deletion -->
    <input type="hidden" value="" name="pending_deletion_id" id="pending_deletion_id">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex items-stretch">
        <table id="data_table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <caption
                class="p-5 text-xl font-semibold text-left bg-gray-50 dark:bg-dark-eval-1 dark:text-white text-gray-900">
                Invitations
                <div class="grid grid-cols-2">
                    <div id="paragraph" class="col-start-1 col-end-2">
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Create and manage
                            your invitations.</p>

                    <div class="flex">
                        <div class="flex-1 ...">
                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative pt-2">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none pt-2">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="search" id="default-search" style="font-weight: lighter;" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Search Employee" required>
                            </div>
                        </div>
                            <div class="flex-1 ..."></div>
                    </div>
                    </div>
                    <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="{{route('preparation.invitations.create')}}"
                           class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-600 text-purple-50 inline-block">
                            <span
                                class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out bg-green-500 transform translate-y-0 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">CSV Import</span>
                        </a>
                        <a href="{{route('preparation.invitations.create')}}"
                           class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-600 text-purple-50 inline-block">
                            <span
                                class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out bg-green-500 transform translate-y-0 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">New</span>
                        </a>
                    </div>
                </div>
            </caption>
            <thead
                class="text-sm text-gray-100 uppercase bg-neutral-600 dark:bg-gray-700 text-gray-100 dark:text-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <div class="flex inline-flex items-baseline">
                        <div class="flex-1 ...">Recipient</div>
                        <div class="flex-2 ...">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true"
                                     fill="currentColor" viewBox="0 0 320 512">
                                    <path
                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex inline-flex items-baseline">
                        <div class="flex-1 ...">Email</div>
                        <div class="flex-2 ..."><a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true"
                                     fill="currentColor" viewBox="0 0 320 512">
                                    <path
                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                </svg>
                            </a></div>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex inline-flex items-baseline">
                        <div class="flex-1 ...">Status</div>
                        <div class="flex-2 ..."><a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true"
                                     fill="currentColor" viewBox="0 0 320 512">
                                    <path
                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                </svg>
                            </a></div>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex inline-flex items-baseline">
                        <div class="flex-1 ...">Designation</div>
                        <div class="flex-2 ..."><a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true"
                                     fill="currentColor" viewBox="0 0 320 512">
                                    <path
                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                </svg>
                            </a></div>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex inline-flex items-baseline">
                        <div class="flex-1 ...">Date Sent</div>
                        <div class="flex-2 ..."><a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true"
                                     fill="currentColor" viewBox="0 0 320 512">
                                    <path
                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                </svg>
                            </a></div>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($invitedUsers as $invitedUser)
                <tr class="bg-gray-50 border-b dark:bg-dark-eval-1 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-opacity-70 hover:bg-gray-100  hover:bg-opacity-50"
                    id="table_row_id{{$invitedUser->id}}">
                    <th scope="row" class="px-6 py-6 font-medium text-gray-600 whitespace-nowrap dark:text-white">
                        {{$invitedUser->name}}
                    </th>

                    <td class="px-6 py-6">
                        {{$invitedUser->email}}
                    </td>
                    @if($invitedUser->email_verified_at)
                        <td class="px-6 py-6 text-green-500" style="font-weight:bold;">
                            Verified
                        </td>
                    @else
                        <td class="px-6 py-6 text-gray-400 dark:text-gray-400" style="font-weight:bold;">
                            Pending
                        </td>
                    @endif
                    <td class="px-6 py-6">
                        {{$invitedUser->designation}}
                    </td>
                    <td class="px-6 py-6">
                        {{Carbon::parse($invitedUser->date_sent)->isoFormat('Do MMM Y')}}
                    </td>
                    <td class="px-6 text-right">
                        @if(!$invitedUser->email_verified_at)
                            <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                                <a href="#" id="delete"
                                   onclick="deleteConfirmation({{$invitedUser->id}}, '','Withdraw invitation')"
                                   class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-purple-500 dark:bg-red-500 text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-purple-400 dark:bg-red-400 group-hover:h-full opacity-90"></span>
                                    <span class="relative group-hover:text-white">Revoke</span>
                                </a>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>

<script>
    window.onload = function () {

        let table = new DataTable('#data_table', {
            paging: false,
            searching: true,
            lengthChange: false,
            info: false,
        });

        $('#default-search').on('keyup', function () {
            table.search( this.value ).draw();
        });

        document.getElementById('data_table_wrapper').classList.add('w-full');
        document.getElementById('data_table_wrapper').classList.remove('dataTables_wrapper');
    };
</script>
