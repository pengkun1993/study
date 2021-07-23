# 全面认识JavaScript的JSON对象

JSON对象包含两个方法，用于解析`JavaScript Object Notation`(JSON)的`parse()`方法以及将对象/值转换为JSON字符串的`stringify()`方法。除了这两个方法，JSON这个对象本身没有其他作用，也不能被调用或者作为构造函数调用。

##### JSON是一种语法，用来序列化对象、数组、数字、字符串、布尔值和null。它基于JavaScript语法，但与之不同：**JavaScript不是JSON，JSON也不是JavaScript**

##### JavaScript与JSON的区别：

|JavaScript类型|JSON的不同点|
|:-|:-|
|对象和数组|属性名称必须是双引号括起来的字符串；最后一个属性后不能有逗号|
|数值|禁止出现前导零*(JSON.stringify方法自动忽略前导零，而在JSON.parse方法中会抛出SyntaxError)*;如果有小数点，则后面最少跟着一位数字|
|字符串|只有有限的一些字符可能会被转移；禁止某些控制字符串；Unicode行分隔符(U+2028)和段分隔符(U+2029)被允许；字符串必须用双引号括起来。|

JSON只支持这些空白字符： 制表符(U+0009)，回车(U+000D)，换行(U+000A)以及空格(U+0020)
