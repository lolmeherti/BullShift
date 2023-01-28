<x-app-layout>
    <x-slot name="header" class="p-2">

    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg flex items-stretch">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

            <caption class="p-5 text-xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-dark-eval-1">
                Contract Types
                <div class="grid grid-cols-2">

                    <div id="paragraph" class="col-start-1 col-end-2">
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Create and manage employment contracts.</p>
                    </div>

                    <div style ="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="#_" class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-700 text-purple-50 inline-block">
                            <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-green-600 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">New</span>
                        </a>
                        </div>
                </div>

            </caption>
            <thead class="text-sm text-gray-100 uppercase bg-neutral-700 dark:bg-gray-700 dark:text-gray-200">
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
            <tr class="bg-white border-b dark:bg-dark-eval-1 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-opacity-70 hover:bg-gray-100  hover:bg-opacity-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap dark:text-white">
                    Full-Time
                </th>
                <td class="px-6 py-4">
                    38,5
                </td>
                <td class="px-6 py-4">
                    21
                </td>

                <td class="px-6 py-4 text-right">
                    <div style ="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="#_" class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-yellow-600 text-purple-50 inline-block">
                            <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-yellow-500 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">Edit</span>
                        </a>
                        <a href="#_" class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-red-600 text-purple-50 inline-block">
                            <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-red-400 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">Delete</span>
                        </a>
                    </div>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-dark-eval-1 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-opacity-70 hover:bg-gray-100  hover:bg-opacity-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap dark:text-white">
                    Part-Time
                </th>
                <td class="px-6 py-4">
                    25
                </td>
                <td class="px-6 py-4">
                    15
                </td>

                <td class="px-6 py-4 text-right">
                    <div style ="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="#_" class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-yellow-600 text-purple-50 inline-block">
                            <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-yellow-500 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">Edit</span>
                        </a>
                        <a href="#_" class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-red-600 text-purple-50 inline-block">
                            <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-red-400 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">Delete</span>
                        </a>
                    </div>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-dark-eval-1 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-opacity-70 hover:bg-gray-100  hover:bg-opacity-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap dark:text-white">
                    Custom A
                </th>
                <td class="px-6 py-4">
                    33
                </td>
                <td class="px-6 py-4">
                    4
                </td>
                <td class="px-6 py-4 text-right">
                    <div style ="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                        <a href="#_" class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-yellow-600 text-purple-50 inline-block">
                            <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-yellow-500 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">Edit</span>
                        </a>
                        <a href="#_" class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-red-600 text-purple-50 inline-block">
                            <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-red-400 group-hover:h-full opacity-90"></span>
                            <span class="relative group-hover:text-white">Delete</span>
                        </a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</x-app-layout>
