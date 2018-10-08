import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component:require('@/pages/index/index')
    },{
    	path:'/hello',
    	name:'hello',
    	component:require('@/pages/hello/index')
    },{
    	path:'/world',
    	name:'world',
    	component:require('@/pages/world/index')
    }
  ]
})
