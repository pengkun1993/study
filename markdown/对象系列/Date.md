# 全面认识JavaScript的Date对象

Date对象基于Unix Time Stamp，即自1970年1月1日（UTC）起经过的毫秒数。

JavaScript的时间由时间标准时间（UTC）1970年1月1日开始，用毫秒计时，一天由86400000毫秒组成。Date对象的范围是-100000000天至100000000天（等效的毫秒值）

Date对象为跨平台提供了统一的行为。时间属性可以在不同的系统中表示相同的时刻，而如果使用了本地时间对象，则反映当地的时间。

在JavaScript中只能将Date作为构造函数调用，才能实例化Date对象，若将它作为常规函数调用（即不加new操作符），则将会返回一个字符串，而非Date对象。

Date不像其他JavaScript对象类型，Date对象没有字面量语法。（字面量语法示例：let obj = {}）

##### 语法：

```javascript

  new Data();
  new Data(value);
  new Data(dateString);
  new Data(year, monthIndex[, day[, hours [, minutes[, seconds[, milliseconds]]]]]);

```

##### 参数：

- value： 一个Unix时间戳，它是一个整数值，表示自1970年1月1日00:00:00UTC以来的毫秒数，忽略了闰秒。（注：大多数Unix时间戳功能仅精确到最接近的秒）
- dateString： 表示日期的字符串值。该字符串应该能被Date.parse()正确方法识别。
- year： 表示年份的整数值。0到99对应1900到1999。
- monthIndex： 表月分的整数值，从0（1月）到11（12月）。
- day：可选，表示一个月中的第几天的整数值，从1开始。
- hours：可选，表示一天中的小时数的整数值（24小时制）。
- minutes：可选，表示一个完整时间（如01：10：00）中的分钟部分的整数值10
- seconds：可选，表示一个完整时间（如01：10：00）中的秒部分的整数值00
- milliseonds: 可选，表示一个完成时间的毫秒部分的整数值。

##### 返回值，Date实例对象：

- 如果没有输入任何参数，则Date的构造器会依据系统设置的当前时间来创建Date对象。
- 如果提供了至少两个参数，其余的参数均默认设置为1（如果没有指定day参数）或者0（如果没有指定day以外的参数）。

###### 注意：当Date作为构造函数调用并传入多个参数时，如果数值大于合理范围时（如月份为13或者分钟数为70），相邻的数值会被调整。比如new Date(2013,13,1)等于new Date(2014,1,1)，它们都表示日期2014-02-01。

###### 当Date作为构造函数调用并传入多个参数时，所定义参数代表的是当地时间。如果需要使用世界协调时UTC，使用new Date(Data.UTC(...))和相同参数。

### 属性

>#### Date.prototype 表示Date构造函数的原型。

|属性特性|值|
|:-:|:-:|
|writable|false|
|enumerable|false|
|configurable|false|

Date.prototype本身就是一个普通的对象，不是Date的实例。

Date实例继承自Date.prototype。可以通过修改构造函数的原型对象来影响Date实例继承的属性和方法。

>#### Date.length 值为7。这是该构造函数可接受的参数个数。

---

### 方法

>#### Date.now()方法返回自1970年1月1日00:00:00 UTC到当前时间的毫秒数，类型为Number。

##### 语法：`let timeInMs = Date.now();`

>#### Date.parse()方法解析一个表示某个日期的字符串，并返回从1970-1-1 0:0:0 UTC到该日期对象（该日期对象的UTC时间）的毫秒数，如果该字符串无法识别，或者一些情况下，包含了不合法的日期数值（如：2015-02-21），则返回值为NaN。

##### 不推荐在ES5之前使用Date.parse方法，因为字符串的解析完全取决于实现。直到至今，不同宿主在如何解析日期字符串上仍存在许多差异，因此最好还是手动解析日期字符串。

##### 语法：

```javascript
  
  Date.parse(dateString);
  // 隐式调用
  new Date(dateString).getTime();

  // 参数
  dateString // 一个符合RFC2822或ISO 8601日期格式的字符串（其他格式也许支持，但结果可能与预期不符）

  // 返回值
  // 一个表示从1970-1-1 00:00:00 UTC到给定日期字符串所表示时间的毫秒数的数值。如果参数不能解析为一个有效的日期，则返回NaN
  
```

##### 该静态方法对参数格式要求苛刻，具体看[文档](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Date/parse)，尽量少使用。

>#### Date.UTC() 方法接受的参数同日期构造函数接受最多参数时一样，返回从1970-1-1 00:00:00 UTC到指定日期的毫秒数。

##### 语法：

```javascript

  Date.UTC(year,month[,date[,hrs[,min[,sec[,ms]]]]]);

  // 参数：
  year // 1900年后的某一个年份
  month // 0到11之间的一个整数，表示月份
  date // 1到31之间的一个整数，表示某月当中的第几天
  hrs // 0到23之间的一个整数，表示小时
  min // 0到59之间的一个整数，表示分钟
  sec // 0到59之间的一个整数，表示秒
  ms // 0到999之间的一个整数，表示毫秒

```

##### 如果有一个指定的参数超出其合理范围，则UTC方法会通过更新其他参数直到该参数在合理范围内。例如，为月份指定15，则年份会加1，然后月份将会使用3。

```javascript

  const utcDate = new Date(Date.UTC(96,11,1,0,0,0));
  console.log(utcDate); // Sun Dec 01 1996 08:00:00 GMT+0800 (中国标准时间)

  // 注意这里时间本事00:00:00，但是日期格式时间里面试 08:00:00，这是因为后面有个 +0800表示与0经度格林尼治时间的的便宜时差

```

---

### Date实例 

#### Getter方法

>#### getFullYear() 根据本地时间返回指定日期的年份。

##### 语法： `dateObj.getFullYear()`

##### 根据当地时间，返回一个对应于给定日期的年份数字。返回的是绝对值。对于1000到9999之间的日期，getFullYear()返回一个四位数字，例如1995。

##### 示例：

```javascript

  const utcDate = new Date(Date.UTC(96,11,1,0,0,0));
  console.log(utcDate.getFullYear()); // 1996
  const utcDate1 = new Date(Date.UTC(1800,11,1,0,0,0));
  console.log(utcDate1.getFullYear()); // 1800

```

>#### getMonth() 根据本地时间，返回一个指定的日期对象的月份，为基于0的值（0表示一年中的第一月）。

##### 语法： `dateObj.getMonth()`

##### 返回一个0到11的整数值： 0表示一月份，1表示二月份，2表示三月份，以此类推。

##### 示例

```javascript
  
  const utcDate = new Date(Date.UTC(96,11,1,0,0,0));
  console.log(utcDate.getMonth()); // 11
  const utcDate1 = new Date(Date.UTC(1800,5,1,0,0,0));
  console.log(utcDate1.getMonth()); // 5

```

>#### getDate() 根据本地时间，返回一个指定的日期对象为一个月中的哪一日（从1-31）。

##### 语法： `dateObj.getDate()`

##### 返回一个1到31的整数值。

##### 示例： 

```javascript
  
  const utcDate = new Date(Date.UTC(96,11,22,0,0,0));
  console.log(utcDate.getDate()); // 22
  const utcDate1 = new Date(Date.UTC(1800,5,18,0,0,0));
  console.log(utcDate1.getDate()); // 18

```

>#### getDay() 根据本地时间，返回一个具体日期中一周的第几天。

##### 语法：`dateObj.getDay()`

##### 返回一个0到6之间的整数值，0代表星期日，1代表星期一，2代表星期二，依次类推。

##### 示例：

```javascript

  const utcDate = new Date(Date.UTC(96,11,22,0,0,0));
  console.log(utcDate.getDay()); // 0 即: 周日
  const utcDate1 = new Date(Date.UTC(1800,5,18,0,0,0));
  console.log(utcDate1.getDay()); // 3 即: 周三

```

>#### getHours() 根据本地时间，返回一个指定的日期对象的小时（0-23）

>#### getMinutes() 根据本地时间，返回一个指定日期对象的分钟（0-59）

>#### getSeconds() 根据本地时间，返回一个指定日期对象的秒数（0-59）

>#### getMilliseconds() 根据本地时间，返回一个指定日期对象的毫秒（0-999）

>#### getUTCFullYear() 根据世界时返回特定日期对象所在的年份（4位数）

>#### getUTCMonth() 根据世界时返回特定日期对象的月份（0-11）

>#### getUTCDate() 根据世界时返回特定日期对象一个月的第几天（1-31）

>#### getUTCDay() 根据世界时返回特定日期对象一个星期的第几天（0-6）

>#### getUTCHours() 根据本地时间，返回一个指定的日期对象的小时（0-23）

>#### getUTCMinutes() 根据本地时间，返回一个指定日期对象的分钟（0-59）

>#### getUTCSeconds() 根据本地时间，返回一个指定日期对象的秒数（0-59）

>#### getUTCMilliseconds() 根据本地时间，返回一个指定日期对象的毫秒（0-999）

---

>#### getTime() 方法返回一个时间的格林威治时间数值。

##### 语法：`dateObj.getTime()`

##### 返回一个数值，表示从1970年1月1日0时0分0秒（UTC，即协调世界时）距离该日期对象所代表时间的毫秒数。

##### 示例： 

```javascript

  const utcDate = new Date(Date.UTC(96,11,22,0,0,0));
  console.log(utcDate.getTime()); // 851212800000
  const utcDate1 = new Date(Date.UTC(1800,5,18,0,0,0));
  console.log(utcDate1.getTime()); // -5350147200000

```

>#### getTimezoneOffset()返回协调世界时(UTC)相对于当前时区的时间差值，单位为分钟。

##### 语法：`dateObj.getTimezoneOffset()`

##### 时区差值表示协调世界时(UTC)与本地时区之间的差值，单位为分钟。需要注意的是如果本地时间晚于协调世界时，则该差值为正直，如果早于协调时则为负值。对于同一个时区，夏令时（Daylight Saving Time）将会改变这个值。

##### 示例：

```javascript

  const utcDate = new Date(Date.UTC(96,11,22,0,0,0));
  console.log(utcDate.getTimezoneOffset()); // -480
  const utcDate1 = new Date(Date.UTC(1800,5,18,0,0,0));
  console.log(utcDate1.getTimezoneOffset()); // -485

```

#### Setter方法

>#### setFullYear() 根据本地时间为一个日期对象设置年份

##### 语法：

```javascript

  dateObj.setFullYear(yearValue[, monthValue[, dayValue]]);

  // 参数
  yearValue // 指定年份的整数值，例如1995
  monthValue // 一个从0到11之间的整数值，表示一月到十二月
  dayValue // 一个1到31之间的整数值，表示月份中的第几天

  // 如果没有指定monthValue和dayValue参数，将会使用getMonth和getDate方法返回的值（即不改变原对象）。
  // 如果有一个参数超出了合理的范围，setFullYear方法会更新其他参数值，日期对象的日期值也会被相应更新。例如，为monthValue指定15，则年份会加1，月份值会为3。

```

##### 示例：

```javascript

  const dateObj = new Date();
  console.log(dateObj); // Wed Sep 18 2019 10:32:09 GMT+0800 (中国标准时间)
  dateObj.setFullYear(1993);
  console.log(dateObj); // Sat Sep 18 1993 10:32:29 GMT+0800 (中国标准时间)

  dateObj.setFullYear(1993, 20);
  console.log(dateObj); // Sun Sep 18 1994 10:34:10 GMT+0800 (中国标准时间)

```

>#### setMonth() 根据本地时间为一个设置年份的日期对象设置月份

##### 语法： `dateObj.setMonth(monthValue[, dayValue])`

>#### setDate() 根据您本地时间来指定一个日期对象的天数

##### 语法： `dateObj.setDate(dayValue)`

###### 如果dayValue指定0，那么日期就会被设置为上个月的最后一天。如果dayValue被设置为负数，日期会被设置为上个月最后一天往前数这个负数绝对值天数后的日期。

>#### setHours() 根据您本地时间为一个日期对象设置小时数

##### 语法：

```javascript

  dateObj.setHours(hoursValue[, minutesValue[, secondsValue[, msValue]]]);

  // 参数
  hoursValue // 一个0到23的整数，表示小时。
  minutesValue // 一个0到59的整数，表示分钟。
  secondsValue // 一个0到59的整数，表示秒数。
  msValue // 一个0到999的数字，表示微妙数。

```

###### 如果有一个参数超出了合理范围，setHours 会相应地更新日期对象中的日期信息。例如，如果为 secondsValue 指定了 100，则分钟会加 1，然后秒数使用 40。

>#### setMinutes() 根据本地时间为一个日期对象设置分钟数。

##### 语法： `dateObj.setMinutes(minutesValue[, secondValue[, msValue]])`

>#### setSeconds() 根据本地时间设置一个日期对象的秒数。

##### 语法： `dateObj.setSeconds(secondsValue[, msValue])`

>#### setMilliseconds() 根据您本地时间设置一个日期对象的毫秒数。

##### 语法： `dateObj.setMilliseconds(millisecondsValue)`

>#### setUTCFullYear() 根据世界时设置Date对象中的年份（四位数字）

>#### setUTCMonth() 根据世界时设置Date对象中的月份（0~11）

>#### setUTCDate() 根据世界时设置Date对象中的月份的一天（1~31）

>#### setUTCHours() 根据世界时设置Date对象中的小时（0~23）

>#### setUTCMinutes() 根据世界时设置Date对象中的分钟（0~59）

>#### setUTCSeconds() 根据世界时设置Date对象中的秒钟（0~59）

>#### setUTCMilliseconds() 根据世界时设置Date对象的毫秒（0~999）

>#### setTime() 方法以一个表示从1970-1-1 00:00:00 UTC计时的毫秒数来为Date对象设置时间

##### 语法：

```javascript

  dateObj.setTime(timeValue);

  // 参数
  timeValue // 一个整数，表示从1970-1-1 00:00:00 UTC开始计时的毫秒数

  // 使用setTime方法用来把一个日期时间赋值给另一个Date对象

```

#### Conversion getter(转换方法)

>#### toString() 返回一个字符串，表示该Date对象，总是返回一个美式英语日期格式的字符串。

>#### toDateString() 以美式英语和人类易度的形式返回一个日期对象日期部分的字符串。

>#### toTimeString() 以人类易读形式返回一个日期对象时间部分的字符串，该字符串以美式英语格式化。

>#### toISOString() 返回一个ISO格式的字符串：YYYY-MM-DDTHH:mm:ss.sssZ。时区总是UTC(协调世界时)，加一个后缀“Z”标识。

>#### toUTCString() 把一个日期转换为一个字符串，使用UTC时区

##### 示例：

```javascript

  const dateObj = new Date(2019,8,18,7,17,30); 
  console.log(dateObj); // Wed Sep 18 2019 07:17:30 GMT+0800 (中国标准时间)

  console.log(dateObj.toString()); // Wed Sep 18 2019 07:17:30 GMT+0800 (中国标准时间)
  console.log(dateObj.toDateString()); // Wed Sep 18 2019
  console.log(dateObj.toTimeString()); // 07:17:30 GMT+0800 (中国标准时间)
  console.log(dateObj.toISOString()); // 2019-09-17T23:17:30.000Z
  console.log(dateObj.toUTCString()); // Tue, 17 Sep 2019 23:17:30 GMT

  // 注意： toISOString和toUTCString转换时都进行了时区还原，原本我们有8个时区的便宜
  
```

>#### toLocaleString() 方法返回该日期对象的字符串，该字符串格式因不同语言而不同。新增的参数locales和options使程序能够指定使用哪种语言格式化规则，允许定制该方法的表现。在旧版本浏览器中， locales 和 options 参数被忽略，使用的语言环境和返回的字符串格式是各自独立实现的。

##### 语法： `dateObj.toLocaleString([locales[, options]])`

##### 根据当地语言规定返回代表着时间的字符串

>#### toLocaleDateString() 返回该日期对象日期部分的字符串，该字符串格式与系统设置的地区关联。

>#### toLocaleTimeString() 返回一个表示该日期对象时间部分的字符串，该字符串格式与系统设置的地区关联。

##### 示例

```javascript

  const dateObj = new Date(Date.UTC(2012, 11, 20, 3, 0, 0));

  // 本地
  console.log(dateObj.toLocaleString()); // 2012/12/20 上午11:00:00
  // 美利坚英语
  console.log(dateObj.toLocaleString('en-US')); // 12/20/2012, 11:00:00 AM
  // 不列颠英语
  console.log(dateObj.toLocaleString('en-GB')); // 20/12/2012, 11:00:00
  // 韩语
  console.log(dateObj.toLocaleString('ko-KR')); // 2012. 12. 20. 오전 11:00:00
  // 阿拉伯数字
  console.log(dateObj.toLocaleString('ar-EG')); // ٢٠‏/١٢‏/٢٠١٢ ١١:٠٠:٠٠ ص
  // 日本
  console.log(dateObj.toLocaleString('ja-JP-u-ca-japanese')); // 24/12/20 11:00:00
  // 印尼语
  console.log(dateObj.toLocaleString(['ban', 'id'])); // 20/12/2012 11.00.00

```

>#### valueOf() 返回一个Date对象的原始值

##### 语法 `dateObj.valueOf()`

##### 返回以数值格式表示的一个Date对象的原始值。从1970年1月1日0时0分0秒（UTC，即协调世界时）到该日期对象所代表时间的毫秒数。

###### 该方法的功能和 Date.prototype.getTime() 方法一样。

>#### toJSON() 返回Date对象的字符串形式。

##### 语法：`dateObj.toJSON()`

###### Date示例引用一个具体的时间点。调用toJSON()返回一个JSON格式字符串，表示该日期对象的值。

#### 示例：

```javascript
  
  var date = new Date();
  console.log(date); //Thu Nov 09 2017 18:54:04 GMT+0800 (中国标准时间)

  var jsonDate = (date).toJSON();
  console.log(jsonDate); //"2017-11-09T10:51:11.395Z"

  var backToDate = new Date(jsonDate);
  console.log(backToDate); //Thu Nov 09 2017 18:54:04 GMT+0800 (中国标准时间)

```

> 参考文档：[DATE MDN](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Date)







