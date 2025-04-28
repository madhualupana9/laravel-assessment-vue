<template>
  <div>
    <!-- Header -->
    <header class="bg-white shadow-md">
      <div class="container mx-auto px-4 py-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Laravel Developer Assessment</h1>
        <span class="text-sm font-semibold text-gray-600">Laravel Version 10</span>
      </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-blue-600 sticky top-0 z-10">
      <div class="container mx-auto px-4 flex items-center justify-between py-3">
        <router-link class="text-white text-lg font-semibold" :to="{ name: 'dashboard' }">
          Assessment Portal
        </router-link>
        <div class="hidden lg:flex space-x-6">
          <router-link 
            class="text-white hover:text-gray-300" 
            :class="{ 'text-gray-300': $route.path === '/' }"
            :to="{ name: 'dashboard' }"
          >
            Dashboard
          </router-link>
          <router-link 
            class="text-white hover:text-gray-300" 
            :class="{ 'text-gray-300': $route.path.startsWith('/assessment1') }"
            :to="{ name: 'user-list' }"
          >
            Assessment 1
          </router-link>
          <router-link 
            class="text-white hover:text-gray-300" 
            :class="{ 'text-gray-300': $route.path.startsWith('/assessment2') }"
            :to="{ name: 'category-list' }"
          >
            Assessment 2
          </router-link>
        </div>
        <!-- Mobile Menu Button -->
        <div class="lg:hidden">
          <button 
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="text-white focus:outline-none"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu Items -->
      <div 
        class="px-4 pb-4" 
        :class="{ 'hidden': !mobileMenuOpen, 'block': mobileMenuOpen }"
      >
        <router-link 
          class="block py-2 text-white hover:text-gray-300" 
          :class="{ 'text-gray-300': $route.path === '/' }"
          :to="{ name: 'dashboard' }"
          @click="mobileMenuOpen = false"
        >
          Dashboard
        </router-link>
        <router-link 
          class="block py-2 text-white hover:text-gray-300" 
          :class="{ 'text-gray-300': $route.path.startsWith('/assessment1') }"
          :to="{ name: 'user-list' }"
          @click="mobileMenuOpen = false"
        >
          Assessment 1
        </router-link>
        <router-link 
          class="block py-2 text-white hover:text-gray-300" 
          :class="{ 'text-gray-300': $route.path.startsWith('/assessment2') }"
          :to="{ name: 'category-list' }"
          @click="mobileMenuOpen = false"
        >
          Assessment 2
        </router-link>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
export default {
  name: 'AppLayout',
  data() {
    return {
      mobileMenuOpen: false
    }
  }
}
</script>