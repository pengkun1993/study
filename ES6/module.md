# ES6 Module语法

#### 历史上，JavaScript一直没有模块体系，无法将一个大程序拆分成相互依赖的小文件，再用简单的方法拼装起来。这种情况对开发大型的、复杂的项目形成了巨大的障碍。

#### 在ES6之前，社区制定了一些模块加载方案，最主要的有CommonJS和AMD两种。前者用于服务器，后者用于浏览器。ES6 在语言标准的层面上，实现了模块功能，而且实现得相当简单，完全可以取代 CommonJS 和 AMD 规范，成为浏览器和服务器通用的模块解决方案。

#### ES6模块的设计思想是尽量的静态化，使得编译时就能确定模块的依赖关系，以及输入和输出的变量。CommonJS和AMD模块，都只能在运行时确定这些东西。比如，CommonJS模块就是对象，输入时必须查找对象属性。

#### 什么是运行时加载？

```javascript
	//commonJS模块
	let {stat , exists , readFile } = require('fs');

	//等同于
	let _fs = require('fs');
	let stat = _fs.stat;
	let exists = _fs.exists;
	let readfile = _fs.readfile;
```

#### 上面的代码实质是整体加载fs模块，生成一个对象_fs，然后再从这个对象上面读取3个方法。这种加载称为“运行时加载”，因为只有运行时才能得到这个对象，导致完全没办法在编译时做“静态优化”。

#### ES6模块不是对象，而是通过export命令显式指定输出的代码，再通过import命令输入。

```javascript
	import { start, exists, readFile} from 'fs';
```

#### 上面代码的实质是从fs模块加载 3 个方法，其他方法不加载。这种加载称为“编译时加载”或者静态加载，即 ES6 可以在编译时就完成模块加载，效率要比 CommonJS 模块的加载方式高。当然，这也导致了没法引用 ES6 模块本身，因为它不是对象。

#### 由于ES6模块是编译时加载，使得静态分析成为可能。有了它，就能进一步拓宽JavaScript的语法，比如引入宏(macro)和类型检验(type system)这些只能靠静态分析实现的功能。

#### 除了静态加载带来的各种好处，ES6模块还有以下好处。

- 不在需要UMD模块格式了，将来服务器和浏览器都会支持ES6模块格式。目前，通过各种工具库，其实已经能够做到这一点。
- 将来浏览器的新API就能用模块格式提供，不在必须做成全局变量或者navigator对象的属性。
- 不再需要对象作为命名空间（比如Math对象），未来这些功能可以通过模块

---

>## 严格模式

#### ES6的模块自动采用严格模式，不管你有没有在模块头部加'use strict'；。

#### 严格模式主要有以下限制：
- 变量必须声明后再使用
- 函数的参数不能有同名属性，否则报错
- 不能使用with语句
- 不能对只读属性赋值，否则报错
- 不能使用前缀0表示八进制数，否则报错
- 不能删除变量，`delete prop`会报错，只能删除属性`delete global[prop]`
- eval不会在它的外层作用域引入变量
- arguments和eval不能被重新赋值
- arguments不会自动反应函数参数的变化
- 不能使用arguments.callee
- 不能使用arguemnts.caller
- 禁止this指向全局对象
- 不能使用fn.caller和fn.arguments获取函数调用的堆栈
- 增加了保留字（比如protected/static/interface）

#### 注意，由上面的可以了解到，ES6模块之中，顶层的this指向undefined，即不应该在顶层代码使用this。

---

>## export命令

#### 一个模块就是一个独立的文件。该文件内部的所有变量，外部无法获取。如果希望外部能够读取模块内部的某个变量，就必须使用export关键字输出该变量。

#### export的写法：

```javascript
	export var firstName = 'aaa';
	export var lastName = 'bbb';
	//等价于
	var firstName = 'aaa';
	var lastName = 'bbb';
	export {firstName,lastName}
```

#### 上面两种写法是等价的，但是应该优先考虑下面的写法，这样就可以在脚本尾部一眼看清楚输出了哪些变量。

#### export除了输出变量还可以输出函数或类。
#### 通常情况下，export输出的变量就是本来的名字，但是可以使用as关键字重命名。

```javascript
	function v1(){//...
	};
	function v2(){//...
	}
	export {
		v1 as streamV1,
		v2 as streamV2,
		v2 as steamlatesVersion
	}
```

#### 注意：export命令规定的是对外的接口，必须与模块内部的变量建立一一对应的关系。

```javascript
	export 1;//报错
	var m = 1;export m;//报错
```

#### 上面两种写法都会报错，应为没有提供对外的接口。第一种写法直接输出1，第二种写法通过变量m，还是直接输出1。1只是一个值，不是接口。正确的写法如下：

```javascript
	export var m = 1;

	var m = 1;
	export { m };

	var n = 1;
	export { n as m};
```

#### 上面三种写法是正确的，他们的实质是，在接口名与模块内部变量之间，建立了一一对应的关系。

#### 另外，export语句输出的接口，与其对应的值是动态绑定关系，即通过该接口，可以去到模块内部实时的值。

#### export命令可以出现在模块的任何位置，只要处于模块顶层就可以。如果处于块级作用域就会报错，下一节的import命令也是如此。这是因为处于条件代码块之中，就没法做静态优化了，违背了ES6模块设计的初衷。

---

>## import命令

#### 使用export命令定义模块的对外接口以后，其他JS文件就可以通过import命令加载这个模块。

```javascript
	import {firstName , lastName, year} from './profile.js';

	function setName(element){
		element.textContent = firstName + ' ' + lastName;
	}
```

#### import 命令接受一对大括号，里面指定要从其他模块导入的变量名。大括号里的变量名必须与被导入模块对外接口名称相同。如果想重新为变量取一个名字，import命令需要使用as关键字，将输入的变量重命名。

#### import 命令输入的变量都是只读的，因为它的本质是输入接口。也就是说，不允许在加载模块的脚本里面，改写接口。

```javascript
	import { a } from './xxx.js';
	a={};//报错：Syntax Error : 'a' is read-only;
	//但如果a是一个对象，那么改写a的属性是允许的。
	a.foo= 'hello';//不报错，合法
```

#### 上面的代码中，a的属性可以成功改写，并且其他模块也可以读到改写后的值。这种写法会导致很难查找到来源或者查错，所以凡是输入的变量，都当做完全只读，轻易不要修改它的属性。

#### import后面的from指定模块文件的位置，可以是相对路径，也可以是绝对路径，`.js`后缀可以省略。如果只是模块名，不带有路径，那么必须有配置文件，告诉javascript引擎该模块的位置。

#### 注意：import命令具有提升效果，会提升到整个模块的头部，首先执行。这种行为的本质是，import命令是编译阶段执行，在代码运行之前。

#### 由于import是静态执行，所以不能使用表达式和变量，这些只有在运行时才能得到结果的语法结构。

```javascript
	//下面的都会报错
	import { 'f'+'oo'} from 'my_module';

	let module = 'my_module';
	import { foo } from module;

	if(x===1){
		import { foo } from 'module1';
	}else{
		import { foo } from 'module2';
	}
```

#### import 语句会执行所加载的模块，因此可以有下面的写法。

```javascript
	import 'lodash';
	// 如此只是执行lodash模块，但是不输入任何值。
```

#### 如果多次重复执行同一句import语句，那么只会执行一次，而不会执行多次

```javascript
	import 'lodash';
	import 'lodash';
	//上面的代码只会执行一次
	import { foo } from 'my_module';
	import { bar } from 'my_module';
	//等同于
	import { foo, bar } from 'my_module';
```

#### 目前阶段，通过Babel转码，CommonJS模块的require命令和ES6模块的import命令，可以写在同一个模块里面，但是最好不要这么做，因为import在静态解析阶段执行，所以它是一个模块之中最早执行的。

#### 使用星号`*`指定一个对象可以将所有输出值都加载在这个对象上面。

---

>## export defalut命令

#### export defalut 命令，为模块指定默认输出，这样用户就不必知道模块导出的名字是什么，可以使用任意一个变量名来接受输入。

```javascript
	//export.defalut.js
	export default function(){
		console.log('foo');
	}
	//import.defalut.js
	import customname from './export.defalut.js';
	customname();
```

#### 上面的import 命令可以使用任意名称指向export.defalut.js输出的方法，这时就不需要知道原模块输出的函数名。需要注意，这时的import命令后面不使用大括号。

#### export default命令用在非匿名函数前也是可以的，这时的函数名在模块外部是无效的。加载的时候，视同匿名函数加载。

```javascript
	//默认输出
	export default function crc32(){};
	import crc32 from 'crc32';
	//正常输出
	export function crc32(){};
	import { crc32 } from 'crc32';
```

#### export default命令用于指定模块的默认输出。显然，一个模块只能有一个默认输出，因此export default命令只能使用一次。所以import命令后面才不用加大括号，因为只可能唯一对应export default命令。

#### 本质上，export default就是输出一个叫做default的变量的方法，然后系统允许你为他取任何名字。

```javascript
	//modules.js
	function add(x,y){
		return x*y;
	}
	export { add as default};
	//等同于
	//export defalut add;
	
	//app.js
	import { defalut as foo} from 'modules';
	//等同于
	//import foo from 'modules'
	//
	//由于export defalut本质上是将后面的值赋值给default变量，所以可以直接将一个值写在export defalut之后。
	export default 43;//正确，对外接口为defalut
	export 32;//错误，没有指定对外接口
	//如果想在一条import语句中，同时输入默认方法和其他接口，如下：
	import _,{each,each as forEach} from 'lodash';
```

---

>## export和import的复合写法

```javascript
	export { foo ,bar } from 'my_module';
	//等价于
	import { foo,bar } from 'my_module';
	export {foo,bar};
```

#### 上面的写法可以看出，export和import可以写在一行，这时foo和bar实际上并没有导入当前模块，只是相当于对外转发了这个接口，导致当前模块不能直接使用foo和bar。

---


