import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import hello from '@/components/hello'
import world from '@/components/world'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
    	path:'/hello',
    	name:'Hello',
    	component:hello
    },
    {
    	path:'/world',
    	name:'World',
    	component:world
    }
  ]
})
