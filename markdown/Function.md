# Function 常用属性和方法整理

#### Function构造函数创建一个新的Function对象。在JavaScript中，每个函数实际上都是一个Function对象。

#### 语法：

```javascript

	new Function([arg1[,arg2[,...argN]],]functionBody);

	// 参数
	arg1,arg2,...argN //被函数使用的参数的名称必须是合法命名的。参数名称是一个有效的JavaScript标识符的字符串，或者一个用逗号分隔的有效字符串的列表。
	functionBody //一个含有包括函数定义的JavaScript语句的字符串。

```

##### 使用Function构造器生成的Function对象是在函数创建时解析的。这比使用函数声明或者函数表达式并在代码中调用更为低效，因为使用后者创建的函数是跟其他代码一起解析的。

##### 注：使用Function构造器生成的函数，并不会在创建它们的上下文中创建闭包；它们一般在全局作用域中被创建。当运行这些函数的时候，它们只能访问自己的本地变量和全局变量，不能访问Function构造器被调用生成的上下文的作用域。

##### 以调用函数的方式调用Function的构造函数（不是用new关键字）跟以构造函数来调用时一样的。

##### 全局的Function对象没有自己的属性和方法，但是，因为它本身也是函数，所以它也会通过原型链从Function.prototype上继承部分属性和方法。

---

### 原型对象的属性

>#### prototype属性存储了Function的原型对象。

##### Function对象（函数实例）继承自Function.prototype属性。因此Function.prototype不能被修改。

>#### name属性返回函数实例的名称

##### 属性的属性特性：`writable:false;enumerable:false;configurable:true`

#### 示例：

```javascript

	// 使用new Function(...)语法创建的函数
	console.log((new Function).name);//anonymous
	// 变量和方法可以从语法位置推断匿名函数的名称
	let f = function(){};
	let c_f=f;
	let object = {
		someMethod:function(){}
	};
	console.log(f.name);//f
	console.log(c_f.name);//f，定义时的变量名决定了方法名
	console.log(object.someMethod.name);//someMethod

	// 在函数表达式中定义函数的名称
	let fn = function fn_method(){};
	console.log(fn.name);//fn_method
	//fn_method只是一个方法名，放在fn这个对象里，它不是一个变量
	try{
		console.log(fn_method);
	}catch(err){
		console.log(err);//Uncaught ReferenceError: fn_method is not defined
	}

	// 简写方法的名称
	let o ={
		foo(){}
	}
	console.log(o.foo.name);//foo

	//绑定函数的名称
	function foo(){};
	console.log(foo.bind({}).name);//bound foo

	// getter和setter的函数名
	let fn_obj = {
		get foo(){},
		set foo(x){}
	}
	let descriptor = Object.getOwnPropertyDescriptor(fn_obj,'foo');
	console.log(descriptor.get.name);// get foo
	console.log(descriptor.set.name);// set foo

	// Symbol作为函数名称
	let sym1 = Symbol('foo');
	let sym2 = Symbol();

	let sym_o = {
		[sym1]:function(){},
		[sym2]:function(){}
	}
	console.log(sym_o[sym1].name);//[foo]
	console.log(sym_o[sym2].name);// ' '

```

>#### length属性指明函数的形参个数。

#### 属性的属性特性:`writable:false;enumberable:false;configurable:true;`

##### length是函数对象的一个属性值，指该函数有多少个必须要传入的参数，即形参的个数。

##### 形参的数量不包括剩余参数的个数，仅包括第一个具有默认值之前的参数个数。

>#### caller属性返回调用指定函数的函数。

##### 如果一个函数f是在全局作用域内被调用的，则f.caller为null，相反，如果一个函数是在另一个函数作用域内被调用的，则f.caller指向调用它的那个函数。

#### 示例：递归中

```javascript

	function f(n) { g(n-1);console.log('f-n::'+n+';f-caller::',f.caller);};
	function g(n) { if(n>0) f(n);else stop();console.log('g-n::'+n+';g-caller::',g.caller);};
	function stop(){ console.log('stop>>caller::'+stop.caller)};
	f(2);

	// f(2)->g(1)->f(1)->g(0)->stop();

```

#### 结果：可以看到stop里只打印了最后一个调用它的方法，*注意打印的与调用顺序相反，因为把打印放在了调用后面*

![caller](https://upload-images.jianshu.io/upload_images/10187278-356bc0073b4b1a80.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

### 原型对象的方法

>#### apply()，调用一个具有给定this值的函数，以及作为一个数组（或类数组对象）提供的参数。

#### 语法：

```javascript
	
	func.apply(thisArg,[argsArray]);

	// 参数
	thisArg //可选，在func函数运行时使用的this值。注意：this可能不是该方法看到的实际值：如果这个函数处于非严格模式下，则指定为null或undefined时会自动替换为指向全局对象，原始值会被包装。
	argsArray //可选，一个数组或者类数组对象，其中的数组元素将作为单独的参数传给func函数。如果该参数值为null或undefined，则表示不需要传入任何参数。

	// 返回值：调用有指定this值和参数的函数的结果

```

##### 可以使用arguments对象作为argsArray参数，arguments是一个函数的局部变量，它可以被用做被调用对象的所有未指定的参数。这样，在使用apply函数的时候就不需要知道被调用对象的所有参数。可以使用arguments来把所有的参数传递给被调用对象。

#### 示例：

```javascript

	let arr1 = [1,2];
	let arr2 = [3,4,5];
	let arr_c = arr1.concat(arr2);
	console.log(arr_c);//[1, 2, 3, 4, 5]
	console.log(arr1);//[1, 2]
	console.log(arr2);//[3, 4, 5]

	let arr_p = [].push.apply(arr1,arr2);
	console.log(arr_p);//5
	console.log(arr1);//[1, 2, 3, 4, 5]
	console.log(arr2);//[3, 4, 5]

	let num = [3,5,672,12,3,1];

	console.log(Math.max.apply(null,num));//672，基本等同于Math.max(num[1],...)
	console.log(Math.min.apply(null,num));//1
```

#### 注意：如果用上面的方式调用apply，会有超出JavaScript引擎的参数长度限制的风险。当对一个方法传入非常多的参数时，就非常有可能会导致越界问题，这个临界值是根据不同的JavaScript引擎而定的。

>#### call()，调用一个函数，其具有一个指定的this值和分别地提供的参数。

#### 语法：

```javascript

	fun.call(thisArg,arg1,arg2,...);

	// 参数
	thisArg //参考上面apply的thisArg
	arg1,arg2,...; //指定的参数列表

	// 返回值：使用调用者提供的this值和参数调用该函数的返回值。若该方法没有返回值，则返回undefined。

```

#### 示例：匿名函数使用call

```javascript

	let animals = [
		{species:'Lion',name:'King'},
		{species:'Whale',name:'Fail'},
	];
	for(let i = 0;i<animals.length;i++){
		(function(i){
			this.print = function(){
				console.log('#' + i + ' ' + this.species + ': ' + this.name);
			}
		}).call(animals[i],i);
	}
	console.log(animals);

```

#### 结果：
![call](https://upload-images.jianshu.io/upload_images/10187278-9c35cafef4b0829b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 注：如果没有传递第一个参数，this的值将会被绑定为全局对象。在严格模式下this的值将会是undefined。

>#### bind()，创建一个新的函数，在调用时设置this关键字为提供的值。在调用新函数时，将给定参数列表作为原函数的参数序列的前若干项。

#### 语法：

```javascript

	function.bind(thisArg[,arg1[,arg2[,...]]]);

	// 参数
	thisArg //参考Apply的参数，这里必填
	arg1,arg2,...; //当目标函数被调用时，预先添加到绑定函数的参数列表中的参数。

	// 返回值：一个原函数的拷贝，并拥有指定的this值和初始参数

```

##### bind()函数会创建一个新绑定函数(bound function,BF)。绑定函数是一个exotic function object(怪异函数对象)，它包装了原函数对象。调用绑定函数通常会导致执行包装函数。

##### 绑定函数具有以下内部属性：

- [[BoundTargetFunction]] - 包装的函数对象。
- [[BoundThis]] - 在调用包装函数时始终作为this值传递的值。
- [[BoundArguments]] - 列表，在对包函数做任何调用都会优先用列表元素填充参数列表。
- [[Call]] - 执行与此对象关联的代码。通过函数调用表达式调用。内部方法的参数是一个this值和一个包含通过调用表达式传递给函数的参数的列表。

##### 当调用绑定函数时，它调用[[BoundTargetFunction]]上的内部方法[[Call]]，就像Call(boundThis,arg)。其中boundThis是[[BoundThis]]，args是[[BoundArguments]]加上通过函数调用传入的参数列表。

##### 绑定函数也可以使用new运算符构造，它会表现为目标函数已经被构建完毕了似的。提供的this值会被忽略，但前置参数仍会提供给模拟函数。

#### 示例：偏函数，bind()使一个函数拥有预设的初始参数。

```javascript

	function list(){
		return Array.prototype.slice.call(arguments);//将类数组对象转换成数组
	}

	function addArguments(arg1,arg2){
		return arg1+arg2;
	}

	let list1 = list(1,2,3);
	console.log(list1);//[1,2,3]
	let result1 = addArguments(1,2);
	console.log(result1);//3

	let leadingThirtysevenList = list.bind(null,37);
	let addThirtySeven = addArguments.bind(null,37);

	let list2 = leadingThirtysevenList();
	console.log(list2);//[37]

	let list3 = leadingThirtysevenList(1,2,3);
	console.log(list3);//[37,1,2,3]

	let result2 = addThirtySeven(5);
	console.log(result2);// 42 , 37+5

	let result3 = addThirtySeven(5,10);
	console.log(result3);// 42 , 10没有被用到

```

>#### toSource()，返回函数的源代码的字符串表示。

##### toSource方法返回下面的值：

- 对于内置的Function对象，toSource返回下面的字符串：

```javascript

	function Function(){
		[native code]
	}

```

- 对于自定义函数来说，toSource返回能定义该函数的JavaScript源码。

>#### toString()，返回一个表示当前函数源代码的字符串。

##### Function对象覆盖了从Object继承来的toString方法。对于用户定义的Function对象，toString方法返回一个字符串，其中包含用于定义函数的源文本段。

##### 在Function需要转换为字符串时，通常会自动调用函数的toString方法。

##### 若this不是Function对象，则toString()方法将抛出TypeError

#### 示例：

|Function|Function.prototype.toString result|
|:-:|:-:|
|`function f(){}`|"function f(){}"|
|`class A { a(){} `}|"class A { a(){} }"|
|`function* g(){}`|"function* g(){}"|
|`a => a`|"a => a"|
|`({ a(){} }.a)`|"a(){}"|
|`({ *a(){} }.a)`|"*a(){}"|
|`({ [0](){} }[0])`|"\[0\](){}"|
|`Object.getOwnPropertyDescriptor({get a(){}}, "a").get`|"get a(){}"|
|`Object.getOwnPropertyDescriptor({set a(x){}}, "a").set`|"set a(x){}"|
|`Function.prototype.toString`|"function toString() { [native code] }"|
|`(function f(){}.bind(0))`|"function () { [native code] }"|
|`Function("a", "b")`|"function anonymous(a\n) {\nb\n}"|

---

>### [MDN - JavaScript标准库 - Function](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Function)












