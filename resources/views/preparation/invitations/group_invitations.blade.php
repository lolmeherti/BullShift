<x-app-layout>
    <x-slot name="header" class="p-2">

    </x-slot>

    <div
        class="bg-gray-50 dark:bg-dark-eval-1 p-6 overflow-hidden rounded-md shadow-md text-gray-500 dark:text-gray-400">

        <p class="text-2xl font-semibold py-6">Group Invitation</p>

        <div class="mt-8  md:mt-0 md:ml-10 md:w-2/3">
            <div class="relative flex pb-6">
                <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                    <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                </div>
                <div
                    class="relative z-10 inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-purple-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                </div>
                <div class="flex-grow pl-4 text-sm">
                    <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-500 dark:text-gray-300 font-semibold">STEP
                        1</h2>
                    <p class="font-laonoto leading-relaxed pb-3">
                        To invite multiple users at once, you can upload a CSV (comma-separated values) file
                        containing their information <br />
                        <b>Please download our template.</b>
                    </p>
                    <button type="button" id="csv_template_download" name="csv_template_download" onclick="downloadExcelInvitationTemplate()"
                            class="px-5 py-1.5 relative rounded group overflow-hidden font-medium text-purple-50 bg-purple-500 dark:bg-purple-500 inline-block ">
                        <span
                            class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-purple-400 dark:bg-purple-400 group-hover:h-full opacity-90"></span>
                        <span class="relative group-hover:text-white">
                            <div class="flex flex-row">
                                <div class="basis-1/4 px-2  text-base"> Template</div>
                                <div class="basis-1/4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                </div>
                            </div>
                        </span>
                    </button>
                </div>
            </div>
            <div class="relative flex pb-6">
                <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
                    <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
                </div>
                <div
                    class="relative z-10 inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-purple-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                    </svg>

                </div>
                <div class="flex-grow pl-4 text-sm">
                    <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-500 dark:text-gray-300 font-semibold">STEP
                        2</h2>
                    <p class="font-laonoto leading-relaxed">
                        Once you have the template, please use the first tab labeled "Invitations" to prepare the
                        invitations.<br>
                        In this tab, you'll be prompted to provide the following mandatory data for each
                        employee.<br><br>
                        <i>- Employee Name<br>
                            - Employee’s email address<br>
                            - Designation ID (unique ID assigned to the specific position)<br>
                            - Contract ID (unique ID assigned to a contract type)<br>
                            - Remaining vacation days (information on vacation days available to each
                            employee).<br><br></i>

                        Information on Department ID and Wage are optional and not required to invite new employees.
                    </p>
                    <br>
                    Please note that you can find the Designation ID and Contract ID in their respective tabs labeled
                    "Designations" and "Contracts" <br> in the downloaded template.<br><br>
                    This data is automatically downloaded from the system and is based on the contracts and job
                    designations created earlier.<br>
                    This will ensure that the IDs are accurate and consistent across your system.
                </div>
            </div>
            <div class="relative flex pb-6 text-sm">
                <div
                    class="relative z-10 inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-purple-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>

                </div>
                <div class="flex-grow pl-4">
                    <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-500 dark:text-gray-300 font-semibold">STEP
                        3</h2>
                    <p class="font-laonoto leading-relaxed">
                        To upload the file, select a file and drop it in the designated field after that click on the
                        "Upload" button to invite the users.
                    </p>
                </div>
            </div>
        </div>

        <form autocomplete="off" method="POST" action="{{ route('preparation.invitations.import') }}"
              class="flex justify-center">
            @csrf
            <div class="grid grid-rows-2 grid-cols-1 grid-flow-col gap-4 w-3/4">
                <div class="w-full overflow-x-hidden">
                    <div class="flex flex-col flex-grow">
                        <div x-data="{ files: null }"
                             class="hover:bg-gray-100 dark:hover:bg-dark-eval-3 block w-full py-1 px-3 relative dark:bg-dark-eval-2 appearance-none border-2 dark:border-gray-600 border-gray-300 border-solid rounded-md hover:shadow-outline-gray">
                            <input type="file" id="InvitationFileUpload"
                                   accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                   onchange="showUploadButton()"
                                   class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
                                   x-on:change="files = $event.target.files; console.log($event.target.files);"
                                   x-on:dragover="$el.classList.add('active')"
                                   x-on:dragleave="$el.classList.remove('active')"
                                   x-on:drop="$el.classList.remove('active')">
                            <template x-if="files !== null">
                                <div class="flex flex-col">
                                    <template x-for="(_,index) in Array.from({ length: files.length })">
                                        <div class="flex flex-row items-center space-x-2">
                                            <template x-if="files[index].type.includes('audio/')"><i
                                                    class="far fa-file-audio fa-fw"></i></template>
                                            <template x-if="files[index].type.includes('application/')"><i
                                                    class="far fa-file-alt fa-fw"></i></template>
                                            <template x-if="files[index].type.includes('image/')"><i
                                                    class="far fa-file-image fa-fw"></i></template>
                                            <template x-if="files[index].type.includes('video/')"><i
                                                    class="far fa-file-video fa-fw"></i></template>
                                            <span class="font-medium dark:text-gray-400 text-gray-600"
                                                  x-text="files[index].name">Uploading</span>
                                            <span class="text-xs self-end text-gray-500"
                                                  x-text="filesize(files[index].size)">...</span>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="files === null">
                                <div class="flex flex-col space-y-2 h-36 items-center justify-center">
                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span>
                                        or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">.CSV .XLSX Files</p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="flex items-baseline justify-center">
                    <button type="button" id="invitationsUploadButton" name="invitationsUploadButton"
                            style="display:none;"
                            class="px-5 py-1 relative rounded group overflow-hidden font-medium text-purple-50 bg-purple-500 dark:bg-purple-500 inline-block">
                        <span
                            class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-purple-400 dark:bg-purple-400 group-hover:h-full opacity-90"></span>
                        <span class="relative group-hover:text-white">
                            <div class="flex flex-row">
                                <div class="basis-1/4 px-4 py-1 text-lg">Upload</div>
                                <div class="basis-1/4 py-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                </div>
                            </div>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
    let fileInput = document.getElementById('InvitationFileUpload');

    function showUploadButton() {
        if (fileInput.files == null || fileInput.files.length === 0) {
            document.getElementById("invitationsUploadButton").style.display = "none";
        } else {
            document.getElementById("invitationsUploadButton").style.display = "block";
        }
    }

    let downloadExcelInvitationTemplate = () => {
        axios({
            method: 'get',
            url: '/invitations/template/download',
            responseType: 'blob'
        })
            .then(function (response) {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'InvitationsTemplate.xlsx');
                document.body.appendChild(link);
                link.click();
            });
    }

</script>
