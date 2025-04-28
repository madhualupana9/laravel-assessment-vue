<template>
  <div class="max-w-6xl mx-auto p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      
      <!-- Basic Information Card -->
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-all">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2 text-gray-800">Basic Information</h2>
        <div class="space-y-4 text-gray-600">
          <p><span class="font-semibold text-gray-700">Full Name:</span> {{ user.firstname }} {{ user.middlename }} {{ user.lastname }}</p>
          <p><span class="font-semibold text-gray-700">Middle Initial:</span> {{ middleInitial }}</p>
          <p><span class="font-semibold text-gray-700">Gender:</span> {{ user.prefixname }}</p>
          <p><span class="font-semibold text-gray-700">Username:</span> {{ user.username }}</p>
          <p><span class="font-semibold text-gray-700">Email:</span> {{ user.email }}</p>
          <p><span class="font-semibold text-gray-700">Type:</span> 
            <span :class="user.type === 'admin' ? 'text-green-600 font-bold' : 'text-blue-600'">{{ user.type }}</span>
          </p>
        </div>
      </div>
      
      <!-- Additional Details Card -->
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-all">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2 text-gray-800">Additional Details</h2>
        <div v-if="user.details && user.details.length" class="space-y-4 text-gray-600">
          <div v-for="detail in user.details" :key="detail.id">
            <p><span class="font-semibold text-gray-700">{{ detail.key }}:</span> {{ detail.value }}</p>
          </div>
        </div>
        <div v-else class="text-gray-400 italic">
          No additional details available.
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'UserView',
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      user: {}
    }
  },
  computed: {
    middleInitial() {
      return this.user.middlename ? this.user.middlename.charAt(0).toUpperCase() + '.' : ''
    }
  },
  async created() {
    await this.fetchUser()
  },
  methods: {
    async fetchUser() {
      try {
        const response = await axios.get(`/api/users/${this.id}`)
        this.user = response.data
      } catch (error) {
        console.error('Error fetching user:', error)
      }
    }
  }
}
</script>
