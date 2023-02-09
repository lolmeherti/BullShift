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
        title="Prepare"
        :active="Str::startsWith(request()->route()->uri(), ['contract', 'designation', 'invitation'])"
    >
        <x-slot name="icon">
            <x-clarity-administrator-line class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Contracts"
            href="{{ route('preparation.contracts.index') }}"
            :active="request()->routeIs('preparation.contracts.index')"
        />
        <x-sidebar.sublink
            title="Designations"
            href="{{ route('preparation.designations.index') }}"
            :active="request()->routeIs('preparation.designations.index')"
        />
        <x-sidebar.sublink
            title="Invitations"
            href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')"
        />
    </x-sidebar.dropdown>

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
</x-perfect-scrollbar>
