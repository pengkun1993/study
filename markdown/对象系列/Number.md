# 全面认识JavaScript的Number对象

首先一个是对JavaScript中Number的理解：JavaScript中函数是一等公民，写在代码中的 `Array/Object/String/Number/Function`等等其实都是一个构造函数，是用来生成相应的数据类型的变量的。

---

JavaScript的Number对象是经过封装的能让你处理数字值的对象。Number对象由Number()构造器创建。

##### 语法：

```javascript

  new Number(value);

  // 参数
  value // 被创建对象的数字值

```

##### Number对象主要用于：

- 如果参数无法被转换为数字，则返回NaN
- 在非构造器上下文中(如：没有new操作符)，Number能被用来执行类型转换。

---

### ========== 属性 ==========

>##### Number.EPSILON属性表示1与Number可表示的大于1的最小浮点数之间的差值。

|属性的属性特性|值|
|:-:|:-:|
|writable|false|
|enumerable|false|
|configurable|false|

EPSILON属性的值接近于2.2204460492503130808472633361816E-16，或者 2^-52。

##### 示例：

```javascript

  let x = 0.2;
  let y = 0.3;
  let z = 0.1;

  console.log(Math.abs(x - y + z) < Number.EPSILON); // true

  console.log(Math.abs(x - y + z)); // 2.7755575615628914e-17
  console.log(Number.EPSILON); // 2.220446049250313e-16

```

>##### `Number.MAX_SAFE_INTEGER/Number.MIN_SAFE_INTEGER`代表在JavaScript中最大/最小的安全的integer型数字(`2^53 - 1/-(2^53 - 1)`)

|属性的属性特性|值|
|:-:|:-:|
|writable|false|
|enumerable|false|
|configurable|false|

`MAX_SAFE_INTEGER`的值是9007199254740991，形成这个数字的原因是JavaScript在IEEE 754中使用[double-precision floating-point format numbers](http://en.wikipedia.org/wiki/Double_precision_floating-point_format)（不懂）作为规定。在这个规定中能安全的表示数字的范围在`-(2^53 - 1)`到`2^53 - 1`之间。

这里安全存储的意思是指能够准确区分两个不相同的值，例如 `Number.MAX_SAFE_INTEGER + 1 === Number.MAX_SAFE_INTEGER + 2` 将得到 true的结果，而这在数学上是错误的

>##### `Number.MAX_VALUE/Number.MIN_VALUE`表示在JavaScript里所能表示的最大/最小数值。

|属性的属性特性|值|
|:-:|:-:|
|writable|false|
|enumerable|false|
|configurable|false|

`MAX_VALUE`属性值接近于`1.79E+308`。大于MAX_VALUE的值代表'Infinity'。

>##### `Number.NEGATIVE_INFINITY/Number.POSITIVE_INFINITY`属性表示负无穷大/正无穷大。

|属性的属性特性|值|
|:-:|:-:|
|writable|false|
|enumerable|false|
|configurable|false|

Number.NEGATIVE_INFINITY的值和全局对象Infinity属性的负值相同。

##### 该值的行为同数学上的无穷大（infinity）有一点儿不同：

- 任何正值，包括`POSITIVE_INFINITY`，乘以`NEGATIVE_INFINITY`都为`NEGATIVE_INFINITY`
- 任何正值，包括`POSITIVE_INFINITY`，乘以`POSITIVE_INFINITY`都为`POSITIVE_INFINITY`。
- 任何负值，包括`NEGATIVE_INFINITY`，乘以`NEGATIVE_INFINITY`都为`POSITIVE_INFINITY`
- 任何负值，包括`NEGATIVE_INFINITY`，乘以`POSITIVE_INFINITY`都为`NEGATIVE_INFINITY`
- 0 乘以 `NEGATIVE_INFINITY/POSITIVE_INFINITY` 为 `NaN`
- `NaN` 乘以 `NEGATIVE_INFINITY/POSITIVE_INFINITY` 为 `NaN`
- `NEGATIVE_INFINITY`除以任何负值（除了`NEGATIVE_INFINITY`）为`POSITIVE_INFINITY`
- `POSITIVE_INFINITY`除以`NEGATIVE_INFINITY`以外的任何负值为`NEGATIVE_INFINITY`
- `NEGATIVE_INFINITY`除以任何正值（除了`POSITIVE_INFINITY`）为`NEGATIVE_INFINITY`
- `POSITIVE_INFINITY`除以`POSITIVE_INFINITY`以外的任何正值为`POSITIVE_INFINITY`
- `NEGATIVE_INFINITY`除以`NEGATIVE_INFINITY`或`POSITIVE_INFINITY`是 `NaN`
- `POSITIVE_INFINITY`除以`NEGATIVE_INFINITY`或`POSITIVE_INFINITY`为 `NaN`
- 任何数除以`NEGATIVE_INFINITY/POSITIVE_INFINITY`为 0

>##### `Number.NaN`表示“非数字”。和`NaN`相同。

|属性的属性特性|值|
|:-:|:-:|
|writable|false|
|enumerable|false|
|configurable|false|

##### 示例： 

```javascript

  console.log(Number.MAX_SAFE_INTEGER); // 9007199254740991
  console.log(Number.MIN_SAFE_INTEGER); // -9007199254740991
  console.log(Number.MAX_SAFE_INTEGER + 1 === Number.MAX_SAFE_INTEGER + 2) // true
  console.log(Number.MAX_SAFE_INTEGER + 1); // 9007199254740992
  console.log(Number.MAX_SAFE_INTEGER + 2); // 9007199254740992 , 加不上去了

  console.log(Number.MAX_VALUE); // 1.7976931348623157e+308
  console.log(Number.MIN_VALUE); // 5e-324
  console.log(Number.MAX_VALUE === Number.MAX_VALUE + 1); // true
  console.log(Number.MAX_VALUE + 1); //  1.7976931348623157e+308 ,再加也不会更大
  console.log(Infinity); // Infinity
  console.log(Number.MAX_VALUE < Infinity); // true

  console.log(Number.POSITIVE_INFINITY); // Infinity
  console.log(Number.NEGATIVE_INFINITY); // -Infinity
  console.log(Number.POSITIVE_INFINITY === Infinity); // true

  console.log(Number.NaN); // NaN
  console.log(NaN); // NaN
  console.log(Number.NaN === Number.NaN); // false
  console.log(Number.NaN === NaN); // false, NaN不等于任何值，包括自身
  console.log(Object.is(Number.NaN, NaN)); // true

```

>##### Number.prototype属性表示Number构造函数的原型

|属性的属性特性|值|
|:-:|:-:|
|writable|false|
|enumerable|false|
|configurable|false|

所有Number实例都继承自Number.prototype。

### ========== 方法 ==========

根据个人的理解，将方法进行分类

#### 值类型判断类：`isNaN/isFinite/isInteger/isSafeInteger`

>##### 1.Number.isNaN()确定传递的值是否为NaN和其类型是Number。它是原始的全局`isNaN`的强大的版本。

##### 语法：

```javascript

  Number.isNaN(value);

  // 参数
  value // 要被检测是否是NaN的值

  // 返回值：一个布尔值，表示给定的值是否是NaN

```

>##### 附：全局的isNaN()函数用来确定一个值是否为NaN。

##### 语法：

```javascript

  isNaN(testValue);

  // 参数
  testValue // 要被检测的值

  // 返回值：如果给定值为NaN则返回值为true;否则为false

```

######为什么要专门出一个方法判断是否是NaN：与JavaScript中其他的值不同，NaN不能通过相等操作符（== 和 ===）来判断，NaN === NaN 和 NaN == NaN都返回false。

##### NaN值如何产生：

- 当算数运算返回一个未定义的或无法表示的值时，NaN就产生了。
- 将某些不能强制转换为数值的非数值转换为数值的时候，也会得到NaN。
- 0除以0会返回NaN，但是其他数除以0则不会返回NaN。

全局isNaN()的怪异行为：如果isNaN函数的参数不是Number，isNaN函数会首先尝试将这个参数转换为数值，然后才会对转换后的结果是否是NaN进行判断。因此，对于能被强制转换为有效的非NaN数值来说（空字符串和布尔值分别会被强制转换为数值0和1），进而会返回false。这让人感到怪异，因为空字符串明显不是数值。这起源于“不是数值”在基于IEEE-754数值的浮点计算体质中代表了一种特定的含义。isNaN函数其实等同于回答了一个问题：被测试的值在被强制转换成数值时，会不会返回IEEE-754中所谓的“不是数值”。

因此，通过Number.isNaN()来检测是否是一个NaN是一种更可靠的方法。也可通过表达式（x != x)来检测变量x是否是NaN。

Number.isNaN()和isNaN()相比，前者不会强制将参数转换成数字，只有在参数是真正的数字类型，且值为NaN的时候才会返回true。

##### Polyfill

```javascript

  var isNaN = function(value) {
    let n = Number(value); // 先转换为Number
    return n != n; // 利用NaN不等于自身进行判断
  }

  Number.isNaN = Number.isNaN || function(value) {
    //非Number类型直接返回false
    return typeof value === 'Number' && isNaN(value); 
  }

```

##### 示例：

```javascript
  
  console.log(isNaN(NaN)); // true
  console.log(Number.isNaN(NaN)); // true

  console.log(isNaN(37)); // false
  console.log(Number.isNaN(37)); // false

  console.log(Number.isNaN('37')); // false
  console.log(isNaN('37')); // false

  console.log(Number.isNaN(undefined)); // false
  console.log(isNaN(undefined)); // true
  console.log(Number(undefined)); // NaN

  console.log(Number.isNaN({})); // false
  console.log(isNaN({})); // true
  console.log(Number({})); // NaN

  console.log(Number.isNaN('37,5')); // false
  console.log(isNaN('37,5')); // true
  console.log(Number('37,5')); // NaN

  console.log(Number.isNaN('123ABC')); // false
  console.log(isNaN('123ABC')); // true
  console.log(Number('123ABC')); // NaN

  console.log(Number.isNaN(new Date().toString())); // false
  console.log(isNaN(new Date().toString())); // true
  console.log(Number(new Date().toString())); // NaN

  console.log(Number.isNaN(true)); // false
  console.log(isNaN(true)); // false
  console.log(Number(true)); // 1

  console.log(Number.isNaN(null)); // false
  console.log(isNaN(null)); // false
  console.log(Number(null)); // 0

  console.log(Number.isNaN('')); // false
  console.log(isNaN('')); // false
  console.log(Number('')); // 0

  console.log(Number.isNaN(' ')); // false
  console.log(isNaN(' ')); // false
  console.log(Number(' ')); // 0

  console.log(Number.isNaN(new Date())) // false
  console.log(isNaN(new Date())); // false
  console.log(Number(new Date())); // 1558496426074

```

个人总结：只要不是NaN任何值放入Number.isNaN()都会返回false。对于isNaN()能被Number()转换成数字的或本身就是数字返回false，不能转为数字的会返回true。（即：如果忽略掉能被转成数字的字符串，所有数字对于isNaN()都返回false，非数字都返回true)

>##### 2.Number.isFinite()用来检测传入的参数是否是一个有穷数。

##### 语法：

```javascript

  Number.isFinite(value);

  // 参数
  value // 要被检测有穷性的值。

  // 返回值：一个布尔值表示给定的值是否是一个有穷数

```

>##### 附：全局的isFinite()函数用来判断被传入的参数值是否是一个有限数值。在必要情况下，参数会首先转为一个数值。

##### 语法：

```javascript

  isFinite(testValue);

  // 参数
  testValue // 用来检测有限性的值。

  // isFinite 方法检测它参数的数值。如果参数是 NaN，正无穷大或者负无穷大，会返回false，其他返回 true。

```

Number.isFinite()和全局的isFinite()相比，不会强制将一个非数值的参数转换成数值，这就意味着，只有数值类型的值，且是有穷的，才返回true。

##### Polyfill

```javascript

  Number.isFinite = Number.isFinite || function(value) {
    return typeof value === 'number' && isFinite(value);
  }

```

##### 示例：

```javascript

  console.log(Number.isFinite(Infinity)); // false
  console.log(isFinite(Infinity)); // false

  console.log(Number.isFinite(NaN)); // false
  console.log(isFinite(NaN)); // false

  console.log(Number.isFinite(2e64)); // true
  console.log(isFinite(2e64)); // true

  console.log(Number.isFinite('0')); // false
  console.log(isFinite('0')); // true

  console.log(Number.isFinite(undefined)); // false
  console.log(isFinite(undefined)); // false
  console.log(Number(undefined)); // NaN

  console.log(Number.isFinite(null)); // false
  console.log(isFinite(null)); // true
  console.log(Number(null)); // 0

```

个人总结：只有为Number的值且是有限的时候Numebr.isFinite()会返回true。而isFinite()在参数经过Number转换后再判断是否是有限的。正无穷、负无穷和NaN都不是有限数字。

>##### 3.Number.isInteger()用来判断给定的参数是否为整数。

##### 语法： 

```javascript

  Number.isInteger(value);

  // 返回值：判断给定的值是否是整数的Boolean值。如果被检测的值是整数，则返回 true，否则返回 false。注意 NaN 和正负 Infinity 不是整数。

```

##### 示例： 

```javascript

  console.log(Number.isInteger(0)); // true
  console.log(Number.isInteger(-0)); // true
  console.log(Number.isInteger(0.1)); // false
  console.log(Number.isInteger(Math.PI)); // false
  console.log(Number.isInteger(Infinity)); // false
  console.log(Number.isInteger(-Infinity)); // false
  console.log(Number.isInteger(NaN)); // false
  console.log(Number.isInteger('10')); // false
  console.log(Number.isInteger(true)); // false
  console.log(Number.isInteger(false)); // false
  console.log(Number.isInteger([1])); // false

```

个人总结：只有是Number类型的值并且是整数才会返回true，Infinity和NaN都不是整数。

##### Polyfill

```javascript

  Number.isInteger = Number.isInteger || function(value) {
    return typeof value === 'number' && isFinite(value) && Math.floor(value) === value;
  }

```

>##### 4.Number.isSafeInteger()用来判断传入的参数是否是一个“安全整数”

比如：`2^53-1`是一个安全整数，它能被精确表示，在任何IEEE-754舍入模式下，没有其他整数舍入结果为该整数。作为对比，`2^53`就不是一个安全整数，它能够使用IEEE-754表示，但是`2^53+1`不能使用IEEE-757直接表示，在就近舍入和向零舍入中，会被舍入为`2^53`。

安全整数范围为`-(2^53-1)`到`2^53-1`之间的整数，包含`-(2^53-1)`和`2^53-1`

##### 语法：

```javascript

  Number.isSafeInteger(testValue);

  // 返回值：一个布尔值表示给定的值是否是一个安全整数

```

##### 示例：

```javascript

  console.log(Number.isSafeInteger(3)); // true
  console.log(Number.isSafeInteger(Math.pow(2,53))); // false
  console.log(Number.isSafeInteger(Math.pow(2,53)-1)); // true
  console.log(Number.isSafeInteger(NaN)); // false
  console.log(Number.isSafeInteger(Infinity)); // false
  console.log(Number.isSafeInteger('3')); // false
  console.log(Number.isSafeInteger(3.1)); // false
  console.log(Number.isSafeInteger(3.0)); // true

```

##### Polyfill

```javascript

  Number.isSafeInteger = Number.isSafeInteger || function(value) {
    return Number.isInteger(value) && Math.abs(value) <= Number.MAX_SAFE_INTEGER;
  }

```

---

#### 类型转换类：`parseFloat/parseInt`

>##### 1.Number.parseInt()方法依据指定基数[参数radix的值]，把字符串[参数string的值]解析成整数。

##### 语法：

```javascript

  Number.parseInt(string[, radix]);

```

##### Number.parseInt()与parseInt()函数是同一个函数：`Number.parseInt === parseInt;// true`

>##### 附：parseInt()函数解析一个字符串参数，并返回一个指定基数的整数。

##### 语法：

```javascript

  parseInt(string, radix);

  // 参数 
  string // 要被解析的值。如果参数不是一个字符串，则将其转换为字符串。字符串开头的空白符将会被忽略。
  radix // 一个介于2和36之间的整数，表示上述字符串的基数。比如参数'10'表示使用我们通常使用的十进制数值系统。始终指定此参数可以取消阅读该代码时的困惑并且保证转换结果可预测。当未指定基数时，不同的实现会产生不同的结果，通常将默认值认为10。

  // 返回值：返回解析后的整数值。如果被解析的第一个字符无法被转化成数值类型，则返回NaN
  
  // 注： radix参数为n将会把第一个参数看作是一个数的n进制表示，而返回的值则是十进制的。

```

一些数中可能包含e字符，使用parseInt去截取包含e字符数值部分会造成难以预料的结果。

```javascript

  console.log(parseInt('6.022e23', 10)); // 6
  console.log(parseInt(6.022e23, 10)); // 6

```

如果parseInt遇到了不属于radix参数所指定的基数中的字符那么该字符和其后的字符都将被忽略。接着返回已经解析的整数部分。parseInt将截取整数部分。开头和结尾的空白符允许存在，会被忽略。

```javascript

  console.log(parseInt('F', 16)); // 15
  console.log(parseInt('FXX123', 16)); // 15,X和X之后的字符被省略
  console.log(parseInt('15 * 3', 10)); // 15
  console.log(parseInt(1123, 2)); // 3

```

在基数为undefined，或者基数为0或者没有指定的情况下，JavaScript作如下处理：

- 如果字符串string以'0x'或者'0X'开头，则基数是16（16进制）
- 如果字符串string以'0'开头，基数是8（八进制）或者10（十进制），那么具体是哪个基数由实现环境决定。ECMAScript 5规定使用10，但是并不是所有浏览器都遵循这个规定。因此，永远都要给出明确的radix参数值。
- 如果字符串string以其他任何值开头，则基数是10（十进制）

```javascript

  console.log(parseInt('012')); // 12 
  console.log(parseInt('012', 8)); // 10 
  console.log(parseInt('08')); // 8
  console.log(parseInt('08', 8)); // 0
  console.log(parseInt('0xF')); // 15
  console.log(parseInt('F', 16)); // 15

  // 可见chrome浏览器认为0开头的基数是10

```

如果一个字符不能被转换成数字，parseInt返回NaN。 算数上NaN不是任何一个进制下的数。

```javascript

  console.log(parseInt('Hello', 8)); // NaN
  console.log(parseInt('546', 2)); // NaN
  console.log(parseInt('-F', 16)); // -15
  console.log(parseInt('  -0F', 16)); // -15
  console.log(parseInt('  -0xF  ', 16)); // -15
  console.log(parseInt('-15e01', 10)); // -15

  console.log(parseInt(4.9, 10)); // 4
  console.log(parseInt(4.7 * 1e22, 10)); // 4 非常大的数值变成4
  console.log(parseInt(0.00000000000000434, 10)); // 4 非常小的数值变成4
  console.log(parseInt(0.0000000000000034, 10)); // 3 非常小的数值变成3
  console.log(parseInt(0.04, 10)); // 0

```

一个更严格的解析函数：MDN上的一个方法，但是感觉和parseInt差别很大，这个方法指示找出数字然后显示，和进制也没有太大关系。

```javascript

  let filterInt = function(value) {
    if(/^(\-|\+)?([0-9]+|Infinity)$/.test(value)){
      return Number(value);
    } else {
      return NaN;
    }
  };

```

>##### 2.Number.parseFloat()可以把一个字符串解析成浮点数。该方法和全局parseFloat()函数相同，并且处于ECMAScript 6 规范中。

>##### 附：parseFloat()函数解析一个字符串参数并返回一个浮点数。

##### 语法：

```javascript

  parseFloat(value);

  // 参数
  value // 需要被解析成为浮点数的值

  // 返回值：给定值被解析成浮点数，如果给定值不能被转换成数值，则返回NaN

```

######parseFloat将它的字符串参数解析成为浮点数并返回.如果在解析过程中遇到了正负号(+或-),数字(0-9),小数点,或者科学记数法中的指数(e或E)以外的字符,则它会忽略该字符以及之后的所有字符,返回当前已经解析到的浮点数.同时参数字符串首位的空白符会被忽略。

如果参数字符串的第一个字符不能被解析成为数字,则parseFloat返回NaN。

```javascript

  console.log(parseFloat('3.14')) // 3.14
  console.log(parseFloat('3.14.15')) // 3.14
  console.log(parseFloat('314e-2')) // 3.14
  console.log(parseFloat('314e-2e-1')) // 3.14
  console.log(parseFloat('0.0314E+2')) // 3.14
  console.log(parseFloat('0.0314E+2E+1')) // 3.14
  console.log(parseFloat('3.14more non-digit characters')) // 3.14
  console.log(parseFloat('FF2')); // NaN

```

更严格的转换函数：

```javascript

  let filterFloat = function(value) {
    if(/^(\-|\+)?|(\.\d+)(\d+(\.\d+)?|(\d+\.)|Infinity)$/
      .test(value)){
      return Number(value);
    } else {
      return NaN;
    }
  }
  console.log(filterFloat('3.14')) // 3.14
  console.log(filterFloat('3.14.15')) // NaN
  console.log(filterFloat('314e-2')) // 3.14
  console.log(filterFloat('314e-2e-1')) // NaN
  console.log(filterFloat('0.0314E+2')) // 3.14
  console.log(filterFloat('0.0314E+2E+1')) // NaN
  console.log(filterFloat('3.14more non-digit characters')); // NaN

```

### ========== 实例属性 =========

>##### Number.prototype.constructor 返回创建该实例对象的构造函数，默认为Number对象

---

### ========= 实例方法 ==========

所有Number实例都继承自Number.prototype。被修改的 Number 构造器的原型对象对全部 Number 实例都生效。

#### 修改表示形式类: `toExponential/toFixed/toPrecision`

>#### 1.toFixed()方法使用定点表示法来格式化一个数。

##### 语法：

```javascript

  numObj.toFixed(digits);

  // 参数
  digits // 小数点后数字的个数；介于0 到 20（包括）之间，实现环境可能支持更大范围。如果忽略该参数，则默认为0。

  // 返回值：所给数值的定点数表示法的字符串形式

  // 抛出异常
  rangeError // 如果 digits 参数太小或太大。0 到 20（包括）之间的值不会引起 RangeError。实现环境（implementations）也可以支持更大或更小的值。

  TypeError // 如果该方法在一个非Number类型的对象上调用。

```

一个数值的字符串表现形式，不使用指数计数法，而是在小数点后有digits位数字。该数值在必要时进行四舍五入，另外在必要时会用0来填充小数部分，以便小数部分有指定的位数。如果数值大于`1e+21`，该方法会简单调用`Number.prototype.toString()`并返回一个指数计数法格式的字符串。

```javascript

  let numObj = 12345.6789;

  console.log(numObj.toFixed()); // '12346'
  console.log(numObj.toFixed(1)); // '12345.7'
  console.log(numObj.toFixed(6)); // '12345.678900'

  console.log((1.23e+20).toFixed(2)); // '123000000000000000000.00'
  console.log((1.23e+22).toFixed(2)); // '1.23e+22' 大于1e+21会返回指数计数法
  console.log((1.23e-10).toFixed(2)); // '0.0'

  console.log(2.34.toFixed(1)); // '2.3'
  console.log(-2.34.toFixed(1)); // -2.3 由于操作符优先级，负数不会返回字符串
  console.log((-2.34).toFixed(1)); // '-2.3' 若用括号提高优先级，则返回字符串

```

>##### 2.toExponential() 以指数表示法返回该数值字符串表示形式。

##### 语法：

```javascript

  numObj.toExponential(fractionDigits);

  // 参数
  fractionDigits // 可选。一个整数，用来指定小数点后有几位数字。默认情况下用尽可能多的位数来显示数字

  // 返回值：一个用幂的形式来表示Number对象的字符串

  // 异常
  RangeError // 如果 fractionDigits 太小或太大将会抛出该错误。介于 0 和 20（包括20）之间的值不会引起 RangeError 。 执行环境也可以支持更大或更小范围。

  TypeError // 如果该方法在一个非数值类型对象上调用。

```

对数值字面量使用toExponential()方法，且该数值没有小数点和指数时，应该在该数值与该方法之间隔开一个空格，以避免点号被解释为一个小数点。也可以使用两个点号调用该方法。

如果一个数值的小数位数多于fractionDigits参数所提供的，则该数值将会在fractionDigits指定的小数位数处四舍五入（四舍五入规则参考toFixed方法的描述）。

```javascript

  let numObj = 12345.6789;

  console.log(numObj.toExponential()); // '1.23456789e+4'
  console.log(numObj.toExponential(1)); // '1.2e+4'
  console.log(numObj.toExponential(10)); // '1.2345678900e+4'

  console.log( 77.toExponential()); // Uncaught SyntaxError: Invalid or unexpected token
  console.log( 77 .toExponential()); // 7.7e+1
  console.log( 77..toExponential()); // 7.7e+1

```

>##### 3.toPrecision()以指定的精度返回数值对象的字符串表示。

##### 语法：

```javascript

  numObj.toPrecision(precision);

  // 参数
  precision // 可选。一个用来指定有效数个数的整数。

  // 返回值：以定点表示法或指数表示法表示的一个数值对象的字符串表示，四舍五入到precision参数指定的显示数字位数（四舍五入规则参考toFixed里方法的描述）
  
  // 如果忽略 precision 参数，则该方法表现类似于 Number.prototype.toString()。如果该参数是一个非整数值，将会向下舍入到最接近的整数。
   
  // 异常 rangeError
  // 如果 precison 参数不在 1 和 100 （包括）之间，将会抛出一个 RangeError 。执行环境也可以支持更大或更小的范围。ECMA-262 只需要最多 21 位显示数字。

```

##### 示例：

```javascript

  let numObj = 12345.6789;

  console.log(numObj.toPrecision()); // 12345.6789
  console.log(numObj.toPrecision(5)); // 12346
  console.log(numObj.toPrecision(10)); // 12345.67890
  console.log(numObj.toPrecision(1)); // 1e+4

```

---

#### 公有方法: `toString/toLocaleString/valueOf`

>##### 1.toString()返回指定Number对象的字符串表示形式。

##### 语法：

```javascript

  numObj.toString([radix]);

  radix // 指定要用于数字到字符串的转换的基数（从2到36）。如果未指定radix参数，则默认值为10。

  // 异常信息
  RangeError // 如果 toString() 的 radix 参数不在 2 到 36 之间，将会抛出一个 RangeError。

```

Number覆盖了Object对象上的toString()方法，它不是继承的Object.prototype.toString()。

如果对象是负数，则会保留负号。即使radix是2时也是如此：返回的字符串包含一个负号（-）前缀和正数的二进制表示，不是数值的二进制补码。

```javascript

  let count = 10;

  console.log(count.toString()); // 10
  console.log(17.toString()); // Uncaught SyntaxError: Invalid or unexpected token
  console.log(17 .toString()); // 17
  console.log((17).toString()); // 17
  console.log(17.2.toString()); // 17.2

  console.log(254 .toString(16)); // fe
  console.log(-10 .toString(2)); // -1010

  // 还是要注意点号的意义

```

>##### 2.toLocaleString()方法涉及到字符编码，随后学习: [Number.prototype.toLocaleString](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Number/toLocaleString)

---

>##### 3.valueOf()返回一个被Number对象包装的原始值。

##### 语法：

```javascript

  numObj.valueOf();

  // 返回值： 表示指定Number对象的原始值的数字

```

##### 示例：

```javascript

  let numObj = new Number(10);
  console.log(typeof numObj); // object

  let num = numObj.valueOf();
  console.log(num); // 10
  console.log(typeof num); // number

  console.log(10 .valueOf()); // 10
  console.log(typeof 10 .valueOf()); // number

```

---

> 参考文档：[https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Number](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Number)











