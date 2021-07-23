# 全面认识JavaScript的Math对象

Math是一个内置对象，它具有数学常数和函数的属性和方法。不是一个函数对象。

与其他全局对象不同的是，Math不是一个构造器。Math的所有属性和方法都是静态的。JavaScript中的常数, 是以全精度的实数定义的。

### 常数

这里的常数都是Math对象的静态属性，所以应该使用`Math.属性名`的方式调用，而不是作为创建的Math实例对象的属性来使用，Math不是构造函数。

>#### 1.Math.E 属性表示自然对数的底数（或者成为基数）

![Math.E](https://upload-images.jianshu.io/upload_images/10187278-2fbcb4c9b19a405e.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 2.Math.LN2 属性表示2的自然对数，约为0.693：

![Math.LN2](https://upload-images.jianshu.io/upload_images/10187278-f247fac73947e48c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 3.Math.LN10 属性表示10的自然对数，约为2.302：

![Math.LN10](https://upload-images.jianshu.io/upload_images/10187278-0338621fa4cb5cce.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 4.Math.LOG2E 属性表示以2为底数，e的对数，约为1.442

![Math.LOG2E](https://upload-images.jianshu.io/upload_images/10187278-5e398e901e1afc20.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 5.Math.LOG10E 属性表示以10为底数，e的对数，约为0.434：

![Math.LOG10E](https://upload-images.jianshu.io/upload_images/10187278-f371c5c8e5d0abab.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 6.Math.PI 属性表示一个圆的周长与直径的比例，约为2.14159：

![Math.PI](https://upload-images.jianshu.io/upload_images/10187278-12f7fdab1eb0cf01.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 7.Math.SQRT1_2 属性表示1/2的平方根，约为0.707：

![Math.SQRT1_2](https://upload-images.jianshu.io/upload_images/10187278-51eeafbb4da93290.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### 8.Math.SQRT2 属性表示2的平方根，约为1.414

##### 它们的属性特性：

|属性的属性特性|值|
|:-:|:-:|
|writable|false|
|enumerable|false|
|configurable|false|

##### 实例

```javascript

  console.log(Math.E); // 2.718281828459045
  console.log(Math.LN2); // 0.6931471805599453
  console.log(Math.LN10); // 2.302585092994046
  console.log(Math.LOG2E); // 1.4426950408889634
  console.log(Math.LOG10E); // 0.4342944819032518
  console.log(Math.PI); // 3.141592653589793
  console.log(Math.SQRT1_2); // 0.7071067811865476
  console.log(Math.SQRT2); // 1.4142135623730951

```

### 方法

Math这些方法和属性类似，他们是静态方法，调用方式：`Math.方法名`。

需要注意的是很多数学函数都有一个精度，并且精度在不同环境下也是不同的。这就意味着不同的浏览器会给出不同的结果，设置相同的js引擎在不同的OS或者架构下也会给出不同的结果。

个人将Math的这些方法进行整理分类为以下几类，方便记忆和对比：

#### 第一类，舍入运算：`abs/round/floor/ceil/trunc`

>#### Math.abs(x) 函数返回指定数字x的绝对值

![Math.abs](https://upload-images.jianshu.io/upload_images/10187278-d83075ef3ccc0283.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 语法：`Math.abs(x);`

##### 示例：

```javascript

  console.log(Math.abs('-1')); // 1
  console.log(Math.abs(-2)); // 2
  console.log(Math.abs(Infinity)); // Infinity
  console.log(Math.abs(-Infinity)); // Infinity
  console.log(Math.abs(null)); // 0
  console.log(Math.abs('string')); // NaN
  console.log(Math.abs()); // NaN

```

>#### Math.round() 函数返回一个数字四舍五入后最接近的整数。

##### 语法：

```javascript

  Math.round(x);

  // 返回值：给定数字的值四舍五入到最接近的整数

```

如果参数的小数部分大于0.5，则舍入到相邻的绝对值更大的整数。如果参数的小数部分小于0.5，则舍入到相邻的绝对值更小的整数。如果参数的小数部分恰好等于0.5，则舍入到相邻的在正无穷（+∞）方向上的整数。*与很多其他语言汇总的round() 函数不同，Math.round()并不总是舍入到远离0的方向（尤其是在负数的小数部分恰好等于0.5的情况下）。*

##### 示例：

```javascript

  console.log(Math.round(2.4)); // 2
  console.log(Math.round(2.5)); // 3  2.5靠近正无穷的方向是3
  console.log(Math.round(2.6)); // 3
  console.log(Math.round(-2.4)); // -2
  console.log(Math.round(-2.5)); // -2  -2.5靠近正无穷的方向是-2
  console.log(Math.round(-2.6)); // -3
  console.log(Math.round('-1.3')); // -1
  console.log(Math.round(Infinity)); // Infinity
  console.log(Math.round(-Infinity)); // -Infinity
  console.log(Math.round(null)); // 0
  console.log(Math.round('string')); // NaN
  console.log(Math.round()); // NaN

```

###### 个人理解：可以看到round方法也会先对参数进行Number()转换，然后再取舍。

>#### Math.floor() 返回小于或等于一个给定数字的最大整数。

##### 语法：

```javascript

  Math.floor(x);

  // 返回值：一个表示小于或等于指定数字的最大整数的数字

```

##### 示例：

```javascript

  console.log(Math.floor(2.4)); // 2
  console.log(Math.floor(2.5)); // 2
  console.log(Math.floor(2.6)); // 2
  console.log(Math.floor(-2.4)); // -3
  console.log(Math.floor(-2.5)); // -3
  console.log(Math.floor(-2.6)); // -3
  console.log(Math.floor('-1.3')); // -2 向下取整是-2，因为-2小于-1
  console.log(Math.floor(Infinity)); // Infinity
  console.log(Math.floor(-Infinity)); // -Infinity
  console.log(Math.floor(null)); // 0
  console.log(Math.floor('string')); // NaN
  console.log(Math.floor()); // NaN

```

>#### Math.ceil() 函数返回大于或等于一个给定数字的最小整数。

##### 语法：

```javascript

  Math.ceil(x);

  // 返回值：大于或等于给定数字的最小整数

```

##### 示例：

```javascript

  console.log(Math.ceil(2.4)); // 3
  console.log(Math.ceil(2.5)); // 3
  console.log(Math.ceil(2.6)); // 3
  console.log(Math.ceil(-2.4)); // -2
  console.log(Math.ceil(-2.5)); // -2
  console.log(Math.ceil(-2.6)); // -2
  console.log(Math.ceil('-1.3')); // -1 -1是比-1.3更大的整数
  console.log(Math.ceil(null)); // 0
  console.log(Math.ceil('string')); // NaN
  console.log(Math.ceil()); // NaN

```

>#### Math.trunc() 方法将数字的小数部分去掉，只保留整数部分。

##### 语法：

```javascript

  Math.trunc(value);

  // 返回值：给定数字的整数部分

```

不像Math的其他三个取舍方法，Math.trunc()的执行逻辑很简单，仅仅是删除掉数字的小数部分和小数点，不管参数是整数还是负数。

##### 示例：

```javascript

  console.log(Math.trunc(2.4)); // 2
  console.log(Math.trunc(2.5)); // 2
  console.log(Math.trunc(2.6)); // 2
  console.log(Math.trunc(-2.4)); // -2
  console.log(Math.trunc(-2.5)); // -2
  console.log(Math.trunc(-2.6)); // -2
  console.log(Math.trunc('-1.3')); // -1
  console.log(Math.trunc(null)); // 0
  console.log(Math.trunc('string')); // NaN
  console.log(Math.trunc()); // NaN

```

##### Polyfill

```javascript
  // 注意0.2，-0.2，0这些情况
  if (!Math.trunc) {
    Math.trunc = function(v) {
      v = +v;
      if (!isFinite(v)) return v;

      return (v - v % 1) || (v < 0 ? -0 : v === 0 ? v : 0);
    }
  }

```

---

### 第二类，指数对数运算：`pow/sqrt/cbrt/exp/expm1/log/log1p/log10/1og2`

>#### Math.pow() 函数返回基数的指数次幂。

##### 语法：

```javascript

  Math.pow(base, exponent); 

  // 返回值：base^exponent

```

##### 示例：

```javascript

  console.log(Math.pow(2, -2)); // 0.25
  console.log(Math.pow('2','2')); // 4
  console.log(Math.pow('2','2.2')); // 4.59479341998814
  console.log(Math.pow(2, null)); // 1 类似2^0
  console.log(Math.pow(2, Infinity)); // Infinity
  console.log(Math.pow(2, -Infinity)); // 0
  console.log(Math.pow(2, 'string')); // NaN
  console.log(Math.pow(2)); // NaN
  console.log(Math.pow()); // NaN

```

>####  Math.sqrt() 函数返回一个数的平方根

##### 语法：`Math.sqrt(x);`，如果参数是负数，则返回NaN

##### 示例：

```javascript

  console.log(Math.sqrt(4)); // 2
  console.log(Math.sqrt(-4)); // NaN
  console.log(Math.sqrt(4.9)); // 2.2135943621178655
  console.log(Math.sqrt('0.49')); // 0.7
  console.log(Math.sqrt(Infinity)); // Infinity
  console.log(Math.sqrt(-Infinity)); // NaN
  console.log(Math.sqrt(null)); // 0
  console.log(Math.sqrt('string')); // NaN
  console.log(Math.sqrt()); // NaN

```

>#### Math.cbrt() 函数返回任意数字的立方根。

##### 语法：`Math.cbrt(x);`

##### 示例：

```javascript

  console.log(Math.cbrt(8)); // 2
  console.log(Math.cbrt(-8)); // -2
  console.log(Math.cbrt(0.027)); // 0.3
  console.log(Math.cbrt('0.027')); // 0.3
  console.log(Math.cbrt(null)); // 0
  console.log(Math.cbrt(Infinity)); // Infinity
  console.log(Math.cbrt(-Infinity)); // -Infinity
  console.log(Math.cbrt('string')); // NaN
  console.log(Math.cbrt()); // NaN

```

##### Polyfill

```javascript

  if(!Math.cbrt) {
    Math.cbrt = function(x) {
      let y = Math.pow(Math.abs(x), 1/3);
      return x < 0 ? -y : y;
    }
  }

```

>#### Math.exp() 函数返回e<sup>x</sup>，x表示参数，e是欧拉常数(Math.E)，自然对数的底数。

##### 语法：`Math.exp(x);`

##### 示例：

```javascript

  console.log(Math.exp(2)); // 7.38905609893065
  console.log(Math.exp('2')); // 7.38905609893065
  console.log(Math.exp(-2)); // 0.1353352832366127
  console.log(Math.exp(null)); // 1
  console.log(Math.exp(-Infinity)); // 0
  console.log(Math.exp(Infinity)); // Infinity
  console.log(Math.exp('string')); // NaN
  console.log(Math.exp()); // NaN

```

>#### Math.expm1()返回e<sup>x<sup>-1。

##### 语法：`Math.expm1(x)`，等价于`Math.exp(x) - 1`，故参照上面即可。

>#### Math.log() 函数返回一个数的自然对数

###### 注意这里是返回一个自然对数，即底数是e不是10，也就是手写的ln方法

##### 语法：`Math.log(x);`，如果参数为负数，则返回NaN。

##### 示例：

```javascript

  console.log(Math.log(Math.E)); // 1
  console.log(Math.log(10)); // 2.302585092994046
  console.log(Math.log(1)); // 0 任何数的0次方等于1
  console.log(Math.log(-1)); // NaN
  console.log(Math.log(0)); // -Infinity  e^-Infintiy = 0
  console.log(Math.log(null)); // -Infinity
  console.log(Math.log(-Infinity)); // NaN
  console.log(Math.log(Infinity)); // Infinity e^Infinity = Infinity
  console.log(Math.log('string')); // NaN
  console.log(Math.log()); // NaN

```

##### 根据同底数相除的规则，可以求x为底y的对数，即log<sub>x</sub><sup>y</sup>

```javascript

  function getBaseLog(x, y) {
    return Math.log(y) / Math.log(x);
  }

  console.log(getBaseLog(3, 9)); // 2.0000000000000004
  console.log(getBaseLog(10, 1000)); // 2.9999999999999996

  // 非常接近正确答案，但是由于浮点数精度问题，会显示成上面的样子

```

>#### Math.log1p() 函数返回一个数字加1后的自然对数，即`log(x+1)`

##### 语法：`Math.log1p(x);`，如果参数小于-1，则返回NaN

##### 函数 `y = log(x+1)` 的图像：

![y=log(x+1)](https://upload-images.jianshu.io/upload_images/10187278-ede16fd8946084a4.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 用法参照Math.log()

>#### Math.log10() 函数返回一个数字以10为底的对数。

##### 语法：`Math.log10(x)`，如果传入的参数小于0，则返回NaN。

##### 示例：

```javascript

  console.log(Math.log10(10)); // 1
  console.log(Math.log10('10')); // 1
  console.log(Math.log10(1)); // 0 任何数的0次方等于1
  console.log(Math.log10(-1)); // NaN
  console.log(Math.log10(0)); // -Infinity  10^-Infintiy = 0
  console.log(Math.log10(null)); // -Infinity
  console.log(Math.log10(-Infinity)); // NaN
  console.log(Math.log10(Infinity)); // Infinity 10^Infinity = Infinity
  console.log(Math.log10('string')); // NaN
  console.log(Math.log10()); // NaN

```

>#### Math.log2() 函数返回一个数字以2位底的对数。

使用方法参照Math.log10()

---

### 第三类，n个数运算：`max/min/hypot`

>#### Math.max() 函数返回一个数组中的最大值。


##### 语法：

```javascript

  Math.max(value1[,vlaue2[,vlaue3...]]);

  // 参数： value1,vlaue2,... 一组数值
  
  // 返回给定的一组数字中的最大值。
  // 如果没有参数，则返回结果为 -Infinity

```


##### 示例：

```javascript

  console.log(Math.max(0,'2')); // 2
  console.log(Math.max(-1,'')); // 0
  console.log(Math.max(-1,null)); // 0
  console.log(Math.max(-1,'string')); // NaN
  console.log(Math.max()); // -Infinity

```

##### 求数组中的最大值：

```javascript

  // 第一种，利用apply
  function getMaxOfArray(numArray) {
    return Math.max.apply(null, numArray);
  }
  // 第二种，利用扩展运算符
  let max = Math.max(...arr);

```

>#### Math.min() 返回零个或更多个数值的最小值。

##### 语法：

```javascript

  Math.min([value[,value2,...]]);

  // 返回值：给定数值中最小的数。
  // 如果没有参数，结果为Infinity

```

##### 示例：

```javascript
  
  console.log(Math.min(3,'2',4)); // 2
  console.log(Math.min(1,'')); // 0
  console.log(Math.min(1,null)); // 0
  console.log(Math.min(1,'string')); // NaN
  console.log(Math.min()); // Infinity

```

##### 使用min裁剪值

```javascript

  // Math.min经常用于裁剪一个值，以便使其总是小于或等于某个边界值。例如：
  let x = f(foo);
  function f() {
    if(x > boundary) {
      x = boundary;
    }
  } 
  // 可以简便写为：
  let x = Math.min(f(foo), boundary);
  // Math.max()也可以被用来以相似的方式裁剪一个值

```

>#### Math.hypot()函数返回它的所有参数的平方和的平方根

##### 语法：

```javascript

  Math.hypot([vlaue1[,value2[,value3...]]]);

  // 如果不传入任何参数，则返回 +0
  // 如果只传入一个参数，则Math.hypot(x)的效果等同于Math.abs(x);

```

##### 示例：

```javascript

  console.log(Math.hypot(3, '2', 4)); // 5.385164807134504
  console.log(Math.hypot(1, '')); // 1
  console.log(Math.hypot(1, null)); // 1
  console.log(Math.hypot(1, Infinity)); // Infinity
  console.log(Math.hypot(1, -Infinity)); // Infinity
  console.log(Math.hypot(1, 'string')); // NaN
  console.log(Math.hypot()); // 0

```

##### Polyfill

```javascript

  if (!Math.hypot) {
    Math.hypot = function hypot() {
      let y = 0;
      let length = arguments.length;

      for ( let i = 0; i<length; i++ ) {
        // 存在无穷的情况
        if (arguments[i] === Infinity || arguments[i] === -Infinity) {
          return Infinity;
        }
        y += (arguments[i] * arguments[i]);
      }
      return Math.sqrt(y);
    }
  }

```

###### 上面三个函数都会对参数进行Number()转换，一旦有一个参数为NaN，则结果必定返回NaN。

### 第四类，三角函数运算：`tan/atan`

>#### Math.tan() 方法返回一个数值的正切值。

###### 个人提示：π弧度 == 180角度  1角度 = (π/180)弧度 1弧度 = (180/π)角度

##### 语法：

```javascript

  Math.tan(x);

  // 参数：x 一个数值，表示一个角（单位：弧度）
  
  // tan方法返回一个数值，表示一个角的正切值

```

##### 示例：

```javascript

  console.log(Math.tan(45)); // 1.6197751905438615
  console.log(Math.tan(1)); // 1.5574077246549023
  console.log(Math.tan(0)); // 0
  console.log(Math.tan('')); // 0
  console.log(Math.tan(null)); // 0
  console.log(Math.tan(Infinity)); // NaN
  console.log(Math.tan(-Infinity)); // NaN
  console.log(Math.tan('String')); // NaN
  console.log(Math.tan()); // NaN

```

>#### Math.sin() 函数返回一个数值的正弦值。

##### 语法：

```javascript

  Math.sin(x);

  // 参数： 一个数值，表示一个角（单位：弧度）
  
  // sin方法返回一个 -1 到 1之间的数值，表示给定弧度的正弦值。

```

##### 示例：

```javascript

  console.log(Math.sin(45)); // 0.8509035245341184
  console.log(Math.sin(Math.PI/2)); // 1
  console.log(Math.sin(0)); // 0
  console.log(Math.sin('')); // 0
  console.log(Math.sin(null)); // 0
  console.log(Math.sin(Infinity)); // NaN
  console.log(Math.sin(-Infinity)); // NaN
  console.log(Math.sin('String')); // NaN
  console.log(Math.sin()); // NaN

```

>#### Math.cos() 函数返回一个数值的余弦值。

##### 语法：

```javascript

  Math.cos(x);

  // 参数：x一个以弧度为单位的数值
  
  // cos方法返回一个-1到1之间的数值，表示弧度的余弦值。

```

##### 示例：

```javascript

  console.log(Math.cos(45)); // 0.5253219888177297
  console.log(Math.cos(Math.PI)); // -1
  console.log(Math.cos(0)); // 1
  console.log(Math.cos('')); // 1
  console.log(Math.cos(null)); // 1
  console.log(Math.cos(Infinity)); // NaN
  console.log(Math.cos(-Infinity)); // NaN
  console.log(Math.cos('String')); // NaN
  console.log(Math.cos()); // NaN

```

##### 上面三个函数的参数都是弧度，可以写一个方法使用角度

```javascript

  /**
   * 根据角度计算三角函数值
   * @param  {Number} deg    角度
   * @param  {Number} method 方法类型，1：tan,2:sin,3:cos
   * @return {Number}        三角函数值
   */
  function getTrigonometricDeg(deg, method = 1) {
    let name = '';
    switch (method) {
      case 1: name = 'tan'; break;
      case 2: name = 'sin'; break;
      case 3: name = 'cos'; break;
      default: alert('参数传递错误');return;
    }

    let rad = deg * Math.PI/180;

    return Math[name](rad);
  }

  console.log(getTrigonometricDeg(30, 1)); // 0.5773502691896257
  console.log(1/Math.sqrt(3)); // 0.5773502691896258
  console.log(getTrigonometricDeg(30, 2)); // 0.49999999999999994
  console.log(1/2); // 0.5
  console.log(getTrigonometricDeg(30, 3)); // 0.8660254037844387
  console.log(Math.sqrt(3)/2); // 0.8660254037844386

  // 由于浮点数精度问题，会显示成上面的样子

```

>#### Math.atan() 返回一个数值的反正切（以弧度为单位）

![Math.atan](https://upload-images.jianshu.io/upload_images/10187278-69e2c77f6614ba83.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 语法：

```javascript

  Math.atan(x);

  // 参数：x 一个数值
  
  // 返回一个 -π/2到π/2弧度之间的数值。

```

##### 示例：

```javascript

  console.log(Math.atan(1)); // 0.7853981633974483
  console.log(Math.atan(-1)); // -0.7853981633974483
  console.log(Math.PI*(45/180)); //0.7853981633974483
  console.log(Math.atan(0)); // 0
  console.log(Math.atan(Infinity)); // 1.5707963267948966
  console.log(Math.PI/2); // 1.5707963267948966

```

>#### Math.atan2() 返回其参数比值的反正切值。

##### 语法：

```javascript

  Math.atan2(y,x);

  // 参数表示(x,y)对应的偏移角度。这是一个逆时针角度，以弧度为单位，正x轴和点(x,y)与原点连线之间。注：先传递y坐标，然后是x坐标
  
  // 返回一个-π到π之间的数值。

```

###### atan2接受单独的x和y参数，而atan接受两个参数的比值。

##### 示例：

```javascript

  Math.atan2(90, 15); // 1.4056476493802699
  Math.atan2(15, 90); // 0.16514867741462683

  Math.atan2( ±0, -0 );               // ±PI.
  Math.atan2( ±0, +0 );               // ±0.
  Math.atan2( ±0, -x );               // ±PI for x > 0.
  Math.atan2( ±0, x );                // ±0 for x > 0.
  Math.atan2( -y, ±0 );               // -PI/2 for y > 0.
  Math.atan2( y, ±0 );                // PI/2 for y > 0.
  Math.atan2( ±y, -Infinity );        // ±PI for finite y > 0.
  Math.atan2( ±y, +Infinity );        // ±0 for finite y > 0.
  Math.atan2( ±Infinity, x );         // ±PI/2 for finite x.
  Math.atan2( ±Infinity, -Infinity ); // ±3*PI/4.
  Math.atan2( ±Infinity, +Infinity ); // ±PI/4.

```

>#### Math.asin() 返回一个数值的反正弦（单位为弧度）

![Math.asin](https://upload-images.jianshu.io/upload_images/10187278-920037b0f3c805fb.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 语法：

```javascript

  Math.asin(x);

  // 参数： x 一个数值，-1到1之间的数值作为参数
  
  // 返回一个介于 -π/2到π/2弧度的数值
  // 如果接受的参数超出范，返回NaN

```

##### 示例：

```javascript

  console.log(Math.asin(1)); // 1.5707963267948966
  console.log(Math.asin(-1)); // -1.5707963267948966
  console.log(Math.PI/2); // 1.5707963267948966
  console.log(Math.asin(0)); // 0
  console.log(Math.asin(Infinity)); // NaN
  console.log(Math.asin(-Infinity)); // NaN

```

>#### Math.acos() 返回一个数的反余弦值（单位为弧度）

![Math.acos](https://upload-images.jianshu.io/upload_images/10187278-9cbebde0fa4af401.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 语法：

```javascript

  Math.acos(x);

  // 参数： x 一个数值，-1到1之间的数值作为参数。
  
  // 返回一个0到π的数值。
  // 如果传入的参数值超出了限定的范围，将返回NaN。

```

##### 示例：

```javascript

  console.log(Math.acos(1)); // 0
  console.log(Math.acos(-1)); // 3.141592653589793
  console.log(Math.acos(0)); // 1.5707963267948966
  console.log(Math.acos(Infinity)); // NaN
  console.log(Math.acos(-Infinity)); // NaN

```

>#### Math.tanh() 返回一个数的双曲正切函数值

![Math.tanh](https://upload-images.jianshu.io/upload_images/10187278-806fbc4ca5fe2fcf.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 语法：`Math.tanh(x);`，返回所给数字的双曲正切值。

>#### Math.sinh() 返回给定数字的双曲正弦值

##### 双曲正弦的图像：

![Math.sinh](https://upload-images.jianshu.io/upload_images/10187278-a04c3471e862aad1.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### Math.cosh() 返回数值的双曲余弦函数

![Math.cosh](https://upload-images.jianshu.io/upload_images/10187278-51a993c7af42551b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### Math.atanh() 返回一个数值反双曲正切值

![Math.atanh](https://upload-images.jianshu.io/upload_images/10187278-7899d7e3001af8d3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

对于大于1或是小于－1的值，函数返回 NaN 。

>#### Math.asinh() 函数返回给定数字的反双曲正弦值

![Math.asinh](https://upload-images.jianshu.io/upload_images/10187278-09dbbd42dd66c25a.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

>#### Math.acosh() 返回一个数值的反双曲余弦值

![Math.acosh](https://upload-images.jianshu.io/upload_images/10187278-6df6233370037d83.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

如果指定的参数小于 1 则返回NaN

---

### 第四类，32位数运算：`clz32/fround/imul`

这块理解不通，浏览器实现也比较欠缺，可参考:[https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Math/clz32](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Math/clz32)

---

### 第三类，其他：`sign/random`

>#### Math.sign() 函数返回一个数字的符号，指示数字是正数，负数还是零。

##### 语法：

```javascript

  Math.sign(x);

  // 参数：x，任意数字
  // 传入该函数的参数会被隐式转换成数字类型

  // 此函数共有5种返回值：分别是1,-1,0,-0,NaN.代表的是正数，负数，正零，负零，NaN

```

##### 示例：

```javascript

  console.log(Math.sign(3)); // 1
  console.log(Math.sign(-3)); // -1
  console.log(Math.sign('-3')); // -1
  console.log(Math.sign(0)); // 0
  console.log(Math.sign(-0)); // -0
  console.log(Math.sign(NaN)); // NaN
  console.log(Math.sign('foo')); // NaN
  console.log(Math.sign('')); // 0
  console.log(Math.sign(Infinity)); // 1
  console.log(Math.sign(-Infinity)); // -1
  console.log(Math.sign()); //NaN

```

##### Polyfill

```javascript

  if (!Math.sign) {
    x = +x;
    if(x === 0 || isNaN(x)) {
      return Number(x);
    }
    return x > 0 ? 1 : -1;
  }

```

>#### Math.random() 返回一个浮点伪随机数在范围[0,1)


###### Math的方法都会先将参数进行Number()转换，然后再进项相应的运算。（可以参照Number对象介绍中全局isNaN方法与Number.isNaN方法的区别）。如果转换失败就会返回NaN。

> 参考文档：[https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Math](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Math)






