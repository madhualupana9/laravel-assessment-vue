<template>
  <div class="min-h-screen bg-gray-100">
    <div class="container mx-auto px-4 py-8">
      <!-- Header -->
      <header class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Laravel Developer Assessment</h1>
        <h2 class="text-2xl text-gray-600">Assessment Portal</h2>
      </header>

      <!-- Assessment Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
        <!-- Assessment 1 Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
          <div class="p-8">
            <div class="text-center mb-6">
              <h3 class="text-2xl font-semibold text-gray-800 mb-2">Assessment 1</h3>
              <p class="text-gray-600">User Details Management</p>
            </div>
            <div class="text-center">
              <router-link 
                to="/assessment1"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-300"
              >
                Go to Assessment 1
              </router-link>
            </div>
          </div>
        </div>

        <!-- Assessment 2 Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
          <div class="p-8">
            <div class="text-center mb-6">
              <h3 class="text-2xl font-semibold text-gray-800 mb-2">Assessment 2</h3>
              <p class="text-gray-600">Category Management</p>
            </div>
            <div class="text-center">
              <router-link 
                to="/assessment2"
                class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-300"
              >
                Go to Assessment 2
              </router-link>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="mt-16 text-center text-gray-500 text-sm">
        <hr class="border-gray-200 mb-4 mx-auto w-24">
        <p>© 2025 Laravel Assessment Portal. All rights reserved.</p>
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DashboardView'
}
</script>

<style scoped>
/* Custom styles if needed */
.container {
  max-width: 1200px;
}
</style>