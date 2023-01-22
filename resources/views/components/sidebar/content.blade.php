<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>
    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')">

        <x-slot name="icon">
            <x-heroicon-o-home class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

    </x-sidebar.link>

    <x-sidebar.dropdown
        title="Management"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-clarity-administrator-line class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Contracts"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
        <x-sidebar.sublink
            title="Designations"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')"
        />
        <x-sidebar.sublink
            title="Invitations"
            href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')"
        />
    </x-sidebar.dropdown>

{{--    <x-sidebar.dropdown--}}
{{--        title="Management"--}}
{{--        :active="Str::startsWith(request()->route()->uri(), 'buttons')"--}}
{{--    >--}}
{{--        <x-slot name="icon">--}}
{{--            <x-clarity-administrator-line class="flex-shrink-0 w-6 h-6" aria-hidden="true" />--}}
{{--        </x-slot>--}}

{{--        <x-sidebar.sublink--}}
{{--            title="Contracts"--}}
{{--            href="#"--}}
{{--        />--}}

{{--        <x-sidebar.sublink--}}
{{--            title="Nuttons2"--}}
{{--            href="#"--}}
{{--        />--}}

{{--        <x-sidebar.sublink--}}
{{--            title="Nuttons3"--}}
{{--            href="#"--}}
{{--        />--}}

{{--    </x-sidebar.dropdown>--}}

    <x-sidebar.dropdown
        title="Nuttons"

    >
        <x-sidebar.sublink
            title="Nuttons1"
            href="#"
        />

        <x-sidebar.sublink
            title="Nuttons2"
            href="#"
        />

        <x-sidebar.sublink
            title="Nuttons3"
            href="#"
        />

    </x-sidebar.dropdown>

{{--    <div--}}
{{--        x-transition--}}
{{--        x-show="isSidebarOpen || isSidebarHovered"--}}
{{--        class="text-sm text-gray-500"--}}
{{--    >--}}
{{--        Dummy Links--}}
{{--    </div>--}}

{{--    @php--}}
{{--        $links = array_fill(0, 20, '');--}}
{{--    @endphp--}}

{{--    @foreach ($links as $index => $link)--}}
{{--        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />--}}
{{--    @endforeach--}}

</x-perfect-scrollbar>
