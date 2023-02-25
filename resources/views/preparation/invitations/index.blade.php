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

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex items-stretch">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <caption
                class="p-5 text-xl font-semibold text-left bg-gray-50 dark:bg-dark-eval-1 dark:text-white text-gray-900">
                Invitations
                <div class="grid grid-cols-2">

                    <div id="paragraph" class="col-start-1 col-end-2">
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Create and manage
                            your invitations.</p>
                    </div>
                    <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
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
                    Invitation Sent
                </th>

                <th scope="col" class="px-6 py-3">
                    EMAIL
                </th>

                <th scope="col" class="px-6 py-3">
                    Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Designation
                </th>

                <th scope="col" class="px-6 py-3">
                    Date Sent
                </th>

                <th scope="col" class="px-6 py-3">

                </th>
            </tr>
            </thead>
            <tbody>
            {{--            @foreach($designations as $designation)--}}
            <tr class="bg-gray-50 border-b dark:bg-dark-eval-1 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-opacity-70 hover:bg-gray-100  hover:bg-opacity-50"
                id="table_row_id{{"designation->id"}}">

                <th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap dark:text-white">
                    {{"Some User"}}
                </th>

                <td class="px-6 py-4">
                    {{"user@email.com"}}
                </td>

                <td class="px-6 py-4 text-green-500" style="font-weight:bold;">
                    Verified
                </td>

                <td class="px-6 py-4">
                    {{"Clown"}}
                </td>

                <td class="px-6 py-4">
                    {{"19/Feb/2023"}}
                </td>

                <td class="px-6 py-4 text-right">
                    <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="#" id="delete"
                           onclick="revokeInvitation()"
                           class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-purple-500 dark:bg-red-500 text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-purple-400 dark:bg-red-400 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">Revoke</span>
                        </a>
                    </div>
                </td>

            </tr>
            <tr class="bg-gray-50 border-b dark:bg-dark-eval-1 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-opacity-70 hover:bg-gray-100  hover:bg-opacity-50"
                id="table_row_id{{"designation->id"}}">

                <th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap dark:text-white">
                    {{"Some User"}}
                </th>

                <td class="px-6 py-4">
                    {{"user@email.com"}}
                </td>

                <td class="px-6 py-4 text-gray-400 dark:text-gray-400" style="font-weight:bold;">
                        Pending
                </td>

                <td class="px-6 py-4">
                    {{"Clown"}}
                </td>

                <td class="px-6 py-4">
                    {{"19/Feb/2023"}}
                </td>

                <td class="px-6 py-4 text-right">
                    <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="#" id="delete"
                           onclick="revokeInvitation()"
                           class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-purple-500 dark:bg-red-500 text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-purple-400 dark:bg-red-400 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">Revoke</span>
                        </a>
                    </div>
                </td>

            </tr>

            <tr class="bg-gray-50 border-b dark:bg-dark-eval-1 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-opacity-70 hover:bg-gray-100  hover:bg-opacity-50"
                id="table_row_id{{"designation->id"}}">

                <th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap dark:text-white">
                    {{"Some User"}}
                </th>

                <td class="px-6 py-4">
                    {{"user@email.com"}}
                </td>

                <td class="px-6 py-4 text-red-500" style="font-weight:bold;">
                   Expired
                </td>

                <td class="px-6 py-4">
                    {{"Clown"}}
                </td>

                <td class="px-6 py-4">
                    {{"19/Feb/2023"}}
                </td>

                <td class="px-6 py-4 text-right">
                    <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="#" id="delete"
                           onclick="revokeInvitation()"
                           class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-purple-500 dark:bg-red-500 text-purple-50 inline-block">
                                <span
                                    class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-purple-400 dark:bg-red-400 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">Revoke</span>
                        </a>
                    </div>
                </td>

            </tr>
            {{--            @endforeach--}}
            </tbody>
        </table>
    </div>

</x-app-layout>
