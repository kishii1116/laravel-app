import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _1133e222 = () => interopDefault(import('../client/pages/enquete/index.vue' /* webpackChunkName: "pages/enquete/index" */))
const _708aae62 = () => interopDefault(import('../client/pages/enquete/done.vue' /* webpackChunkName: "pages/enquete/done" */))
const _c5c54670 = () => interopDefault(import('../client/pages/index.vue' /* webpackChunkName: "pages/index" */))

const emptyFn = () => {}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: '/',
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/enquete",
    component: _1133e222,
    name: "enquete"
  }, {
    path: "/enquete/done",
    component: _708aae62,
    name: "enquete-done"
  }, {
    path: "/",
    component: _c5c54670,
    name: "index"
  }],

  fallback: false
}

export function createRouter (ssrContext, config) {
  const base = (config._app && config._app.basePath) || routerOptions.base
  const router = new Router({ ...routerOptions, base  })

  // TODO: remove in Nuxt 3
  const originalPush = router.push
  router.push = function push (location, onComplete = emptyFn, onAbort) {
    return originalPush.call(this, location, onComplete, onAbort)
  }

  const resolve = router.resolve.bind(router)
  router.resolve = (to, current, append) => {
    if (typeof to === 'string') {
      to = normalizeURL(to)
    }
    return resolve(to, current, append)
  }

  return router
}
