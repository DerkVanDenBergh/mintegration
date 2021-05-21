<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        @stack('scripts')
        
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            
            @auth
                <div class="flex flex-wrap bg-gray-100 w-full h-screen">
                    <div class="w-3/12 bg-white rounded p-3 shadow-lg">
                        <div class="space-x-4 p-5 text-center">
                            <a href="{{ route('dashboard') }}">
                                <x-miscs.application-logo class="inline-block h-20 w-auto fill-current" />
                                <div class="block align-middle mt-3">
                                    <h4 class="w-full font-semibold text-lg text-gray-700 capitalize font-poppins tracking-wide">{{ Auth::user()->name }}</h4>
                                    <span class="w-full text-sm tracking-wide space-x-1 text-gray-600">
                                        {{ Auth::user()->email }}
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-start-2 col-span-3 border-b border-gray-400 m-5 mb-7 mt-2"></div>
                        </div>
                        <ul class="space-y-2 text-sm">
                            <li>
                                <x-nav.nav-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                    <span>
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    <span>Dashboard</span>
                                </x-nav.nav-sidebar-link>
                            </li>
                            <li>
                                <x-nav.nav-sidebar-link :href="route('routes.index')" :active="request()->is('routes*')" >
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </span>
                                    <span>Routes</span>
                                </x-nav.nav-sidebar-link>
                            </li>
                            <li>
                                <x-nav.nav-sidebar-link :href="route('connections.index')" :active="request()->is('connections*')" >
                                    <span>
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <span>Connections</span>
                                </x-nav.nav-sidebar-link>
                            </li>
                            <li>
                                <x-nav.nav-sidebar-link :href="route('models.index')" :active="request()->is('models*')">
                                    <span>
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </span>
                                    <span>Models</span>
                                </x-nav.nav-sidebar-link>
                            </li>
                            <li>
                                <x-nav.nav-sidebar-link :href="route('authentications.index')" :active="request()->is('authentications*')" >
                                    <span>
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>
                                    <span>Authentications</span>
                                </x-nav.nav-sidebar-link>
                            </li>
                            @can('manage')
                                <li>
                                    <x-nav.nav-sidebar-link :href="route('manage')" :active="request()->routeIs('manage')" >
                                        <span>
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                            </svg>
                                        </span>
                                        <span>Manage</span>
                                    </x-nav.nav-sidebar-link>
                                </li>
                            @endcan
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-nav.nav-sidebar-link :href="route('logout')" :active="request()->routeIs('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <span>
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                        </span>
                                        <span>Logout</span>
                                    </x-nav.nav-sidebar-link>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <div class="w-9/12 h-screen overflow-y-scroll pt-10 grid grid-cols-6 gap-4">

                        <div class="col-start-2 col-span-4">
                            <h2 class="font-semibold text-3xl text-gray-800 leading-tight pb-4">
                                {{ $header }}
                            </h2>


                            <!-- Page Content -->
                            <main class="pb-12">
                                {{ $slot }}
                            </main>
                        </div>
                    </div>
                @endauth

                @guest
                    @include('layouts.navigation', ['header' => $header])
                    
                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                @endguest
            </div>
        </div>
        <div id="notifications" class="fixed bottom-10 right-10">
            <x-session.session-checker></x-session.session-checker>
        </div>
        @yield('page-scripts')
    </body>
</html>
