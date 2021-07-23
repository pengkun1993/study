# mockjs学习笔记

#### 个人理解：mockjs就是封装了一个Mock对象，而这个对象有一系列方法，用最多的Mock.mock({})，就是Mock对象有一个方法mock，我们给mock方法传递一个对象，它就会解析这个对象并返回对应的格式的数据，用于生成一些接口数据。

#### 由于上面的原因，可以直接在一个html中引入[mock.js文件](https://github.com/nuysoft/Mock/blob/refactoring/dist/mock.js)，这样就相当于定义了Mock对象，可以直接调用。

```html

	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Document</title>
		</head>
		<body>
			<script src="./mock.js"></script>
			<script type="text/javascript">
				console.log(Mock.mock({
					'string|3': '*'
				}))
			</script>
		</body>
	</html>

```

##### 输出结果：

![html](https://upload-images.jianshu.io/upload_images/10187278-5673bc71fecb8e78.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


---

### 如何决定拦截哪些url

#### `Mock.mock([rurl][,rtype][,template|function(optinos)])`

- rurl，可选，表示需要拦击的URL，可以是URL字符串或者URL正则
- rtype，可选，表示需要拦截的Ajax请求类型。例如`get/post/put/delete`等
- template，可选，表示数据模板，可以是对象或字符串（即下面重点介绍的数据模板定义规范）
- function(options)，可选，表示用于生成相应数据的函数
	+ options指向本次请求的Ajax选项集，含有url/type/body三个属性

>#### Mock.mock(template) 根据数据模板生成模拟数据

>#### Mock.mock(rurl,tempalte) 记录数据模板。当拦截到匹配rurl的Ajax请求时，将根据数据模板template生成模拟数据，并作为响应数据返回。

>#### Mock.mock(rurl,function(options)) 记录用于生成响应数据的函数。当拦截到匹配rurl的Ajax请求时，函数function(options)将被执行，并把执行结果作为相应数据返回。

>#### Mock.mock(rurl,rtype,template) 记录数据模板。当拦截到匹配 rurl 和 rtype 的 Ajax 请求时，将根据数据模板 template 生成模拟数据，并作为响应数据返回。

>#### Mock.mock(rurl,rtype,function(options)) 记录用于生成响应数据的函数。当拦截到匹配 rurl 和 rtype 的 Ajax 请求时，函数 function(options) 将被执行，并把执行结果作为响应数据返回。

---

### mock.js的语法规范包括两部分：数据模板定义规范和数据占位符定义规范。

### 数据模板定义规范(DTD)：`'name|rule':value`（属性名|生成规则：属性值）

#### 注：生成规则是可选的，且生成规则的含义需要依赖属性值的类型才能确定，属性值中可以含有@占位符。

##### 生成规则和示例：

>#### 属性值是字符串 String：

- `'name|min-max':string`：在min到max之间重复string生成一个字符串

- `'name|count':string`：重复count次string生成一个字符串

#### 示例：

```javascript

	console.log(Mock.mock({
		's1|0-10': '*',
		's2|3': '*'
	}));

```

#### 示例结果：刷新浏览器可以看到s1中*的数量会变化

![String](https://upload-images.jianshu.io/upload_images/10187278-f5a577caa9624e51.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 属性值是数字Number：

-  `'name|+1':number`：属性值会自动加1，初始值为number

-  `'name|min-max':number`：生成一个在min到max之间的整数，number的作用是用来确定需要返回一个Number类型的数据，没有实际意义。

-  `'name|min-max.dmin-dmax':number`：生成一个浮点数，整数部分在min到max之间，小数部分**位数**在dmin到dmax之间

#### 示例：

```javascript

	console.log(Mock.mock({
		'n1|+1': 2,
		'n2|0-100': 1,
		'n3|2-10.4-5': 1,// 整数部分：2-10，小数部分：4-5位
		'n4|123.2-3': 1,// 整数部分：123，小数部分：2到3位小数
		'n4|123.3': 1,// 整数部分：123，小数部分：3位小数
	}));

```

#### 示例结果：

![Number](https://upload-images.jianshu.io/upload_images/10187278-3e30e977247ff64a.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 属性值是布尔型Boolean：

- `'name|1':boolean`：随机生成一个布尔值，true和false的概率各位1/2；
- `'name|min-max':value`：随机生成一个布尔值，值为value的概率为min/(min+max)，!value的概率为max/(max+min)。

#### 示例：

```javascript

	console.log(Mock.mock({
		'b1|1':true,// 1/2概率为true
		'b2|1-10':true,// 1/10概率为true
		'b3|1-10':false// 1/10概率为false
	}));

```

#### 示例结果：

![Boolean](https://upload-images.jianshu.io/upload_images/10187278-47217afe3c23212c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 属性值是对象Object：

- `'name|count':object`：从object中随机选出count个属性生成一个新的对象
- `'name|min-max':object`：从object中随机选出min到max个属性

#### 示例：

```javascript

	const obj = {
		'110000': '北京市',
    '120000': '天津市',
    '130000': '河北省',
    '140000': '山西省'
	}
	console.log(Mock.mock({
		o1: obj,
		'o2|3': obj,// 从obj中选取3个属性
		'o3|0-2': obj// 从obj中选取0、1、2个属性
	}));

```

#### 示例结果：

![Object](https://upload-images.jianshu.io/upload_images/10187278-b8c417dfcea81d34.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 属性值为数组Array：

- `'name|1':array`：从属性值array中**随机**选取1个元素，作为最终值

- `'name|+1':array`：从属性值array中**顺序**选取1个元素，作为最终值

- `'name|min-max':array`：重复array生成一个新数组，重复min到max次，包含min/max

- `'name|count':array`：重复count次array生成一个新数组


#### 示例：

```javascript

	const arr = ['北京市', '天津市', '河北省', '山西省'];
	console.log(Mock.mock({
		'a1|1': arr,// 随机选一个
		'a2|1': arr,// 随机选一个
		'a3|+1': arr,// 顺序第一个
		'a4|+1': arr,// 顺序第二个
		'a5|1-10': arr,// 重复5到10次
		'a6|3': arr// 重复3次
	}));

```

#### 示例结果：

![Array](https://upload-images.jianshu.io/upload_images/10187278-196bb5b3174693a2.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 属性值是函数Function：

- `'name':function`：执行函数function，取其返回值作为最终的属性值，函数的上下文为属性name所在对象

#### 示例：

```javascript

	var foo=12;
	console.log(Mock.mock({
		'foo':'syntax demo',
		'foo1':function(){
			return this.foo;// 指向该属性所在对象本身
		},
		'foo2':() => {
			return this.foo;// 指向定义时的上下文环境，这里是Object
		}
	}));

```

#### 示例结果：

![Function](https://upload-images.jianshu.io/upload_images/10187278-686ef9914c88af28.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 属性值是正则表达式RegExp：

- `'name':regexp`：根据正则表达式regexp反向生成可以匹配它的字符串

- `'name|count':regexp`：根据正则表达式regexp反向生成可以匹配它的字符串，并重复count次

- `'name|min-max':regexp`：根据正则表达式regexp反向生成可以匹配它的字符串，并重复min到max次

#### 示例：

```javascript

  console.log(Mock.mock({
		'r1': /[a-z][A-Z][0-9]/,
		'r2': /\w\W\s\S\d\D/,
		'r3': /\d{5,10}/,
		'r4|3': /\d{5,10}\-/,
		'r5|4-10': /\d{5,10}\-/
	}));

```

#### 示例结果：

![RegExp](https://upload-images.jianshu.io/upload_images/10187278-6c8a544e511a75ef.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---

### 数据占位符定义规范(DPD)：@占位符(参数[,参数])

1. 用@来标识其后的字符串是占位符
2. 占位符引用的是Mock.Random中的方法
3. 通过Mock.Random.extend()来扩展自定义占位符
4. 占位符**也可以**引用数据模板中的属性
5. 占位符**会优先**引用数据模板中的属性
6. 占位符支持相对路径和绝对路径

#### 示例：

```javascript

	console.log(Mock.mock({
		'foo': 'hello',
		'nested': {
			'a': {
				'b': {
					'c': 'Mock.js'
				}
			}
		},
		'absolutePath': '@/foo @/nested/a/b/c',
		'relativePath': {
			'a': {
				'b': {
					'c': '@../../../foo @../../../nested/a/b/c'
				}
			}
		}
	}));

```

#### 示例结果：

![Path](https://upload-images.jianshu.io/upload_images/10187278-54a2d862a9b58bba.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 下面整理Mock.Random中的方法：

---

#### Basic

>#### `Random.boolean([min,max,current])`：返回一个随机的布尔值，current概率出现的计算公式为`min/(min+max)`。

- min：可选，指示参数current出现的概率，默认为1。

- max：可选，指示参数!current出现的概率，默认为1。

- current：可选，值为true或false，，没有默认值。如果未传入则返回true和false的概率各为50%。

#### 示例

```javascript

	console.log(Mock.mock({
		'rb1': Mock.Random.boolean(),
		'rb2': '@boolean()',
		'rb3': Mock.Random.boolean(0,1,true), // true的概率为0/(0+1)
		'rb4': '@boolean(0,1,false)', // false 的概率为 0/(0+1)
		'rb5|3': '@boolean(0,1,false)',// 从这里可以看出也可以用规则，不过数据类型被转换了
	}));

```

#### 示例结果：

![@boolean](https://upload-images.jianshu.io/upload_images/10187278-a805206fe7db3d76.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.natural([min][,max])`：返回一个随机自然数

- min：可选，默认为0，指示随机自然数的最小值。

- max：可选，默认值为9007199254740992，指示随机自然数的最大值。

#### 示例

```javascript

	console.log(Mock.mock({
		'rn1': '@natural()',
		'rn2': '@natural(10000)',
		'rn3': '@natural(50,100)',
		'rn4|1-10': '@natural(11,20)'// 随机生成1到10个11到20的自然数
	}));

```

#### 示例结果：

![@natural](https://upload-images.jianshu.io/upload_images/10187278-74d8f5d3015f15fe.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.integer([min][,max])`：返回一个随机整数

- min，可选，指示随机整数的最小值，默认为 -9007199254740992

- max，可选，指示随机整数的最大值，默认为 9007199254740992

#### 示例：

```javascript

	console.log(Mock.mock({
		'ri1': '@integer()',
		'ri2': '@integer(10000)',
		'ri3': '@integer(50,100)',
		'ri4|1-10': '@integer(11,13)'
	}));

```

#### 示例结果：

![@integer](https://upload-images.jianshu.io/upload_images/10187278-a77ce71391e1296c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.fload([min][,max][,dmin][,dmax])`：返回一个随机的浮点数

- min，可选，整数部分的最小值。默认值为 -9007199254740992。

- max，可选，整数部分的最大值。默认值为 9007199254740992。

- dmin，可选，小数部分位数的最小值。默认值为 0。

- dmax，可选，小数部分位数的最大值。默认值为 17。

#### 示例

```javascript

	console.log(Mock.mock({
		'rf1': '@float()',
		'rf2': '@float(10000)',
		'rf3': '@float(50,100)',
		'rf4': '@float(50,100,3)',
		'rf5': '@float(50,100,3,5)',
	}));

```

#### 示例结果

![@float](https://upload-images.jianshu.io/upload_images/10187278-129e6852e1039d94.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.character([pool])`：返回一个随机字符

- pool，可选，字符串，表示字符池，将从中选择一个字符返回，如果pool为`lower/upper/number/symbol`则表示如下字符串：

```javascript

	{
    lower: "abcdefghijklmnopqrstuvwxyz",
    upper: "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
    number: "0123456789",
    symbol: "!@#$%^&*()[]"
	}

```

#### 如果为传入，则从`lower + upper + number + symbol`中随机选取一个字符返回

#### 示例

```javascript

	console.log(Mock.mock({
		'rc1': '@character()',
		'rc2': '@character("123")'
	}));

```

#### 示例结果

![@character](https://upload-images.jianshu.io/upload_images/10187278-4a6fbaefb2f2d158.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.string([pool,length|min][,max])`

- pool 可选，字符串，与character中的pool意义相同

- length 可选，字符串长度

- min 可选，随机字符传的最小长度，默认为3

- max 可选，随机字符串的最大长度，默认为7

#### 示例

```javascript

	console.log(Mock.mock({
		'rs1': '@string()',
		'rs2': '@string(5)',
		'rs3': '@string(4,9)',
		'rs4': '@string("ab",3,6)',
		'rs5': '@string("abdefghi",3,6)',
		'rs6': '@string(哈哈啊啊啦啦花花)',//一直为空
		'rs7': '@string(哈哈啊啊啦啦花花,1,3)'
	}));

```

#### 示例结果：试验中如果只有pool参数，后面没有别的参数返回的都是空字符串，所以pool必须配合后面参数使用

![@string](https://upload-images.jianshu.io/upload_images/10187278-5b08b149aa0b6411.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.range(start[,stop][,step])`：返回一个整型数组。

- start，必选，只有该参数是表示结束值，有结束参数的时候表示起始值

- stop，可选，数组中整数的结束值（不包含在返回值中）

- step，可选，数组中整数之间的步长，默认是1

#### 示例

```javascript

	console.log(Mock.mock({
		'rr1': '@range(10)',
		'rr2|2': '@range(10)',
		'rr3': '@range(2,9)',
		'rr4': '@range(2,10,2)'
	}));

```

#### 示例结果：

![@range](https://upload-images.jianshu.io/upload_images/10187278-f6a65661e7462912.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### Date

>#### `Random.date([format])`：返回一个随机的日期字符串

- format，可选，指示生成字符串的格式。默认格式为yyyy-MM-dd，占位符参考如下

|Format|Description|Example|
|:-:|:-:|:-:|
|yyyy|4位数的年份|1999、2001|
|yy|2位数的年份|99、01|
|y|2位数的年份|99、01|
|MM|月份，补0|01、12|
|M|月份，不补0|1、12|
|dd|日期，补0|01、31|
|d|日期，不补0|1、31|
|HH|24小时格式的小时数，补0|00，23|
|H|24小时格式的小时数，不补0|1，23|
|hh|12小时格式的小时数，补0|01，12|
|h|12小时格式的小时数，不补0|1，12|
|mm|分钟数，补0|00，59|
|m|分钟数，不补0|0，59|
|ss|秒数，补0|00，59|
|s|秒数，不补0|0，59|
|SS|毫秒数，补0|000，999|
|S|毫秒数，不补0|0，999|
|A|大写的表示上午还是下午|AM/PM|
|a|小写的表示上午还是下午|am/pm|
|T|Milliseconds, since 1970-1-1 00:00:00 UTC|759883437303|

#### 示例

```javascript

	console.log(Mock.mock({
		'rd1':'@date()',
		'rd2':'@date(yy-MM-dd)',
		'rd3':'@date(y-MM-d)'
	}));

```

#### 示例结果

![@date](https://upload-images.jianshu.io/upload_images/10187278-bc442b9fa082eb08.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.time([format])`：返回一个随机的时间字符串

- format，可选，指示生成的时间字符串的格式，默认为HH:mm:ss

#### 示例

```javascript

	console.log(Mock.mock({
		'rt1': '@time()',
		'rt2': '@time(A HH:mm:ss)',
		'rt3': '@time(a h:m:s)'
	}));

```

#### 示例结果

![@time](https://upload-images.jianshu.io/upload_images/10187278-9f568b19c7446a39.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.datetime([format])`：返回一个随机的日期和时间字符串

- format 可选，指示生成的日期和时间字符串的格式。默认值为yyyy-MM-dd HH:mm:ss

#### 示例

```javascript

	console.log(Mock.mock({
		'rdt1': '@datetime()',
		'rdt2': '@datetime(yyyy-MM-dd A HH:mm:ss)',
		'rdt3': '@time(y-M-d a h:m:s)'
	}));

```

#### 示例结果

![@datetime](https://upload-images.jianshu.io/upload_images/10187278-9b0afa83c6774e3b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.now([unit|format])`：返回当前的日期和时间字符串

- unit，可选，表示时间单位，用于对当前日期和时间进行格式化。可选值有：year/month/week/day/hour/minute/second/week，默认不会格式化

- format，可选，指示生成的日期和时间字符串的格式，默认值为 yyyy-MM-dd HH:mm:ss

#### 示例

```javascript

	console.log(Mock.mock({
		'rnow1': '@now()',
		'rnow2': '@now(yyyy-MM-dd A HH:mm:ss)',
		'rnow3': '@now(year)',
		'rnow4': '@now(day)',
		'rnow4': '@now(day,yyyy-MM-dd A HH:mm:ss)'
	}));

```

#### 示例结果

![@now](https://upload-images.jianshu.io/upload_images/10187278-38ae0c8aee80a92b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### Image

##### 注：Random.image()用于生成高度自定义的图片地址，一般情况下，应该使用更简单的Random.dataImage()

>#### `Random.image([size][,background][,foreground][,format][,text])`：生成一个随机的图片地址

- size，可选，指示图片的宽高，格式为‘宽*高’。默认从下面的数组中随机读取一个：

```javascript

	['300x250', '250x250', '240x400', '336x280', '180x150', '720x300', '468x60', 
	'234x60', '88x31', '120x90', '120x60', '120x240', '125x125', '728x90', '160x600', 
	'120x600', '300x600']

```

- background，可选，指示图片的背景色，默认值为'#000000'
- foreground，可选，指示图片的前景色（文字颜色）。默认值为'#ffffff'
- format，可选，指示图片的格式，默认值为png，可选值为png/gif/jpg
- text，可选，指示图片上的文字。默认值为参数size

#### 示例

```javascript

	console.log(Mock.mock({
		'rimg1': '@image()',
		'rimg2': '@image(200x100)',// image(size)
		'rimg3': '@image(200x100,#FF6600)',// image(size, background)
		'rimg4': '@image(200x100,#4A7BF7,Hello)',// image(size, background, text)
		'rimg5': '@image(200x100,#4A7BF7,#000,Mock)',// image(size, background, foreground)
		'rimg6': '@image(200x100,#4A7BF7,#000,jpg,坤)'// image(size, background, foreground, format, text)
	}));

```

#### 示例结果

![@image](https://upload-images.jianshu.io/upload_images/10187278-a673e755fe3e97ec.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 上面的连接输入到浏览器中可以显示为一张图片

|地址|生成图片|
|:-:|:-:|
|rimg1: "http://dummyimage.com/728x90"|![rimg1](https://upload-images.jianshu.io/upload_images/10187278-624c709b95ca2f7c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|
|rimg2: "http://dummyimage.com/200x100"|![rimg2](https://upload-images.jianshu.io/upload_images/10187278-dd4c065efdf49b1e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|
|rimg3: "http://dummyimage.com/200x100/FF6600"|![rimg3](https://upload-images.jianshu.io/upload_images/10187278-49a3b5af5450ac16.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|
|rimg4: "http://dummyimage.com/200x100/4A7BF7&text=Hello"|![rimg4](https://upload-images.jianshu.io/upload_images/10187278-10f86c2a804a7f94.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|
|rimg5: "http://dummyimage.com/200x100/4A7BF7/000&text=Mock"|![rimg5](https://upload-images.jianshu.io/upload_images/10187278-7c02cb8abe57d862.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|
|rimg6: "http://dummyimage.com/200x100/4A7BF7/000.jpg&text=坤"|![rimg6](https://upload-images.jianshu.io/upload_images/10187278-771df37707d115cc.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|

>#### `Random.dataImage([size][,text]`：生成一段随机的Base64图片编码

- siez，可选，指示图片的匡高，与Random.image中该参数相同
- text，可选，指示图片上的文字，默认值为参数size

#### 示例

```javascript

	console.log(Mock.mock({
		'rdimg1': '@dataImage()',
		'rdimg2': '@dataImage(200x100)',
		'rdimg3': '@dataImage(200x100,Hello world)',
	}));

```

#### 示例结果

![@dataImage](https://upload-images.jianshu.io/upload_images/10187278-4f19a26708ca0f15.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### Color

|命令|格式|
|:-:|:-:|
|Random.color()|#RRGGBB|
|Random.hex()|#RRGGBB|
|Random.rgb()|rgb(r,g,b)|
|Random.rgba()|rgba(r,g,b,a)|
|Random.hsl()|hsl(h,s,l)|

#### 示例

```javascript

	console.log(Mock.mock({
		'rc1': '@color()',
		'rc2': '@hex()',
		'rc3': '@rgb()',
		'rc4': '@rgba()',
		'rc5': '@hsl()'
	}));

```

#### 示例结果

![@color](https://upload-images.jianshu.io/upload_images/10187278-852c6f24e9c2878c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### Text

>### `Random.paragraph([len]|[min,max])`：随机生成一段文本

- len，可选，指示文本中*句子*的个数。默认值3到7之间的随机数
- min，可选，指示文本中句子的最小个数。默认值为3
- max，可选，指示文本中句子的最大个数。默认值为7

#### 示例

```javascript

	console.log(Mock.mock({
		'rp1':'@paragraph()',
		'rp2':'@paragraph(2)',
		'rp3':'@paragraph(1,3)',
		'rp4':'@paragraph(1,3)'
	}));

```

#### 示例结果

![@paragraph](https://upload-images.jianshu.io/upload_images/10187278-bace09bf7bea47b5.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


>#### `Random.cparagraph([len]|[min,max])`：随机生成一段*中文*文本。

#### 参数的含义和默认值与Random.paragraph相同

#### 示例

```javascript

	console.log(Mock.mock({
		'rcp1':'@cparagraph()',
		'rcp2':'@cparagraph(2)',
		'rcp3':'@cparagraph(1,3)',
		'rcp4':'@cparagraph(1,3)'
	}));

```

#### 示例结果

![@cparagraph](https://upload-images.jianshu.io/upload_images/10187278-77303f4ba54b23a5.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.sentence([len]|[min,max])`：随机生成一个句子，第一个单词的首字母大写。

- len，可选，指示句子中单词的个数。默认值为12到18之间的随机数
- min，可选，指示句子中的单词的最小个数。默认值为12
- max，可选，指示句子中的单词的最大个数。默认值为18

#### 示例

```javascript

	console.log(Mock.mock({
		'rst1':'@sentence()',
		'rst2':'@sentence(2)',
		'rst3':'@sentence(7,10)',
		'rst4':'@sentence(6,12)'
	}));

```

#### 示例结果

![@sentence](https://upload-images.jianshu.io/upload_images/10187278-b52cf65f1d5cfd9e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.csentence([len]|[min,max])`：随机生成一段*中文*文本

##### 参数的含义和默认值同Random.sentence

#### 示例

```javascript

	console.log(Mock.mock({
		'rcst1':'@csentence()',
		'rcst2':'@csentence(2)',
		'rcst3':'@csentence(5,10)',
	}));

```

#### 示例结果

![@csentence](https://upload-images.jianshu.io/upload_images/10187278-cabc67b44fb1e766.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.word([len]|[min,max])`：随机生成一个单词。

- len 可选，指示单词中字符的个数。默认值为3到10之间的随机数
- min 可选，指示单词中字符的最小个数。默认值为3
- max 可选，指示单词中字符的最大个数。默认值为10

#### 示例

```javascript

	console.log(Mock.mock({
		'rw1':'@word()',
		'rw2':'@word(3)',
		'rw3':'@word(5,9)'
	}));

```

#### 示例结果

![@word](https://upload-images.jianshu.io/upload_images/10187278-2440ccca590cf247.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.cword([pool]|[,length]|[min,max]`：随机生成一个汉字

- pool 可选，汉字字符串。表示汉字字符池，将从中选择一个汉字字符返回
- min 可选，随机汉字字符串的最小长度。默认值为1
- max 可选，随机汉字字符串的最大长度。默认值为1

#### 示例

```javascript

	console.log(Mock.mock({
		'rcw1': '@cword()',
		'rcw2': '@cword("哈啦滴立即逻辑逻辑",3)',
		'rcw3': '@cword(5)',
		'rcw4': '@cword("里面valid阿不见了恐惧",3,7)'
	}));

```

#### 示例结果

![@cword](https://upload-images.jianshu.io/upload_images/10187278-6a5654585bb40d1e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.title([len]|[min,max])`：随机生成一句标题，其中每个单词的首字母大写。

- len 可选，指示单词中字符的个数。默认值为3到7之间的随机数
- min 可选，指示单词中字符的最小个数。默认值为3
- max 可选，指示单词中字符的最大个数。默认值为7

#### 示例

```javascript

	console.log(Mock.mock({
		'rt1': '@title()',
		'rt2': '@title(5)',
		'rt3': '@title(3,5)'
	}));

```

#### 示例结果

![@title](https://upload-images.jianshu.io/upload_images/10187278-5adec92f0fbb3bfd.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### `Random.ctitle([len]|[min,max])`：随机生成一句中文标题。

##### 参数的含义和默认值同Random.title()

#### 示例

```javascript

	console.log(Mock.mock({
		'rct1': '@ctitle()',
		'rct2': '@ctitle(5)',
		'rct3': '@ctitle(3,5)'
	}));

```

#### 示例结果

![@ctitle](https://upload-images.jianshu.io/upload_images/10187278-cbeb2a8328e2363e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### Name

- `Random.first()`：随机生成一个常见的英文名
- `Random.last()`：随机生成一个常见的英文姓	
- `Random.name(middle)`：随机生成一个常见的英文姓名，middle，可选，布尔值，指示是否生成中间名。
- `Random.cfirst()`：随机生成一个常见的中文名
- `Random.clast()`：随机生成一个常见的中文姓
- `Random.cname()`：随机生成一个常见的中文姓名

#### 示例

```javascript

	console.log(Mock.mock({
		'rf': '@first()',
		'rl': '@last()',
		'rn1': '@name()',
		'rn2': '@name(true)',
		'rcf': '@cfirst()',
		'rcl': '@clast()',
		'rcn': '@cname()'
	}));

```

#### 示例结果

![@name](https://upload-images.jianshu.io/upload_images/10187278-398ff75dabcf6132.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### web

>#### `Random.url([protocol | host])`：随机生成一个url

- protocol 指定url协议。例如http
- host 指定URL域名和端口号。例如 unysoft.com

#### 示例

```javascript

	console.log(Mock.mock({
		'ru1': '@url()',
		'ru2': '@url("http")',
		'ru3': '@url("https","pengkun.com")'
	}));

```

#### 示例结果

![@url](https://upload-images.jianshu.io/upload_images/10187278-7502b4bd108f99c1.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

- `Random.protocol()`：随机生成一个URL协议。返回一下值之一:`http/ftp/gopher/mailto/mid/cid/news/nntp/prospero/telnet/rlogin/tn3270/wais`
- `Random.domain()`：随机生成一个域名
- `Random.tld()`：随机生成一个顶级域名
- `Random.email([domain])`：随机生成一个邮件地址，domain，指定邮件地址的域名
- `Random.ip()`：随机生成一个IP地址

#### 示例

```javascript

	console.log(Mock.mock({
		'rpro': '@protocol()',
		'rdm': '@domain()',
		'rtld': '@tld()',
		'remail': '@email()',
		'rip': '@ip()',
	}));

```

#### 示例结果

![@url1](https://upload-images.jianshu.io/upload_images/10187278-98ad7865fc2f5f70.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### Address

- `Random.region()`：随机生成一个中国大区
- `Random.province()`：随机生成一个中国省级行政单位
- `Random.city([prefix])`：随机生成一个种鸽市级行政单位，prefix，可选，布尔值，指示是否生成所属的省
- `Random.county([prefix])`：随机生成一个中国县，prefix，可选，指示是否生成所属的省、市
- `Random.zip()`：随机生成一个邮政编码（六位数字）。

#### 示例

```javascript

	console.log(Mock.mock({
		'rar': '@region()',
		'rap': '@province()',
		'rac': '@city()',
		'ract': '@city(true)',
		'rac': '@county()',
		'ract': '@county(true)',
		'raz': '@zip()'
	}));

```

##### 示例结果

![@address](https://upload-images.jianshu.io/upload_images/10187278-d65d7caa0dbf562b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### Helper

- `Random.capitalize(word)`：把字符串的第一个字母转换为大写
- `Random.upper(str)`：把字符串转换为大写
- `Random.lower(str)`：把字符串转换为小写
- `Random.pick(arr)`：从数组中随机选取一个元素，并返回
- `Random.shuffle(arr)`：打乱数组中元素的顺序，并返回

#### 示例

```javascript

	console.log(Mock.mock({
		'rhc': '@capitalize("hello world")',
		'rhu': '@upper("hello world")',
		'rhl': '@lower("HELLO WORld")',
		'rhp': '@pick(["he","wo","la"])',
		'rhs': '@shuffle(["a","b","c","d"])'
	}));

```

#### 示例结果

![@helper](https://upload-images.jianshu.io/upload_images/10187278-91bb1172fc4d6edd.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### Miscellaneous（其他）

- `Random.guid()`：随机生成一个GUID
- `Random.id()`：随机生成一个18位身份证
- `Random.increment([step])`：生成一个全局的自增整数，step，可选，自增的步长，默认值为1

#### 示例

```javascript

	console.log(Mock.mock({
		'rmg': '@guid()',
		'rmi': '@id()',
		'rmi': '@increment()',
		'rmi1': '@increment(10)',
		'rmi2': '@increment(10)'
	}));

```

#### 示例结果

![其他](https://upload-images.jianshu.io/upload_images/10187278-035632650f7e5eee.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---

### Mock.setup()

>#### `Mock.setup(settions)`：配置拦截Ajax请求时的行为。支持的配置项有:timeout

##### settings，必选，配置项集合

##### timeout，可选，指定被拦截的 Ajax 请求的响应时间，单位是毫秒。值可以是正整数，例如 400，表示 400 毫秒 后才会返回响应内容；也可以是横杠 '-' 风格的字符串，例如 '200-600'，表示响应时间介于 200 和 600 毫秒之间。默认值是'10-100'。

#### 示例

```javascript

	Mock.setup({
		timeout:400
	});
	Mock.setup({
		timeout:'200-500'
	});

```

---

### Mock.valid()

>#### Mock.valid(template,data)：校验真实数据data是否与数据模板template匹配

- template 必选，表示数据模板，可以是对象或字符串。
- data 必选，表示真实数据

#### 示例

```javascript

	var template = {
	  name: 'value1'
	}
	var data = {
	  name: 'value2'
	}
	console.log(Mock.valid(template, data));

```

#### 示例结果

![valid](https://upload-images.jianshu.io/upload_images/10187278-4ec0b9aa3d6551bb.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>## 参考文档：[Mock.js](http://mockjs.com/)





























