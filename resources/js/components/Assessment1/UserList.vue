<template>
  <div class="container mx-auto px-4 py-8">
  

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <!-- Table headers -->
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <!-- Table body -->
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">{{ user.id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              {{ user.firstname }} {{ user.lastname }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">{{ user.email }}</td>
            <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
            <router-link 
                :to="`/assessment1/${user.id}`"
                class="bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-1 rounded text-sm"
            >
                View
            </router-link>
            <router-link 
                :to="`/assessment1/${user.id}/edit`"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm"
            >
                Edit
            </router-link>
            <button 
                @click="deleteUser(user.id)"
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
      users: []
    }
  },
  async created() {
    await this.fetchUsers()
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users')
        this.users = response.data
      } catch (error) {
        console.error('Error fetching users:', error)
      }
    },
    async deleteUser(id) {
      if (confirm('Are you sure you want to delete this user?')) {
        try {
          await axios.delete(`/api/users/${id}`)
          this.$emit('success', 'User deleted successfully')
          await this.fetchUsers()
        } catch (error) {
          console.error('Error deleting user:', error)
        }
      }
    }
  }
}
</script>