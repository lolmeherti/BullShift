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
    </style>
    @php
        $theme = new \App\Models\Theme();
        $normalFormInputTheme = \App\Models\Theme::compileFormInputTheme();
        $alertFormInputTheme = \App\Models\Theme::compileFormInputTheme($alert = true);
    @endphp

    <dialog id="myModal" class="h-1/4 w-1/4  {{$theme::BRIGHT_MODAL_BACKGROUND_COLOR}} {{$theme::DARK_MODAL_BACKGROUND_COLOR}} rounded-md {{$theme::MODAL_BORDER}} {{$theme::BRIGHT_MODAL_BORDER_COLOR}} {{$theme::DARK_MODAL_BORDER_COLOR}}">
        <div class="flex flex-col w-full h-auto ">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div
                    class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold {{$theme::BRIGHT_MODAL_HEADER_COLOR}} {{$theme::DARK_MODAL_HEADER_COLOR}}"
                    id="deletion_warning">
                    Modal Header
                </div>

                <!--Header End-->
            </div>
            <!-- Modal Content-->
            <div class="justify-center items-center rounded text-center {{$theme::DARK_MODAL_SUBTEXT_COLOR}} {{$theme::BRIGHT_MODAL_SUBTEXT_COLOR}}">
                This action is permanent. Are you sure you want to proceed?
            </div>
            <div class="flex w-full h-auto py-10 px-2 justify-center items-center rounded text-center text-gray-500">
                <div>
                    <div role="status" id="deletion_spinner" class="hidden" style="padding-bottom: 2em;">
                        <svg aria-hidden="true"
                             class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600"
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
                       onclick="deleteRequest()"
                       class="px-5 py-1.5 relative rounded group overflow-hidden font-medium {{$theme::BRIGHT_DELETE_BUTTON_COLOR}} {{$theme::DARK_DELETE_BUTTON_COLOR}} text-purple-50 inline-block">
                            <span
                                class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 {{$theme::BRIGHT_DELETE_BUTTON_HOVER_COLOR}} {{$theme::DARK_DELETE_BUTTON_HOVER_COLOR}} group-hover:h-full opacity-90"></span>
                        <span class="relative group-hover:text-white"> Yes, I'm sure</span>
                    </a>

                    <a href="#" data-modal-hide="popup-modal" id="deletion_cancel_button" type="button"
                       onclick="closeModal()"
                       class="px-5 py-1.5 relative rounded group overflow-hidden font-medium {{$theme::BRIGHT_MODAL_CANCEL_BUTTON_COLOR}} {{$theme::DARK_MODAL_CANCEL_BUTTON_COLOR}} text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 {{$theme::BRIGHT_MODAL_CANCEL_HOVER_BUTTON_COLOR}} {{$theme::DARK_MODAL_CANCEL_HOVER_BUTTON_COLOR}} group-hover:h-full opacity-90"></span>
                        <span class="relative group-hover:text-white">No, cancel</span>
                    </a>
                </div>

            </div>
            <!-- End of Modal Content-->
        </div>
    </dialog>


    <!-- this is the hidden input storing the id for deletion -->
    <input type="hidden" value="" name="pending_deletion_id" id="pending_deletion_id">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex items-stretch">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <caption
                class="p-5 text-xl font-semibold text-left {{$theme::BRIGHT_TABLE_BG_COLOR}} {{$theme::DARK_TABLE_BG_COLOR}} {{$theme::DARK_TEXT_COLOR}} {{$theme::BRIGHT_TEXT_COLOR}}">
                Contract Types
                <div class="grid grid-cols-2">

                    <div id="paragraph" class="col-start-1 col-end-2">
                        <p class="mt-1 text-sm font-normal {{$theme::BRIGHT_TABLE_SUBTEXT_COLOR}} {{$theme::DARK_TABLE_SUBTEXT_COLOR}}">Create and manage
                            employment contracts.</p>
                    </div>
                    <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="{{route('preparation.contracts.create')}}"
                           class="px-5 py-1.5 relative rounded group overflow-hidden font-medium {{$theme::NEW_BUTTON_BACKGROUND_COLOR}} text-purple-50 inline-block">
                            <span
                                class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-green-600 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">New</span>
                        </a>
                    </div>
                </div>

            </caption>
            <thead class="text-sm text-gray-100 uppercase {{$theme::BRIGHT_TABLE_HEADER_BG_COLOR}} {{$theme::DARK_TABLE_HEADER_BG_COLOR}} {{$theme::BRIGHT_TABLE_COLUMN_HEADER_COLOR}} {{$theme::DARK_TABLE_COLUMN_HEADER_COLOR}} ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Contract
                </th>
                <th scope="col" class="px-6 py-3">
                    Hours/Week
                </th>
                <th scope="col" class="px-6 py-3">
                    Employee Count
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($contracts as $contract)
                <tr class="bg-gray-50 border-b dark:bg-dark-eval-1 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-opacity-70 hover:bg-gray-100  hover:bg-opacity-50"
                    id="table_row_id{{$contract->id}}">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap dark:text-white">
                        {{$contract->contract_type}}
                    </th>

                    <td class="px-6 py-4">
                        {{$contract->max_hours_per_week + 0}}
                    </td>

                    <td class="px-6 py-4">
                        0
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                            <a href="{{url('/contract/'.$contract->id.'/edit')}}"
                               class="px-5 py-1.5 relative rounded group overflow-hidden font-medium text-purple-50 {{$theme::BRIGHT_EDIT_BUTTON_COLOR}} {{$theme::DARK_EDIT_BUTTON_COLOR}} inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-neutral-500 dark:bg-gray-600 group-hover:h-full opacity-90"></span>
                                <span class="relative group-hover:text-white">Edit</span>
                            </a>

                            <a href="#" id="delete"
                               onclick="deleteConfirmation({{$contract->id}}, '{{$contract->contract_type}}')"
                               class="px-5 py-1.5 relative rounded group overflow-hidden font-medium {{$theme::BRIGHT_DELETE_BUTTON_COLOR}} {{$theme::DARK_DELETE_BUTTON_COLOR}} text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 {{$theme::BRIGHT_DELETE_BUTTON_HOVER_COLOR}} {{$theme::DARK_DELETE_BUTTON_HOVER_COLOR}} group-hover:h-full opacity-90"></span>
                                <span class="relative group-hover:text-white">Delete</span>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>

<script>
    ///////////////////////////////////DELETE REQUEST SECTION WITH AXIOS/////////////////////////////////////

    //FORM CONFIGS FOR AXIOS POST REQUEST//
    let postUrl = '/contract/delete';
    //FORM CONFIGS FOR AXIOS POST REQUEST//

    let deleteConfirmation = (id, name) => {
        let deletionText = "Delete ";

        document.getElementById('myModal').showModal()

        document.getElementById("deletion_warning").innerHTML = deletionText + name + "?";

        document.getElementById("pending_deletion_id").value = id;
    }

    let closeModal = () => {
        document.getElementById('myModal').close();

        document.getElementById("pending_deletion_id").value = "";
    }

    let deleteRequest = () => {
        let id = document.getElementById("pending_deletion_id").value;

        document.getElementById("consent_to_deletion_button").classList.add("hidden");
        document.getElementById("deletion_cancel_button").classList.add("hidden");
        document.getElementById("deletion_spinner").classList.remove("hidden");

        axios.post(postUrl, {
            contractId: id
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
            .then(function (response) {
                closeModal();
                document.getElementById("table_row_id" + id).remove();
                document.getElementById("consent_to_deletion_button").classList.remove("hidden");
                document.getElementById("deletion_cancel_button").classList.remove("hidden");
                document.getElementById("deletion_spinner").classList.add("hidden");
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
    }
    ///////////////////////////////////DELETE REQUEST SECTION WITH AXIOS/////////////////////////////////////
</script>
