<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Category Management</h1>
            <router-link 
              v-if="$route.name === 'category-list'"
              to="/assessment2/create"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
              Add Category
            </router-link>
            <router-link 
              v-else
              to="/assessment2"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
              Back to List
            </router-link>
          </div>

          <div v-if="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ successMessage }}
          </div>

          <router-view @success="handleSuccess"></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Assessment2View',
  data() {
    return {
      successMessage: ''
    }
  },
  methods: {
    handleSuccess(message) {
      this.successMessage = message
      setTimeout(() => {
        this.successMessage = ''
      }, 3000)
    }
  }
}
</script>