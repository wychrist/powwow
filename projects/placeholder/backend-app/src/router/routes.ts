import { RouteRecordRaw } from 'vue-router'

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [{ path: '', component: () => import('pages/IndexPage.vue') }]
  },
  {
    path: '/login',
    component: () => import('layouts/LoginLayout.vue'),
    children: [{ path: '', component: () => import('pages/login/LoginPage.vue') }]
  },
  {
    path: '/register',
    component: () => import('layouts/LoginLayout.vue'),
    children: [{ path: '', component: () => import('pages/login/RegisterPage.vue') }]
  },
  {
    path: '/reset-password',
    component: () => import('layouts/LoginLayout.vue'),
    children: [{ path: '', component: () => import('pages/login/ResetPasswordPage.vue') }]
  },
  {
    path: '/forgot-password',
    component: () => import('layouts/LoginLayout.vue'),
    children: [{ path: '', component: () => import('pages/login/ForgotPasswordPage.vue') }]
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
