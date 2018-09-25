import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import KeepAlive from '@/components/KeepAlive'
import RouterTest from '@/components/RouterTest'
import WangEditor from '@/components/WangEditor'

Vue.use(Router)

const router = new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },{
    	path: '/keep-alive',
    	name: 'keep-valive',
    	component: KeepAlive
    },{
    	path: '/keep-alive:id',
    	name: 'keep-valive_id',
    	component: KeepAlive
    },{
    	path: '/router-test',
    	name: 'router-test',
    	component: RouterTest
    },{
      path: '/wang-editor',
      name: 'wang-editor',
      component: WangEditor
    }
  ]
})

export default router