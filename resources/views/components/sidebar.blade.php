@props(['collapsed' => false])

<aside
    :class="sidebarCollapsed ? 'lg:w-20' : 'lg:w-64'"
    class="fixed inset-y-0 left-0 z-50 bg-white shadow-xl transform transition-all duration-300 ease-in-out lg:translate-x-0 border-r border-gray-100 flex flex-col"
    :class="{ '-translate-x-full': !sidebarOpen }"
    @click.away="sidebarOpen = false">

    <!-- Logo Section -->
    <div class="flex items-center justify-between h-20 px-4 mb-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 transition-all duration-300" :class="sidebarCollapsed ? 'justify-center w-full' : ''">
            <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="w-12 h-12 object-contain" />
            <div x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0" class="flex flex-col">
                <span class="text-sm font-black text-bnhs-blue leading-tight tracking-tight">BNHS</span>
                <span class="text-xs font-medium text-gray-500 uppercase tracking-widest leading-none">eDocument</span>
            </div>
        </a>
    </div>

    <!-- User Profile Section (Moved from Header) -->
    <div class="px-4 py-4 mb-4" x-show="!sidebarCollapsed" x-transition>
        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 shadow-sm transition-all hover:shadow-md">
            <div class="flex flex-col items-center text-center">
                <div class="relative mb-3">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-bnhs-blue to-blue-600 text-white flex items-center justify-center font-bold text-xl shadow-lg transform -rotate-3 hover:rotate-0 transition duration-300">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                </div>
                <h3 class="text-sm font-bold text-gray-900 truncate w-full">{{ Auth::user()->name }}</h3>
                <div class="flex items-center gap-1.5 mt-1">
                    @if(Auth::user()->role === 'admin')
                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-md bg-purple-100 text-purple-700 border border-purple-200">Admin</span>
                    @elseif(Auth::user()->role === 'registrar')
                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-md bg-blue-100 text-blue-700 border border-blue-200">Registrar</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Collapsed User Avatar -->
    <div class="px-4 mb-4 flex justify-center" x-show="sidebarCollapsed" x-transition>
        <div class="w-12 h-12 rounded-xl bg-bnhs-blue text-white flex items-center justify-center font-bold text-sm shadow-md">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 space-y-1.5 overflow-y-auto custom-scrollbar">
        @php
        $navItems = [
        ['route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Dashboard', 'active' => request()->routeIs('admin.dashboard') || request()->routeIs('dashboard')],
        ['route' => 'admin.requests.index', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'label' => 'Requests', 'active' => request()->routeIs('admin.requests.*'), 'roles' => ['admin', 'registrar']],
        ['route' => 'admin.users.index', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'label' => 'Users', 'active' => request()->routeIs('admin.users.*'), 'roles' => ['admin']],
        ['route' => 'admin.document-types.index', 'icon' => 'M7 21H17A2 2 0 0019 19V9.414a1 1 0 00-.293-.707L13.293 3.293A1 1 0 0012.586 3H7a2 2 0 00-2 2V19a2 2 0 002 2z', 'label' => 'Doc Types', 'active' => request()->routeIs('admin.document-types.*'), 'roles' => ['admin']],
        ['route' => 'admin.logs.index', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Timeline', 'active' => request()->routeIs('admin.logs.*'), 'roles' => ['admin']],
        ['route' => 'admin.settings', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z', 'label' => 'Settings', 'active' => request()->routeIs('admin.settings'), 'roles' => ['admin']],
        ];
        @endphp

        @foreach($navItems as $item)
        @if(!isset($item['roles']) || in_array(Auth::user()->role, $item['roles']))
        <a
            href="{{ route($item['route']) }}"
            wire:navigate
            class="group flex items-center gap-3 px-3 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200 {{ $item['active'] ? 'bg-bnhs-blue text-white shadow-md shadow-blue-200' : 'text-gray-600 hover:bg-gray-50 hover:text-bnhs-blue' }}"
            :title="sidebarCollapsed ? '{{ $item['label'] }}' : ''">
            <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
            </svg>
            <span x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0" class="truncate">{{ $item['label'] }}</span>
        </a>
        @endif
        @endforeach
    </nav>

    <!-- Bottom Actions -->
    <div class="px-3 py-4 border-t border-gray-100 mt-auto space-y-1">
        <a href="{{ route('profile.edit') }}"
            class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-gray-600 rounded-xl hover:bg-gray-50 hover:text-bnhs-blue transition-all group"
            :title="sidebarCollapsed ? 'Profile' : ''">
            <svg class="w-5 h-5 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span x-show="!sidebarCollapsed" x-transition>Profile</span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-red-500 rounded-xl hover:bg-red-50 transition-all group"
                :title="sidebarCollapsed ? 'Logout' : ''">
                <svg class="w-5 h-5 flex-shrink-0 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span x-show="!sidebarCollapsed" x-transition>Logout</span>
            </button>
        </form>

        <!-- Sidebar Toggle (Desktop) -->
        <button
            @click="toggleSidebar()"
            class="hidden lg:flex mt-4 items-center justify-center w-full p-2 text-gray-400 hover:text-bnhs-blue transition-colors">
            <svg class="w-6 h-6 transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>
    </div>
</aside>