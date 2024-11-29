<template>
    <LayoutDashboard>
        <div class="p-6">
            <h1 class="text-3xl font-bold mb-2">My Dashboard</h1>
            <div class="text-gray-400">
                <RouterLink to="/" class="hover:text-gray-300">Portal Home</RouterLink>
                <span class="mx-2">/</span>
                <span>Client Area</span>
            </div>
        </div>

        <div class="px-6 grid gap-6 lg:grid-cols-4">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Support PIN -->
                <CardComponent>
                    <h2 class="text-gray-400 mb-2">Support Pin</h2>
                    <div class="flex items-center gap-2">
                        <span class="text-[#7cff4d] text-2xl font-mono">637238</span>
                        <button class="text-gray-400 hover:text-gray-300">
                            <RefreshCcwIcon class="w-4 h-4" />
                        </button>
                    </div>
                </CardComponent>
                <!-- Profile Card -->
                <CardComponent>
                    <div class="flex flex-col items-center text-center">
                        <img src="https://github.com/mythicalltd.png?height=80&width=80" alt="Profile"
                            class="w-20 h-20 rounded-full mb-4" />
                        <div class="text-xl mb-4">{{ Session.getInfo('company_name') }} ({{
                            Session.getInfo('vat_number') }})</div>
                        <div class="text-gray-400 text-sm space-y-1 mb-4">
                            <div>{{ Session.getInfo('first_name') }} {{ Session.getInfo('last_name') }}</div>
                            <div>{{ Session.getInfo('address1') }}</div>
                            <div>{{ Session.getInfo('city') }} ({{ Session.getInfo('postcode') }}), {{
                                Session.getInfo('country') }}</div>
                        </div>
                        <div class="flex gap-2">
                            <RouterLink to="/account" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 rounded">Update
                            </RouterLink>
                            <a href="/api/auth/logout"
                                class="px-4 py-2 bg-gray-800 hover:bg-gray-700 rounded">Logout</a>
                        </div>
                    </div>
                </CardComponent>
            </div>
            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Stats Grid -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <CardComponent>
                        <ServerIcon class="w-5 h-5 text-blue-400 mb-4" />
                        <div class="text-4xl font-bold text-blue-400 mb-2">2</div>
                        <div class="text-gray-400">Services</div>
                    </CardComponent>
                    <CardComponent>
                        <GlobeIcon class="w-5 h-5 text-blue-400 mb-4" />
                        <div class="text-4xl font-bold text-blue-400 mb-2">0</div>
                        <div class="text-gray-400">Domains</div>
                    </CardComponent>
                    <CardComponent>
                        <FileTextIcon class="w-5 h-5 text-blue-400 mb-4" />
                        <div class="text-4xl font-bold text-blue-400 mb-2">0</div>
                        <div class="text-gray-400">Unpaid Invoices</div>
                    </CardComponent>
                    <CardComponent>
                        <TicketIcon class="w-5 h-5 text-blue-400 mb-4" />
                        <div class="text-4xl font-bold text-blue-400 mb-2">1</div>
                        <div class="text-gray-400">Tickets</div>
                    </CardComponent>
                </div>

                <!-- Active Products -->
                <CardComponent>
                    <div class="p-4 border-b border-gray-800">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold">Your Active Products/Services</h2>
                            <MenuIcon class="w-5 h-5 text-gray-400" />
                        </div>
                    </div>
                    <div class="p-4 space-y-4">
                        <div v-for="(server, index) in servers" :key="index"
                            class="flex items-center justify-between py-3 border-b border-gray-800 last:border-0">
                            <div>
                                <div class="font-medium">{{ server.name }}</div>
                                <div class="text-sm text-gray-400">{{ server.hostname }}</div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded text-sm">Active</span>
                                <button class="px-4 py-1 bg-gray-800 hover:bg-gray-700 rounded">Manage</button>
                            </div>
                        </div>
                    </div>
                </CardComponent>
            </div>
        </div>
    </LayoutDashboard>
</template>

<script setup lang="ts">
import LayoutDashboard from '../components/LayoutDashboard.vue';
import CardComponent from '@/components/ui/Card/CardComponent.vue';
import Session from '@/mythicalclient/Session';
import {
    RefreshCcw as RefreshCcwIcon,
    Server as ServerIcon,
    Globe as GlobeIcon,
    FileText as FileTextIcon,
    Ticket as TicketIcon,
    Menu as MenuIcon,
} from 'lucide-vue-next';

const servers = [
    {
        name: 'Storage Root Server Frankfurt - Storage KVM S',
        hostname: 'backup2.mythical.systems',
    },
    {
        name: 'Storage Root Server Frankfurt - Storage KVM S',
        hostname: 'backup.mythical.systems',
    },
];
</script>
