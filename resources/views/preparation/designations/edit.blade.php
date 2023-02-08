<x-app-layout>

    <x-slot name="header" class="p-2">

    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form autocomplete="off" method="POST" action="{{url('/designation/'.$jobDesignation->id.'/update')}}">
            @csrf
            <caption class="text-xl font-bold text-left text-gray-900 bg-white dark:text-white dark:bg-dark-eval-1">
                <p class="text-xl font-semibold">
                    Edit a Job Designation
                @if(session('success'))
                    <p class="text-green-400">{{session('success')}}</p>
                    @endif
                    </p>
            </caption>
            <div class="py-3">

            </div>
            <div class="mb-6">
                <label for="contract_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation
                    <span class="text-gray-600 dark:text-gray-400"
                          style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>

                @if ($errors->has('designation'))
                    <input type="text" id="designation" value="{{old('designation')}}" maxlength="70" name="designation"
                           class="bg-red-100 border border-red-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-red-200 dark:border-red-500 dark:placeholder-gray-400 dark:text-gray-600 dark:focus:ring-purple-500 dark:focus:border-purple-500"
                           placeholder="Full-Time" required>
                    <span class="text-red-500">{{ $errors->first('designation') }}</span>
                @else
                    <input type="text" id="designation" value="{{$jobDesignation->designation}}" maxlength="70"
                           name="designation"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                           placeholder="Accountant" required>
                @endif
            </div>

            <div class="mb-6">
                <label for="contract_type_fid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contract
                    Type <span class="text-gray-600 dark:text-gray-400"
                               style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>

                @if ($errors->has('contract_type_fid'))
                    <select id="contract_type_fid" name="contract_type_fid"
                            class="bg-red-100 border border-red-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-red-200 dark:border-red-500 dark:placeholder-gray-400 dark:text-gray-600 dark:focus:ring-purple-500 dark:focus:border-purple-500">
                        @foreach($contractTypes as $contract)
                            <option value="{{$contract->id}}">{{$contract->contract_type}}</option>
                        @endforeach
                    </select>
                @else
                    <select id="contract_type_fid" name="contract_type_fid"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
                        @foreach($contractTypes as $contract)
                            <option
                                value="{{$contract->id}}" {{$contract->id == $jobDesignation->contract_type_fid ? "selected" : ""}}>{{$contract->contract_type}}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            <td class="px-6 py-4 text-right">
                <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end py-4">
                    <button type="submit"
                            class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-600 text-purple-50 inline-block">
                        <span
                            class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-green-500 group-hover:h-full opacity-90"></span>
                        <span class="relative group-hover:text-white">Submit</span>
                    </button>
                </div>
        </form>
    </div>
</x-app-layout>


