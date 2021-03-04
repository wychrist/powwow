import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [{ path: '', component: () => import('pages/Index.vue') }],
  },
  {
    path: '/chat-desktop',
    component: () => import('layouts/DesktopLayout.vue'),
    children: [
      { path: '', component: () => import('pages/chat/Index.vue') }
    ]
  },
  {
    path: '/chat-desktop-dn',
    component: () => import('layouts/DesktopMessengerLayout.vue'),
    children: [
      { path: '', component: () => import('pages/messenger/Index.vue') }
    ]
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue'),
  },
];

export default routes;
