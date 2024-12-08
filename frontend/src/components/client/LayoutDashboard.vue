<template>
    <div class="min-h-screen bg-gradient text-gray-100">
        <div v-if="loading" class="fixed inset-0 z-50 flex items-center justify-center bg-gradient">
            <div class="text-center">
                <div class="w-16 h-16 mb-4 mx-auto">
                    <svg class="animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                        ></path>
                    </svg>
                </div>
                <div
                    class="text-xl font-bold bg-gradient-to-r from-purple-400 to-purple-600 bg-clip-text text-transparent"
                >
                    Loading...
                </div>
            </div>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <template v-if="!loading">
            <div
                v-if="isSidebarOpen"
                class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 lg:hidden"
                @click="closeSidebar"
            ></div>

            <!-- Top Navigation Bar -->
            <nav
                class="fixed top-0 left-0 right-0 h-16 bg-gray-900/50 backdrop-blur-sm border-b border-gray-700/50 z-30"
            >
                <div class="h-full px-4 flex items-center justify-between">
                    <!-- Left: Logo & Menu Button -->
                    <div class="flex items-center gap-3">
                        <button class="lg:hidden p-2 hover:bg-gray-800/50 rounded-lg" @click="toggleSidebar">
                            <MenuIcon v-if="!isSidebarOpen" class="w-5 h-5" />
                            <XIcon v-else class="w-5 h-5" />
                        </button>

                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 flex items-center justify-center">
                                <img :src="Settings.getSetting('app_logo')" alt="MythicalClient" class="h-6 w-6" />
                            </div>
                            <span
                                class="text-xl font-bold bg-gradient-to-r from-purple-400 to-purple-600 bg-clip-text text-transparent"
                            >
                                {{ Settings.getSetting('app_name') }}
                            </span>
                            <!-- Search Bar (Desktop) -->
                            <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2">
                                <div class="relative">
                                    <SearchIcon class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" />
                                    <input
                                        type="text"
                                        placeholder="Search (Ctrl + /)"
                                        class="px-10 py-2 w-64 bg-gray-800/50 border border-gray-700/50 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500/50"
                                        @click="toggleSearch"
                                        readonly
                                    />
                                </div>
                            </div>
                            <!-- Search Icon (Mobile) -->
                            <button class="lg:hidden p-2 hover:bg-gray-800/50 rounded-lg" @click="toggleSearch">
                                <SearchIcon class="w-5 h-5" />
                            </button>
                        </div>
                    </div>

                    <!-- Right: Actions -->
                    <div class="flex items-center gap-2">
                        <button @click="toggleNotifications" class="p-2 hover:bg-gray-800/50 rounded-lg relative">
                            <BellIcon class="w-5 h-5" />
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-purple-500 rounded-full"></span>
                        </button>

                        <button @click="toggleProfile" class="p-2 hover:bg-gray-800/50 rounded-lg">
                            <UserIcon class="w-5 h-5" />
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Sidebar -->
            <aside
                class="fixed top-0 left-0 h-full w-64 bg-gray-900/50 backdrop-blur-sm border-r border-gray-700/50 transform transition-transform duration-200 ease-in-out z-50 lg:translate-x-0 lg:z-20"
                :class="isSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            >
                <!-- Sidebar Content -->
                <div class="flex flex-col h-full pt-16">
                    <div class="flex-1 overflow-y-auto">
                        <nav class="p-4">
                            <div v-for="(section, index) in menuSections" :key="index" class="mb-6">
                                <div class="text-xs uppercase tracking-wider text-gray-500 font-medium px-4 mb-2">
                                    {{ section.title }}
                                </div>
                                <div class="space-y-1">
                                    <RouterLink
                                        v-for="item in section.items"
                                        :key="item.name"
                                        :to="item.href"
                                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-800/50 transition-colors"
                                        :class="{ 'bg-purple-500/10 text-purple-400': item.active }"
                                    >
                                        <component :is="item.icon" class="w-5 h-5" />
                                        {{ item.name }}
                                    </RouterLink>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="pt-16 lg:pl-64 min-h-screen">
                <div class="p-6">
                    <slot></slot>
                </div>
            </main>

            <!-- Search Modal -->
            <div v-if="isSearchOpen" class="fixed inset-0 bg-gray-900/95 backdrop-blur-sm z-50" @click="closeSearch">
                <div class="max-w-3xl mx-auto pt-32 px-4" @click.stop>
                    <div class="relative">
                        <SearchIcon class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" />
                        <input
                            type="text"
                            placeholder="Search (Ctrl+/)"
                            class="w-full bg-gray-800/50 border border-gray-700/50 rounded-lg pl-11 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500/50"
                            @keydown.esc="closeSearch"
                            ref="searchInput"
                        />
                    </div>
                </div>
            </div>

            <!-- Notifications Dropdown -->
            <div
                v-if="isNotificationsOpen"
                class="absolute top-16 right-4 w-80 bg-gray-900/95 backdrop-blur-sm border border-gray-700/50 rounded-lg shadow-xl z-50 dropdown"
            >
                <div class="p-4">
                    <h3 class="font-semibold mb-4 text-purple-400">Notifications</h3>
                    <div class="space-y-4">
                        <div
                            v-for="notification in notifications"
                            :key="notification.id"
                            class="flex items-start gap-3 p-2 hover:bg-gray-800/50 rounded-lg transition-colors"
                        >
                            <div
                                class="w-8 h-8 rounded-full bg-purple-500/20 flex items-center justify-center flex-shrink-0"
                            >
                                <component :is="notification.icon" class="h-4 w-4 text-purple-400" />
                            </div>
                            <div>
                                <p class="font-medium">{{ notification.title }}</p>
                                <p class="text-sm text-gray-400">{{ notification.time }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div
                v-if="isProfileOpen"
                class="absolute top-16 right-4 w-64 bg-gray-900/95 backdrop-blur-sm border border-gray-700/50 rounded-lg shadow-xl z-50 dropdown"
            >
                <div class="p-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-10 w-10 rounded-full bg-purple-500/20 flex items-center justify-center">
                            <UserIcon class="h-6 w-6 text-purple-400" />
                        </div>
                        <div>
                            <p class="font-medium">
                                {{ Session.getInfo('first_name') }} {{ Session.getInfo('last_name') }}
                            </p>
                            <p class="text-sm text-gray-400">{{ Session.getInfo('role_name') }}</p>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <RouterLink
                            :to="item.href"
                            v-for="item in profileMenu"
                            :key="item.name"
                            class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-800/50 transition-colors flex items-center gap-3"
                        >
                            <component :is="item.icon" class="h-5 w-5 text-purple-400" />
                            {{ item.name }}
                        </RouterLink>
                    </div>
                </div>
            </div>
            <br />
            <br />
            <!-- Footer -->
            <footer
                class="fixed bottom-0 left-0 right-0 bg-gray-900/50 backdrop-blur-sm border-t border-gray-700/50 py-4 z-50"
            >
                <div class="flex justify-between items-center text-gray-400 text-sm px-6">
                    <!-- Left side -->
                    <div class="flex items-center gap-4">
                        <span>Copyright &copy; 2020-{{ new Date().getFullYear() }} MythicalSystems</span>
                    </div>
                    <!-- Right side -->
                    <div class="flex gap-4">
                        <RouterLink to="/terms" class="hover:text-purple-400 transition-colors">Terms</RouterLink>
                        <RouterLink to="/privacy" class="hover:text-purple-400 transition-colors">Privacy</RouterLink>
                        <RouterLink to="/support" class="hover:text-purple-400 transition-colors">Support</RouterLink>
                    </div>
                </div>
            </footer>
        </template>
    </div>
</template>
<script setup lang="ts">
import { ref, onMounted, onUnmounted, type FunctionalComponent } from 'vue';
import {
    Search as SearchIcon,
    Bell as BellIcon,
    User as UserIcon,
    Menu as MenuIcon,
    X as XIcon,
    HelpCircle as HelpIcon,
    Users as UsersIcon,
    Settings as SettingsIcon,
    LogOut as LogOutIcon,
    LayoutDashboard as LayoutDashboardIcon,
    Server as ServerIcon,
    Database as DatabaseIcon,
    AlertTriangle as AlertTriangleIcon,
    Ticket as TicketIcon,
    Webhook as ApiKeysIcon,
    Scale as ScaleIcon,
    Antenna as RssIcon,
    Blocks as AddonsIcon,
    Logs as LogsIcon,
} from 'lucide-vue-next';
import Settings from '@/mythicalclient/Settings';
import Session from '@/mythicalclient/Session';
import router from '@/router';
import Translation from '@/mythicalclient/Translation';
import StorageMonitor from '@/mythicalclient/StorageMonitor';

new StorageMonitor();

if (!Session.isSessionValid()) {
    router.push('/auth/login');
}

try {
    Session.startSession();
} catch (error) {
    console.error('Session failed:', error);
}

const loading = ref(true);

// Mobile Sidebar State
const isSidebarOpen = ref(false);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const closeSidebar = () => {
    isSidebarOpen.value = false;
};

// Dropdowns State
const isSearchOpen = ref(false);
const isNotificationsOpen = ref(false);
const isProfileOpen = ref(false);
const searchInput = ref<HTMLInputElement | null>(null);

// Menu Sections
const isActiveRoute = (routes: string | string[]) => {
    return routes.includes(window.location.pathname);
};

const menuSections = ref([
    {
        title: 'General',
        items: [
            {
                name: Translation.getTranslation('components.sidebar.dashboard'),
                icon: LayoutDashboardIcon,
                href: '/',
                active: isActiveRoute(['/']),
            },
            {
                name: Translation.getTranslation('components.sidebar.tickets'),
                icon: TicketIcon,
                href: '/ticket',
                active: isActiveRoute(['/ticket']),
            },
        ],
    }
]);

// Profile Menu


interface ProfileMenuItem {
    name: string;
    icon: FunctionalComponent;
    href: string;
}

const profileMenu = ref<ProfileMenuItem[]>([]);

const role = Session.getInfo('role_real_name'); 
if (["admin", "administrator", "support", "supportbuddy"].includes(role)) {
    profileMenu.value = [
        { name: 'Settings', icon: SettingsIcon, href: '/account' },
        { name: 'Admin Area', icon: UsersIcon, href: '/mc-admin' },
        { name: 'Logout', icon: LogOutIcon, href: '/auth/logout' },
    ];
    console.log('User is Admin: ', role);
} else {
    profileMenu.value = [
        { name: 'Settings', icon: SettingsIcon, href: '/account' },
        { name: 'Logout', icon: LogOutIcon, href: '/auth/logout' },
    ];
    console.log('User is not Admin:' , role);
}

// Sample Notifications
const notifications = ref([
    { id: 1, title: 'High CPU Usage Alert', time: '5 minutes ago', icon: AlertTriangleIcon },
    { id: 2, title: 'System Update Available', time: '1 hour ago', icon: ServerIcon },
    { id: 3, title: 'Backup Completed', time: '2 hours ago', icon: DatabaseIcon },
]);

// Toggle Functions
const toggleSearch = () => {
    isSearchOpen.value = true;
    isNotificationsOpen.value = false;
    isProfileOpen.value = false;
    setTimeout(() => {
        searchInput.value?.focus();
    }, 100);
};

const toggleNotifications = () => {
    isNotificationsOpen.value = !isNotificationsOpen.value;
    isProfileOpen.value = false;
    isSearchOpen.value = false;
};

const toggleProfile = () => {
    isProfileOpen.value = !isProfileOpen.value;
    isNotificationsOpen.value = false;
    isSearchOpen.value = false;
};

// Close Functions
const closeSearch = () => {
    isSearchOpen.value = false;
};

const closeDropdowns = () => {
    isNotificationsOpen.value = false;
    isProfileOpen.value = false;
};

// Click Outside Handler
const handleClickOutside = (event: MouseEvent) => {
    const target = event.target as HTMLElement | null;
    if (target && !target.closest('.dropdown') && !target.closest('button')) {
        closeDropdowns();
    }
};

// Keyboard Shortcuts
const handleKeydown = (event: KeyboardEvent) => {
    if (event.ctrlKey && event.key === '/') {
        event.preventDefault();
        toggleSearch();
    }
    if (event.key === 'Escape') {
        closeSearch();
        closeDropdowns();
        closeSidebar();
    }
};

// Lifecycle Hooks
onMounted(() => {
    document.addEventListener('click', handleClickOutside);
    document.addEventListener('keydown', handleKeydown);
    document.addEventListener('visibilitychange', handleVisibilityChange);
    if (sessionStorage.getItem('firstLoad') === null) {
        loading.value = true;
        setTimeout(() => {
            loading.value = false;
            sessionStorage.setItem('firstLoad', 'false');
        }, 2000);
    } else {
        loading.value = false;
    }
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
    document.removeEventListener('keydown', handleKeydown);
    document.removeEventListener('visibilitychange', handleVisibilityChange);
});

const isPageActive = ref(true);

const handleVisibilityChange = () => {
    if (document.hidden) {
        isPageActive.value = false;
        document.title = `${document.title} - Inactive`;
        console.log('Page is inactive');
    } else {
        isPageActive.value = true;
        document.title = document.title.replace(' - Inactive', '');
        console.log('Page is active');
    }
};
</script>

<style scoped>
.bg-gradient {
    background: radial-gradient(circle at center, #2d1b69 0%, #1a103f 50%, #0f0a24 100%);
}

:deep(.dropdown) {
    animation: dropdown 0.2s ease-out;
}

@keyframes dropdown {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Preloader animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
