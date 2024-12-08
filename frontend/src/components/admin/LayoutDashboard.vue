<template>
    <div class="min-h-screen bg-gray-900 text-gray-100 font-sans">
        <!-- Mobile Menu Button -->
        <button
            @click="isSidebarOpen = !isSidebarOpen"
            class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-800/50 rounded-full backdrop-blur-sm"
        >
            <Menu v-if="!isSidebarOpen" class="w-6 h-6 text-pink-400" />
            <X v-else class="w-6 h-6 text-pink-400" />
        </button>

        <!-- Sidebar -->
        <aside
            :class="[
                'fixed inset-y-0 left-0 z-40 w-64 transition-transform duration-300 ease-in-out transform',
                isSidebarOpen ? 'translate-x-0' : '-translate-x-full',
                'lg:translate-x-0 bg-gray-800/50 backdrop-blur-md',
            ]"
        >
            <div class="p-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-pink-500 to-violet-500 bg-clip-text text-transparent"
                >
                    MythicalClient
                </h1>
            </div>
            <nav class="p-6">
                <div v-for="(menuGroup, index) in menuGroups" :key="index" class="mb-6">
                    <h3 class="text-sm uppercase tracking-wider text-gray-400 mb-4">{{ menuGroup.title }}</h3>
                    <ul class="space-y-2">
                        <li v-for="item in menuGroup.items" :key="item.name">
                            <a
                                :href="item.path"
                                class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 hover:bg-gray-700/50"
                                :class="{ 'bg-gray-700/50': item.active }"
                            >
                                <component :is="item.icon" class="w-5 h-5 mr-3 text-pink-400" />
                                <span>{{ item.name }}</span>
                                <span
                                    v-if="item.count"
                                    class="ml-auto text-xs bg-violet-500 text-white px-2 py-1 rounded-full"
                                >
                                    {{ item.count }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="lg:ml-64 min-h-screen flex flex-col">
            <!-- Top Navigation -->
            <header class="bg-gray-800/50 backdrop-blur-md p-4 flex items-center justify-between">
                <div class="relative w-full max-w-xl">
                    <input
                        v-model="searchQuery"
                        type="search"
                        placeholder="Search..."
                        class="w-full bg-gray-700/50 text-gray-100 placeholder-gray-400 rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-pink-500"
                        @focus="isSearchFocused = true"
                        @blur="handleSearchBlur"
                    />
                    <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" />

                    <!-- Search Results Dropdown -->
                    <div
                        v-if="isSearchFocused && filteredResults.length > 0"
                        class="absolute z-10 w-full mt-2 bg-gray-800/90 backdrop-blur-md rounded-lg shadow-xl max-h-60 overflow-y-auto"
                    >
                        <a
                            v-for="result in filteredResults"
                            :key="result.id"
                            :href="result.path"
                            class="block px-4 py-2 hover:bg-gray-700/50 transition-colors duration-200"
                            @mousedown.prevent="handleResultClick(result)"
                        >
                            {{ result.name }}
                        </a>
                    </div>
                </div>

                <div class="relative ml-4">
                    <button
                        @click="isProfileOpen = !isProfileOpen"
                        class="flex items-center space-x-2 focus:outline-none"
                    >
                        <img :src="Session.getInfo('avatar')" alt="User Avatar" class="w-8 h-8 rounded-full" />
                        <ChevronDown class="w-4 h-4 text-gray-400" :class="{ 'rotate-180': isProfileOpen }" />
                    </button>
                    <div
                        v-if="isProfileOpen"
                        class="absolute right-0 mt-2 w-48 bg-gray-800/90 backdrop-blur-md rounded-lg shadow-xl py-1 animate-fadeIn"
                    >
                        <RouterLink
                            v-for="item in profileMenu"
                            :key="item.name"
                            :to="item.path"
                            class="block px-4 py-2 hover:bg-gray-700/50 transition-colors duration-200"
                        >
                            {{ item.name }}
                        </RouterLink>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-grow p-6 overflow-y-auto">
                <div class="p-3">
                    <slot></slot>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-gray-800/50 backdrop-blur-md py-4 px-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-2 md:mb-0">© 2023 MythicalClient. All rights reserved.</p>
                    <div class="flex space-x-4">
                        <a
                            v-for="link in footerLinks"
                            :key="link.name"
                            :href="link.path"
                            class="text-gray-400 hover:text-pink-400 text-sm transition-colors duration-200"
                        >
                            {{ link.name }}
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import {
    LayoutDashboard,
    Users,
    Settings,
    Key,
    Database,
    HardDrive,
    Search,
    ChevronDown,
    Menu,
    X,
} from 'lucide-vue-next';
import Session from '@/mythicalclient/Session';
import StorageMonitor from '@/mythicalclient/StorageMonitor';
const router = useRouter();

new StorageMonitor();

if (!Session.isSessionValid()) {
    router.push('/auth/login');
}

try {
    Session.startSession();
} catch (error) {
    console.error('Session failed:', error);
}

// Existing refs here

const handleResultClick = (result: { id: number; name: string; path: string }) => {
    searchQuery.value = '';
    console.log(`Navigating to ${result.path}`);
    isSearchFocused.value = false;
};

const isSidebarOpen = ref(false);
const isProfileOpen = ref(false);
const searchQuery = ref('');
const isSearchFocused = ref(false);

const handleSearchBlur = () => {
    setTimeout(() => {
        isSearchFocused.value = false;
    }, 200);
};

import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const adminBaseUri = '/mc-admin';

const menuGroups = [
    {
        title: 'Main Menu',
        items: [
            {
                name: 'Dashboard',
                path: `${adminBaseUri}/dashboard`,
                icon: LayoutDashboard,
                active: route.path === `${adminBaseUri}`,
            },
            {
                name: 'Users',
                path: `${adminBaseUri}/users`,
                icon: Users,
                count: '1',
                active: route.path === `${adminBaseUri}/users`,
            },
        ],
    },
    {
        title: 'Advanced',
        items: [
            {
                name: 'Settings',
                path: `${adminBaseUri}/settings`,
                icon: Settings,
                active: route.path === `${adminBaseUri}/settings`,
            },
            {
                name: 'API Keys',
                path: `${adminBaseUri}/api-keys`,
                icon: Key,
                count: '1',
                active: route.path === `${adminBaseUri}/api-keys`,
            },
            {
                name: 'Shard Hosts',
                path: `${adminBaseUri}/database-hosts`,
                icon: Database,
                active: route.path === `${adminBaseUri}/database-hosts`,
            },
            {
                name: 'Addons',
                path: `${adminBaseUri}/mounts`,
                icon: HardDrive,
                active: route.path === `${adminBaseUri}/mounts`,
            },
        ],
    },
];

const profileMenu = [
    { name: 'Profile', path: '/account' },
    { name: 'Exit Admin', path: '/dashboard' },
    { name: 'Sign out', path: '/auth/logout' },
];

const footerLinks = [
    { name: 'Privacy Policy', path: '#' },
    { name: 'Terms of Service', path: '#' },
    { name: 'Contact Us', path: '#' },
];

const searchResults = [
    { id: 1, name: 'Dashboard', path: '/dashboard' },
    { id: 2, name: 'Users', path: '/users' },
    { id: 3, name: 'Settings', path: '/settings' },
    { id: 4, name: 'API Keys', path: '/api-keys' },
    { id: 5, name: 'Shard Hosts', path: '/database-hosts' },
    { id: 6, name: 'Addons', path: '/mounts' },
];

const filteredResults = computed(() => {
    if (!searchQuery.value) return [];
    return searchResults.filter((result) => result.name.toLowerCase().includes(searchQuery.value.toLowerCase()));
});
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
}

.animate-fadeIn {
    animation: fadeIn 0.2s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Custom scrollbar styles */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}

/* Glassmorphism effect */
.backdrop-blur-md {
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}

/* Gradient text effect */
.bg-gradient-text {
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Hover effects */
.hover\:opacity-80:hover {
    opacity: 0.8;
}

.hover\:bg-gray-700\/50:hover {
    background-color: rgba(55, 65, 81, 0.5);
}

/* Responsive layout adjustments */
@media (max-width: 1023px) {
    .lg\:ml-64 {
        margin-left: 0;
    }
}
</style>
