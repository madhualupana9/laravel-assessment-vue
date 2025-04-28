<template>
  <div>
    <form @submit.prevent="submitForm">
      <div class="grid grid-cols-1 gap-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Category Name *</label>
          <input 
            id="name" 
            v-model="form.name" 
            type="text" 
            required 
            class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          >
        </div>

        <div>
          <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
          <select 
            id="status" 
            v-model="form.status" 
            required 
            class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          >
            <option value="1">Enabled</option>
            <option value="2">Disabled</option>
          </select>
        </div>

        <div>
          <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Category</label>
          <select 
            id="parent_id" 
            v-model="form.parent_id" 
            class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
          >
            <option :value="null">-- No Parent --</option>
            <option 
              v-for="category in parentOptions" 
              :key="category.id" 
              :value="category.id"
              :disabled="category.id === id"
            >
              {{ category.full_path }}
            </option>
          </select>
        </div>
      </div>

      <div class="mt-6">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          {{ isEdit ? 'Update' : 'Create' }} Category
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'CategoryForm',
  props: {
    id: {
      type: String,
      default: null
    }
  },
  data() {
    return {
      form: {
        name: '',
        status: '1',
        parent_id: null
      },
      parentOptions: [],
      isEdit: false
    }
  },
  async created() {
    await this.fetchParentOptions()
    if (this.id) {
      this.isEdit = true
      await this.fetchCategory()
    }
  },
  methods: {
    async fetchParentOptions() {
      try {
        const response = await axios.get('/api/categories')
        this.parentOptions = response.data.map(category => ({
          id: category.id,
          full_path: this.getFullPath(category, response.data)
        }))
      } catch (error) {
        console.error('Error fetching parent options:', error)
      }
    },
    getFullPath(category, allCategories) {
      const path = []
      let current = category
      
      while (current) {
        path.unshift(current.name)
        current = allCategories.find(c => c.id === current.parent_id)
      }
      
      return path.join(' > ')
    },
    async fetchCategory() {
      try {
        const response = await axios.get(`/api/categories/${this.id}`)
        this.form = {
          name: response.data.name,
          status: response.data.status.toString(),
          parent_id: response.data.parent_id
        }
      } catch (error) {
        console.error('Error fetching category:', error)
      }
    },
    async submitForm() {
      try {
        const payload = {
          ...this.form,
          status: parseInt(this.form.status)
        }

        if (this.isEdit) {
          await axios.put(`/api/categories/${this.id}`, payload)
          this.$emit('success', 'Category updated successfully')
        } else {
          await axios.post('/api/categories', payload)
          this.$emit('success', 'Category created successfully')
        }
        this.$router.push('/assessment2')
      } catch (error) {
        console.error('Error saving category:', error)
      }
    }
  }
}
</script>