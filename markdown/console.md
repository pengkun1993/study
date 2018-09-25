# 浏览器console相关内容整理
### console对象提供对浏览器控制台的接入。不同浏览器上它的工作方式是不一样的，本文示例和截图均来自Chrome浏览器。

***

## 一、输出文本到控制台
### console对象中较多使用的主要有四个方法：
#### `console.log(),console.info(),console.warn(),console.error()`

#### 语法

```javascript
	console.log(obj1[,obj2,...,objN]);
	console.log(msg [, subst1,...,substN]);
	console.log('String: %s,Int:%d,Float: %f, Object: %o',str,ints,floats,obj)
	console.log(`temp的值为：${temp}`);
	//console.exception()是console.error()的别名；它们功能相同。
```

#### 参数

```
	obj1...objN
	一个用于输出的javascript对象列表。其中每个对象会以字符串的形式按照顺序依次输出到控制台。
	msg
	一个JavaScript字符串，其中包含零个或多个替代字符串
	subst1...stbstN
	javascript对象，用来依次替换msg中的替代字符串。你可以在替代字符串中指定对象的输出格式。
```
### 它可以格式化打印字符的功能类似于C语言的printf方法。
#### 格式化打印：

|字符|描述|
|------|------|
|%o|打印javascript对象，可以是整数、字符串以及JSON数据|
|%d or % i|打印整数|
|%s|打印字符串|
|%f|打印浮点数|

#### 当要替换的参数类型和预期的打印类型不同时，参数会被转换成预期的打印类型

```javascript
	for(let i=0;i<5;i++){
		console.log("hello,$s. You've called me %d times.",'Bob',i+1);
	}
	console.log('I want to print a number: %d','string');
```

#### 输出显示如下： 

```
	hello, Bob. You've called me 1 times.
	hello, Bob. You've called me 2 times.
	hello, Bob. You've called me 3 times.
	hello, Bob. You've called me 4 times.
	hello, Bob. You've called me 5 times.
	I want to print a number: NaN  
```

#### 可以看到最后一行，`string`被转换成了`NaN`

#### 我们可以为console定义样式，使用`%c`。

```javascript
	console.log('%cMy strylish message','color:red;font-style:italic');
```
#### 效果：
![模板输出示例结果](https://upload-images.jianshu.io/upload_images/10187278-7171523d466a501f.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

***

## 二、在控制台输出树状信息
### 可以使用`console.group/console.groupCollapsed`方法来组织自己的打印内容以期获得更好的显示方式。
#### 在web控制台上创建一个新的分组。随后输出到控制台上的内容都会被添加和一个缩进，表示该内容属于当前分组，直到调用console.groupEnd()之后，当前分组结束。console.group和console.groupCollapsed方法的不同点是，新建的分组默认是折叠的，用户必须点击一个按钮才能将折叠的内容打开。
#### 语法：`console.group();console.groupEnd();console.groupCollapsed();`
#### 参数：无
#### 示例
```javascript
	console.log("this is the outer level");
	console.group();
	console.log("level 2");
	console.group();
	console.log('level 3');
	console.warn('more of level 3');
	console.groupEnd();
	console.log('back to level 2');
	console.groupEnd();
	console.debug('back to the outer level');
```
#### 执行结果
![1树状信息示例结果](https://upload-images.jianshu.io/upload_images/10187278-617a90f1ebd75652.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

***

## 三、定时器：`time` 、`timeEnd`
#### 可以启动一个计时器来跟踪某一个操作的占用时长。每一个计时器必须拥有唯一的名字，页面中最多可同时运行10000个计时器。当以此计时器名字为参数调用`console.timeEnd()`时，浏览器将以毫秒为单位，输出对应计时器所经过的时间。
#### 语法：`console.time(timerName);console.timeEnd(timerName);`
#### 参数：新计时器的名字，用来标记这个计时器，作为参数调用console.timeEnd()可以停止计时并将经过的时间在终端中打印出来。
#### 示例：

```javascript
	console.time('answer time');
	alert('click to continue');
	console.timeEnd('answer time');
```

#### 示例结果：
![定时器示例结果](https://upload-images.jianshu.io/upload_images/10187278-d4587cd0f23b90b3.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

***

## 四、堆栈跟踪
#### 向web控制台输出一个堆栈跟踪。
#### 语法：`console.trace()`
#### 参数：无
#### 示例1：打印当前执行位置到console.trace()的路径信息
```javascript
	foo();
	function foo(){
		function bar(){
			console.trace();
		}
		bar();
	}
```
#### 示例1结果：

![堆栈跟踪示例结果](https://upload-images.jianshu.io/upload_images/10187278-690e0c62f23689a1.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 示例2

```javascript
	function add(a,b){
        console.trace();
        return a+b;
    }
    var x=add3(1,1);
    function add3(a,b){
        return add2(a,b);
    }
    function add2(a,b){
        return add1(a,b);
    }
    function add1(a,b){
        return add(a,b);
    }
```

### 示例2结果

![trace示例2结果](https://upload-images.jianshu.io/upload_images/10187278-477e785d7a8808d4.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

***

## 五、`console.table()`
#### 将数据以表格的形式显示。在数组中的每一个元素（或对象的可枚举的属性）将会以行的形式显示在table中。
#### table的第一列是index。如果数据是一个数组，那么值就是索引。如果数据是一个对象，那么它的值就是属性名称。
#### 语法：`console.table(data [,columns]);`
#### 参数：

```
	data:要显示的数据必须是数组或者是对象，强制必须有并且是一个数组或对象。
	columns:一个数组需要包括列的名称进行输出否则显示为索引。
```
#### 示例1：打印单一参数类型

```javascript
console.table(['apples','oranges','bananas']);
```

#### 示例1结果：

![table示例结果](https://upload-images.jianshu.io/upload_images/10187278-fc217859c463dc49.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 示例2：打印一个属性值是字符串的对象

```javascript
	function Person(firstName,lastName){
		this.firstName=firstName;
		this.lastName=lastName;
	}
	var me=new Person('john','smith');
	console.table(me);
```

![table示例2结果](https://upload-images.jianshu.io/upload_images/10187278-fa4a0049f5a70cc1.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 示例3：打印复合的参数类型

```javascript
	//如果需要打印的元素在一个数组中,或者需要打印的属性在一个对象, 并且他们本身就是一个数组或者对象,则将会把这个元素显示在同一行, 每个元素占一列
	var people=[["John", "Smith"], ["Jane", "Doe"], ["Emily", "Jones"]];
	console.table(people);
```

#### 示例3结果

![table示例3结果](https://upload-images.jianshu.io/upload_images/10187278-0eeba43e33b8eb28.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 示例4：控制每行元素是否显示

```javascript
	//console.table会把所有的元素罗列在每一列，你可以使用每一列的元素名做为第二个参数去选择你所需要的列的内容去显示。
	function Person(firstName,lastName){
		this.firstName = firstName;
  		this.lastName = lastName;
	}

	var john = new Person("John", "Smith");
	var jane = new Person("Jane", "Doe");
	var emily = new Person("Emily", "Jones");

	console.table([john, jane, emily], ["firstName"]);
```

#### 示例4结果

![1534158671186.jpg](https://upload-images.jianshu.io/upload_images/10187278-55256c933b5b0f24.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 可以通过点击每列的顶部标签来得到每一个列里面的重排元素。
***

## 六、`console.assert()`
### 用来判断一个表达式或变量是否为真。如果`assertion`为`false`，则将一个错误消息写入控制台。如果为`true`，没有任何反应。
#### 语法：

```javascript
	console.assert(assertion,obj1 [,obj2,...objN]);
	console.assert(assertion,msg [,subst1,...,substN]);//类似c语法的格式输出
```

#### 参数：

```
	assertion
	一个布尔表达式。如果assertion为假，消息将会被输出到控制台之中。
	obj1...objN
	被用来输出的JavaScript对象列表，最后输出的字符串是各个对象依次拼接的结果。
	msg
	一个包含零个或多个子串的JavaScript字符串。
	subst1...substN
	各个消息作为子串的JavaScript对象。这个参数可以让你能够控制输出的格式。
```

***

## 七、清空控制台信息：`console.clear()` 

***

## 八、`console.count()`
#### 输出`count()`被调用的次数。
##### 如果有`label`，此函数输出为那个指定的label和`count()`被调用的次数。
##### 如果没有`lable`,此函数输出`count()`在其所处位置上被调用的次数。
#### 语法：`console.count([label])`
#### 参数：`lable`字符串，如果有，`count()`输出此给定的`label`及其被调用的次数
#### 示例代码：

```javascript
	var user='';
	function greet(){
		console.count();
		return 'hi '+user;
	}
	user = 'bob';
	greet();
	user = 'alice';
	greet();
	greet();
	console.count();
```

#### 示例结果：
![count示例结果1](https://upload-images.jianshu.io/upload_images/10187278-5f716fa0fc31d792.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)
#### 如果我们给count加上参数，greet里面改为`console.count('inner')`;最后改为`console.count('outer')`;
#### 则输出结果如下：

![count示例结果2](https://upload-images.jianshu.io/upload_images/10187278-68d93b9bea35a366.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 当然也可以把变量`user`传递给`count()`

***

## 九、`console.dir()`
#### 在控制台显示指定JavaScript对象的属性，并通过类似文件树样式列表显示。
#### 语法：`console.dir(Object)`;
#### 参数：`object`打印出该对象的所有属性和属性值

***

## 十、`console.dirxml()`
#### 显示一个明确的xml/html元素的包括所有后代元素的交互树。如果无法作为一个element被显示，那么会以javascript对象的形式作为替代。它的输出是一个继承扩展的节点列表，可以让你看到子节点的内容。
#### 语法：`console.dirxml(object)`
#### 参数：`object`一个属性将被输出的javascript对象。

***

#### 初学者能力有限，在一次开发中发现console.log打印的不是程序当时的状态，而是之后的状态，所以系统地了解了下控制台console相关内容，不过还是没有解决问题，如有新的体会随时补充，也希望能有大神提点，感谢！

> 参考：[https://developer.mozilla.org/zh-CN/docs/Web/API/Console/trace](https://developer.mozilla.org/zh-CN/docs/Web/API/Console/trace)
> [https://www.cnblogs.com/kuangke/p/5794444.html](https://www.cnblogs.com/kuangke/p/5794444.html)

