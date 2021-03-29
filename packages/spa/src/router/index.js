import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "home" */ '../views/Home.vue')
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('../views/Register.vue')
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: () => import('../views/Dashboard.vue'),
    meta: {
      requireLogin: true
    }
  },
  {
    path: '/projet/:id/gallery',
    name: 'Gallery',
    component: () => import('../views/Gallery.vue'),
    meta: {
      requireLogin: true
    }
  },
]

const router = new VueRouter({
  routes
})

let checkLogin = async function() {
  if (localStorage.getItem('jwt')) {
    await store.dispatch('auth/getAccountInfo');
    if (store.getters['auth/getAuthenticated']) {
      return true;
    }
  }
  // TODO: Renvoyer false quand authentification en ligne et en place
  return true
}

router.beforeEach(async function(to, from, next) {
  let isLogin = await checkLogin();
  if (to.matched.some(record => record.meta.requireLogin) && !isLogin)
    next({ name: 'Home' });
  else if (to.matched.some(record => !record.meta.requireLogin) && isLogin) {
    next({ name: 'Dashboard' });
  }
  else next()
})

export default router
