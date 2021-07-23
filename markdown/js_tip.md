# JS常用技巧留存

> 参考文档：[一个合格的中级前端工程师需要掌握的 28 个 JavaScript 技巧](https://juejin.im/post/5cef46226fb9a07eaf2b7516)

### 判断数据类型

```javascript

  const isType = type => target => `[object ${type}]` === Object.prototype.toString.call(target);
  const isArray = isType('Array');
  console.log(isArray([])); // true

  // 上方的判断方法使用连续的箭头函数，封装了两层方法，其实精髓是后面的Object.prototype.toString，因为toString方法被很多类型对象重写所以使用call，保证调用的是Object的toString方法
   
  console.log(Object.prototype.toString.call([])); // [object Array]
  console.log(Object.prototype.toString.call(123)); // [object Number]
  console.log(Object.prototype.toString.call('123')); // [object String]
  console.log(Object.prototype.toString.call(true)); // [object Boolean]
  console.log(Object.prototype.toString.call(null)); // [object Null]
  console.log(Object.prototype.toString.call(undefined)); // [object Undefined]
  console.log(Object.prototype.toString.call(new Date())); // [object Date]
  console.log(Object.prototype.toString.call(Math)); // [object Math]
  let obj = { a: 1, b: 2 };
  console.log(Object.prototype.toString.call(obj)); // [object Object]

```

### 实现数组map方法

```javascript
  /**
   * 自定义map方法
   * @param  {Function} fn      对数组每个值执行的方法
   * @param  {Object}   context 改变上面方法fn的this指向，如果调用时fn是箭头函数，则该参数无作用
   * @return {Array}           执行完方法fn后的数组
   */
  const selfMap = function(fn, context) {
    // this [1,2,3] 谁调用指向谁
    let arr = Array.prototype.slice.call(this); // [1,2,3]
    let mappedArr = Array();
    for (let i = 0; i < arr.length; i++) {
      if (!arr.hasOwnProperty(i)) continue;
      mappedArr[i] = fn.call(context, arr[i], i, this);
    }
    return mappedArr;
  }

  Array.prototype.selfMap = selfMap

  console.log([1,2,3].selfMap(number => number * 2)); // [2,4,6]

```


