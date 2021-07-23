# 全面认识JavaScript的Boolean对象

###### Boolean对象是一个布尔值的对象包装器。

#### 语法： 

```javascript

  new Boolean([value]);

  // 参数
  value // 可选，用来初始化Boolean对象

```

###### 如果第一个参数不是布尔值，则会将其转换为布尔值。

- 如果省略该参数，或者其值为`0/-1/null/false/NaN/undefined/''`则生成Boolean对象的值为false。
- 如果传入的参数是DOM对象`document.all`，也会生成值为false的Boolean对象。
- 如果传入其他的值，包括值为'false'的字符串和任何对象，都会创建一个值为true的Boolean对象。

###### 当Boolean对象用于条件语句的时候，任何不是undefined和null的对象，包括值为false的Boolean对象，都会被当做true来对待。

##### 示例：下面的if语句条件为真：

```javascript

  let x = new Boolean(false);

  if(x) {
    // 这里的代码会被执行
  }

```

###### 不要使用创建Boolean对象的方式将一个非布尔值转化为布尔值，直接将Boolean当做转换函数来使用即可

```javascript

  let x = Boolean(expression); // 推荐，x是一个基本数据类型
  let x = Boolean(expression); // 不推荐，x是一个Boolean对象

```

###### 注：不要在应该使用基本类型布尔值的地方使用Boolean对象。


### ========== 属性 ==========


>##### Boolean.length length属性，值为1。

>##### Boolean.prototype构造函数的原型对象。


### ========== 方法 ==========


###### Boolean对象自身没有任何方法，不过它从自己的原型链上继承了一些方法。


### ========== 实例属性 ==========


>##### Boolean.prototype.constructor 返回创建了实例原型的函数。默认为Boolean函数


### ========== 实例方法 ==========


>##### 1.Boolean.prototype.toString()返回指定的布尔对象的字符串形式。

##### 语法：

```javascript

  bool.toString();

  // 返回值：表示特定Boolean对象的字符串

```

###### Boolean对象覆盖了Object对象的toString方法。并没有继承Object.prototype.toString()。对于布尔对象，toString方法返回该对象的字符串形式。

###### 当一个Boolean对象作为文本值或进行字符串连接时，JavaScript会自动调用其toString方法。

```javascript

  let flag = new Boolean(true);

  let myVar = flag.toString();

  console.log(myVar); // true
  console.log(flag+' hah'); // true hah
  console.log(true + ' hah');  // true hah

```

>#####  2.Boolean.prototype.valueOf()返回一个Boolean对象的原始值。

###### Boolean的valueOf方法返回一个Boolean对象或Boolean字面量的原始值作为布尔数据类型。

```javascript

  let x = new Boolean();
  let flag = x.valueOf();

  if(x) {
    console.log('I am x');
  }

  if(flag) {
    console.log('I am flag');
  }

  // 上面代码在控制台只输出：I am x

```

> 参考文档：[https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Boolean](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Boolean)











