<template>
  <LayoutDashboard>
    <div class="space-y-6">
      <!-- Welcome Section -->
      <div class="flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-bold text-gray-100">Welcome to MythicalClient</h1>
          <p class="text-gray-400">Here's what's happening with your systems today.</p>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div
          v-for="(stat, index) in stats"
          :key="index"
          class="p-6 rounded-lg bg-gradient-to-br from-gray-900/50 to-gray-800/50 border border-gray-700/50 hover:border-purple-500/50 transition-colors group"
        >
          <div class="flex justify-between items-start mb-4">
            <span class="text-gray-400 text-sm">{{ stat.label }}</span>
            <div
              class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors"
            >
              <component :is="stat.icon" class="w-4 h-4" />
            </div>
          </div>
          <div class="text-2xl font-bold text-gray-100 mb-2">{{ stat.value }}</div>
          <div class="flex items-center gap-2 text-sm">
            <span :class="stat.trend === 'up' ? 'text-green-400' : 'text-red-400'">
              <component
                :is="stat.trend === 'up' ? TrendingUpIcon : TrendingDownIcon"
                class="w-4 h-4 inline"
              />
              {{ stat.percentage }}%
            </span>
            <span class="text-gray-400">vs last month</span>
          </div>
        </div>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Quick Actions -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div
              v-for="(action, index) in quickActions"
              :key="index"
              class="p-6 rounded-lg bg-gradient-to-br from-purple-500/10 to-purple-600/10 border border-gray-700/50 hover:border-purple-500/50 transition-all hover:translate-y-[-2px] cursor-pointer group"
            >
              <div class="flex items-start gap-4">
                <div
                  class="w-12 h-12 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors"
                >
                  <component :is="action.icon" class="w-6 h-6" />
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-100 mb-1">{{ action.title }}</h3>
                  <p class="text-gray-400 text-sm">{{ action.description }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Activity Timeline -->
          <div class="rounded-lg bg-gray-900/50 border border-gray-700/50 overflow-hidden">
            <div class="p-6 border-b border-gray-700/50">
              <h3 class="text-lg font-semibold text-gray-100">Recent Activity</h3>
            </div>
            <div class="p-6">
              <div class="space-y-6">
                <div v-for="(activity, index) in recentActivity" :key="index" class="flex gap-4">
                  <div
                    class="w-8 h-8 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400 flex-shrink-0"
                  >
                    <component :is="activity.icon" class="w-4 h-4" />
                  </div>
                  <div>
                    <p class="text-gray-100">{{ activity.message }}</p>
                    <p class="text-sm text-gray-400">{{ activity.time }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- System Status -->
        <div class="space-y-6">
          <!-- Status Card -->
          <div class="rounded-lg bg-gray-900/50 border border-gray-700/50 overflow-hidden">
            <div class="p-6 border-b border-gray-700/50">
              <h3 class="text-lg font-semibold text-gray-100">System Status</h3>
            </div>
            <div class="p-6">
              <div class="space-y-4">
                <div v-for="(service, index) in systemStatus" :key="index">
                  <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-300">{{ service.name }}</span>
                    <span
                      :class="{
                        'text-green-400': service.status === 'Operational',
                        'text-yellow-400': service.status === 'Degraded',
                        'text-red-400': service.status === 'Down',
                      }"
                      >{{ service.status }}</span
                    >
                  </div>
                  <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                    <div
                      class="h-full rounded-full transition-all duration-500"
                      :class="{
                        'bg-green-400': service.status === 'Operational',
                        'bg-yellow-400': service.status === 'Degraded',
                        'bg-red-400': service.status === 'Down',
                      }"
                      :style="{ width: `${service.uptime}%` }"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Resources Card -->
          <div
            class="rounded-lg bg-gradient-to-br from-purple-500/10 to-purple-600/10 border border-gray-700/50 p-6"
          >
            <h3 class="text-lg font-semibold text-gray-100 mb-4">Resource Usage</h3>
            <div class="space-y-4">
              <div v-for="(resource, index) in resources" :key="index">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-gray-300">{{ resource.name }}</span>
                  <span class="text-purple-400">{{ resource.usage }}%</span>
                </div>
                <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                  <div
                    class="h-full bg-purple-500 rounded-full transition-all duration-500"
                    :style="{ width: `${resource.usage}%` }"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </LayoutDashboard>
</template>

<script setup>
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import {
  Users as UsersIcon,
  Server as ServerIcon,
  Activity as ActivityIcon,
  Shield as ShieldIcon,
  Plus as PlusIcon,
  DownloadCloud as DownloadCloudIcon,
  TrendingUp as TrendingUpIcon,
  TrendingDown as TrendingDownIcon,
  Rocket as RocketIcon,
  Database as DatabaseIcon,
  Settings as SettingsIcon,
  Bell as BellIcon,
  UserPlus as UserPlusIcon,
  AlertTriangle as AlertTriangleIcon,
} from 'lucide-vue-next'

const stats = [
  {
    label: 'Total Users',
    value: '3,721',
    percentage: 12,
    trend: 'up',
    icon: UsersIcon,
  },
  {
    label: 'Active Servers',
    value: '156',
    percentage: 8,
    trend: 'up',
    icon: ServerIcon,
  },
  {
    label: 'System Load',
    value: '67%',
    percentage: 5,
    trend: 'down',
    icon: ActivityIcon,
  },
  {
    label: 'Security Score',
    value: '98/100',
    percentage: 15,
    trend: 'up',
    icon: ShieldIcon,
  },
]

const quickActions = [
  {
    title: 'Deploy Project',
    description: 'Deploy a new project to production',
    icon: RocketIcon,
  },
  {
    title: 'Database Backup',
    description: 'Create a new database backup',
    icon: DatabaseIcon,
  },
  {
    title: 'System Settings',
    description: 'Configure system parameters',
    icon: SettingsIcon,
  },
  {
    title: 'Add User',
    description: 'Create a new user account',
    icon: UserPlusIcon,
  },
]

const recentActivity = [
  {
    message: 'New user registration: John Doe',
    time: '5 minutes ago',
    icon: UserPlusIcon,
  },
  {
    message: 'Database backup completed successfully',
    time: '1 hour ago',
    icon: DatabaseIcon,
  },
  {
    message: 'System update available: v2.1.0',
    time: '2 hours ago',
    icon: BellIcon,
  },
  {
    message: 'High CPU usage detected on Server #12',
    time: '3 hours ago',
    icon: AlertTriangleIcon,
  },
]

const systemStatus = [
  {
    name: 'API Server',
    status: 'Operational',
    uptime: 100,
  },
  {
    name: 'Database Cluster',
    status: 'Degraded',
    uptime: 85,
  },
  {
    name: 'Storage Server',
    status: 'Operational',
    uptime: 98,
  },
  {
    name: 'Backup System',
    status: 'Operational',
    uptime: 100,
  },
]

import { ref, onMounted } from 'vue'

const resources = ref([
  {
    name: 'CPU Usage',
    usage: 0,
  },
  {
    name: 'Memory Usage',
    usage: 0,
  },
  {
    name: 'Storage Usage',
    usage: 0,
  },
])

onMounted(() => {
  setInterval(() => {
    resources.value = resources.value.map((resource) => ({
      ...resource,
      usage: Math.floor(Math.random() * 100),
    }))
  }, 1000)
})
</script>
