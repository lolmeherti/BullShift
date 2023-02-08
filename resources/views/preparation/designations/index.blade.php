<x-app-layout>

    <x-slot name="header" class="p-2">

    </x-slot>

    <style>
        #popup-modal {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

    <div id="popup-modal" tabindex="-1" class="fixed  z-50 hidden overflow-x-hidden overflow-y-auto ">

        <input  type="hidden" value="" name="pending_deletion_id" id="pending_deletion_id">

        <div class="relative w-full h-full max-w-md md:h-auto">
            <div class="relative bg-white rounded-lg shadow border border-neutral-700 dark:bg-gray-700">
                <button type="button" onclick="closeModal()"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p id="deletion_warning" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-100">Warning: this action is permanent! Do you wish to delete </p>
                    <div>
                        <div role="status" id="deletion_spinner" class="hidden" style="padding-bottom: 2em;">
                            <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>

                        <a href="#" id="consent_to_deletion_button" data-modal-hide="popup-modal" type="button" onclick="deleteRequest()"
                           class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-red-600 text-purple-50 inline-block">
                            <span
                                class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-red-400 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white"> Yes, I'm sure</span>
                        </a>

                        <a href="#" data-modal-hide="popup-modal" id="deletion_cancel_button" type="button" onclick="closeModal()"
                           class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-neutral-700 dark:bg-gray-600 text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-neutral-600 dark:bg-gray-500 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">No, cancel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex items-stretch">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <caption
                class="p-5 text-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-dark-eval-1">
                Designations
                <div class="grid grid-cols-2">

                    <div id="paragraph" class="col-start-1 col-end-2">
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Create and manage
                            your designations.</p>
                    </div>
                    <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="{{route('preparation.designations.create')}}"
                           class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-700 text-purple-50 inline-block">
                            <span
                                class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-green-600 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">New</span>
                        </a>
                    </div>
                </div>

            </caption>
            <thead class="text-sm text-gray-100 uppercase bg-neutral-600 dark:bg-gray-700 dark:text-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Designation
                </th>
                <th scope="col" class="px-6 py-3">
                    Contract
                </th>
                <th scope="col" class="px-6 py-3">
                    Employee Count
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($designations as $designation)
                <tr class="bg-white border-b dark:bg-dark-eval-1 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-opacity-70 hover:bg-gray-100  hover:bg-opacity-50"
                    id="table_row_id{{$designation->id}}">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap dark:text-white">
                        {{$designation->designation}}
                    </th>

                    <td class="px-6 py-4">
                        {{$designation->contract_type}}
                    </td>

                    <td class="px-6 py-4">
                        0
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                            <a href="{{url('/designation/'.$designation->id.'/edit')}}"
                               class="px-5 py-1.5 relative rounded group overflow-hidden font-medium dark:bg-gray-700 bg-neutral-600 text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-neutral-500 dark:bg-gray-600 group-hover:h-full opacity-90"></span>
                                <span class="relative group-hover:text-white">Edit</span>
                            </a>
                            <a href="#" id="delete" onclick="deleteConfirmation({{$designation->id}}, '{{$designation->designation}}')"
                               class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-red-600 text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-red-400 group-hover:h-full opacity-90"></span>
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
    let postUrl = '/designation/delete';
    let deletionText = "Warning: this action is permanent! Do you wish to delete ";
    //FORM CONFIGS FOR AXIOS POST REQUEST//

    let deleteConfirmation = (id, name) =>
    {
        document.getElementById("deletion_warning").innerHTML = deletionText + name + "?";

        let element = document.getElementById("popup-modal");
        element.classList.remove("hidden");

        document.getElementById("pending_deletion_id").value = id;
    }

    let closeModal = () =>
    {
        let element = document.getElementById("popup-modal");
        element.classList.add("hidden");

        document.getElementById("pending_deletion_id").value = "";
    }

    let deleteRequest = () =>
    {
        let id = document.getElementById("pending_deletion_id").value;

        document.getElementById("consent_to_deletion_button").classList.add("hidden");
        document.getElementById("deletion_cancel_button").classList.add("hidden");
        document.getElementById("deletion_spinner").classList.remove("hidden");

        axios.post(postUrl, {
            id: id
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
            .then(function (response) {
                closeModal();
                document.getElementById("table_row_id"+id).remove();
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
