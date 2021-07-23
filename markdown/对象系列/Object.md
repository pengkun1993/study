# Object属性和方法整理

### 首先一个是对JS中Object的理解：JavaScript中函数是一等公民，写在代码中的 `Array/Object/String/Number/Function`其实都是一个构造函数，是用来生成相应的数据类型的变量的。

### 这篇笔记整理Object这个构造函数的常用属性和方法。

### Object构造函数为给定值创建一个对象包装器。如果给定值是null或undefined，将会创建并返回一个空对象，否则，将返回一个与给定值对应类型的对象。

---

>### 一、 Object构造函数的属性

#### 1. Object.length值为1

#### 2. Object.protoType 属性是Object的原型对象。

##### 几乎所有的JavaScript对象都是Object的实例；一个典型的对象继承了Object.prototype的属性（包括方法），尽管这些属性可能被遮蔽（亦称为覆盖）。但是有时候可能故意创建不具有典型原型链继承的对象，比如通过`Object.create(null)`创建的对象，或者通过`Object.setPrototypeOf`方法改变原型链。

##### 改变Object原型，会通过原型链改变所有对象。

##### Object.prototype属性的属性特性： `writable:true;enumerable:false;configurable:true`。

##### 由于JavaScript并不完全具有子类对象，所以原型式一种有用的变通方法，可以使用某些函数的“基类”对象来充当对象。

#### 示例：继承

```javascript

	let Person = function(name){
		this.name = name;//公有属性
		this.cantalk = true;//公有属性
	}
	// 公有方法
	Person.prototype.greet = function(){
		if(this.cantalk){
			console.log('Hi,I am '+this.name);
		}
	}

	let Employee = function(name ,title){
		Person.call(this,name);//继承父级属性
		this.title = title;//私有属性
	}

	//继承父级原型，不直接等于避免子级重写方法时影响到父级的原型方法
	Employee.prototype = Object.create(Person.prototype);

	Employee.prototype.greet = function(){//重写父级方法
		if(this.cantalk){
			console.log('Hi,I am '+this.name+',the '+this.title);
		}
	}

	let Customer = function(name){
		Person.call(this,name);
	}

	Customer.prototype = Object.create(Person.prototype);

	let Mime = function(name){
		Person.call(this,name);
		this.cantalk = false;
	}

	Mime.prototype = Object.create(Person.prototype);

	let bob = new Employee('Bob','Builder');
	let joe = new Customer('Joe');
	let rg = new Employee('Red Green','Handyman');
	let mike = new Customer('Mike');
	let mime = new Mime('Mime');

	bob.greet();//Hi,I am Bob,the Builder
	joe.greet();//Hi,I am Joe
	rg.greet();//Hi,I am Red Green,the Handyman
	mike.greet();//Hi,I am Mike
	mime.greet();

```

>### 二、 Object构造函数的方法

#### 这些方法不会被实例继承，只能通过`Object.fn`（fn表示方法名）来调用。

>#### 1. Object.assign()，用于将所有可枚举属性的值从一个或多个源对象复制到目标对象。

#### 语法：

```javascript

	Object.assign(target,...source);

	// 参数
	target // 目标对象，会被修改
	sources // 源对象，不会被改变

	// 返回值：目标对象，也就是target

```

##### 如果目标对象中的属性具有相同的键，则属性将被源对象中的属性覆盖。后面的源对象的属性将类似地覆盖前面的源对象的属性。

##### Object.assign方法只会拷贝源对象自身的并且可枚举的属性到目标对象。该方法使用源对象的[[get]]和目标对象的[[set]]，所以它会调用相关getter和setter。因此，它分配属性，而不仅仅是复制或定义新的属性。如果合并源包含getter，这可能使其不适合将新属性合并到原型中。

##### String和Symbol类型的属性都会被拷贝。

##### 在出现错误的情况下，例如，如果属性不可写，会引发TypeError，如果在引发错误之前添加了任何属性，则可以更改target对象。

##### Object.assign不会跳过那些值为null何undefined的源对象。

##### Object.assign拷贝的是属性值，如果源对象的属性值是一个对象的引用，那么它也只指向那个引用。

#### 示例：拷贝symbol类型的属性

```javascript

	const o1 = { a:1 };
	const o2 = {[Symbol('foo')]:2};

	const obj = Object.assign({},o1,o2);
	console.log(obj);//{ a : 1, [Symbol("foo")]: 2 } 

```

#### 示例：继承属性和不可枚举属性是不能拷贝的

```javascript

	const obj = Object.create({foo:1},{//foo是个继承属性
		bar:{
			value:2 //bar是个不可枚举属性
		},
		baz:{
			value:3,
			enumerable:true //baz是个自身可枚举属性
		}
	})

	const copy = Object.assign({},obj);
	console.log(copy);// { baz: 3 }

```

#### 示例：原始类型会被包装为对象

```javascript

	const v1 = 'abc';
	const v2 = true;
	const v3 = 10;
	const v4 = Symbol('foo');

	const obj = Object.assign({},v1,null,v2,undefined,v3,v4);
	// 原始类型会被包装，null和undefined会被忽略
	// 注意，只有字符串的包装对象才可能有自身可枚举属性
	
	console.log(obj);//{0: "a", 1: "b", 2: "c"}

```

#### 示例：异常会打断后续拷贝任务

```javascript

	const target = Object.defineProperty({},'foo',{
		value:1,
		writable:false
	});// target的foo属性是个只读属性
	try{
		Object.assign(target,{bar:2},{foo2:3,foo:3,foo3:3},{baz:4});
	}catch(err){
		console.log(err);
	}//如果不使用捕获机制，会造成阻塞，下面的打印无法执行

	console.log(target.bar);
	console.log(target.foo2);
	console.log(target.foo);
	console.log(target.foo3);
	console.log(target.baz);

```

#### 结果：可以看到foo之前的都拷贝成功了，之后的拷贝失败，异常之后assign方法就退出了。

![assign](https://upload-images.jianshu.io/upload_images/10187278-690266c2f14a991f.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 示例：拷贝访问器

```javascript

	const obj = {
		foo:1,
		get bar(){
			return 2;
		}
	}
	console.log(obj);// { foo:1, get bar() { return 2 } }

	let copy = Object.assign({},obj);
	console.log(copy);//{foo: 1, bar: 2} copy.bar的值来自obj.bar的getter函数的返回值
	// 下面这个函数会拷贝所有自有属性的属性描述符
	function completeAssign(target, ...sources){
		sources.forEach(source => {
			let descriptors = Object.keys(source).reduce((descriptors,key)=>{
				descriptors[key] = Object.getOwnPropertyDescriptor(source,key);
				return descriptors;
			},{});

			Object.getOwnPropertySymbols(source).forEach(sym => {
			let descriptor = Object.getOwnPropertyDescriptor(source,sym);
				if(descriptor.enumerable){
					descriptors[sym] = descriptor;
				}
			});
			Object.defineProperties(target,descriptors);
		});
		return target;
	}

	copy = completeAssign({},obj);

	console.log(copy);// { foo:1, get bar() { return 2 } }

```

>#### 2. Object.create()，创建一个新对象，使用现有的对象来提供新创建的对象的`__proto__`。

#### 语法：

```javascript

	Object.create(proto,[propertiesObject]);

	// 参数
	proto //新创建对象的原型对象

	propertiesObject //可选，如果没有指定为undefined，则是要添加到新创建对象的可枚举属性（即其自身定义的属性，而不是其原型链上的枚举属性）的属性描述符以及相应的属性名称。这些属性对应Object.defineProperties()的第二个参数。

	// 返回值：一个新对象，带着指定的原型对象和属性
	
	// 如果propertiesObject参数不是null或一个对象，则抛出一个TypeError异常

```

#### 示例：通过定义对象区分两个参数的意义

```javascript

	// 创建一个原型为null的空对象
	let o = Object.create(null);
	console.log('o::',o);

	let o1 = {};
	console.log('o1::',o1);
	// 以字面量方式创建的空对象就相当于：
	let o2 = Object.create(Object.prototype);
	console.log('o2::',o2);

	let o3 = Object.create(Object.prototype,{
		//foo会成为所创键对象的数据属性
		foo:{
			writable:true,
			configurable:true,
			value:'hello'
		},
		//bar会成为所创建对象的访问器属性
		bar:{
			configurable:false,
			get:function(){
				return 10;
			},
			set:function(value){
				console.log('Setting `o.bar` to',value);
			}
		}
	})
	console.log('o3::',o3);

```

#### 结果：第一个参数会赋值到`__proto__`上，也就是原型链上，第二个参数里的值是被定义对象的自有属性，且第二个参数可规定属性的描述属性。

![create](https://upload-images.jianshu.io/upload_images/10187278-f94b23c6d5b5b6b0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 示例：

```javascript

	function Constructor(){};
	let o = new Constructor();
	console.log('o::',o);//o:: Constructor {}
	//上面一句就相当于：
	let o1 = Object.create(Constructor.prototype);
	//当然如果Constructor函数中有一些初始化代码，Object.create不能执行那些代码，而new会触发方法执行
	console.log('o1::',o1);//o1:: Constructor {}

	// 创建一个一另一个空对象为原型，且拥有一个属性p的对象
	let o2 = Object.create({},{p:{value:21}});

	//省略的的属性特性默认为false，所以属性p是不可写，不可枚举，不可配置的：
	o2.p = 24
	console.log(o2.p);//21

	o2.q = 12

	for(let prop in o2 ){
		console.log(prop);
	}//q

	console.log(delete o2.p);//false

	console.log('delete >> o2 ::',o2);//delete >> o2 :: {q: 12, p: 21} 删除失败

```

#### 示例：用Object.create实现类式继承

```javascript

	// Shape - 父类
	function Shape(){
		this.x = 0;
		this.y = 0;
	}
	// 父类的方法
	Shape.prototype.move = function(x,y){
		this.x+=x;
		this.y+=y;
		console.log('Shape move execute');
	}

	// 子类
	function Rectangle(){
		Shape.call(this);
	}

	// 继承父类
	Rectangle.prototype = Object.create(Shape.prototype);
	Rectangle.prototype.constructor = Rectangle;

	let rect = new Rectangle();

	console.log(rect);

```

#### 结果：使用Object.create实现链式继承，子类重写proto不会影响父类的proto

![create实现继承](https://upload-images.jianshu.io/upload_images/10187278-b85ea2a875c44ad3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240))

>#### 3. 属性描述符相关方法：

#### `defineProperty,defineProperties,getOwnPropertyDescriptor,getOwnPropertyDescriptors,getOwnPropertyNames,getOwnPropertySymbols`

##### 在 Javascript 中， 属性 由一个字符串类型的“名字”（name）和一个“属性描述符”（property descriptor）对象构成。

#### 属性描述符：

##### 对象里目前存在的属性描述符有两种主要形式：**数据描述符** 和 **存取描述符**。

##### 数据描述符是一个具有值的属性，该值可能是可写的，也可能是不可写的。

##### 存取描述符是由getter-setter函数对描述的属性。

##### 描述符必须是上面两种形式之一，不能同时是两者。

##### 数据描述符和存取描述符的键值对比：

||数据描述符|存取描述符|键值属性描述|
|:-:|:-:|:-:|:-|
|configurable|yes|yes|当且仅当该属性的该值为true时，该属性描述符才能够改变，同时该属性也能从对应的对象上被删除。默认为false。|
|enumerable|yes|yes|当且仅当该属性的该值为true时，该属性才能够出现在对象的枚举属性中。默认为false。|
|value|yes|no|该属性对应的值。可以是任何有效的JavaScript值。默认为undefined。|
|writable|yes|no|当且仅当该属性的该值为true时，value才能被赋值运算符改变。默认为false。|
|get|no|yes|一个给属性提供getter的方法，如果没有getter则为undefined。当访问该属性时，该方法会被执行，方法执行时没有参数传入，但是会传入this对象（由于继承关系，这里的this并不一定是定义该属性的对象）。默认为undefined。|
|set|no|yes|一个给属性提供setter的方法，如果没有setter则为undefined。当属性值修改时，触发执行该方法。该方法将接受唯一参数，即该属性新的参数值。默认为undefined。|

##### 如果一个描述符不具有value，writable,get和set任意一个关键字，那么它将被认为是一个数据描述符。

##### 如果一个描述符同时有（value或writable)和(get或set)关键字，将会产生一个异常。

>#### defineProperty()，会直接在一个对象上定义一个新属性，或者修改一个对象的现有属性，并返回这个对象。

#### 语法：

```javascript

	Object.defineProperty(obj,prop,descriptor);

	// 参数
	obj //要在其上定义属性的对象
	prop //要定义或修改的属性的名称
	descriptor // 将被定义或修改的属性描述符

	// 返回值：被传递给函数的对象，即这里的参数obj

```

##### 该方法允许精确添加或修改对象的属性。通过赋值操作添加的普通属性是可枚举的，能够在属性枚举期间呈现出来（for...in或Object.keys方法），这些属性的值可以被改变，也可以被删除。

##### 这个方法允许修改默认的额外选项（或配置）。默认情况下，使用Object.defineProperty()添加的属性值是不可修改的。

##### 如果对象中不存在指定的属性，`Object.defineProperty()`就创建这个属性。

##### 当描述符中省略某些字段时，这些字段将使用它们的默认值。

##### 一个没有`get/set/value/writable`定义的属性被称为“通用的”，并被“键入”为一个数据描述符。

##### 如果属性已经存在，`Object.defineProperty()`将尝试根据描述符中的值以及对象当前的配置来修改这个属性。

##### 如果旧描述符将其configurable属性设置为false，则该属性被认为是“不可配置的”，并且没有属性可以被改变（除了单向改变writable为false）。当属性不可配置是，不能再数据和访问属性类型之间切换。

##### 当试图改变不可配置属性（除了value和writable属性之外）的值时会抛出TypeError，除非当前值和新值相同。

#### 示例：各个修饰符的不同情况演示

```javascript

	//writable
	let o ={};

	Object.defineProperty(o,'a',{
		value:37,
		writable:false
	})

	console.log(o.a);//37
	o.a = 12;//无效，严格模式下会报错
	console.log(o.a);//37

	// enumerable
	let o1 = {};

	Object.defineProperty(o1,'a',{value:1,enumerable:true});
	Object.defineProperty(o1,'b',{value:2,enumerable:false});
	Object.defineProperty(o1,'c',{value:3});//enumerable默认false
	o1.d = 4; //如果使用直接赋值的方式创建对象的属性，则这个属性的enumerable为true

	for(let i in o1){
		console.log(i);
	}//a,d

	console.log(Object.keys(o1));//["a", "d"]

	//configurable，表示对象的属性是否可以被删除，以及除value和writable特性外的其他特性是否可以被修改。
	
	let o2 = {};

	Object.defineProperty(o2,'a',{
		get:function(){
			return 1;
		},
		configurable:false
	});
	try{
		Object.defineProperty(o2,'a',{configurable:true});//报错
	}catch(err){
		console.log(err);//TypeError: Cannot redefine property: a
	}
	try{
		Object.defineProperty(o2,'a',{enumerable:true});
	}catch(err){
		console.log(err);//ypeError: Cannot redefine property: a
	}
	try{
		Object.defineProperty(o2,'a',{set:function(){}});
	}catch(err){
		console.log(err);//TypeError: Cannot redefine property: a
	}
	try{
		Object.defineProperty(o2,'a',{get:function(){return 1;}});
	}catch(err){
		console.log(err);//TypeError: Cannot redefine property: a
	}

	console.log(o2.a);//1
	o2.a = 3;delete o.a;//这两句都无效
	console.log(o2.a);//1

```

#### 示例：添加多个属性和默认值

```javascript

	let o = {};
	o.a = 1;
	// 等同于：
	Object.defineProperty(o,'a',{
		value:1,
		writable:true,
		configurable:true,
		enumerable:true
	});

	Object.defineProperty(o,'b',{value:1});
	//等同于：
	Object.defineProperty(o,'b',{
		value:1,
		writable:false,
		configurable:false,
		enumerable:false
	});

```

#### 示例：实现一个自存档对象。当设置temperature属性时，archive数组会获取日志条目。

```javascript

	function Archiver(){
		let temperature = null;
		let archive = [];

		Object.defineProperty(this,'temperature',{
			get:function(){
				console.log('get!');
				return temperature;
			},
			set:function(value){
				temperature = value;
				archive.push({val:temperature});
			}
		})

		this.getArchive = function(){
			return archive;
		};
	}

	let arc = new Archiver();
	console.log('arc::',arc);
	arc.temperature = 11;
	arc.temperature =12;
	console.log('arc.getArchive::',arc.getArchive());

```

#### 结果：temperature一开始是(...)三个点，点击后才系那是12，而且这时输出'get!'，说明getter类型的属性，在控制台一开始不输出，点击后才触发getter方法从而输出。

![defineProperty](https://upload-images.jianshu.io/upload_images/10187278-cf6a34ddf6341cb5.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 示例：继承属性

```javascript

	function myclass(){
	}
	let value;
	Object.defineProperty(myclass.prototype,'x',{
		get(){
			return value;
		},
		set(x){
			value = x;
		}
	});

	let a = new myclass();
	let b = new myclass();
	a.x = 1;
	console.log(b.x);//1
	// MDN说法：如果访问者的属性是被继承的，它的 get 和set 方法会在子对象的属性被访问或者修改时被调用。如果这些方法用一个变量存值，该值会被所有对象共享。
	// 个人理解：上面的构造函数myclass的公共属性x在原型链上，所以实例a修改x值会作用到myclass原型链上，所以b.x也被改变了
	
	//可以通过将值存储在另一个属性中解决，如下面添加y属性，这里x属性不能被修改了，因为它的configurable为false
	Object.defineProperty(myclass.prototype,'y',{
		get(){
			return this.stored_y;
		},
		set(y){
			this.stored_y;
		}
	});

	let a1 = new myclass();
	let b1 = new myclass();
	a1.y = 1;
	console.log(b1.y);//undefined
	//this指向实例，所以每一个实例上有一个自己的stroed_y，就不会修改掉别的实例的属性了。
	
	//上面的是访问者属性，而值属性始终在对象自身上设置，而不是一个原型。所以为了防止构造函数原型链上的属性被修改，可以把它设置为不可写的。

```

>#### Object.defineProperties()，直接在一个对象上定义新的属性或修改现有属性，并返回该对象。

#### 语法：

```javascript

	Object.defineProperties(obj,props);

	//参数
	obj //在其上定义或修改属性的对象
	props //要定义其可枚举属性或修改的属性描述符的对象

	// 返回值：被传递给函数的对象，即这里的参数obj	

```

##### Object.defineProperties与Object.defineProperty基本相同，差别就是前者可以一次定义多个属性而后者每次只定义或修改一个属性。

#### 示例：

```javascript

	let obj = {};

	Object.defineProperties(obj,{
		'property1':{
			value:true,
			writable:true
		},
		'property2':{
			value:'hello',
			writable:false
		}
	});

```

>#### Object.getOwnPropertyDescriptor()，返回指定对象上一个自由属性对应的属性描述符。（自有属性：直接赋予对象的属性，不需要从原型链上进行查找的属性）

#### 语法：

```javascript

	Object.getOwnPropertyDescriptor(obj,prop);

	//参数
	obj //需要查找的目标对象
	prop // 目标对象内属性名称

	// 返回值：如果指定的属性存在于对象上，则返回其属性描述符对象，否则返回undefined。

```

#### 示例：

```javascript

	let o , d;
	o = { get foo(){return 12}};
	d = Object.getOwnPropertyDescriptor(o,'foo');
	console.log(d);
	/*{
	  configurable: true,
	  enumerable: true,
	  get: //the getter function,
	  set: undefined
	}*/
	o = { bar:42 };
	d = Object.getOwnPropertyDescriptor(o,'bar');
	console.log(d);
	/*{
	  configurable: true,
	  enumerable: true,
	  value: 42,
	  writable: true
	}*/

	//如果第一参数不是对象，在ES6之前会报错，之后会强制转换为对象。
	let p = Object.getOwnPropertyDescriptor('foo',0);
	console.log(p);
	/*{
	  configurable: false,
	  enumerable: true,
	  value: "f",
	  writable: false
	}*/
```

>#### Object.getOwnPropertyDescriptors()，获取一个对象的所有自身属性的描述符。

#### 语法：

```javascript

	Object.getOwnPropertyDescriptors(obj);

	// 参数
	obj //任意对象

	// 返回值：所有指定对象的所有自身属性的描述符，如果没有任何自身属性，则返回空对象。

```

#### 示例：浅拷贝一个对象

```javascript

	Object.create(Object.getPrototypeOf(obj),Object.getOwnPropertyDescriptors(obj));

	// 这个方法可以拷贝所有属性，与Object.assign相比，Object.assign只能拷贝源对象的可枚举的自身属性，同时拷贝时无法拷贝属性的特性，而且访问其属性会被转换成数据属性，也无法拷贝源对象的原型。

```

>#### Object.getOwnPropertyNames()，返回一个由指定对象的所有自身属性的属性名（包括不可枚举属性但不包括Symbol值作为名称的属性）组成的数组。

#### 语法：

```javascript

	Object.getOwnPropertyNames(obj);

	// 参数
	obj //一个对象，其自身的可枚举和不可枚举属性的名称被返回

	// 返回值：在给定对象上找到的自身属性对应的字符串数组

```

#### 示例：

```javascript

	let arr = ['a','b','c'];

	console.log(Object.getOwnPropertyNames(arr));//["0", "1", "2", "length"]

	// 不会获取到原型链上的属性
	function ParentClass(){};

	ParentClass.prototype.inheritedMethod = function(){};

	function ChildClass(){
		this.prop = 5;
		this.method = function(){};
	}

	ChildClass.prototype = new ParentClass;
	ChildClass.prototype.prototypeMethod = function(){};

	console.log(
		Object.getOwnPropertyNames(
				new ChildClass()
			)
		);//['prop','method'];

	// ES6之后该方法会把参数强制转换成对象，ES6之前会抛出错误
	Object.getOwnPropertyNames('foo');//['length', '0', '1', '2']

```

>#### Object.getOwnPropertySymbols()，返回一个给定对象自身的所有Symbol属性的数组。

#### 语法：

```javascript

	Object.getOwnPropertySymbols(obj);

	// 参数
	obj //要返回Symbol属性的对象

	// 返回值：在给定对象自身上找到的所有Symbol属性的数组，如果没有则返回空数组。

```

#### 示例：

```javascript

	let obj = {};
	let a = Symbol('a');
	let b = Symbol.for('b');

	obj[a] = 'localSymbol';
	obj[b] = 'globalSymbol';

	let objectSymbols = Object.getOwnPropertySymbols(obj);

	console.log(objectSymbols);//[Symbol(a), Symbol(b)]

```

>#### 4. 操作原型对象：`getPrototypeOf,setPrototypeOf`

##### 由于现代JavaScript引擎优化属性访问所带来的特性的关系，更改对象的[[prototype]]在各个浏览器和JavaScript引擎上都是一个很慢的操作。其在更改继承的性能上的影响是微妙而又广泛的，这不仅仅限于 `obj.__proto__ = ...`语句上的时间花费，而且可能延伸到任何代码，那些可以访问任何[[prototype]]已被更改的对象的代码。如果你关心性能，应该避免设置一个对象的[[prototype]]。相反，你应该使用Object.create()来创建带有想要的[[prototype]]的新对象。

>#### Object.setPrototypeOf()，设置一个指定的对象的原型到另一个对象或null。

#### 语法：

```javascript

	Object.setPrototypeOf(obj,prototype);

	// 参数
	obj //要设置其原型的对象
	prototype //该对象的新原型

```

##### 如果对象的[[prototype]]被修改成不可扩展，就会抛出TypeError异常。如果prototype参数不是一个对象或者null（如数字，字符串，boolean，或者undefined），则会抛出错误。否则，该方法将obj的[[prototype]]修改为新的值。

##### Object.setPrototypeOf()是ECMAScript 6最新草案中的方法，相对于`Object.prototype.__proto__`，它被认为是修改对象原型更合适的方法。

#### 示例：

```javascript

	let dict = Object.setPrototypeOf({},null);

	console.log(dict);//{} No properties
	
	try{
		let dict1 = Object.setPrototypeOf({},'abc');
	}catch(err){
		console.log(err);//TypeError: Object prototype may only be an Object or null: abc at Function.setPrototypeOf (<anonymous>)
	}

```

>#### Object.getPrototypeOf()，返回指定对象的原型（内部[[prototype]属性的值）。

#### 语法：

```javascript

	Object.getPrototypeOf(object);

	// 参数
	obj // 要返回其原型的对象。

	// 返回值：给定对象的原型。如果没有继承属性，则返回null

```

#### 示例：

```javascript

	let proto = {};

	let obj = Object.create(proto);

	console.log(Object.getPrototypeOf(obj) === proto);//true

	let reg = /a/;
	console.log(Object.getPrototypeOf(reg) === RegExp.prototype);//true

```

#### 示例：Object.getPrototypeOf(Object) 不是 Object.prototype

```javascript

	// Javascript 中的Object是构造函数。
	let og = Object.getPrototypeOf(Object);
	let fg = Object.getPrototypeOf(Function);

	console.log(og);//ƒ () { [native code] }
	console.log(fg);//ƒ () { [native code] }
	console.log(og === fg);//true
	console.log(og === Function.prototype);//true
	// Object.getPrototypeOf( Object )是把Object这一构造函数看作对象，返回的当然是函数对象的原型，也就是 Function.prototype。

```

##### 如果参数不是一个对象类型，会被强制转换为一个object。（es6之前会报错）

>#### 4. 键值相关方法：`entries/keys,values`

#### 还有一个entries的反转函数：fromEntries

>#### Object.entries()，返回一个给定对象自身可枚举属性的键值对数组，其排列与使用`for...in`循环遍历对象时返回的顺序一致（区别在于for-in循环也枚举原型链中的属性）。

#### 语法：

```javascript

	Object.entries(obj);

	//参数
	obj //可以返回其可枚举属性的键值对的对象

	// 返回值：给定对象自身可枚举属性的键值对数组

```

#### 示例：

```javascript

	const myObj = Object.create({},{getFoo:{value(){return this.foo;}}});//getFoo是不可枚举属性
		myObj.foo = 'bar';
	console.log(Object.entries(myObj));//[['foo','bar']]

	console.log(Object.entries('foo'));//[['0':'f'],['1','o'],['2','o']]

	// 返回的数组进行iterate遍历
	const obj = { a:5,b:7,c:9 };
	for(const [key,value] of Object.entries(obj)){
		console.log(`${key} ${value}`);
	}// a 5 / b 7 /c 9

```

>#### Object.keys()，返回一个由一个给定对象的自身可枚举属性组成的数组，数组中属性名的排列顺序和使用`for...in`循环遍历该对象时返回的顺序一致。

#### 语法：

```javascript

	Object.keys(obj);

	// 参数
	obj // 要返回其枚举自身属性的对象

	// 返回值：一个表示给定对象的所有可枚举属性的字符串数组。

```

#### 示例：

```javascript

	let arr = ['a','b','c'];
	console.log(Object.keys(arr));//["0", "1", "2"]

	let myObj = Object.create({},{
		getFoo:{
			value:function(){
				return this.foo;
			}
		}
	})//getFoo是不可枚举属性

	myObj.foo =1;
	console.log(Object.keys(myObj));//["foo"]

	console.log(Object.keys('foo'));//["0", "1", "2"]

```

>#### Object.values()，返回一个给定对象自身的所有可枚举属性值的数组。

#### 语法和规则参照Object.keys()，一个返回key一个返回value。

>#### Object.fromEntries()，把键值对列表转换为一个对象。Object.fromEntries 是 Object.entries() 的反转函数。

#### 语法：

```javascript

	Object.fromEntries(iterable);

	// 参数
	iterable // 类似实现了可迭代协议Array或者Map或者其他可迭代对象。

	// 返回值：一个包含提供的可迭代对象条目的对应属性的新对象

```

#### 试验了下，Chrome浏览器暂不支持。

>#### 5. 操作对象与判断对象：

`freeze/preventExtensions/seal/isfreeze/isExtensible/isSealed`

##### 定义：

##### Object.freeze()，冻结一个对象。一个被冻结的对象再也不能被修改；冻结了一个对象则不能向这个对象添加新的属性，不能删除已有属性，不能修改该对象已有属性的可枚举性、可配置性、可写性，以及不能修改已有属性的值。此外，冻结一个对象后该对象的原型也不能被修改。

##### Object.seal()，封闭一个对象，阻止添加新属性并将所有现有属性标记为不可配置。当前属性的值只要可写就可以改变。

##### Object.preventExtensions()，让一个对象变的不可扩展，也就是永远不能再添加新的属性。

##### Object.isFrozen()，判断一个对象是否被冻结。

##### Object.isSealed()，判断一个对象是否被密封。

##### Object.isExtensible()，判断一个对象是否是可扩展的。

##### 语法：

```javascript

	Object.fn(obj);//fn代表：freeze/seal/preventExtensions

	//参数
	obj //将要被改变的对象

	// 返回值：被改变的对象，也就是传进来的参数obj的引用
	
	Object.fun(object);//fun代表： isFrozen/isSealed/isExtensible

	// 参数
	object //需要检测的对象

	// 返回值：给定对象是否是相应类型的Boolean值

```

#### 总结为一个表格，对比几个方法：

||添加属性|删除属性|修改属性|configurable|writable|isFrozen|isSealed|isExtensible|
|:-:|:-:|:-:|:-:|:-:|:-:|:-:|:-:|:-:|
|freeze()|No|No|No|false|false|true|true|false|
|seal()|No|No|Yes|false|true|空对象：true;非空对象：false|true|false|
|preventExtensions()|No|Yes|Yes|true|true|空对象：true;非空对象：false|空对象：true;非空对象：false|false|

##### 自我总结：首先一个对象天生是可扩展的，可以通过preventExtensions设置成不可扩展，则此时该对象是不可扩展对象，然后设置该对象的所有属性的configurable为false，则此时该对象是封闭对象，之后设置该对象的所有属性的writable为false，则此时该对象就是被冻结的对象。

##### 所有这个修改都是针对对象的直接属性，如果对象的属性值是一个引用类型，则属性指向的对象不受影响。

##### 这几个方法对数组同样有效。

##### 上面三种类型的对象，都不能更改原型（`setPrototypeOf()/__proto__`)

#### 示例：

```javascript

	console.log('================preventExtensions====================');
	let obj = {
		prop:function(){},
		foo:'bar',
	};
	Object.defineProperty(obj,'baz',{
		get:function(){
			return this.x;
		},
		set:function(x){
			this.x = x;
		},
		configurable:true,
		enumerable:true
	})
	console.log(Object.getOwnPropertyDescriptors(obj));
	console.log('================preventExtensions(obj)====================');
	let o = Object.preventExtensions(obj);
	console.log('o === obj ::',o === obj);
	console.log(Object.getOwnPropertyDescriptors(obj));

	console.log('================seal==============')
	let obj1 = Object.assign({},obj);
	console.log(Object.getOwnPropertyDescriptors(obj1));
	console.log('================seal(obj1)====================');
	let o1 = Object.seal(obj1);
	console.log(Object.getOwnPropertyDescriptors(obj1));

	console.log('================freeze==============')
	let obj2 = Object.assign({},obj);
	let o2 = Object.freeze(obj2);
	console.log(Object.getOwnPropertyDescriptors(obj2));

	console.log(Object.isExtensible(1));//false
	console.log(Object.isFrozen(1));//true
	console.log(Object.isSealed(1));//true

```

#### 结果：

![freeze](https://upload-images.jianshu.io/upload_images/10187278-37efe26ec805100a.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 示例：深度冻结，避免对象的引用包含循环引用，否则会造成死循环。

```javascript

	function deepFreeze(obj){
		let propNames = Object.getOwnPropertyNames(obj);

		propNames.forEach(function(name){
			let prop = obj[name];

			if(typeof prop == 'object' && prop !== null){
				deepFreeze(prop);
			}
		})

		return Object.freeze(obj);
	}

```

>#### 6. Object.is()，判断两个值是否是相同的值。

#### 语法：

```javascript

	Object.is(value1,value2);

	// 参数
	value1 //需要比较的第一个值
	value2 //需要比较的第二个值

	// 返回值：表示两个参数是否相同的Boolean.

```

##### Object.is()的判断逻辑和传统的`==`运算符不同，`==`运算符会对两边的操作数做隐式类型转换，但是Object.is不会做这种类型转换。

##### Object.is()与`===`运算符也不一样。`===`运算符将数字`-0`和`+0`视为相等，并且认为`Number.NaN`不等于`NaN`。

#### 示例：相等逻辑

```javascript

	//两个值都是 undefined
	console.log(Object.is(undefined,undefined));//true
	console.log(undefined == undefined);//true
	console.log(undefined === undefined);//true
	//两个值都是 null
	console.log(Object.is(null,null));//true
	console.log(null == null);//true
	console.log(null === null);//true
	// 两个值都是 true 或者都是 false
	// 两个值是由相同个数的字符按照相同的顺序组成的字符串
	// 两个值指向同一个对象
	// 都是正零 +0
	// 都是负零 -0
	// 都是 NaN
	// 都是除零和 NaN 外的其它同一个数字
	
	console.log(Object.is(NaN,NaN));//true
	console.log(NaN == NaN);//false
	console.log(NaN === NaN);//false

	console.log(Object.is(+0,-0));//false
	console.log(+0 == -0);//true
	console.log(+0 === -0);//true

```

#### 示例：Polyfill（ie浏览器不支持Object.is，可以使用这个）

```javascript

	if(!Object.is){
		Object.is = function(x,y){
			if(x === y){//此时要考虑的是 +0和-0
				return x!== 0 || 1/x === 1/y;
			}else{
				return x !== x && y !== y;
			}
		}
	}

```

>### 三、Object原型对象的属性

#### JavaScript中的所有对象都来自Object；所有对象从Object.prototype继承方法和属性，尽管它们可能被覆盖。

>#### Object.prototype.constructor，返回创建实例对象的Object构造函数的引用。注意，此属性的值是对函数本身的引用，而不是一个包含函数名称的字符串。对原始类型来说，如`1/true/'test'`，该值只可读。

#### 描述：所有对象都会从它的原型上继承一个constructor属性：

```javascript

	let o = {};
	console.log(o.constructor === Object);//true

	let o1 = new Object;
	console.log(o1.constructor === Object);//true

	let a = [];
	console.log(a.constructor === Array);//true

	let a1 = new Array;
	console.log(a1.constructor === Array);//true

	let n = new Number(3);
	console.log(n.constructor === Number);//true

```

#### 示例：打印一个对象的构造函数

```javascript

	function Tree(name){
		this.name = name;
	}

	let theTree = new Tree('Redwood');
	console.log('theTree.constructor is',theTree.constructor);
	/*theTree.constructor is ƒ Tree(name){
		this.name = name;
	}*/

```

#### 示例：修改基本类型对象的constructor属性的值。

```javascript

	function Type(){};
	let types = [
		new Array,
		[],
		new Boolean,
		true,
		new Date,
		new Error,
		new Function,
		function(){},
		Math,
		new Number,
		1,
		new Object,
		{},
		new RegExp,
		/(?:)/,
		new String,
		'test'
	];
	for(let i =0;i<types.length;i++){
		types[i].constructor = Type;
		types[i]=[types[i].constructor,types[i] instanceof Type,types[i].toString()];
	}
	console.log(types.join('\n'));

```

#### 结果：只有 true, 1 和 "test" 的不受影响，因为创建他们的是只读的原生构造函数（native constructors）。这个例子也说明了依赖一个对象的 constructor 属性并不安全。

![constructor](https://upload-images.jianshu.io/upload_images/10187278-b7f5c290a6d358a3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 注意：手动设置或更新构造函数可能会导致不同且有时令人困惑的后果。为了防止它，只需在每个特定情况下定义构造函数的角色。在大多数情况下，不使用构造函数，并且不需要重新分配构造函数。

>#### Object.prototype.__proto__，这是一个访问器属性，暴露了通过它访问的对象的内部[[prototype]]。

##### 使用`__proto__`是有争议的，也不鼓励使用它。因为它从来没有被包括在ECMAScript语言规范中，但是现代浏览器都实现了它。`__proto__`属性已在ECMAScript 6语言规范中标准化，用于确保Web浏览器的兼容性，因此它未来将被支持。它已被不推荐使用，现在更推荐使用`Object.getPrototypeOf/Reflect.getPrototypeOf`和`Object.setPrototypeOf/Reflect.setPrototypeOf`。尽管如此，设置对象的[[prototype]]是一个缓慢的操作，如果性能是一个问题，应该避免。

##### `__proto__`的读取器(getter)暴露了一个对象的内部 [[Prototype]] 。也就是对象的`__proto__`指向它的构造函数的`prototype`。对于使用对象字面量创建的对象，这个值是 `Object.prototype`。对于使用数组字面量创建的对象，这个值是 `Array.prototype`。对于functions，这个值是`Function.prototype`。对于使用 new fun 创建的对象，其中fun是由js提供的内建构造器函数之一(Array, Boolean, Date, Number, Object, String 等等），这个值总是fun.prototype。对于用js定义的其他js构造器函数创建的对象，这个值就是该构造器函数的prototype属性。

>### 四、Object原型对象的方法

#### 这些方法放在Object这个构造函数的prototype上，能够被对象实例所继承使用。

>#### 1.hasOwnProperty()，返回一个布尔值，指示对象自身属性中是否具有指定的属性。

#### 语法：

```javascript

	obj.hasOwnProperty(prop);

	// 参数
	prop //要检测的属性字符串名称或者Symbol

	// 返回值：用来判断某个对象是否含有指定的属性的逻辑值。

```

##### 所有继承了Object的对象都会继承到该方法，这个方法可以用来检测一个对象是否含有特定的**自身属性**；和in运算符不同，该方法会忽略掉那些从原型链上继承到的属性。

#### 示例：自身属性与继承属性

```javascript

	let o = new Object();

	o.prop = 'exists';
	console.log(o.hasOwnProperty('prop'));//true
	console.log(o.toString());//[object Object]
	console.log(o.hasOwnProperty('toString'));//false
	console.log(o.hasOwnProperty('hasOwnProperty'));//false

```

#### 示例：JavaScript并没有保护hasOwnProperty属性名，因此某个对象是有可能存在使用这个属性名的属性，使用外部的hasOwnProperty获得正确的结果是需要的：

```javascript

	var foo = {
	    hasOwnProperty: function() {
	        return false;
	    },
	    bar: 'Here be dragons'
	};

	foo.hasOwnProperty('bar'); // 始终返回 false

	// 如果担心这种情况，可以直接使用原型链上真正的 hasOwnProperty 方法
	({}).hasOwnProperty.call(foo, 'bar'); // true

	// 也可以使用 Object 原型上的 hasOwnProperty 属性
	Object.prototype.hasOwnProperty.call(foo, 'bar'); // true

```

>#### 2.propertyIsEnumerable()，返回一个布尔值，表示指定的属性是否可枚举。

#### 语法：

```javascript

	obj.propertyIsEnumerable(prop);

	//参数
	prop //需要测试的属性名

	// 返回值：用来表示指定的属性名是否可枚举的逻辑值

```

##### 此方法可以确定对象中指定的属性是否是可以被for...in循环枚举，但是通过原型链继承的属性除外。如果对象没有指定的属性，则此方法返回false。

#### 示例：

```javascript

	var a = [];
	a.propertyIsEnumerable('constructor');         // 返回 false

	function firstConstructor() {
	  this.property = 'is not enumerable';
	}

	firstConstructor.prototype.firstMethod = function() {};

	function secondConstructor() {
	  this.method = function method() { return 'is enumerable'; };
	}

	secondConstructor.prototype = new firstConstructor;
	secondConstructor.prototype.constructor = secondConstructor;

	var o = new secondConstructor();
	o.arbitraryProperty = 'is enumerable';

	o.propertyIsEnumerable('arbitraryProperty');   // 返回 true
	o.propertyIsEnumerable('method');              // 返回 true
	o.propertyIsEnumerable('property');            // 返回 false

	o.property = 'is enumerable';

	o.propertyIsEnumerable('property');            // 返回 true

	// 这些返回fasle，是因为，在原型链上propertyIsEnumerable不被考虑
	// (尽管最后两个在for-in循环中可以被循环出来)。
	o.propertyIsEnumerable('prototype');   // 返回 false (根据 JS 1.8.1/FF3.6)
	o.propertyIsEnumerable('constructor'); // 返回 false
	o.propertyIsEnumerable('firstMethod'); // 返回 false

```

>#### 3.isPrototype()，方法用于测试一个对象是否存在于另一个对象的原型链上。

#### 语法：

```javascript

	prototypeObj.isPrototypeOf(object);

	// 参数
	object //在改对象的原型链上搜寻
	
	// 返回值：表示调用对象是否在另一个对象的原型链上。
	// 如果prototypeObj为undefined或null，会抛出TypeError。

```

##### isPrototypeOf() 与 instanceof 运算符不同。在表达式 "object instanceof AFunction"中，object 的原型链是针对 AFunction.prototype 进行检查的，而不是针对 AFunction 本身。

#### 示例：

```javascript

	function Foo(){};
	function Bar(){};
	function Baz(){};

	Bar.prototype = Object.create(Foo.prototype);
	Baz.prototype = Object.create(Bar.prototype);

	let baz = new Baz();

	console.log(Baz.prototype.isPrototypeOf(baz));//true
	console.log(Bar.prototype.isPrototypeOf(baz));//true
	console.log(Foo.prototype.isPrototypeOf(baz));//true
	console.log(Object.prototype.isPrototypeOf(baz));//true

```

#### 如果有段代码只需要操作继承自一个特定的原型链的对象的情况下执行，同instanceOf操作符一样isPrototypeOf()方法就会派上用场。

>#### 4.toString()，返回一个表示该对象的字符串。

#### 语法：

```javascript

	object.toString();

	// 返回值：表示该对象的字符串。

```

##### 每个对象都有一个toString()方法，当该对对象表示为一个文本值时，或者一个对象以预期的字符串方式引用时自动调用。默认情况下，toString()方法被每个Object对象继承。如果此方法在自定义对象中未被覆盖，toString()返回[object type]，其中type是对象的类型。

##### null/undefined直接调用toString()方法报错。

#### 示例：使用toString()检验对象类型，由于对象可以重写覆盖toString()方法，需要以Function.prototype.call()或者Function.prototype.apply()的形式来调用，传递要检查的对象作为第一个参数，称为thisArg。

```javascript

	let toString = Object.prototype.toString;

	console.log(toString.call(new Date));//[object Date]
	console.log(toString.call(new String));//[object String]
	console.log(toString.call(Math));//[object Math]

	console.log(toString.call(undefined));//[object Undefined]
	console.log(toString.call(null));//[object Null]

	function fn(){
		this.name = 'fn';
	}

	let obj_fn = new fn;
	console.log(obj_fn.toString());//[object Undefined]
	console.log(toString.call(obj_fn));//[object Null]

```

>#### 5.toLocaleString()，返回一个该对象的字符串表示。此方法被用于派生对象为了特定语言环境的目的（locale-specific purposes）而重载使用。

##### Object toLocaleString()返回调用toString()的结果。

>#### 6.toSource()，返回一个表示对象源代码的字符串。

##### 该特性是非标准的，尽量不要在生产环境使用，浏览器支持率很低，不属于任何标准的一部分。

>#### 7.valueOf()，返回指定对象的原始值。

#### 语法：

```javascript

	object.valueOf();

	// 返回值：该对象的原始值。

```

##### JavaScript调用valueOf方法将对象转换为原始值。当遇到要使用预期的原始值的对象时，JavaScript会自动调用它。

##### 默认情况下，valueOf方法由Object后面的每个对象继承。每个内置的核心对象都会覆盖此方法以返回适当的值。如果对象没有原始值，则valueOf返回对象本身。

#### 不同类型对象的valueOf方法的返回值：

|对象|返回值|
|:-:|:-:|
|Array|返回数组对象本身|
|Boolean|布尔值|
|Date|存储的时间是从1970年1月1日午夜开始计的毫秒数UTC|
|Function|函数本身|
|Number|数字值|
|Object|对象本身。这是默认情况。|
|String|字符串值|
||Math和Error对象没有valueOf方法|

#### 示例：

```javascript

	// Array：返回数组对象本身
	var array = ["ABC", true, 12, -5];
	console.log(array.valueOf() === array);   // true

	// Date：当前时间距1970年1月1日午夜的毫秒数
	var date = new Date(2013, 7, 18, 23, 11, 59, 230);
	console.log(date.valueOf());   // 1376838719230

	// Number：返回数字值
	var num =  15.26540;
	console.log(num.valueOf());   // 15.2654

	// 布尔：返回布尔值true或false
	var bool = true;
	console.log(bool.valueOf() === bool);   // true

	// new一个Boolean对象
	var newBool = new Boolean(true);
	// valueOf()返回的是true，两者的值相等
	console.log(newBool.valueOf() == newBool);   // true
	// 但是不全等，两者类型不相等，前者是boolean类型，后者是object类型
	console.log(newBool.valueOf() === newBool);   // false

	// Function：返回函数本身
	function foo(){}
	console.log( foo.valueOf() === foo );   // true
	var foo2 =  new Function("x", "y", "return x + y;");
	console.log( foo2.valueOf() );
	/*
	ƒ anonymous(x,y
	) {
	return x + y;
	}
	*/

	// Object：返回对象本身
	var obj = {name: "张三", age: 18};
	console.log( obj.valueOf() === obj );   // true

	// String：返回字符串值
	var str = "http://www.xyz.com";
	console.log( str.valueOf() === str );   // true

	// new一个字符串对象
	var str2 = new String("http://www.xyz.com");
	// 两者的值相等，但不全等，因为类型不同，前者为string类型，后者为object类型
	console.log( str2.valueOf() === str2 );   // false

```

#### 注意：可以手动改写valueOf方法。

>#### 参考文档：[MDN > JavaScript > Object](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Object)




















