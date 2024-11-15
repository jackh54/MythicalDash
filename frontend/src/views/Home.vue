<template>
    <LayoutDashboard>
        <div class="space-y-6">
            <!-- Welcome Section -->
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-100">Welcome to MythicalFramework</h1>
                    <p class="text-gray-400">Here's what's happening with your systems today.</p>
                </div>

            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div v-for="(stat, index) in stats" :key="index"
                    class="p-6 rounded-lg bg-gradient-to-br from-gray-900/50 to-gray-800/50 border border-gray-700/50 hover:border-purple-500/50 transition-colors group">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-gray-400 text-sm">{{ stat.label }}</span>
                        <div
                            class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors">
                            <component :is="stat.icon" class="w-4 h-4" />
                        </div>
                    </div>
                    <div class="text-2xl font-bold text-gray-100 mb-2">{{ stat.value }}</div>
                    <div class="flex items-center gap-2 text-sm">
                        <span :class="stat.trend === 'up' ? 'text-green-400' : 'text-red-400'">
                            <component :is="stat.trend === 'up' ? TrendingUpIcon : TrendingDownIcon"
                                class="w-4 h-4 inline" />
                            {{ stat.percentage }}%
                        </span>
                        <span class="text-gray-400">vs last month</span>
                    </div>
                </div>
            </div>


        </div>
    </LayoutDashboard>
</template>

<script setup>
import LayoutDashboard from '../components/LayoutDashboard.vue'
import {
    Users as UsersIcon,
    Server as ServerIcon,
    Activity as ActivityIcon,
    Shield as ShieldIcon,
    TrendingUp as TrendingUpIcon,
    TrendingDown as TrendingDownIcon,
} from 'lucide-vue-next'


const stats = [
    {
        label: 'Total Users',
        value: '3,721',
        percentage: 12,
        trend: 'up',
        icon: UsersIcon
    },
    {
        label: 'Active Servers',
        value: '156',
        percentage: 8,
        trend: 'up',
        icon: ServerIcon
    },
    {
        label: 'System Load',
        value: '67%',
        percentage: 5,
        trend: 'down',
        icon: ActivityIcon
    },
    {
        label: 'Security Score',
        value: '98/100',
        percentage: 15,
        trend: 'up',
        icon: ShieldIcon
    }
]

</script>