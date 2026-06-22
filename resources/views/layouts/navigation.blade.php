<nav x-data="{ open: false }"
class="bg-white shadow-lg border-b-4 border-blue-900">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white">
        <div class="flex justify-between h-16">

            <div class="flex">

                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    <img
                        src="{{ asset('images/logo-kominfo.png') }}"
                        alt="Logo Kominfo"
                        class="h-16 w-auto"
                    >
                </div>

                {{-- Menu Desktop --}}
                <div class="hidden sm:flex sm:items-center sm:ms-10 space-x-8">

                    <x-nav-link
                        :href="url('/dashboard')"
                        :active="request()->is('dashboard')"
                    >
                        Dashboard
                    </x-nav-link>

                    @if(Auth::user()->role == 'admin')

                        <x-nav-link
                            :href="url('/employees')"
                            :active="request()->is('employees')"
                        >
                            Input Nilai
                        </x-nav-link>

                        <x-nav-link
                            :href="url('/kriteria')"
                            :active="request()->is('kriteria')"
                        >
                            Kriteria
                        </x-nav-link>

                        <x-nav-link
                            :href="url('/mfep')"
                            :active="request()->is('mfep')"
                        >
                            Sistem MFEP
                        </x-nav-link>

                    @endif

                    <x-nav-link
                        :href="url('/perankingan')"
                        :active="request()->is('perankingan')"
                    >
                        Perankingan
                    </x-nav-link>

                </div>

            </div>

            {{-- Dropdown User --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button

                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-800 to-cyan-500 text-white font-semibold rounded-xl shadow-lg hover:scale-105 transition"
                        >

                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg
                                    class="fill-current h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();"
                            >
                                Log Out
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                >

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </div>

        </div>
    </div>

    {{-- Responsive Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link
                :href="url('/dashboard')"
                :active="request()->is('dashboard')"
            >
                Dashboard
            </x-responsive-nav-link>

            @if(Auth::user()->role == 'admin')

                <x-responsive-nav-link
                    :href="url('/employees')"
                    :active="request()->is('employees')"
                >
                    Input Nilai
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="url('/kriteria')"
                    :active="request()->is('kriteria')"
                >
                    Kriteria
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="url('/mfep')"
                    :active="request()->is('mfep')"
                >
                    Sistem MFEP
                </x-responsive-nav-link>

            @endif

            <x-responsive-nav-link
                :href="url('/perankingan')"
                :active="request()->is('perankingan')"
            >
                Perankingan
            </x-responsive-nav-link>

        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">

            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();"
                    >
                        Log Out
                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>