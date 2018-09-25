// 如果我们的代码不依赖其他任何模块，可以直接写js代码
//alert('加载成功');
//但这样的话，就没必要使用require.js了。真正常见的情况是，主模块依赖于其他模块，这时就要使用AMD规范定义的的require()函数。
//，主模块的依赖模块是['jquery', 'underscore', 'backbone']。默认情况下，require.js假定这三个模块与main.js在同一个目录，文件名分别为jquery.js，underscore.js和backbone.js，然后自动加载。
//使用require.config()方法，我们可以对模块的加载行为进行自定义。require.config()就写在主模块（main.js）的头部。参数就是一个对象，这个对象的paths属性指定各个模块的加载路径。
require.config({
	/*paths:{
		'jquery':'lib/jquery.min',
		'underscore':'lib/underscore.min',
		'backbone':'lib/backbone.min'
	}*/
	baseUrl:'js/lib',//改变基目录
	paths{
		"jquery": "jquery.min",
　　　　　"underscore": "underscore.min",
　　　　　"backbone": "backbone.min"
	}
	// 上下两种写法效果相同
});
require(['jquery', 'underscore', 'backbone'], function ($, _, Backbone){

　　　　console.log($);

});
//require.js加载的模块，采用AMD规范。也就是说，模块必须按照AMD的规定来写。

//具体来说，就是模块必须采用特定的define()函数来定义。如果一个模块不依赖其他模块，那么可以直接定义在define()函数之中。
//math.js
define(function(){
	var add=function(x,y){
		return x+y;
	};
	return{
		add:add
	};
});
//main.js
require(['main'],function(math){
	alert(math.add(1,1));
});
//如果这个模块还依赖其他模块，那么define()函数的第一个参数必须是一个数组，指明模块的依赖性
define(['myLib'],function(myLib){
	function foo(){
		myLib.doSomething();
	}
	return {
		foo:foo
	}
})
//当require()函数加载上面这个模块的时候，就会先加载myLib.js文件。
//理论上，require.js加载的模块，必须是按照AMD规范、用define()函数定义的模块。但是实际上，虽然已经有一部分流行的函数库（比如jQuery）符合AMD规范，更多的库并不符合。那么，require.js是否能够加载非规范的模块呢？回答是可以的。
//这样的模块在用require()加载之前，要先用require.config()方法，定义它们的一些特征。
//举例来说，underscore和backbone这两个库，都没有采用AMD规范编写。如果要加载它们的话，必须先定义它们的特征。

require.config({

　　　　shim: {//该属性专门用来配置不兼容的模块

　　　　　　'underscore':{
　　　　　　　　exports: '_'//输出的变量名，表名这个模块外部调用时的名称
　　　　　　},

　　　　　　'backbone': {
　　　　　　　　deps: ['underscore', 'jquery'],//依赖的模块
　　　　　　　　exports: 'Backbone'
　　　　　　},
		  //比如，jQuery的插件可以这么定义
		  'jquery.scroll': {

		　　　　deps: ['jquery'],

		　　　　exports: 'jQuery.fn.scroll'

		　　}

　　　　}

});
//require.js还提供一系列插件(https://github.com/requirejs/requirejs/wiki/Plugins)，实现一些特定的功能。

//domready插件，可以让回调函数在页面DOM结构加载完成后再运行。
require(['domready!'], function (doc){

　　　　// called once the DOM is ready

　　});
//text和image插件，则是允许require.js加载文本和图片文件。

define([

　　　　'text!review.txt',

　　　　'image!cat.jpg'

　　　　],

　　　　function(review,cat){

　　　　　　console.log(review);

　　　　　　document.body.appendChild(cat);

　　　　}

　　);
//类似的插件还有json和mdown，用于加载json文件和markdown文件。

