<x-app-layout>

    <x-slot name="header" class="p-2">

    </x-slot>

    @php
        $normalFormInputTheme = 'border dark:bg-gray-700 dark:border-gray-600 border-gray-300 dark:text-white bg-gray-100 dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500 focus:ring-purple-500 focus:border-purple-500 text-gray-900';
        $alertFormInputTheme = 'border bg-red-100 text-gray-700 border-red-300 dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500 focus:ring-purple-500 focus:border-purple-500 text-gray-900';
    @endphp

    <div class="p-6 overflow-hidden bg-gray-50 dark:bg-dark-eval-1 rounded-md shadow-md">
        <form autocomplete="off" method="POST" action="{{route('preparation.contracts.store')}}">
            @csrf
            <caption class="text-gray-900 dark:text-white bg-gray-50 dark:bg-dark-eval-1 text-xl font-bold text-left">
                <p class="text-xl font-semibold">
                    Create a Contract Type
                @if(session('success'))
                    <p class="text-green-400">{{session('success')}}</p>
                    @endif
                </p>
            </caption>
                <div class="py-3">

                </div>

            <div class="mb-6">
                <label for="contract_type" class="text-gray-900 dark:text-white block mb-2 text-sm font-medium">Contract Type
                    <span class="text-gray-600 dark:text-gray-400"
                          style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>

                @if ($errors->has('contract_type'))
                    <input type="text" id="contract_type" value="{{old('contract_type')}}" maxlength="70" name="contract_type" class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Full-Time" required>
                    <span class="text-red-500">{{ $errors->first('contract_type') }}</span>
                @else
                    <input type="text" id="contract_type" value="{{old('contract_type')}}" maxlength="70" name="contract_type" class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Full-Time" required>
                @endif
            </div>

            <div class="mb-6">
                <label for="hours_per_week" class="text-gray-900 dark:text-white block mb-2 text-sm font-medium">Hours/Week <span class="text-gray-600 dark:text-gray-400" style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>
                @if ($errors->has('hours_per_week'))
                    <input type="number" value="{{old('hours_per_week')}}" max="120" step="0.01" id="hours_per_week" name="hours_per_week" class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="38.5" required>
                    <span class="text-red-500">{{ $errors->first('hours_per_week') }}</span>
                @else
                    <input type="number" value="{{old('hours_per_week')}}" max="120" step="0.01" id="hours_per_week" name="hours_per_week" class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="38.5" required>
                @endif
            </div>

            <div class="mb-6">
                <label for="min_shift_length" class="text-gray-900 dark:text-white block mb-2 text-sm font-medium">Min. Shift Length <span class="text-gray-600 dark:text-gray-400" style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>
                @if ($errors->has('min_shift_length'))
                    <input type="number" value="{{old('min_shift_length')}}" min="1" max="48" id="min_shift_length"  name="min_shift_length" class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="8" required>
                    <span class="text-red-500">{{ $errors->first('min_shift_length') }}</span>
                @else
                    <input type="number" value="{{old('min_shift_length')}}" min="1" max="48" id="min_shift_length" name="min_shift_length" class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="8" required>
                @endif
            </div>

            <div class="mb-6">
                <label for="days_of_vacation_per_year" class="text-gray-900 dark:text-white block mb-2 text-sm font-medium">Vacation Days/Year <span class="text-gray-600 dark:text-gray-400" style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>
                @if ($errors->has('days_of_vacation_per_year'))
                    <input type="number" value="{{old('days_of_vacation_per_year')}}" id="days_of_vacation_per_year" name="days_of_vacation_per_year" class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="8" required>
                    <span class="text-red-500">{{ $errors->first('days_of_vacation_per_year') }}</span>
                @else
                    <input type="number" value="{{old('days_of_vacation_per_year')}}" id="days_of_vacation_per_year" name="days_of_vacation_per_year" class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="26" required>
                @endif
            </div>

            <div class="mb-6">
                <label for="break_length" class="text-gray-900 dark:text-white block mb-2 text-sm font-medium">Break Length per Shift <span class="text-gray-600 dark:text-gray-400" style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>
                @if ($errors->has('break_length'))
                    <input type="number" value="{{old('break_length')}}" id="break_length" name="break_length" class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Minutes" required>
                    <span class="text-red-500">{{ $errors->first('break_length') }}</span>
                @else
                    <input type="number" value="{{old('break_length')}}" id="break_length" name="break_length" class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Minutes" required>
                @endif
            </div>

            <label class="relative inline-flex items-center mb-4 cursor-pointer">
                <input type="checkbox" @if (old('break_included') == "on") checked @endif name="break_included" id="break_included" class="sr-only peer">
                <div class="bg-gray-200 dark:bg-gray-700 peer-checked:bg-purple-500 w-11 h-6 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-gray-50 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                <span class="text-gray-900 dark:text-white ml-3 text-sm font-medium">Shift includes break</span>
            </label>

        <td class="px-6 py-4 text-right">
            <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end py-4">
                <button type="submit"
                        class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-600 text-purple-50 inline-block">
                        <span
                            class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-green-500 group-hover:h-full opacity-90"></span>
                    <span class="relative group-hover:text-white">Submit</span>
                </button>
            </div>
        </td>
        </form>
    </div>
</x-app-layout>


