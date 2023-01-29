<x-app-layout>
    <x-slot name="header" class="p-2">

    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form autocomplete="off">
            <caption class="text-xl font-bold text-left text-gray-900 bg-white dark:text-white dark:bg-dark-eval-1">
                <p class="text-xl font-semibold">
                    Create a Contract Type
                </p>

                <div class="py-3">

                </div>
            <div class="mb-6">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contract Type</label>
                <input type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Full-Time" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hours/Week</label>
                <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="38,5" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Min. Shift Length</label>
                <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="8" required>
            </div>
            <td class="px-6 py-4 text-right">
                <div style ="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end">
                    <a href="#_" class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-600 text-purple-50 inline-block">
                        <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-green-500 group-hover:h-full opacity-90"></span>
                        <span class="relative group-hover:text-white">Submit</span>
                    </a>
                </div>
        </form>
    </div>

</x-app-layout>
