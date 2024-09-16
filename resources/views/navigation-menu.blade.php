<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden space-x-8 sm:flex sm:items-center">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>

                <x-nav-link href="{{ route('admin.companies') }}" :active="request()->routeIs('admin.companies')">
                    {{ __('Companies') }}
                </x-nav-link>

                <x-nav-link href="{{ route('admin.convocatorias') }}" :active="request()->routeIs('admin.convocatorias')">
                    {{ __('Convocatorias') }}
                </x-nav-link>

                <x-nav-link href="{{ route('admin.students') }}" :active="request()->routeIs('admin.students')">
                    {{ __('Students') }}
                </x-nav-link>

                <x-nav-link href="{{ route('admin.applications') }}" :active="request()->routeIs('admin.applications')">
                    {{ __('Applications') }}
                </x-nav-link>

                <x-nav-link href="{{ route('admin.company-registrations') }}" :active="request()->routeIs('admin.company-registrations')">
                    {{ __('Company Registrations') }}
                </x-nav-link>

                <!-- Additional Links -->
                <x-nav-link href="{{ route('admin.student-company') }}" :active="request()->routeIs('admin.student-company')">
                    {{ __('Student-Company') }}
                </x-nav-link>

                <x-nav-link href="{{ route('admin.company-review') }}" :active="request()->routeIs('admin.company-review')">
                    {{ __('Company Review') }}
                </x-nav-link>
                <x-nav-link href="{{ route('admin.work-hours') }}" :active="request()->routeIs('admin.work-hours')">
                    {{ __('work-hours ') }}
                </x-nav-link>

                <!-- Links for users with certain permissions -->
                @can('Listar estudiantes')
                    <x-nav-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
                        {{ __('Users') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('admin.inductions') }}" :active="request()->routeIs('admin.inductions')">
                        {{ __('Organize Induction') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('admin.competitors') }}" :active="request()->routeIs('admin.competitors')">
                        {{ __('Run Induction') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('admin.evaluation') }}" :active="request()->routeIs('admin.evaluation')">
                        {{ __('Performance Evaluation') }}
                    </x-nav-link>
                @endcan

                <x-nav-link href="{{ route('admin.userinduction') }}" :active="request()->routeIs('admin.userinduction')">
                    {{ __('View Induction') }}
                </x-nav-link>

                <x-nav-link href="{{ route('admin.coordis') }}" :active="request()->routeIs('admin.coordis')">
                    {{ __('Supervisor Management') }}
                </x-nav-link>

                <x-nav-link href="{{ route('admin.criterias') }}" :active="request()->routeIs('admin.criterias')">
                    {{ __('Evaluation Criteria') }}
                </x-nav-link>
            </div>

            <!-- User Menu (Desktop) -->
            <div class="hidden sm:flex sm:items-center">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                        {{ __('Log Out') }}
                    </button>
                </form>

                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{ Auth::user()->currentTeam->name }}
                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>
                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}
                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif
                            <div class="border-t border-gray-200"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" @click.away="open = false" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('admin.companies') }}" :active="request()->routeIs('admin.companies')">
                {{ __('Companies') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('admin.convocatorias') }}" :active="request()->routeIs('admin.convocatorias')">
                {{ __('Convocatorias') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('admin.students') }}" :active="request()->routeIs('admin.students')">
                {{ __('Students') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('admin.applications') }}" :active="request()->routeIs('admin.applications')">
                {{ __('Applications') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('admin.company-registrations') }}" :active="request()->routeIs('admin.company-registrations')">
                {{ __('Company Registrations') }}
            </x-responsive-nav-link>

            <!-- Additional Links -->
            <x-responsive-nav-link href="{{ route('admin.student-company') }}" :active="request()->routeIs('admin.student-company')">
                {{ __('Student-Company') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('admin.company-review') }}" :active="request()->routeIs('admin.company-review')">
                {{ __('Company Review') }}
            </x-responsive-nav-link>


            <!-- Links for users with certain permissions -->
            @can('Listar estudiantes')
                <x-responsive-nav-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
                    {{ __('Users') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('admin.inductions') }}" :active="request()->routeIs('admin.inductions')">
                    {{ __('Organize Induction') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('admin.competitors') }}" :active="request()->routeIs('admin.competitors')">
                    {{ __('Run Induction') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('admin.evaluation') }}" :active="request()->routeIs('admin.evaluation')">
                    {{ __('Performance Evaluation') }}
                </x-responsive-nav-link>
            @endcan

            <x-responsive-nav-link href="{{ route('admin.userinduction') }}" :active="request()->routeIs('admin.userinduction')">
                {{ __('View Induction') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('admin.coordis') }}" :active="request()->routeIs('admin.coordis')">
                {{ __('Supervisor Management') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('admin.criterias') }}" :active="request()->routeIs('admin.criterias')">
                {{ __('Evaluation Criteria') }}
            </x-responsive-nav-link>
        </div>

        <!-- Mobile User Menu -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex items-center space-x-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens') }}">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
