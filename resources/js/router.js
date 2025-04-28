import { createRouter, createWebHistory } from 'vue-router'
import AppLayout from './Layouts/AppLayout.vue'
import DashboardView from './views/Dashboard.vue'
import Assessment1View from './views/Assessment1.vue'
import Assessment2View from './views/Assessment2.vue'

const routes = [
  {
    path: '/',
    component: AppLayout,
    children: [
      {
        path: '',
        name: 'dashboard',
        component: DashboardView
      },
      {
        path: '/assessment1',
        name: 'assessment1',
        component: Assessment1View,
        redirect: { name: 'user-list' }, 
        children: [
          {
            path: '',
            name: 'user-list',
            component: () => import('./components/Assessment1/UserList.vue')
          },
          {
            path: 'create',
            name: 'user-create',
            component: () => import('./components/Assessment1/UserForm.vue')
          },
          {
            path: ':id/edit',
            name: 'user-edit',
            component: () => import('./components/Assessment1/UserForm.vue'),
            props: true
          },
          {
            path: ':id',
            name: 'user-view',
            component: () => import('./components/Assessment1/UserView.vue'),
            props: true
          }
        ]
      },
      {
        path: '/assessment2',
        name: 'assessment2',
        component: Assessment2View,
        redirect: { name: 'category-list' },
        children: [
          {
            path: '',
            name: 'category-list',
            component: () => import('./components/Assessment2/CategoryList.vue')
          },
          {
            path: 'create',
            name: 'category-create',
            component: () => import('./components/Assessment2/CategoryForm.vue')
          },
          {
            path: ':id/edit',
            name: 'category-edit',
            component: () => import('./components/Assessment2/CategoryForm.vue'),
            props: true
          }
        ]
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL), // Added BASE_URL
  routes
})

// Optional: Add navigation guard for debugging
router.beforeEach((to, from, next) => {
  console.log(`Navigating from ${from.path} to ${to.path}`)
  next()
})

export default router