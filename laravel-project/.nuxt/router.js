import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _1133e222 = () => interopDefault(import('../client/pages/enquete/index.vue' /* webpackChunkName: "pages/enquete/index" */))
const _d1a829e0 = () => interopDefault(import('../client/pages/enquete/confirm.vue' /* webpackChunkName: "pages/enquete/confirm" */))
const _708aae62 = () => interopDefault(import('../client/pages/enquete/done.vue' /* webpackChunkName: "pages/enquete/done" */))
const _3b5578f0 = () => interopDefault(import('../client/pages/enquete/init.vue' /* webpackChunkName: "pages/enquete/init" */))
const _618ff5ec = () => interopDefault(import('../client/pages/enquete/_id.vue' /* webpackChunkName: "pages/enquete/_id" */))
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
    path: "/enquete/confirm",
    component: _d1a829e0,
    name: "enquete-confirm"
  }, {
    path: "/enquete/done",
    component: _708aae62,
    name: "enquete-done"
  }, {
    path: "/enquete/init",
    component: _3b5578f0,
    name: "enquete-init"
  }, {
    path: "/enquete/:id",
    component: _618ff5ec,
    name: "enquete-id"
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
