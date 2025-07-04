<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const sidebarOpen = ref(false);
const user = usePage().props.auth.user;
</script>

<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div :class="[sidebarOpen ? 'block' : 'hidden', 'fixed inset-0 z-40 flex-none w-64 bg-white shadow-lg md:block md:static md:inset-auto md:translate-x-0']">
      <div class="flex flex-col h-full">
        <div class="flex items-center justify-center h-16 border-b">
          <span class="text-xl font-bold tracking-wide text-blue-600">Ecom Admin</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
          <Link href="/dashboard" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium" :class="{ 'bg-blue-500 text-white': $page.url === '/dashboard' }">Dashboard</Link>
          <Link href="/products" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium" :class="{ 'bg-blue-500 text-white': $page.url.startsWith('/products') }">Products</Link>
          <form :action="route('logout')" method="post">
            <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600 font-medium">Logout</button>
          </form>
        </nav>
      </div>
    </div>

    <!-- Main content -->
    <div class="flex-1 flex flex-col min-w-0">
      <!-- Header -->
      <header class="flex items-center h-16 px-4 bg-white border-b shadow-sm">
        <button @click="sidebarOpen = !sidebarOpen" class="md:hidden mr-4 text-gray-500 focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        <div class="flex-1 text-lg font-semibold text-gray-700">{{$slots.header ? '' : 'Admin Panel'}}</div>
        <div class="hidden md:block text-gray-600 font-medium">{{ user.name }}</div>
      </header>
      <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
        <slot />
      </main>
    </div>
  </div>
</template>

<style scoped>
@media (min-width: 768px) {
  .sidebar {
    display: block !important;
  }
}
</style> 