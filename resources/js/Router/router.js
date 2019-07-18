import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Login from '../components/login/Login'
import signUp from '../components/login/signUp'
import Forum from '../components/forum/forum'
import Read from '../components/forum/read'
import Create from '../components/forum/create'
import Logout from '../components/login/Logout'
import CreateCategory from '../components/category/CreateCategory'

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
  { path: '/login', component: Login },
  { path: '/signup', component: signUp },
  { path: '/logout', component: Logout },
  { path: '/category', component: CreateCategory },

  { path: '/forum', component: Forum, name: 'forum' },
  { path: '/ask', component: Create },
  { path: '/question/:slug', component: Read, name: 'read' },

]


// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes, // short for `routes: routes`
  hashbang: false, // menghilangkan # pada url
  mode: 'history'
})

export default router
