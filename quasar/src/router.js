import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

function load (component) {
  // '@' is aliased to src/components
  return () =>
        import(`@/${component}.vue`)
}

function loadAdmin (component) {
  // '@' is aliased to src/admin/components
  return () =>
        import(`@admin/${component}.vue`)
}

const routes = [{
  path: '/',
  component: load('Index'),
  children: [
    {
      name: 'home',
      path: '',
      component: load('home/Home')
    }, {
      name: 'login',
      path: 'login',
      component: load('login/Login')
    }, {
      name: 'signup',
      path: 'signup',
      component: load('signup/Signup')
    }, {
      name: 'forgot_password',
      path: 'forgot_password',
      component: load('Hello')
    }, {
      name: 'reset_password',
      path: 'reset_password',
      component: load('Hello')
    }, {
      name: 'portfolio',
      path: 'portfolio',
      component: load('portfolio/Portfolio'),
      meta: {
        requiresAuth: true
      }
    }

  ]
},
{
  path: '/admin',
  component: loadAdmin('Index'),
  children: [
    {
      name: 'admin_dashboard',
      path: 'dashboard',
      component: loadAdmin('dashboard/Dashboard'),
      meta: {
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      name: 'admin_users',
      path: 'users',
      component: loadAdmin('users/Users'),
      meta: {
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      name: 'admin_coins',
      path: 'coins',
      component: loadAdmin('coins/Coins'),
      meta: {
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      name: 'admin_markents',
      path: 'markets',
      component: loadAdmin('markets/Markets'),
      meta: {
        requiresAuth: true,
        requiresAdmin: true
      }
    },
    {
      name: 'admin_currencies',
      path: 'currencies',

      component: loadAdmin('currencies/Currencies'),
      meta: {
        requiresAuth: true,
        requiresAdmin: true
      }
    }

  ]
},
  // Always leave this last one
{
  path: '*',
  component: load('Error404')
} // Not found
]

/*
 * NOTE! VueRouter "history" mode DOESN'T works for Cordova builds,
 * it is only to be used only for websites.
 *
 * If you decide to go with "history" mode, please also open /config/index.js
 * and set "build.publicPath" to something other than an empty string.
 * Example: '/' instead of current ''
 *
 * If switching back to default "hash" mode, don't forget to set the
 * build publicPath back to '' so Cordova builds work again.
 */
const router = new VueRouter({
  routes,
  mode: 'hash',
  scrollBehavior: () => ({
    y: 0
  })
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
    if (!authUser || !authUser.token) {
      next({
        name: 'login'
      })
    }
    else {
      if (to.matched.some(record => record.meta.requiresAdmin) && authUser.data.role !== 'admin') {
        next({
          name: 'home'
        })
      }
      else {
        next()
      }
    }
  }
  else {
    next()
  }
})

export default router
