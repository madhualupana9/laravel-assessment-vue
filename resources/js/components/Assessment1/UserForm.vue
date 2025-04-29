<template>
  <div>
    <form @submit.prevent="submitForm">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
          <div>
            <label for="prefixname" class="block text-sm font-medium text-gray-700">Prefix</label>
            <select id="prefixname" v-model="form.prefixname" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
              <option value="Mr.">Mr.</option>
              <option value="Mrs.">Mrs.</option>
              <option value="Ms.">Ms.</option>
            </select>
          </div>

          <div>
            <label for="firstname" class="block text-sm font-medium text-gray-700">First Name *</label>
            <input id="firstname" v-model="form.firstname" type="text" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>

          <div>
            <label for="middlename" class="block text-sm font-medium text-gray-700">Middle Name</label>
            <input id="middlename" v-model="form.middlename" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>
        </div>

        <div class="space-y-4">
          <div>
            <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name *</label>
            <input id="lastname" v-model="form.lastname" type="text" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>

          <div>
            <label for="suffixname" class="block text-sm font-medium text-gray-700">Suffix</label>
            <input id="suffixname" v-model="form.suffixname" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>

         <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username *</label>
            <input id="username" v-model="form.username" type="text" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <span v-if="usernameError" class="text-red-500 text-sm">{{ usernameError }}</span>
          </div>
        </div>

        <div class="space-y-4">
           <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
            <input id="email" v-model="form.email" type="email" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <span v-if="emailError" class="text-red-500 text-sm">{{ emailError }}</span>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
              {{ isEdit ? 'New Password' : 'Password *' }}
            </label>
            <input 
              id="password" 
              v-model="form.password" 
              type="password" 
              :required="!isEdit"
              class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
          </div>

          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
              {{ isEdit ? 'Confirm New Password' : 'Confirm Password *' }}
            </label>
            <input 
              id="password_confirmation" 
              v-model="form.password_confirmation" 
              type="password" 
              :required="!isEdit"
              class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
          </div>
        </div>

        <div class="space-y-4">
          <div>
            <label for="photo" class="block text-sm font-medium text-gray-700">Photo URL</label>
            <input id="photo" v-model="form.photo" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>

         
        </div>
      </div>

     <div class="mt-6">
        <button 
          type="submit" 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
          :disabled="isSubmitting"
        >
          <span v-if="isSubmitting">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
          </span>
          <span v-else>
            {{ isEdit ? 'Update' : 'Create' }} User
          </span>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { debounce } from 'lodash-es'

export default {
  name: 'UserForm',
  props: {
    id: {
      type: String,
      default: null
    }
  },
  setup(props, { emit }) {
    const router = useRouter()

    const form = ref({
      prefixname: 'Mr.',
      firstname: '',
      middlename: '',
      lastname: '',
      suffixname: '',
      username: '',
      email: '',
      password: '',
      password_confirmation: '',
      photo: null,
      type: 'user'
    })

    const isEdit = ref(false)
    const isSubmitting = ref(false)
    const checkingUniqueness = ref(false)
    const usernameError = ref('')
    const emailError = ref('')

    const debouncedCheckUniqueFields = debounce(async () => {
      checkingUniqueness.value = true
      
      try {
        // Check for unique email
        if (form.value.email) {
          try {
         
            const params = { email: form.value.email }
            if (isEdit.value) params.exclude_id = props.id
             
            const response = await axios.get('/api/users/check-email', { params })
            console.log(response.data.exists);
            emailError.value = response.data.exists ? 'Email is already taken' : ''
          } catch (error) {
            emailError.value = 'Error checking email'
            console.error('Email check error:', error)
          }
        }

        // Check for unique username
        if (form.value.username) {
          try {
            const params = { username: form.value.username }
            if (isEdit.value) params.exclude_id = props.id
            
            const response = await axios.get('/api/users/check-email', { params })
            usernameError.value = response.data.exists ? 'Username is already taken' : ''
          } catch (error) {
            usernameError.value = 'Error checking username'
            console.error('Username check error:', error)
          }
        }
      } finally {
        checkingUniqueness.value = false
      }
    }, 500)

    async function fetchUser() {
      try {
        const response = await axios.get(`/api/users/${props.id}`)
        console.log('API Response:', response.data)
        
        const userData = response.data.data || response.data
        form.value = {
          prefixname: userData.prefixname || 'Mr.',
          firstname: userData.firstname || '',
          middlename: userData.middlename || '',
          lastname: userData.lastname || '',
          suffixname: userData.suffixname || '',
          username: userData.username || '',
          email: userData.email || '',
          password: '',
          password_confirmation: '',
          photo: userData.photo || null,
          type: userData.type || 'user'
        }
      } catch (error) {
        console.error('Failed to fetch user:', error)
        emit('error', 'Failed to load user data')
      }
    }

    watch(
      () => form.value.email,
      () => {
        if (form.value.email) {
          debouncedCheckUniqueFields()
        } else {
          emailError.value = ''
        }
      }
    )

    watch(
      () => form.value.username,
      () => {
        if (form.value.username) {
          debouncedCheckUniqueFields()
        } else {
          usernameError.value = ''
        }
      }
    )

    async function submitForm() {
      // Force immediate check before submission
      await debouncedCheckUniqueFields.flush()
      
      if (usernameError.value || emailError.value) {
        return
      }

      isSubmitting.value = true
      try {
        const payload = { ...form.value }

        if (isEdit.value && !payload.password) {
          delete payload.password
          delete payload.password_confirmation
        }

        const endpoint = isEdit.value 
          ? `/api/users/${props.id}`
          : `/api/users`

        const response = isEdit.value
          ? await axios.put(endpoint, payload)
          : await axios.post(endpoint, payload)

        emit('success', isEdit.value ? 'User updated!' : 'User created!')
        await router.push({ name: 'user-list' })

      } catch (error) {
        console.error('Submission error:', error)
        
        if (error.response?.status === 422) {
          const errors = error.response.data.errors
          if (errors.email) {
            emailError.value = errors.email[0]
          }
          if (errors.username) {
            usernameError.value = errors.username[0]
          }
          emit('error', Object.values(errors).flat().join(', '))
        } else {
          emit('error', error.response?.data?.message || 'Request failed')
        }
      } finally {
        isSubmitting.value = false
      }
    }

    onMounted(async () => {
      if (props.id) {
        isEdit.value = true
        await fetchUser()
      }
    })

    return {
      form,
      isEdit,
      isSubmitting,
      checkingUniqueness,
      submitForm,
      usernameError,
      emailError
    }
  }
}
</script>

<style scoped>
.form-input {
  transition: border-color 0.3s ease;
}
.form-input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
button:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}
</style>