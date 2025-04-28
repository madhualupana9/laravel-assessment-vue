<template>
  <div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <h2 class="text-xl font-semibold mb-4">Category Information</h2>
        <div class="space-y-2">
          <p><strong>ID:</strong> {{ category.id }}</p>
          <p><strong>Name:</strong> {{ category.name }}</p>
          <p><strong>Status:</strong> {{ category.status == 1 ? 'Enabled' : 'Disabled' }}</p>
          <p><strong>Parent ID:</strong> {{ category.parent_id || 'None' }}</p>
          <p><strong>Full Path:</strong> {{ fullPath }}</p>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl font-semibold mb-4">Timestamps</h2>
        <div class="space-y-2">
          <p><strong>Created At:</strong> {{ formatDate(category.created_at) }}</p>
          <p><strong>Updated At:</strong> {{ formatDate(category.updated_at) }}</p>
        </div>
      </div>
    </div>

    <div class="mt-6">
      <router-link 
        :to="`/assessment2/${category.id}/edit`"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >
        Edit Category
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'CategoryView',
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      category: {},
      allCategories: []
    }
  },
  computed: {
    fullPath() {
      const path = []
      let current = this.category
      
      while (current) {
        path.unshift(current.name)
        current = this.allCategories.find(c => c.id === current.parent_id)
      }
      
      return path.join(' > ')
    }
  },
  async created() {
    await this.fetchAllCategories()
    await this.fetchCategory()
  },
  methods: {
    formatDate(dateString) {
      if (!dateString) return ''
      const date = new Date(dateString)
      return date.toLocaleDateString() + ' ' + date.toLocaleTimeString()
    },
    async fetchAllCategories() {
      try {
        const response = await axios.get('/api/categories')
        this.allCategories = response.data
      } catch (error) {
        console.error('Error fetching categories:', error)
      }
    },
    async fetchCategory() {
      try {
        const response = await axios.get(`/api/categories/${this.id}`)
        this.category = response.data
      } catch (error) {
        console.error('Error fetching category:', error)
      }
    }
  }
}
</script>