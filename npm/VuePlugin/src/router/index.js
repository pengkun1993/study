import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import PluginTest from '@/components/pluginTest'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },{
    	path:'/plugin_test',
    	name:'pluginTest',
    	component: PluginTest
    }
  ]
})
