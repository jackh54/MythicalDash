<template>
  <!-- User Info -->
  <div class="flex flex-col sm:flex-row items-start gap-4 mb-8 p-4 bg-gray-800/20 rounded-lg">
    <img :src="user.avatar" alt="" class="w-16 h-16 rounded bg-gray-800" />
    <div class="flex-1 min-w-0">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
          <div class="flex items-center gap-2 flex-wrap">
            <span class="text-xs text-gray-400">UUID:</span>
            <code class="text-xs font-mono text-purple-400">{{ user.uuid }}</code>
          </div>
          <div class="flex items-center gap-2 flex-wrap">
            <span class="text-xs text-gray-400">Role:</span>
            <span class="text-xs font-mono text-pink-400">{{ user.role }}</span>
          </div>
          <div class="flex items-center gap-2 flex-wrap">
            <span class="text-xs text-gray-400">First IP:</span>
            <code class="text-xs font-mono text-gray-300">{{ user.firstIp }}</code>
            <span class="text-xs text-gray-500">(</span>
            <code class="text-xs font-mono text-gray-300">{{ user.currentIp }}</code>
            <span class="text-xs text-gray-500">)</span>
          </div>
          <div class="flex items-center gap-2 flex-wrap">
            <span class="text-xs text-gray-400">First seen:</span>
            <code class="text-xs font-mono text-gray-300">{{ user.firstSeen }}</code>
            <span class="text-xs text-gray-500">(</span>
            <code class="text-xs font-mono text-gray-300">{{ user.lastSeen }}</code>
            <span class="text-xs text-gray-500">)</span>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <span class="text-xs text-gray-400">Verified:</span>
          <span class="text-xs font-mono text-emerald-400">{{ user.verified }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const user = {
  uuid: '166ef11e12f6f3',
  role: 'Administrator',
  firstIp: '46.206.36.165',
  currentIp: '46.206.132.228',
  verified: 'true',
  firstSeen: '2024-09-21 20:35:13',
  lastSeen: '2024-11-05 21:30:30',
  avatar: 'https://github.com/nayskutzu.png',
}

const form = ref({
  firstName: 'Cassian1',
  lastName: 'Gherman1',
  email: 'ghermancassian2008@gmail.com',
  avatar: 'https://secure.gravatar.com/avatar/4beb8512d5218ddd310330ee37908dfe',
  background: 'https://cdn.mythicalsystems.xyz/background.gif',
})
</script>

<style scoped>
/* Hide scrollbar for Chrome, Safari and Opera */
.overflow-x-auto::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.overflow-x-auto {
  -ms-overflow-style: none;
  /* IE and Edge */
  scrollbar-width: none;
  /* Firefox */
}
</style>
