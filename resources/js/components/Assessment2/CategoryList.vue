<template>
  <div class="container mx-auto px-4 py-8">
   

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="category in categories" :key="category.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">{{ category.id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              {{ getFullPath(category) }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span :class="{
                'bg-green-100 text-green-800': category.status === 1,
                'bg-red-100 text-red-800': category.status === 2
              }" class="px-2 py-1 rounded-full text-xs">
                {{ category.status === 1 ? 'Enabled' : 'Disabled' }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
              <router-link 
                :to="`/assessment2/${category.id}/edit`"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm"
              >
                Edit
              </router-link>
              <button 
                @click="deleteCategory(category.id)"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
              >
                Delete
              </button> 
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      categories: []
    }
  },
  async created() {
    await this.fetchCategories()
  },
  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get('/api/categories')
        this.categories = response.data
      } catch (error) {
        console.error('Error fetching categories:', error)
      }
    },
    getFullPath(category) {
      const path = []
      let current = category
      
      while (current) {
        path.unshift(current.name)
        current = this.categories.find(c => c.id === current.parent_id)
      }
      
      return path.join(' > ')
    },
    async deleteCategory(id) {
      if (confirm('Are you sure you want to delete this category?')) {
        try {
          await axios.delete(`/api/categories/${id}`)
          this.$emit('success', 'Category deleted successfully')
          await this.fetchCategories()
        } catch (error) {
          console.error('Error deleting category:', error)
        }
      }
    }
  }
}
</script>