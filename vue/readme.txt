1、v-for
	v-for最多可以由3个参数 v-for="(value,key,index) in object"
	v-for正在更新已渲染过的元素的列表时，它默认用“就地复用”策略。如果数据项的顺序被改变，vue将不会移动DOM元素来匹配数据项的顺序，而是简单复用此处每个元素，并且确保它在特定索引下显示已被渲染过的每个元素。
	为了给vue一个提示，以便它能跟踪每个节点的身份，从而重用或重新排序现有元素，你需要为每项提供一个唯一的key属性。所以使用v-for时尽可能提供key
2、变异方法：push/pop/shift/unshift/splice/sort/reverse,会改变被这些方法调用的原始数组。
   非变异方法：filter/concat/slice,这些不会改变原始数组，但总是返回一个新数组。
   用一个含有相同元素的数组去替换原来的数组是非常高效的操作
3、Vue无法检测数组通过引用修改值或者修改数组的长度，解决方法如下：
	var vm=new Vue({
		data:{
			items:['a','b','c']
		}
	})
	vm.items[1]='x'//非响应式的
	vm.items.length=2//非相应式的
	//以下是可以造成响应式效果的
	Vue.set(vm.items,indexOfItem,newValue);
	vm.$set(vm.items,indexOfItem,newValue);//上面的另一种写法
	vm.items.splice(indexOfItem,1,newVaule);
4、vue不能检测对象属性的添加或删除
	var vm=new Vue({
		data:{
			a:1
		}
	})
	vm.a现在是响应式的
	vm.b=2
	vm.b不是响应式的
	对于已经创建的实例，vue不能动态添加根级别的响应式属性。但是，可以使用
	Vue.set(Object,key,value)向嵌套对象添加响应式属性。
	vm.$set(vm.userProfile,'age',27)//等同Vue.set
	有时你可能需要为已有对象赋予多个新属性，比如使用Object.assign()或_.extend()。在这种情况下，你应该用两个对象的属性创建一个新的对象。所以如果你想添加新的响应式属性，不要这样
		Object.assign(vm.userProfile,{
			age:29,
			favoriteColor:'Vue green'
		})
	应该这样做
		vm.userProfile=Object.assign({},vm.userProfile,{
			age:29,
			favoriteColor:'Vue green'
		})
5、v-for和v-if处于同一个节点，v-for的优先级比v-if更高，这意味着v-if将分别重复运行与每个v-for循环中。v-for可以使用在组件上，但是不会传递数据到组件，如果要传递需要通过props，单个进行传入
6、事件可以通过$event将event参数传入所调用的方法
7、方法只有纯粹的数据逻辑，而不是去处理DOM事件细节。这是vue对方法的实现思想，所以有了事件修饰符。按键修饰符 v-on:keyup.13="submit"，
8、为什么在HTML中监听事件
	你可能注意到这种事件监听的方式违背了关注点分离 (separation of concern) 这个长期以来的优良传统。但不必担心，因为所有的 Vue.js 事件处理方法和表达式都严格绑定在当前视图的 ViewModel 上，它不会导致任何维护上的困难。实际上，使用 v-on 有几个好处：
	1、扫一眼 HTML 模板便能轻松定位在 JavaScript 代码里对应的方法。
	2、因为你无须在 JavaScript 里手动绑定事件，你的 ViewModel 代码可以是非常纯粹的逻辑，和 DOM 完全解耦，更易于测试。 
	3、当一个 ViewModel 被销毁时，所有的事件处理器都会自动被删除。你无须担心如何自己清理它们。
9、自定义事件名推荐使用kebab-case的命名方法，因为html会把所有大写转为小写
10、一个组件上的v-model默认会利用名为value的prop和名为input的事件。












