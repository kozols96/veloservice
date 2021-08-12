import { RouteRecordRaw, createRouter, createWebHistory } from 'vue-router'

const Home = () => import(/* webpackChunkName: "home" */'../views/Home.vue')
const SignUp = () => import(/* webpackChunkName: "sign-up" */'../views/SignUp.vue')

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/sign-up',
    name: 'Sign Up',
    component: SignUp
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
