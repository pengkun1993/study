import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'

import Index from '@/pages/index'
import Hello from '@/pages/hello/index'
import World from '@/pages/world/index' 

Vue.use(Router)

export default new Router({
  routes: [
    {
    	path:'/hello',
    	name:'hello',
    	component:Hello
    },{
    	path:'/world',
    	name:'world',
    	component:World
    }
  ]
})
