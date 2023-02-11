<x-app-layout>

    <x-slot name="header" class="p-2">

    </x-slot>

    @php
        $normalFormInputTheme = 'border dark:bg-gray-700 dark:border-gray-600 border-gray-300 dark:text-white bg-gray-100 dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500 focus:ring-purple-500 focus:border-purple-500 text-gray-900';
        $alertFormInputTheme = 'border bg-red-100 text-gray-700 border-red-300 dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500 focus:ring-purple-500 focus:border-purple-500 text-gray-900';
    @endphp

    <div class="bg-gray-50 dark:bg-dark-eval-1 p-6 overflow-hidden rounded-md shadow-md ">
        <form autocomplete="off" method="POST" action="{{route('preparation.designations.store')}}">
            @csrf
            <caption class="text-gray-900 dark:text-white bg-gray-50 dark:bg-dark-eval-1 text-xl font-bold text-left">
                <p class="text-xl font-semibold">
                    Create a Job Designation
                @if(session('success'))
                    <p class="text-green-400">{{session('success')}}</p>
                    @endif
                    </p>
            </caption>

            <div class="py-3">

            </div>

            <div class="mb-6">
                <label for="contract_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation <span class="text-gray-600 dark:text-gray-400" style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>
                @if ($errors->has('designation'))
                    <input type="text" id="designation" value="{{old('designation')}}" maxlength="70" name="designation" class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Accountant" required>
                    <span class="text-red-500">{{ $errors->first('designation') }}</span>
                @else
                    <input type="text" id="designation" value="{{old('designation')}}" maxlength="70" name="designation" class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Accountant" required>
                @endif
            </div>

            <div class="mb-6">
                <label for="contract_type_fid" class="text-gray-900 dark:text-white block mb-2 text-sm font-medium">Contract Type <span class="text-gray-600 dark:text-gray-400" style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>
                @if ($errors->has('contract_type_fid'))
                    <select id="contract_type_fid" name="contract_type_fid" class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5">
                        <option selected >Select</option>
                        @foreach($contractTypes as $contract)
                            <option value="{{$contract->id}}">{{$contract->contract_type}}</option>
                        @endforeach
                    </select>
                @else
                    <select id="contract_type_fid" name="contract_type_fid" class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5">
                        <option selected value="">Select</option>
                        @foreach($contractTypes as $contract)
                            <option value="{{$contract->id}}">{{$contract->contract_type}}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            <td class="px-6 py-4 text-right">
                <div style ="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end py-4">
                    <button type="submit" class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-700 text-purple-50 inline-block">
                        <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-green-600 group-hover:h-full opacity-90"></span>
                        <span class="relative group-hover:text-white">Submit</span>
                    </button>
                </div>
            </td>

        </form>
    </div>
</x-app-layout>


