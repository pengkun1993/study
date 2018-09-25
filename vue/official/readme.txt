指令是带有v-前缀的特殊特性。指令特性的值预期是单个JavaScript表达式（v-for是个例外情况），指令的职责是，当表达式的值改变时，将其产生的连带影响，响应式地作用于DOM。
v-once 一次性地插入值，当数据改变时，插值处的内容不会更新。
v-html 双大括号会将数据解释为普通文本，而非HTML代码。为了输出真正的HTML，你需要使用v-html指令.
v-bind Mustache语法即双大括号语法不能作用在HTML特性上，遇到这种情况应该使用v-bind指令
双大括号内只能是单个JavaScript表达式，语句不会生效
表达式：
{{number++}};{{ok?'yes':'no'}};{{message.split('').reverse().join('')}}
语句：（这里不会生效）
{{var a=1}};{{if(ok){return message}}};
v-if <p v-if="seen"></p>;指令根据表达式seen的值来确定插入/移除p元素。v-else;v-else-if;
v-on 用于监听DOM事件
修饰符是以半角句号.指明的特殊后缀，用于指出一个指令应该以特殊方式绑定。例如，.prevent修饰符告诉v-on指令对于触发的时间调用event.preventDefault():
<form v-on:submit.prevent="onSubmit">...</form>
v-前缀作为一种视觉提示，用来识别模板中vue特定的特性。在构建vue.js管理所有模板的单页面应用程序时，v-前缀变得没那么重要了。因此，vue.js为v-bind和v-on这两个常用的指令，提供了特定简写：
#v-bind
<a v-bind:href="url">...</a>
<a :href="url">...</a>
#v-on
<a v-on:click="doSomething">...</a>
<a @click="doSomething">...</a>
#在组件中
computed 计算属性 methods 声明方法
我们可以将同一个函数定义为一个方法而不是一个计算属性。两种方式的最终结果确实是完全相同的。然而，不同的是计算属性是基于它们的依赖进行缓存的。计算属性只有在它的相关依赖发生改变时才会重新求值。这就意味着只要message还没有发生改变，多次访问reversedMessage计算属性会立即返回之前的计算结果，而不必再次执行函数。
相比之下，每当触发重新渲染是，调用方法将总会再次执行函数。

vue提供了一种更通用的方式来观察和相应vue实例上的数据变动：侦听属性。当你有一些数据需要随着其他数据变动而变动时，你很容易滥用watch。然而，通常更好的做法是使用计算属性而不是命令式的watch回调。
计算属性默认只有getter，不过在需要的时候你也可以提供一个setter

用key管理可复用的元素，vue会尽可能高效地渲染元素，通常会复用已有元素而不是从头开始渲染。这样也不总是符合实际需求，所以vue提供了一种方式来表达“这两个元素是完全独立的，不要重复他们”。只需要添加一个具有唯一值的key属性即可。

v-show，用于根据条件展示元素的选项。不同的是带有v-show的元素始终会被渲染并保留在DOM中。v-show只是简单地切换元素的css属性display。v-show不支持<template>元素，也不支持v-else
#v-if v-show
v-if是“真正”的条件渲染，因为它会确保在切换过程中条件块内的事件监听器和子组件适当地被销毁和重建
v-if也是惰性的：如果在初始渲染时条件为假，则什么也不做——知道条件第一次变为真时，才会开始渲染条件块。
v-show不管初始条件是什么，元素总是会被渲染，并且只是简单地基于CSS进行切换。
一般来说，v-if有更高的切换开销，而v-show有更高的初始渲染开销。因此，如果需要非常频繁地切换，则使用v-show较好；如果在运行时条件很少改变，则使用v-if较好。

当v-if与v-for一起使用时，v-for具有比v-if更高的优先级。

v-for指令根据一组数组的选项列表进行渲染。v-for指令需要使用item in items形式的特殊语法，items是源数据数组并且item是数组元素迭代的别名。
v-for支持一个可选的第二个参数为当前项的索引 (item,index) in items
v-for拥有对父级作用域的完全访问权限，即在for循环中也可以使用组件里面的属性
可以使用of替代in作为分隔符 item of items
v-for还可以作用于对象，对对象的属性进行迭代。第三个参数为索引0，1，2...
当vue.js正在更新已渲染过的元素列表时，它默认用“就地复用”策略。如果数据项的顺序被改变，vue将不会移动DOM元素来匹配数据项的顺序，而是简单复用此处每个元素，并且确保它在特定索引下显示已被渲染过的每个元素。这个默认模式是高效的，但是只适用于不依赖子组件状态或临时DOM状态的列表渲染输出。为了给vue一个提示，以便它能跟踪每个节点的身份，从而重用和重新排列现有元素，你需要为每项提供一个唯一key属性。理想的key值是每项都有的且唯一的id，所以需要用v-bind来绑定动态值。
建议尽可能在使用v-for时提供key，除非遍历输出的DOM内容非常简单，或者是刻意依赖默认行以获取性能上的提升。
v-for也可以取整，在这种情况下，它将重复多次模板。
<div>
	<span v-for="n in 10">{{n}}</span>
</div>
结果：12345678910
#变异方法
vue包含一组观察数组的变异方法，所以他们也会触发视图更新。
push/pop/shift/unshift/splice/sort/reverse
变异方法顾名思义就是会改变这些方法调用的原始数组。相比之下，也有非变异方法，例如filter()/concat()/slice()。这些不会改变原始数组，但总是返回一个新数组。
#注意事项
由于JavaScript的限制，Vue不能检测以下变动的数组：
1、当你利用索引直接设置一个项时，例如：vm.items[indexOfItem]=newValue
2、当你修改数组的长度时，例如：vm.items.length=newLength
解决方法
Vue.set(vm.items,indexOfItem,newValue);
vm.items.splice(indexOfItem,1,newValue);
还是由于JavaScript的限制，Vue不能检测队形属性的添加或删除
var vm=new Vue({
	data:{
		a:1
	}
});
vm.a现在是响应式
vm.b不是响应式
解决方法：对于已经创建的实例，Vue不能动态添加根级别的响应式属性。但是，可以使用Vue.set(object,key,value)方法向嵌套对象添加响应式属性。例如，对于：
var vm=new Vue({
	data:{
		userProfile:{
			name:'Anika'
		}
	}
})
你可以添加一个新的age属性到嵌套的userProfile对象
Vue.set(vm.userProfile,'age',27);
或使用object.assign()或_.extend()。
所以，如果你想添加新的响应式属性，不要像这样：
Object.assign(vm.userProfile,{
	age:27,
	favoriteColor:'Vue Green'
})
而应该这样做：
vm.userProfile=Object.assign({},vm.userProfile,{
	age:27,
	favoriteColor:'Vue Green'
})

#v-for和v-if
当他们处于同一节点，v-for的优先级比v-if更高，这意味着v-if将分别重复运行于每个v-for循环中。当你想为仅有的一些项渲染节点时，这种优先级的机制会十分有用，如下：
<li v-for="todo in todos" v-if="!todo.isComplete">
	{{todo}}
</li>
上面的代码只传递了未完成的todos。
而如果你的目的是有条件地跳过循环的执行，那么可以将v-if置于外层元素（或<template>）上。如：
<ul v-if="todos.length">
	<li v-for="todo in todos">
		{{todo}}
	</li>
</ul>
<p v-else>No todos left!</p>














