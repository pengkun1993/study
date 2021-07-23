# RegExp属性和方法整理

##### 正则表达式从上学时候就感觉跟一个噩梦似得，怎么都看不懂，工作后也有几次想好好看看正则，不知是时间还是自身技能层次的限制都没能搞明白如何写一个正则表达式，直到今天，再次一行一行阅读了MDN关于RegExp的介绍，才感觉大概有了一个概念，首先不要惧怕正则表达式，它本身也是一个对象，而RegExp()是一个构造函数，把它理解成一个和String、Number一样的对象，然后继续阅读相关介绍文档。

##### 由于也是刚入门，所以相当于一篇笔记，过于深入的正则功能不做探讨，主要是没能力探讨，哈哈，提供一个自己学习的思路。越来越爱写文档也是因为听到一句话：如果你不知道自己是不是掌握了一个知识，那就试着把这个知识讲解给别人，在你准备讲解和讲解的时候才能明白自己是否真的理解了这个知识，能给人讲明白才表明自己明白了。

---
### 定义

#### 概念：RegExp构造函数创建了一个正则表达式对象，用于将文本与一个模式匹配。（就是用一个简介的表达式匹配一个字符串）

#### 定义一个正则对象： 

```javascript

	/pattern/flags;  // 字面量
	new RegExp(pattern [,flags]); // 构造函数
	RegExp(pattern [,flags]); // 工厂符号

```

#### 参数

- pattern: 正则表达式的文本
- flags: 如果指定，标志可以具有以下值的任意组合：
	+ g:全局匹配；找到所有匹配，而不是在第一个匹配后停止（这个全局是指被作用的字符串）
	+ i:忽略大小写
	+ m:多行；将开始和结束字符（^和$）视为在多行上工作，而不是只匹配整个输入字符串的最开始和最末尾处
	+ u:Unicode;将模式视为Unicode序列点的序列
	+ y:粘性匹配；仅匹配目标字符串中此正则表达式的lastIndex属性指示的索引（并且不尝试从任何后续的索引匹配）

#### 以下表示式创建相同的正则表达式：

```javascript

	/ab+/i;
	new RegExp('ab_c', 'i');
	new RegExp(/ab+c/, 'i');

```

#### 什么时候使用构造函数创建正则，什么时候使用表示式创建：（以下摘自MDN，比较绕，可以先不去理解）

##### 当表达式被赋值时，字面量形式提供正则表达式的编译（compilation）状态，当正则表达式保持为常量时使用字面量。例如当你在循环中使用字面量构造一个正则表达式时，正则表达式不会在每一次迭代中都被重新编译（recompiled）。

##### 而正则表达式对象的构造函数，如 new RegExp('ab+c') 提供了正则表达式运行时编译（runtime compilation）。如果你知道正则表达式模式将会改变，或者你事先不知道什么模式，而是从另一个来源获取，如用户输入，这些情况都可以使用构造函数。

---

#### 正则表达式中特殊字符的含义

##### 这块其实很重要，正则之所以可以用一些简单的符号去匹配复杂的字符串就是因为定义了这些规则，比较多记忆起来比较麻烦，甚至有些干看也比较晦涩，可以粗略看一遍有一个印象，不必太过纠结每个的含义，看了后面的示例解析，然后回头来看这里会顺畅的多。


>##### 字符类别：

|字符类别|
|:-:|:-|:-|
|字符|含义|示例|
|`.`|点号，或者叫小数点用于匹配任意单个字符，但是行结束符除外：`\n \r \u2028 或 \u2019`。<br/>在字符集中，点(.)失去其特殊含义，并匹配一个字面量(.)。<br/>需要注意的是，m多行标志不会改变点号的表现。因此为了匹配多行中的字符集，可以使用[^]，它将会匹配任意字符，包括换行符。|`/.y/`匹配"yes make my day"  中的"my"和"ay"，但是不匹配"yes"。|
|`\d`|匹配任意阿拉伯数字。等价于[0-9]|`/\d/`或`/[0-9]/`匹配"B2 is the suite number."中的"2"|
|`\D`|匹配任意一个不是阿拉伯数字的字符。等价于[^0-9]|`/\D/`或`[^0-9]`  匹配"B2 is the suite number."中的'B'。<br/>因为不是全局模式，所以只匹配第一个|
|`\w`|匹配任意来自基本拉丁字母表中的字母数字字符，还包括下划线。等价于[A-Za-z0-9_]|`/\w/`或`/[^A-Za-z0-9_]/`  匹配"apple"中的'a'，"$5.27"中的'5'和"3D"中的'3'|
|`\W`|匹配任意不是基本拉丁字母表中中单词字符的字符。等价于[^A-Za-z0-9_]|`/\W/`或`/[^A-Za-z0-9_]/`  匹配"50%"中的"%"|
|`\s`|匹配一个空白符，包括空格、制表符、换页符、换行符和其他Unicode空格<br/>等价于 `[ \f\n\r\t\v​\u00a0\u1680​\u180e\u2000​\u2001\u2002​\u2003\u2004​ \u2005\u2006​\u2007\u2008​\u2009\u200a​\u2028\u2029​​\u202f\u205f​ \u3000]`|`/\s\w*/`匹配"foo bar"中的" bar"|
|`\S`|匹配一个非空白符。等价于`[^ \f\n\r\t\v​\u00a0\u1680​\u180e\u2000​\u2001\u2002​\u2003\u2004​ \u2005\u2006​\u2007\u2008​\u2009\u200a​\u2028\u2029​\u202f\u205f​\u3000]`|`/\S\w*/`匹配"foo bar"中的'foo'|
|`\t`|匹配一个水平制表符|tab|
|`\r`|匹配一个回车符|carriage return|
|`\n`|匹配一个换行符|linefeed|
|`\v`|匹配一个垂直制表符|vertical tab|
|`\f`|匹配一个换页符|form-feed|
|`[\b]`|匹配一个退格符|backspace|
|`\0`|匹配一个NUL字符。不要在此后面跟小数点||
|`\cX`|X是A-Z的一个字母。匹配字符串中的一个控制字符|`/\cM/`匹配字符串中的control-M|
|`\xhh`|匹配编码为hh（两个十六进制数字）的字符||
|`\uhhhh`|匹配Unicode值为hhhh（四个十六进制数字）的字符||
|`\`|对于那些通常被认为字面意义的字符来说，表示下一个字符具有特殊用处，并且不会被按照字面意义解释。<br/>对于那些通常特殊对待的字符，表示下一个字符不具有特殊用途，会被按照字面意义解释。|`/b/`匹配字符'b'。在b前面加上一个反斜杠，即使用`/\b/`，则该字符变得特殊，以为这匹配一个单词边界。<br/>*是一个特殊字符，表示匹配某个字符0或多次，如`/a*/`匹配`'a*'`|
|字符集合|
|`[xyz]`|一个字符集合，也叫字符组。匹配集合中的任意一个字符。可以使用'-'指定一个范围|[abcd]等价于[a-d]  匹配'birsket'中的'b'和'chop'中的'c'|
|`[^xyz]`|一个反义或补充字符集，也叫反义字符组。也就是说匹配任意不在括号内的字符。可以通过使用连字符'-'指定一个范围内的字符|`[^abcd]`等价于`[^a-d]`  第一个匹配的是'bacon'中的'o'和'chop'中的'h'|
|边界|
|`^`|匹配输入开始。如果多行标志被设为true，该字符也会匹配一个断行符后的开始处。|`/^A/`不匹配'an A'中的'A'，但匹配'An'中的'A'|
|`$`|匹配输入结尾。如果多行标志被设为true，该字符也会匹配一个断行符前的结尾处。|`/t$/`不匹配'eater'中的't'，但匹配'eat'中的't'|
|`\b`|匹配一个零宽单词边界，如一个字母与一个空格之间|`/\bno/`匹配'at noon'中的'no'，`/ly\b/`匹配'possibly yesterday'中的'ly'|
|`\B`|匹配一个零宽非单词边界，如两个自字母之间或两个空格之间|`/\Bon/`匹配'at noon'中的'on'，`/ye\B/`匹配'possibly yesterday'中的'ye'|
|分组与反向引用|
|`(x)`|匹配x并且捕获匹配项。这被称为捕获括号。捕获组有性能惩罚。如果不需要再次访问被匹配的子字符串，最好使用非捕获括号（下行）。|`/(foo)/`匹配且捕获'foo bar'中的'foo'。被匹配的子字符串可以在结果数组的元素`[1]...[n]`中找到，或在被定义的RegExp对象的属性`$1,...,$9`中找到。|
|`(?:x)`|匹配x不会捕获匹配项。这被称为非捕获括号。匹配项不能够从结果数组的元素`[1]...[n]`或已被定义的RegExp对象的属性`$1...$9`再次访问到||
|`\n`|n是一个正整数。一个反向引用，指向正则表达式中第n个括号（从左开始数）中匹配的子字符串。|`/apple(,)\sorange\1/`匹配'apple,orange,cherry,peach.'中的'apple,orange,'。|
|数量词|
|`x*`|匹配前面的模式x 0或多次|`/bo*/`匹配'A ghost booooed'中的'boooo'，'A bird wrabled'中的'b'，但是不匹配'A goat grunted'|
|`x+`|匹配前面的模式x 1或多次。等价于`{1,}`|`/a+/`匹配'candy'中的'a'，'caaaaaaaandy'中所有的'a'。|
|`x*?/x+?`|像上面的\*和+一样匹配前面的模式x，然而匹配是最小可能匹配。|`/".*?"/`匹配'"foo""bar"'中的'"foo"'，而\*后面没有？时匹配'"foo""bar"'|
|`x?`|匹配前面的模式x 0或1次|`/e?le?/`匹配'angel'中的'el'，'angle'中的'le'|
|`x(?=y)`|只有当x后面紧跟着y时，才匹配x。|`/Jack(?=Sprat)/`只有在'Jack'后面紧跟着'Sprat'时，才会匹配它。<code>/Jack(?=Sprat&#124;Frost)/</code>只有在'Jack'后面紧跟着'Sprat'或'Frost'时，才会匹配它。  然而，'Sprat'或'Frost'都不是匹配结果的一部分。|
|`x(?!y)`|只有当x后面不是紧跟着y时，才匹配x。|`/\d+(?!\.)/`只有当一个数字后面没有紧跟着一个小数点时，才会匹配该数字。`/\d+(?!\./.exec('3.141')`匹配141而不是3.141|
|<code>x&#124;y</code>|匹配x或y|<code>/green&#124;red/</code>匹配'green apple'中的'green'，'red apple'中的'red'。|
|`x{n}`|n是一个正整数。前面的模式x连续出现n次时匹配|`/a{2}/`不匹配'candy'中的'a'，但是匹配'caandy'中的两个'a'，且匹配'caaandy'中的前两个'a'|
|`x{n,}`|n是一个正整数。前面的模式x连续出现至少n次时匹配|`/a{2,}/`不匹配'candy'中的'a'，但是匹配'caandy'和'caaaaaaaandy'中的所有'a'|
|`x{n,m}`|n和m是正整数。前面的模式x连续出现至少n次，至多m次时匹配|`/a{1,3}/`不匹配'cndy'，匹配'candy'中的'a'，'caandy'中的两个'a'，匹配'caaaaaaandy'中的前三个'a'。  当匹配'caaaaaaaandy'时，即使原始字符串拥有更多的'a'，匹配项也是'aaa'。|
|断言|这两个上面都有|
|`x(?=y)`|仅匹配被y跟随的x。||
|`x(?!y)`|仅匹配不被y跟随的x。||

##### 注：如果在数量词 *、+、? 或 {}, 任意一个后面紧跟该符号（?），会使数量词变为非贪婪（ non-greedy） ，即匹配次数最小化。反之，默认情况下，是贪婪的（greedy），即匹配次数最大化。

---

### 属性

#### RegExp.prototype 允许为所有正则对象添加属性。

#### RegExp.length 值为2

### 实例

#### 实例属性

>#### RegExp.prototype.global 返回是否开启全局匹配，也就是匹配目标字符串中所有可能的匹配项，而不是只进行第一次匹配。

>#### RegExp.prototype.ignoreCase 返回是否忽略字符的大小写

>#### RegExp.prototype.multiline 返回是否开启多行模式匹配

>#### RegExp.prototype.sticky 返回搜索是否具有粘性（仅从正则表达式的lastIndex属性表示的索引处搜索）。

##### 上面的属性都是只读属性，不可修改。

>#### RegExp.prototype.lastIndex 返回下次匹配开始的字符串索引位置

##### 这是一个可读可写的整型属性，只有正则表达式使用了表示全局检索的'g'标志时，该属性才会起作用。规则如下：

- 如果lastIndex大于字符串的长度，则`regexp.text`和`regexp.exec`将会匹配失败，然后lastIndex被设置为0。
- 如果lastIndex等于字符串的长度，则该正则表达式匹配空字符串，则该正则表达式匹配从lastIndex开始的字符串。
- 如果lastIndex等于字符串的长度，且该正则表达式不匹配空字符串，则该正则表达式不匹配字符串，lastIndex被设置为0。
- 否则，lastIndex被设置为紧随最近一次成功匹配的下一个位置。

##### 示例：

```javascript
	
	const re = /(hi)?/g;
	console.log(re.exec('hi'));
	console.log(re.lastIndex);
	console.log(re.exec('hi'));
	console.log(re.lastIndex);

```

##### 结果：lastIndex 为 2（且一直是 2），"hi" 长度为 2，所以后面输出空字符串。

![lastIndex](https://upload-images.jianshu.io/upload_images/10187278-6dbf70ab745a0a45.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### RegExp.prototype.source 返回一个值为当前正则表达式对象的模式文本的字符串。该字符串不会包含正则字面量两边的斜杠以及任何的标志字符。

##### 示例

```javascript

	let regex = /fooBar/ig;

	console.log(regex.source); // fooBar

```

#### 实例方法

>#### RegExp.prototype.exec() 方法在一个指定字符串中执行一个搜索匹配。返回一个结果数组或null。

##### 语法：

```javascript

	regexpObj.exec(str);

	// 参数
	str // 要匹配正则表达式的字符串

	// 返回值 如果匹配成功，exec() 方法返回一个数组，并且更新正则表达式对象的属性。返回的数组将完全匹配成功的文本作为第一项，将正则括号里匹配成功的作为数组填充到后面。
	// 如果匹配失败，exec()返回null。

```

##### 示例：

```javascript

	const re = /quick\s(brown).+?(jumps)/ig;
	const result = re.exec('The Quick Brown Fox Jumps Over The Lazy Dog');
	console.log(result);
	console.log('lastIndex::',re.lastIndex);
	console.log('ignoreCase::',re.ignoreCase);
	console.log('global::',re.global);
	console.log('multiline::',re.multiline);
	console.log('source::',re.source);

```

##### 结果：

![exec](https://upload-images.jianshu.io/upload_images/10187278-e7b374d52b871bd6.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 下表列出这个脚本返回值的描述：

|属性/索引|描述|值|
|[0]|匹配的全部字符串|`Quick Brown Fox Jumps`|
|[1],...[n]|括号中的分组捕获|`1: "Brown" 2: "Jumps"`|
|index|匹配到的字符位于原始字符串的基于0的索引值|4|
|input|原始字符串|`The Quick Brown Fox Jumps Over The Lazy Dog`|

##### 示例：查找所有匹配

当正则表达式使用 "g" 标志时，可以多次执行 exec 方法来查找同一个字符串中的成功匹配。当你这样做时，查找将从正则表达式的 lastIndex 属性指定的位置开始。（test() 也会更新 lastIndex 属性）。

```javascript
	
	const myRe = /ab*/g;
	const str = 'abcdefabh';
	let myArray;

	while((myArray = myRe.exec(str)) !== null) {
		let msg = 'Found ' + myArray[0] + ' .';
		msg += 'Next Match starts at ' + myRe.lastIndex;
		console.log(msg);
	}

	// Found ab .Next Match starts at 2
	// Found ab .Next Match starts at 8

```

>#### RegExp.prototype.test() 方法执行一个检索，用来查看正则表达式与指定的字符串是否匹配。返回true或false。

##### 语法：

```javascript

	regexObj.test(str);

	// 参数
	str // 用来与正则表达式匹配的字符串

	// 返回值 如果正则表达式与指定的字符串匹配，返回true;否则返回false

```

###### 当你想要知道一个模式是否存在于一个字符串中时，就可以使用 test()（类似于 String.prototype.search() 方法），差别在于test返回一个布尔值，而 search 返回索引（如果找到）或者-1（如果没找到）；若想知道更多信息（然而执行比较慢），可使用`exec()`方法（类似于`String.prototype.match()`方法）。和`exec()`（或者组合使用）一样，在相同的全局正则表达式实例上多次调用test将会越过之前的匹配。

##### 示例：测试hello是否包含在字符串的最开始，返回布尔值。

```javascript

	let str = 'hello world';
	let result = /^hello/.test(str);
	console.log(result); // true

```

##### 示例：当设置全局标志的正则使用test()

```javascript
	
  let regex = /foo/g;
  console.log(regex.test('foo')); // true 
  console.log(regex.test('foo')); // false

```

###### 从上面示例可以看出，如果正则表达式设置了全局标志，`test()`的执行会改变正则表达式lastIndex属性。连续的执行`test()`方法，后续的执行将会从lastIndex处开始匹配字符串，(`exec()`同样改变正则本身的`lastIndex`属性值)。

>#### RegExp.prototype.toString()

`toString()`返回一个表示该正则表达式的字符串。 

##### 语法：`regexObj.toString()`

`RegExp`对象覆盖了Object对象的`toString()`方法，并没有继承`Object.prototype.toString()`。对于RegExp对象，toString方法返回一个该正则表达式的字符串形式。

```javascript

  const myExp = new RegExp('a+b+c');
  console.log(myExp.toString()); // /a+b+c/
  const foo = new RegExp('bar', 'g');
  console.log(foo.toString()); // /bar/g

```

#### 示例

##### 使用正则改变数据结构，匹配姓名的first last输出新的格式 last first。

```javascript

  const re = /(\w+)\s(\w+)/;
  const str = 'John Smith';
  const newstr = str.replace(re, '$2 $1');
  console.log(newstr); // Smith John

```

##### 在多行中使用正则表达式

```javascript

  const s = 'Please yes \n make my day!';
  console.log(s.match(/yes.*day/));
  console.log(s.match(/yes[^]*day/));

```

###### 结果：

![exec-match](https://upload-images.jianshu.io/upload_images/10187278-cc15c58233daee1b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 使用带有'sticky'表示的正则表达式，来匹配多行输入的单独行

```javascript

	// RegExp.prototype.sticky 返回搜索是否具有粘性（仅从正则表达式的lastIndex属性表示的索引处搜索）。

  const text = 'First line\nSecond line';
  const regex = /(\S+) line\n?/y;

  const match = regex.exec(text);
  console.log(match[1]); // First
  console.log(regex.lastIndex); // 10

  const match2 = regex.exec(text);
  console.log(match2[1]); // Second
  console.log(regex.lastIndex); // 22

  const match3 = regex.exec(text);
  console.log(match3); // null

```

##### 使用正则表达式和Unicode字符

正如上面表格提到的，`\w`或`\W`只会匹配基本的ASCII字符；如'a'到'z'、'A'到'Z'、0到9及'_'。为了匹配其他语言中的字符，如西里尔或希伯来语，要使用`\uhhhh`，'hhhh'表示十六进制表示的字符的Unicode值。下例展示怎样从一个单词中分离出Unicode字符。

```javascript

  const text = 'Образец text на русском языке';
  const regex = /[\u0400-\u04FF]+/g;

  const match = regex.exec(text);
  console.log(match[0]); // Образец
  console.log(regex.lastIndex); // 7

  const match2 = regex.exec(text);
  console.log(match2[0]); // на
  console.log(regex.lastIndex); // 15

```

##### 从URL中提取子域名

```javascript

  const url = 'http://www.baidu.com'
  console.log(/[^.]+/.exec(url)[0].substr(7)); // www

```


主要还是一些正则这个对象的介绍，它的属性和方法，多用慢慢熟悉其中的意义。

> 参考文档：[MDN RegExp](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/RegExp)






















