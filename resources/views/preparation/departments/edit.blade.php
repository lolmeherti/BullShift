<x-app-layout>

    <x-slot name="header" class="p-2">

    </x-slot>

    @php
        $normalFormInputTheme = 'border dark:bg-gray-700 dark:border-gray-600 border-gray-300 dark:text-white bg-gray-100 dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500 focus:ring-purple-500 focus:border-purple-500 text-gray-900';
        $alertFormInputTheme = 'border bg-red-100 text-gray-700 border-red-300 dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500 focus:ring-purple-500 focus:border-purple-500 text-gray-900';
    @endphp

    <div class="bg-gray-50 dark:bg-dark-eval-1 p-6 overflow-hidden rounded-md shadow-md ">
        <form autocomplete="off" method="POST" action="{{url('/department/'.$department->id.'/update')}}">
            @csrf
            <caption class="text-gray-900 dark:text-white bg-gray-50 dark:bg-dark-eval-1 text-xl font-bold text-left">
                <p class="text-xl font-semibold">
                    Create a Department
                @if(session('success'))
                    <p class="text-green-400">{{session('success')}}</p>
                    @endif
                    </p>
            </caption>

            <div class="py-3">

            </div>

            <input type="hidden" id="manager_user_fid" name="manager_user_fid" value="{{$department->manager_user_fid}}">
            <input type="hidden" name="manager_name" id="manager_name" value="{{$department->manager_name}}">

            <div class="mb-6">
                <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department
                    <span class="text-gray-600 dark:text-gray-400"
                          style="font-style: italic; font-size:0.8em">{{ "(required)" }}</span></label>
                @if ($errors->has('department'))
                    <input type="text" id="department" value="{{$department->department}}" maxlength="70" name="department"
                           class="{{$alertFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Sales" required>
                    <span class="text-red-500">{{ $errors->first('department') }}</span>
                @else
                    <input type="text" id="department" value="{{$department->department}}" maxlength="70" name="department"
                           class="{{$normalFormInputTheme}} text-sm rounded-lg block w-full p-2.5"
                           placeholder="Sales" required>
                @endif
            </div>

            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Manager
                <span class="text-gray-600 dark:text-gray-400"
                      style="font-style: italic; font-size:0.8em">{{ "(optional)" }}</span></label>
            <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" data-dropdown-placement="right-end" data-dropdown-offset-skidding="215" class="text-white bg-purple-500 hover:bg-purple-400  focus:outline-none font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-purple-500 dark:hover:bg-purple-500" type="button"><span id="manager_name_display">{{$department->manager_name}}</span> <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

            <!-- Dropdown menu -->
            <div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700 border border-gray-400">
                <div class="p-3">
                    <label for="input-group-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="text" id="input-group-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Search user">
                    </div>
                </div>
                <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
                    @foreach($users as $user)
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" onclick="setManagerName('{{$user->name}}', {{$user->id}})">
                                <img class="w-6 h-6 mr-2 rounded-full" src="{{asset('images/1676204359.jpg')}}" alt="profile_picture_{{$user->name}}">
                                {{$user->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a href="#" class="flex items-center p-3 text-sm font-medium text-purple-500 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white hover:underline">
                    <svg class="w-5 h-5 mr-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
                    Invite Manager
                </a>
            </div>

            <div class="h-8">

            </div>

            <div style="justify-self: end;" id="button" class="col-start-2 col-end-3 justify-items-end py-4">
                <button type="submit"
                        class="px-5 py-1.5 relative rounded group overflow-hidden font-medium bg-green-700 text-purple-50 inline-block">
                    <span
                        class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-green-600 group-hover:h-full opacity-90"></span>
                    <span class="relative group-hover:text-white">Submit</span>
                </button>
            </div>

        </form>
    </div>
</x-app-layout>

<script>
    let setManagerName = (name, id) =>
    {
        document.getElementById('manager_user_fid').value = id;
        document.getElementById('manager_name').value = name;
        document.getElementById('manager_name_display').innerHTML = name;
    }
</script>


