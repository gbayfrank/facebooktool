import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import firstPage from './components/pages/myFirstVuePage'
import newRoute from './components/pages/newRoutePage'
import testRoute from './components/pages/testRoutePage'
import hooks from './components/pages/basic/hooks'
import methods from './components/pages/basic/methods'


// project page
import home from './components/pages/home'
import tags from './components/pages/tags'

const routes = [
    {
        path: '/',
        component: home
    },
    {
        path: '/tags',
        component: tags
    },
    {
        path: '/my-new-vue-route',
        component: firstPage
    },
    {
        path: '/new-route',
        component: newRoute
    },
    {
        path: '/test',
        component: testRoute
    },

    // vue hooks
    {
        path: '/hooks',
        component: hooks
    },

    // more basics
    {
        path: '/methods',
        component: methods
    },
]

export default new VueRouter({
    mode: 'history',
    routes
})