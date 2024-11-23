<!-- src/components/Auth/Layout.vue -->

<template>
  <div class="min-h-screen bg-[#0a0a1f] relative overflow-hidden">
    <!-- Background elements -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#0a0a1f] via-[#1a0b2e] to-[#0a0a1f]">
      <div class="stars"></div>
      <div class="mountains"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center p-4">
      <slot></slot>

      <!-- Footer -->
      <div class="absolute bottom-4 text-center text-sm text-gray-400">
        <a href="https://mythical.systems">MythicalSystems</a>
        <p>LTD 2020 - {{ new Date().getFullYear() }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.stars {
  position: absolute;
  inset: 0;
  background-image: radial-gradient(
    2px 2px at calc(random() * 100%) calc(random() * 100%),
    white,
    transparent
  );
  background-size: 200px 200px;
  animation: twinkle 8s infinite;
}

.mountains {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 30vh;
  background-image: linear-gradient(170deg, transparent 0%, #0a0a1f 80%),
    linear-gradient(150deg, #1a0b2e 0%, transparent 100%);
  clip-path: polygon(0 100%, 20% 65%, 40% 90%, 60% 60%, 80% 85%, 100% 50%, 100% 100%);
}

@keyframes twinkle {
  0%,
  100% {
    opacity: 0.8;
  }

  50% {
    opacity: 0.4;
  }
}
</style>
