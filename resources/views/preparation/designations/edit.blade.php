<x-app-layout>

    <x-slot name="header" class="p-2">

    </x-slot>

    @php
        $normalFormInputTheme = 'border dark:bg-gray-700 dark:border-gray-600 border-gray-300 dark:text-white bg-gray-100 dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500 focus:ring-purple-500 focus:border-purple-500 text-gray-900';
        $alertFormInputTheme = 'border bg-red-100 text-gray-700 border-red-300 dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500 focus:ring-purple-500 focus:border-purple-500 text-gray-900';
    @endphp

    <div class="p-6 overflow-hidden bg-gray-50 dark:bg-dark-eval-1 rounded-md shadow-md">
        <form autocomplete="off" method="POST" action="{{url('/designation/'.$jobDesignation->id.'/update')}}">
            @csrf
            <caption class="text-gray-900 dark:text-white bg-gray-50 dark:bg-dark-eval-1 text-xl font-bold text-left">
                <p class="text-xl font-semibold">
                    Editing a Designation

                <ul id="loading_spinner_animated" class="pt-2 hidden">
                    <li class="flex items-center">
                        <svg aria-hidden="true" class="inline w-5 h-5 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-green-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="text-gray-500 bg:text-gray-500">Loading...</span>
                    </li>
                </ul>

                @if(session('success'))
                    <p class="text-green-400">{{session('success')}}</p>
                    @endif
                    </p>
            </caption>
            <div class="py-3">

            </div>
            <div class="mb-6">
                <label for="designation" class="text-gray-900 dark:text-white block mb-2 text-sm font-medium">Designation
                    <span class="text-gray-600 dark:text-gray-400"
                          style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>

                @if ($errors->has('designation'))
                    <input type="text" id="designation" value="{{old('designation')}}" maxlength="70" name="designation"
                           class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Accountant" required>
                    <span class="text-red-500">{{ $errors->first('designation') }}</span>
                @else
                    <input type="text" id="designation" value="{{$jobDesignation->designation}}" maxlength="70"
                           name="designation"
                           class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Accountant" required>
                @endif
            </div>

            <div class="mb-6">
                <label for="contract_type_fid" class="text-gray-900 dark:text-white block mb-2 text-sm font-medium">Contract
                    Type <span class="text-gray-600 dark:text-gray-400"
                               style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>

                @if ($errors->has('contract_type_fid'))
                    <select id="contract_type_fid" name="contract_type_fid"
                            class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5">
                        @foreach($contractTypes as $contract)
                            <option value="{{$contract->id}}">{{$contract->contract_type}}</option>
                        @endforeach
                    </select>
                @else
                    <select id="contract_type_fid" name="contract_type_fid"
                            class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5">
                        @foreach($contractTypes as $contract)
                            <option
                                value="{{$contract->id}}" {{$contract->id == $jobDesignation->contract_type_fid ? "selected" : ""}}>{{$contract->contract_type}}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            <td class="px-6 py-4 text-right">
                <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end py-4">
                    <button type="submit" id="create_button" onclick="showCreatingInProgress()"
                            class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-600 text-purple-50 inline-block">
                        <span id="create_button_highlighted"
                            class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-green-500 group-hover:h-full opacity-90"></span>
                        <span class="relative group-hover:text-white">Submit</span>
                    </button>
                </div>
            </td>
        </form>
    </div>
</x-app-layout>


