# eslint 规范解析	

###### 强调：这是一篇关于vue-adimn-template项目中.eslintrc.js文件的映射解析，不是eslint教程，本人也是第一次使用eslint做代码开发规范，只是解析该文件，快速入手读懂规则。

##### 基础配置

##### 默认情况下，eslint会在所有父级目录里寻找配置文件，直到根目录或直到发现一个有`root:true`的配置

---

##### 解析器配置

```javascript

	parserOptions: {
    parser: 'babel-eslint',//一个对babel解析器的包装，使其能够与eslint兼容
    sourceType: 'module'//表示代码是ECMAScript模块
  }

```

---

##### 环境参数配置

```javascript

	env: {
    browser: true,//浏览器环境中的全局变量
    node: true,//node.js全局变量和node.js作用域
    es6: true,//启用除了moudules以外的所有ECMAScript 6特性（该选项会自动设置ecmaVersion解析器选项为6
  }

```

---

##### 一个配置文件可以从基础配置中继承已启用的规则

```javascript

	extends: ['plugin:vue/recommended', 'eslint:recommended']

	//'eslint:recommended'启动了一系列核心规则
	//'plugin:vue/recommended'启动了一个vue的eslint插件

```

---

##### rules属性可以做下面的任何事情，以扩展或覆盖规则

- 启用额外的规则
- 改变继承的规则级别而不改变它的选项
	+ 基础配置：`"eqeqeq":["error","allow-null"]`
	+ 派生配置：`"eqeqeq":"warn"`
	+ 最后生成的配置：`"eqeqeq":["warn","allow-null"]`
- 覆盖基础配置中的规则的选项
	+ 基础配置：`"quotes":["error","single","avoid-escape"]`
	+ 派生配置：`"quotes":["error","single"]`
	+ 最后生成的配置：`"quotes":["error","single"]`


##### 下面规则都放在rules里面，也是主要会影响到代码编写规则的，只对我们项目中的配置做解析，详细说明看官方文档。

##### ESlint附带有大量的规则，设置规则必须为下列值之一

- `off/0`：关闭规则
- `warn/1`：开启规则，使用警告级别的错误
- `error/2`：开启规则，使用错误级别的错误

---

#### 下面每一个都是一条规则：

#### 与vue有关的规则

##### vue：强制每行的最多属性数量

```javascript

	"vue/max-attributes-per-line": [2, {
    "singleline": 10,//当开始标记在一行中时每行的最大属性数，这里设置为10
    "multiline": {
      "max": 1,//当开始标记位于多行时每行的最大属性数，这里设置为1
      "allowFirstLine": false//多行时禁止与标记名称在同一行写属性
    }
  }]

```

##### vue：强制name属性为Pascal大小写：`"vue/name-property-casing": ["error", "PascalCase"`

```javascript

	// 正确示例
	name:'MyComponent'

```

##### 规则文件中关于eslint-plugin-vue插件的配置不多，但是`extends: ['plugin:vue/recommended', 'eslint:recommended']`决定项目中会用到很多推荐配置：

##### `vue/attributes-order`规定vue属性需按照一定的规则排列书写，详情见官网[风格指南](https://cn.vuejs.org/v2/style-guide/index.html)

##### `vue/no-v-html`规定不允许使用v-html指令

```html

	<!-- 错误示例 -->
	<div v-html="someHTML"></div>
	<!-- 正确示例 -->
	<div>{{ someHTML }}</div>

```

##### `vue/order-in-components`规则要求组件中的性质（props,data等）要按一定顺序书写，详情见vue官网[风格指南](https://cn.vuejs.org/v2/style-guide/index.html)


##### `vue/this-in-template`规则不允许在template里面使用this。

```html

	<!-- 错误示例 -->
	<a :href="this.url">
		{{ this.text }}
	</a>
	<!-- 正确示例 -->
	<a :href="url">
		{{ text }}
	</a>

```

##### 注：关于eslint-plugin-vue相关的可以参考文档：[https://eslint.vuejs.org/rules/](https://eslint.vuejs.org/rules/)

---

#### 与js有关的规则

##### 强制getter/setter成对出现的对象中：`'accessor-pairs': 2`

##### 要求箭头函数之前和之后都有空格：

```javascript

	'arrow-spacing': [2, {
      'before': true,
      'after': true
    }]

```

##### 强制在左花括号和同一行的下一个token之间有一致的空格，同样强制右花括号和在同一行的前一个token之间有一只的空格：`'block-spacing': [2, 'always']`

```javascript

	// 错误示例
	function foo() {return true;}
	// 正确示例
	function foo() { return true; }

```

##### 大括号风格要求，将大括号放在控制语句或声明语句同一行的位置，并允许块的开括号和闭括号在同一行。

```javascript

	// 规则代码，1tbs表示强制大括号放在控制语句或声明语句同一行的位置
	'brace-style': [2, '1tbs', {
    'allowSingleLine': true//允许块的开括号和闭括号在同一行
  }]

  // 错误示例：
  if (foo) 
  {
  	bar();
  }
  else 
  {
  	baz();
  }

  //正确示例：
  if (foo){
  	bar();
  } else {
  	baz();
  }

  if (foo) bar();
  else if (baz) boom();

  try { somethingRisky(); } catch(e) { handleError(); }

```

##### 不强制要求使用驼峰拼写法

```javascript

	'camelcase': [0, {//0,表示关闭
      'properties': 'always'
    }]

```

##### 禁用拖尾逗号:`'comma-dangle': [2, 'never']`

```javascript

	// 错误示例
	let foo = {
		bar:'baz',
		qux:'quux',
	}
	let arr = [1,2,];

	// 正确示例
	let foo = {
		bar:'baz',
		qux:'quux'
	}
	let arr = [1,2];

```

##### 禁止在逗号前使用空格，要求在逗号后使用一个或多个空格

```javascript

	'comma-spacing': [2, {
    'before': false,
    'after': true
  }]

  // 错误示例
  let foo = 1 ,bar=2;
  let arr = [1 , 2];
  // 正确示例
  let foo = 1, bar=2;
  let arr = [1, 2];

```

##### 要求逗号放在数组元素、对象属性或变量声明之后，且在同一行:`'comma-style': [2, 'last']`

```javascript

	// 错误示例
	let foo = 1
	,
	bar = 2;
	let foo = ['apples'
							, 'oranges'];
	// 正确示例
	let foo = 1,
			bar = 2;
	let foo = ['apples', 'oranges'];

```

##### 派生类中的构造函数必须调用super()。非派生类的构造函数不能调用super()：`'constructor-super': 2`

```javascript
	// 错误示例
	class A {
		constructor() {
			super();
		}
	}
	class A extends B {
		constructor() { }
	}
	// 正确示例
	class A {
		constructor() { };
	}
	class A extends B {
		constructor() {
			super();
		}
	}
```

##### 允许在单行中省略大括号，而if/else if/else/for/while和do，在其他情况使用中依然强制使用大括号:`'curly': [2, 'multi-line']`

```javascript

	// 错误示例
	if (foo)
		doSomething();
	else 
		doSomethingElse();

	if (foo) foo(
		bar,
		baz);

	// 正确示例
	if (foo) foo++; else doSomething();

	if (foo) foo++;
	else if (bar) baz()
	else doSomething();

	while (true) {
		doSomething();
		doSomethingElse();
	}

```

##### 要求表达式中的点号操作符应该和属性在同一行：`'dot-location': [2, 'property']`

```javascript

	// 错误示例
	let foo = Object.
	property;
	// 正确示例
	let foo = Object
	.property;
	let bar = object.property;

```

##### 要求在非空文件末尾至少存在一行空行：`'eol-last': 2`

```javascript

	// 错误示例
	function doSmth() {
		let foo = 2;
	}

	// 正确示例
	function doSmth() {
		let foo = 2;
	}\n

```

##### 强制在任何情况下都使用`===`和`!==`

```javascript

	'eqeqeq': [2,  "always", {
    "null": "ignore"//总是使用===或!==，即使是对null
  }]

```

##### 强制generator函数中*前后都有空格

```javascript

	'generator-star-spacing': [2, {
    'before': true,
    'after': true
  }]

```

##### 强制回调进行错误处理，该期望当在node.js中使用回调模式时，处理错误:`'handle-callback-err': [2, '^(err|error)$']`

```javascript

	// 错误示例
	function loadData (err, data) {
		doSomething();
	}

	// 正确示例
	function loadData (err, data) {
		if(err){
			console.log(err.statck);
		}
		doSomething();
	}

```

##### 强制缩进两个空格

```javascript

	'indent': [2, 2, {
    'SwitchCase': 1//设置case子句相对于switch语句缩进2个空格
  }]

```

##### 强制所有不包含单引号的jsx属性值使用单引号，如果想在jsx的属性中使用单引号，必须使用双引号作为字符串分隔符：`'jsx-quotes': [2, 'prefer-single']`

##### 禁止在对象字面量的键和冒号之间存在空格，要求在对象字面量的冒号和值之间存在至少有一个空格。

```javascript

	'key-spacing': [2, {
    'beforeColon': false,
    'afterColon': true
  }]

  // 错误示例
  let obj = { foo :42 };
  let obj = { foo : 42 };

  // 正确示例
  let obj = { foo: 42 };

```

##### 要求在关键字之前和之后至少都有一个空格。

###### 该规则强制关键字和类似关键字的符号周围空格的一致性：`as、async、await、break、case、catch、class、const、continue、debugger、default、delete、do、else、export、extends、finally、for、from、function、get、if、import、in、instanceof、let、new、of、return、set、static、super、switch、this、throw、try、typeof、var、void、while、with 、yield`

```javascript

	'keyword-spacing': [2, {
    'before': true,
    'after': true
  }]

  // 错误示例
  if(foo) {
  	//...
  }else if (bar) {
  	//...
  }else {
  	//...
  }
  // 正确示例
  if (foo) {
  	//...
  } else if (bar) {
  	//...
  } else {

  }

```

##### 要求调用new操作符时有首字母大写的函数，允许调用首字母大写的函数时没有new操作符。

```javascript

	'new-cap': [2, {
    'newIsCap': true,
    'capIsNew': false
  }]

  // 错误示例
  let friend = new person();
  // 正确示例
  let friend = new Person();
  let person = Person();

```

##### 要求调用无参构造函数时带括号：`'new-parens': 2`

```javascript

	// 错误示例
	let person = new Person;
	let person = new (Person);

	// 正确示例
	let person = new Person();
	let person = new (Person)();

```

##### 禁用Array构造函数，由于单参数的陷阱，和全局范围的 Array 可能被重定义，通常不允许使用 Array的构造函数来创建数组，唯一的例外是通过给构造函数传入指定的一个数值来创建稀疏数组：`'no-array-constructor': 2`

```javascript

	// 错误示例
	Array(0, 1, 2);
	new Array(0, 1, 2);
	// 正确示例
	Array(500);
	new Array(someOtherArray.length)

```

##### 禁用`arguments.caller`或`arguments.callee`：`'no-caller': 2`

##### 允许使用console:`no-console': 'off'`

##### 禁止修改类声明的变量：`'no-class-assign': 2`

```javascript

	// 错误示例
	class A { };
	A = 0;

	// 正确示例
	let A = class A { }
	A = 0;

```

##### 禁止在条件表达式中出现赋值操作符，在条件语句中很容易将一个比较运算符`==/===`错写成`=`，所以引用该规则，即禁止在 if、for、while 和 do...while 语句中出现模棱两可的赋值操作符：`'no-cond-assign': 2`

```javascript

	// 错误示例
	let x;
	if(x = 0) {
		let b = 1;
	}
	// 正确示例
	if(x === 0){
		let b = 1;
	}
```

##### 禁止修改const关键字声明的变量：`'no-const-assign': 2`

##### 禁止在正则表达式中使用控制字符，在 ASCII 中，0-31 范围内的控制字符是特殊的、不可见的字符。这些字符很少被用在 JavaScript 字符串中，所以一个正则表达式如果包含这些字符的，很有可能一个错误：`'no-control-regex': 2`

```javascript

	// 错误示例
	let pattern1 = /\x1f/;
	let pattern2 = new RegExp("\x1f");
	// 正确示例
	let pattern1 = /\x20/;
	let pattern2 = new RegExp("\x20");
```

##### 禁止使用delete删除变量，delete 的目的是删除对象的属性。使用 delete 操作删除一个变量可能会导致意外情况发生：`'no-delete-var': 2`

##### 禁止在function定义中出现重复的参数，该规则并不适用于箭头函数或类方法：`'no-dupe-args': 2`

##### 禁止类成员中出现重复的名称，如果类成员中有同名的声明，最后一个声明将会默默地覆盖其它声明。 它可能导致意外的行为：`'no-dupe-class-members': 2`

##### 禁止对象字面量中出现重复的键：`'no-dupe-keys': 2`

##### 禁止出现重复的case标签：`'no-duplicate-case': 2`

##### 禁止在正则表达式中出现空字符集，在正则表达式中空字符集不能匹配任何字符，它们可能是打字错误：`'no-empty-pattern': 2`

##### 禁用eval()，JavaScript 中的 eval() 函数是有潜在危险的，而且经常被误用。在不可信的代码里使用 eval() 有可能使程序受到不同的注入攻击。eval() 在大多数情况下可以被更好的解决问题的方法代替：`'no-eval': 2`

##### 禁止对catch子句中的异常重新赋值，在 try 语句中的 catch 子句中，如果意外地（或故意地）给异常参数赋值，是不可能引用那个位置的错误的。由于没有 arguments 对象提供额外的方式访问这个异常，对它进行赋值绝对是毁灭性的：`'no-ex-assign': 2`

##### 禁止扩展原生对象,在 JavaScript 中，你可以扩展任何对象，包括内置或者”原生”对象。有时人们改变这些原生对象的行为，会影响到代码中的其它部分。例如我们重写了一个内建的方法，将会影响到所有对象，甚至是其它内建对象:`'no-extend-native': 2`

```javascript

	// 错误示例
	Object.prototype.a = 'a';

```

##### 避免不必要的 bind() 使用，不会标记有函数参数绑定的bind() 的使用情况，把所有使用bind() 的箭头函数标记为是有问题的：`'no-extra-bind': 2`

```javascript

	// 错误示例
	let x = function () {
		foo();
	}.bind(bar);
	// 正确示例
	let x = function () {
		this.foo();
	}.bind(bar);

```

##### 禁止不必要的布尔类型转换：`'no-extra-boolean-cast': 2`

```javascript

	// 错误示例
	!!!bar;
	!!foo ? baz : bat;
	Boolean(!!bar);
	if(Boolean(foo)){ };

	// 正确示例
	let foo = !!bar;//这里两个感叹号是有意义的，第一个取反，第二个把bar转换成布尔类型

```

##### 在函数表达式周围禁止不必要的圆括号：`'no-extra-parens': [2, 'functions']`

```javascript

	// 错误示例
	((function foo() {}))();
	let y = (function () {return 1;});

```

##### 禁止case落空，即从上一个case落入下一个case执行，旨在消除非故意case落空行为：`'no-fallthrough': 2`

```javascript

	// 错误示例
	switch(foo) {
		case 1:
			doSomething();
		case 2:
			doSomethingElse();

	}
	// 正确示例
	switch(foo) {
		case 1:
			doSomething();
			//falls through，标记此处希望执行落空操作
		case 2:
			doSomethingElse();
	}

```

##### 禁止不规范的浮点小数：`'no-floating-decimal': 2`

```javascript

	// 错误示例
	let num = .5;
	let num = 2.;
	let num = -.8;
	// 正确示例
	let num = 0.5;
	let num = 2.0;
	let num = -0.8;

```

##### 禁止对function声明重新赋值：`'no-func-assign': 2`

```javascript

	// 错误示例
	function foo() { }
	foo = bar;
	// 正确示例
	let foo = function() { };
	foo=bar;

```

##### 禁止隐式的eval()，消除使用 setTimeout()、setInterval() 或 execScript() 时隐式的 eval()：`'no-implied-eval': 2`

```javascript

	// 错误示例
	setTimeout("alert('hi');",100);
	setInterval("alert('hi');",100);
	// 正确示例
	setTimeout(function(){
		alert('hi');
	},100);

```

##### 禁止function声明出现在嵌套的语句块中：`'no-inner-declarations': [2, 'functions']`

```javascript

	// 错误示例
	if (test) {
		function doSomething() { };
	}
	// 正确示例
	if (test) {
		let fn = function fnExpression() {}
	}

```

##### 禁止在RegExp构造函数中出现无效的正则表达式，在正则表达式字面量中无效的模式在代码解析时会引起 SyntaxError，但是 RegExp 的构造函数中无效的字符串只在代码执行时才会抛出 SyntaxError，所以启用该规则：`'no-invalid-regexp': 2`

```javascript

	// 错误示例
	RegExp('[');
	RegExp('.','z');
	new RegExp('\\');
	// 正确示例
	RegExp('.');

```

##### 禁止不规则的空白，无效的或不规则的空白会导致 ECMAScript 5 解析问题，也会使代码难以调试：`'no-irregular-whitespace': 2`

##### 禁用`__iterator__`属性：`'no-iterator': 2`

##### 禁用与变量同名的标签：`'no-label-var': 2`

##### 禁用标签语句

```javascript

	'no-labels': [2, {
    'allowLoop': false,
    'allowSwitch': false
  }]

  // 错误示例
  label:
  	while (true) {
  		break label;
  	}
  // 正确示例
  while (true) {
  	break;
  }

```

##### 禁止不必要的嵌套块：`'no-lone-blocks': 2`

```javascript

	// 错误示例
	if (foo) {
		bar();
		{
			baz();
		}
	}
	// 正确示例
	if (foo) {
		if (bar) {
			baz();
		}
	}

```

##### 禁止使用空格和tab混合缩进：`'no-mixed-spaces-and-tabs': 2`

##### 禁止出现多个空格，在某行中，出现多个空格而且不是用来作缩进的，通常是个错误：`'no-multi-spaces': 2`

```javascript

	// 错误示例
	let a =  1;
	if (foo  === 'bar') { }
	// 正确示例
	let a = 1;
	if (foo === 'bar') { }

```

##### 禁止使用多行字符串， JavaScript 中，可以在新行之前使用斜线创建多行字符串，这不是一个好的做法，因为它是 JavaScript 中的一个非正式的特性：`'no-multi-str': 2`

```javascript

	// 错误示例
	let x = 'line 1 \
					 line 2';
	// 正确示例
	let x = 'line 1\n' + 
					'line 2'; 
	
```

##### 不允许多个空行，最大连续空行数为1

```javascript

	'no-multiple-empty-lines': [2, {
    'max': 1
  }]

  // 错误示例
  let foo = 5;


  let bar = 3;
  // 正确示例
  let foo = 5;

  let bar = 3;

```

##### 禁止对原生对象或只读的全局对象进行赋值：`'no-global-assign': 2`

##### 禁止对关系运算符的左操作数使用否定操作符，关系运算符有`in、instanceof`：`'no-unsafe-negation': 2`

```javascript

	// 错误示例
	if (!key in object) {

	}
	// 正确示例
	if (!(key in object)) {

	}

```

##### 禁止使用Object构造函数：`'no-new-object': 2`

```javascript

	// 错误示例
	let myObject = new Object();
	// 正确示例
	let myObject = {};

```

##### 不允许new require形式的表达式：`'no-new-require': 2`

```javascript

	// 错误示例
	let appHeader = new require('app-header');
	// 正确示例
	let ArrHeader = require('app-header');
	let appHeader = new AppHeader();

```

##### 禁止Symbol操作符和new一起使用：`'no-new-symbol': 2`

##### 禁止使用原始`String/Number/Boolean`包装实例：`'no-new-wrappers': 2`

##### 禁止将`Math/JSON/Reflect`对象当做函数进行调用：`'no-obj-calls': 2`

##### 禁止八进制字面量：`'no-octal': 2`

##### 禁止在字符串中使用八进制转义序列：`'no-octal-escape': 2`

##### 当使用\_dirname和\_filename时不允许字符串拼接,在 Node.js 中，全局变量 _dirname 和 _filename 分别代表当前执行脚本的目录路径以及文件路径，阻止在 Node.js 中使用字符串拼接路径：`'no-path-concat': 2`

```javascript

	// 错误示例
	let fullPath = __dirname + '/foo.js';
	let fullPath = __filename + '/foo.js';

	// 正确示例
	let fullPath = dirname + '/foo.js';
	let fullPath = path.join(__dirname,'foo.js');

```

##### 禁用`__proto__`属性：`'no-proto': 2`

##### 禁止重复声明变量：`'no-redeclare': 2`

##### 禁止正则表达式字面量中出现多个空格：`'no-regex-spaces': 2`

##### 禁止在返回语句中赋值，除非使用括号把它们括起来：`'no-return-assign': [2, 'except-parens']`

##### 禁止自我赋值：`'no-self-assign': 2`

##### 禁止自身比较：`'no-self-compare': 2`

##### 不允许使用逗号操作符，除了在初始化或者更新部分for语句时或者表达式序列被明确包裹在括号中：`'no-sequences': 2`

```javascript

	// 逗号操作符包含多个表达式，其中只有一个是可使用的。它从左到右计算每一个操作数并且返回最后一个操作数的值。然而，这往往掩盖了它的副作用，它的使用经常会发生事故，如下：
	let a = (3, 5);//a = 5

	a = b += 5, a+b;//设b=1;此时该语句返回12,打印后a=6,b=6;

	// 错误示例
	foo = doSomething(),val;
	// 正确示例
	foo = (doSomething(),val);

```

##### 关键字不能被遮蔽：`'no-shadow-restricted-names': 2`

###### 全局对象的属性值 (NaN、Infinity、undefined)和严格模式下被限定的标识符 eval、arguments 也被认为是关键字。重定义关键字会产生意想不到的后果且易迷惑其他读者

##### 禁止在函数标识符和其调用之间有空格：`'no-spaced-func': 2`

```javascript

	// 错误示例
	fn ();
	fn
	();
	// 正确示例
	fn();

```

##### 禁用稀疏数组：`'no-sparse-arrays': 2`

##### 禁止在构造函数中，在调用 super() 之前使用 this 或 super：`'no-this-before-super': 2`

##### 保持异常抛出的一致性，禁止抛出字面量和那些不可能是 Error 对象的表达式：`'no-throw-literal': 2`

```javascript

	// 错误示例
	throw 'error'
	// 正确示例
	throw new Error('error');

```

##### 禁用行尾空格：`'no-trailing-spaces': 2`

###### 有时在编辑文件的过程中，你可以在行的末尾以额外的空格作为结束。这些空格差异可以被源码控制系统识别出并被标记为差异，给开发人员带来挫败感。虽然这种额外的空格并不会造成功能性的问题，许多编码规范要求在提交代码之前删除尾部空格。

##### 禁用未声明的变量，除非显式地在`/*global*/`注释中指定过：`'no-undef': 2`

```javascript
	// 错误示例
	let a = someFunction();
	b = 10;
	// 正确示例
	/*global b*/
	b = 10;
```

##### 不允许初始化变量值为undefined：`'no-undef-init': 2`

##### 禁止使用令人困惑的多行表达式，个人理解就是别漏分号：`'no-unexpected-multiline': 2`

```javascript

	// 在JavaScript中，一下情况不会自动插入分号
		// 该语句有一个没有闭合的括号，数组字面量或对象字面量或其他某种方式，不是有效结束一个语句的方式。（比如，以 . 或 , 结尾）
		// 该行是 -- 或 ++（在这种情况下它将减量/增量的下一个标记）
		// 它是个 for()、while()、do、if() 或 else，并且没有 {
		// 下一行以 [、(、+、*、/、-、,、. 或一些其它在单个表达式中两个标记之间的二元操作符。
	// 错误示例
	let foo = bar
	(1 || 2).baz();
	// 正确示例
	let foo = bar;
	(1 || 2).baz();

```

##### 禁用一成不变的循环条件，循环条件中的变量在循环中是要经常改变的。如果不是这样，那么可能是个错误：`'no-unmodified-loop-condition': 2`

##### 禁止可以表达为更简单结构的额三元操作符，禁止条件表达式作为默认的赋值模式

```javascript

	'no-unneeded-ternary': [2, {
    'defaultAssignment': false
  }]

  // 错误示例
  let a = x === 2 ? true : false;
  let a = x ? x : 1;
  // 正确示例
 	let a = x === 2;

```

##### 禁止在`return/throw/continue/break`语句后出现不可达代码：`'no-unreachable': 2`

##### 禁止在finally语句块中出现控制流语句：`'no-unsafe-finally': 2`

###### JavaScript 暂停 try 和 catch 语句块中的控制流语句，直到 finally 语句块执行完毕。所以，当 return、throw、break 和 continue 出现在 finally 中时， try 和 catch 语句块中的控制流语句将被覆盖，这被认为是意外的行为。

##### 禁止出现未使用过的变量，检查所有变量包括全局环境中的变量，不检查参数

```javascript

	'no-unused-vars': [2, {
    'vars': 'all',
    'args': 'none'
  }]

```

##### 禁用不必要的`.call()`和`.apply()`，目的在于标记出可以被正常函数调用所替代的 Function.prototype.call() 和 Function.prototype.apply() 的使用：`'no-useless-call': 2`

##### 禁止在对象中使用不必要的计算属性：`'no-useless-computed-key': 2`

```javascript

	// 错误示例
	let a = { ['0']: 0 };
	let a = { ['0+1,234']: 0 };
	// 正确示例
	let a = { 'a': 0 };
	let a = { '0+1,234': 0 };

```

##### 禁止不必要的构造函数：`'no-useless-constructor': 2`

```javascript
	// 错误示例
	class A {
		construction () {

		}
	}
	// 正确示例
	class A {
		construction (){
			doSomething();
		}
	}
```

##### 禁止不必要的转移：`'no-useless-escape': 0`

##### 禁止属性前有空白：`'no-whitespace-before-property': 2`

```javascript

	// 错误示例
	foo [bar]
	foo. bar
	// 正确示例
	foo[bar]
	foo.bar

```

##### 禁用with语句：`'no-with': 2`

##### 要求每个作用域的初始化的变量有多个变量声明

```javascript

	'one-var': [2, {
    'initialized': 'never'
  }]

  // 错误示例
  function foo() {
  	let bar,
  			baz;
  	const BAR = true,
  				BAZ = false;
  }
  // 正确示例
  function foo() {
  	let bar;
  	let baz;
  	const BAR = true;
  	const BAZ = false;
  }
```

##### 强制操作符使用一致的换行符风格

```javascript

	'operator-linebreak': [2, 'after', {//要求吧换行符放在操作符后面
    'overrides': {
      '?': 'before',//?放在前面
      ':': 'before'//:放在前面
    }
  }]

  // 错误示例
  foo = 1
  +
  2;
  foo = 1
  		+ 2;

  // 正确示例
  foo = 1 + 2;
  foo = 1 +
  			2;

```

##### 禁止块语句和类的开始或末尾有空行：`'padded-blocks': [2, 'never']`

```javascript

	// 错误示例
	if (a) {

		b();

	}
	// 正确示例
	if (a) {
		b();
	}
```

##### 强制使用一致的反勾号、双引号或单引号

```javascript

	'quotes': [2, 'single', {//要求尽可能地使用单引号
    'avoidEscape': true,// 允许字符串使用单引号或双引号，只要字符串中包含了一个其他引号，否则需要转义
    'allowTemplateLiterals': true//允许字符串使用反勾号`
  }]

  // 错误示例
  let double = "double";
  let unescaped = "a string containning 'single' quotes";
  // 正确示例
  let single = 'single';
  let single = 'a string containing "double" quotes';
  let double = `double`;

```

##### 禁止在语句末尾使用分号（除了消除以[、(、/、+ 或 - 开始的语句的歧义）:`'semi': [2, 'never']`

###### 在很多情况下，JavaScript 引擎可以确定一个分号应该在什么位置然后自动添加它。此特征被称为 自动分号插入 (ASI)，被认为是 JavaScript 中较为有争议的特征。个人认为分号还是有必要写的，故关闭了这个选项，写不写看个人了。

##### 分号前禁止有空格，分号后强制有空格

```javascript

	'semi-spacing': [2, {
    'before': false,
    'after': true
  }]

  // 错误示例
  let foo ;
  let foo;let bar;
  // 正确示例
  let foo;
  let foo; let bar;
  

```

##### 块语句必须总是至少有一个前置空格：`'space-before-blocks': [2, 'always']`

```javascript

	// 错误示例
	if (a){
		b();
	}
	// 正确示例
	if (a) {
		b();
	}
```

##### 禁止在参数的`(`前有空格：`'space-before-function-paren': [2, 'never']`

```javascript

	// 错误示例
	function foo () {

	}
	// 正确示例
	function foo() {

	}

```

##### 强制圆括号内没有空格：`'space-in-parens': [2, 'never']`

```javascript

	// 错误示例
	foo( 'bar');
	// 正确示例
	foo('bar'); 

```

##### 要求在缀操作符周围有空格：`'space-infix-ops': 2`

```javascript

	// 错误示例
	a+b;
	// 正确示例
	a + b;

```

##### 强制在单词类一元操作符`new/delete/typeof/void/yield`后使用空格，其他一元操作符`-/+/--/++/!/!!`要求不使用空格

```javascript

	'space-unary-ops': [2, {
    'words': true,
    'nonwords': false
  }]

  // 错误示例
  type!foo;
  -- foo;
 	// 正确示例
 	type !foo;
 	--foo

```

##### 要求注释`//`和`/*`必须跟随至少一个空白

```javascript

	'spaced-comment': [2, 'always', {
    'markers': ['global', 'globals', 'eslint', 'eslint-disable', '*package', '!', ',']//这些字符串也就是块级注释的标记，例如一个额外的 /，被用来表示是由 doxygen、vsdoc 等系统读取的文档，这些系统必须有额外的字符。 不管第一个参数是 "always" 还是 "never"、"markers"数组都会起作用
  }]

  // 错误示例
  /*eslint spaced-comment: ["error", "always"]*/
	//This is a comment with no whitespace at the beginning
	
	// 正确示例
	/* eslint spaced-comment: ["error", "always"] */
	// This is a comment with a whitespace at the beginning
	/*global a,b */

```

##### 禁止模板字符串的花括号中出现空格：`'template-curly-spacing': [2, 'never']`

```javascript

	// 错误示例
	`hello, ${ people.name}`;
	// 正确示例
	`hello, ${people.name}`;

```

##### 要求调用`isNaN()`检查`NaN`：`'use-isnan': 2`

```javascript

	// 因为在 JavaScript 中 NaN 独特之处在于它不等于任何值，包括它本身
	// 错误示例
	if (foo == NaN){ };
	// 正确示例
	if (isNaN(foo)){ };

```

##### 要求typeof表达式只与字符串字面量或其他typeof表达式进行比较，禁止与其他值进行比较：`'valid-typeof': 2`

```javascript

	// 错误示例
	typeof foo === 'strnig'
	// 正确示例
	typeof foo === 'string'
	typeof foo === baz

```

##### 要求所有的立即执行函数表达式使用括号包裹起来，但允许其他风格：`'wrap-iife': [2, 'any']`

```javascript

	// 错误示例
	let x = function () { return { y: 1};}();
	// 正确示例
	let x = (function () { return { y: 1};})()
	let x = (function () { return { y: 1};}());

```

##### 强制在`yield*`表达式中`*`前后使用空格：`'yield-star-spacing': [2, 'both']`

##### 禁止Yoda条件：`'yoda': [2, 'never']`

```javascript

	// 错误示例
	if ('red' === color) { }
	if (true == flag) { }
	// 正确示例
	if (color === 'red') { }
	if (flag == true) { }

```

##### 在初始化赋值后从未被修改过的变量，要求使用const声明：`'prefer-const': 2`

##### 禁用debugger

```javascript
	
	'no-debugger': process.env.NODE_ENV === 'production' ? 2 : 0;

```

##### 要求花括号内有空格，除了{}，禁止以对象元素开始或结尾的对象的花括号中有空格 

```javascript

	'object-curly-spacing': [2, 'always', {
    objectsInObjects: false
  }]

  // 错误示例
  let obj = {'foo': 'bar'};
  // 正确示例
  let obj = {'foo': 'bar' };
  let obj = { "foo": { "baz": 1, "bar": 2 }};

```

##### 禁止在数组括号内出现空格：`'array-bracket-spacing': [2, 'never']`

```javascript

	// 错误示例
	let arr = [ 'foo', 'bar'];
	// 正确示例
	let arr = ['foo', 'bar'];

```

>参考文档：[vue规范](https://eslint.vuejs.org/rules/)
>参考文档：[JavaScript规范](https://cn.eslint.org/)








