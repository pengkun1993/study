#vue生命周期

#### 每个Vue实例或组件从创建到显示再到废弃的过程就是vue的生命周期。很多时候我们希望能在这个过程中执行一些操作，于是就有了生命周期钩子。
#### 生命周期钩子函数允许我们在实例不同阶段执行各种操作，便于我们更好地控制和使用实例。

---
## 一、基本生命周期

### 首先看一个示例

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>vue生命周期学习</title>
        <script src="https://cdn.bootcss.com/vue/2.5.16/vue.js"></script>
    </head>
    <body>
        <div id="app">
            <h1>{{message}}，这是在outerHtml中</h1>
        </div>
    </body>
    <script>
        var app = new Vue({
            el: '#app',
            data: {
              message: 10
            },
            beforeCreate: function() {
                console.group('------beforeCreate创建前状态------');
                console.log("%c%s", "color:red" , "el     : " + this.$el); 
                console.log("%c%s", "color:red","data   : " + this.$data); 
                console.log("%c%s", "color:red","message: " + this.message) 
            },
            created: function() {
                console.group('------created创建完毕状态------');
                console.log("%c%s", "color:red","el     : " + this.$el); 
                console.log("%c%s", "color:red","data   : " + this.$data); 
                console.log("%c%s", "color:red","message: " + this.message); 
            },
            beforeMount: function() {
                console.group('------beforeMount挂载前状态------');
                console.log("%c%s", "color:red","el     : " + (this.$el)); 
                console.log(this.$el);
                console.log("%c%s", "color:red","data   : " + this.$data);
                console.log("%c%s", "color:red","message: " + this.message);
            },
            mounted: function() {
                console.group('------mounted 挂载结束状态------');
                console.log("%c%s", "color:red","el     : " + this.$el);
                console.log(this.$el);    
                console.log("%c%s", "color:red","data   : " + this.$data);
                console.log("%c%s", "color:red","message: " + this.message);
            },
            beforeUpdate: function () {
                console.group('beforeUpdate 更新前状态===============》');
                console.log("%c%s", "color:red","el     : " + this.$el);
                console.log(this.$el);   
                console.log("%c%s", "color:red","data   : " + this.$data); 
                console.log("%c%s", "color:red","message: " + this.message); 
            },
            updated: function () {
                console.group('updated 更新完成状态===============》');
                console.log("%c%s", "color:red","el     : " + this.$el);
                console.log(this.$el); 
                console.log("%c%s", "color:red","data   : " + this.$data); 
                console.log("%c%s", "color:red","message: " + this.message); 
            },
            beforeDestroy: function () {
                console.group('beforeDestroy 销毁前状态===============》');
                console.log("%c%s", "color:red","el     : " + this.$el);
                console.log(this.$el);    
                console.log("%c%s", "color:red","data   : " + this.$data); 
                console.log("%c%s", "color:red","message: " + this.message); 
            },
            destroyed: function () {
                console.group('destroyed 销毁完成状态===============》');
                console.log("%c%s", "color:red","el     : " + this.$el);
                console.log(this.$el);  
                console.log("%c%s", "color:red","data   : " + this.$data); 
                console.log("%c%s", "color:red","message: " + this.message)
            }
        })
    </script>
</html>
```

### 输出结果

### 1、在beforeCreate之前的生命周期
#### 顾名思义，创建之前的阶段，此时该实例内的所有东西都还没有创建，所以在这个生命周期钩子函数中$el,data都是undefined。

![beforeCreate](https://upload-images.jianshu.io/upload_images/10187278-12987f7ff6024684.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---
### 2、在beforeCreate和created钩子函数之间的生命周期。
#### 在这个生命周期之间，进行初始化事件，进行数据的观测，在created的时候数据已经和data属性进行绑定，在这个生命周期钩子函数中，我们可以获取到data的值并对它进行操作。

![created](https://upload-images.jianshu.io/upload_images/10187278-a3379ffd5b178b0c.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---
### 3、在created和beforeMount间的生命周期
#### （1）在这一阶段，首先会判断是否有el选项，如果有的话就继续向下编译，如果没有el选项，则停止编译，也就意味着停止了生命周期，直到在该实例上调用vm.$mount(el)[也就是动态引入了el]。

#### 当我们把示例代码中el注释或者删掉，则页面最后效果如下图：

![没有el](https://upload-images.jianshu.io/upload_images/10187278-0a767a559489a93f.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### （2）除了el，我们还会用到template，template对生命周期的影响如下：
1. 如果如果vue实例对象中有template参数选项，则将其作为模板编译成render函数
2. 如果没有template选项，则将外部html作为模板编译（可参考上面示例的结果）
3. template中的模板优先级要高于outer html的优先级

#### 当我们添加template参数，代码下图：

![template代码](https://upload-images.jianshu.io/upload_images/10187278-a26e2ed68cfc6edd.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 打印结果如下图：

![template结果](https://upload-images.jianshu.io/upload_images/10187278-12ce569003f7a437.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 所以el的判断要在template之前，因为vue需要通过el找到对应的outer template

#### （3）在vue对象中，还有一个render函数，它是以createElement作为参数，然后做渲染，而且可以直接嵌入JSX。

#### 添加render函数看下效果，更改代码如下图：

![render代码](https://upload-images.jianshu.io/upload_images/10187278-751094407164c51c.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 效果如下：

![render结果](https://upload-images.jianshu.io/upload_images/10187278-8121709a36f87e0f.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 注：综合排名优先级：render函数>template选项>outer Html
---
### 4、beforeMount和mounted钩子函数间的生命周期
#### 此时是给vue实例对象添加$el成员，并且替换掉挂载的DOM元。

![mount](https://upload-images.jianshu.io/upload_images/10187278-94678f8cd267f6a7.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 可以看到图中beforeMount钩子函数中挂载元素中还是{{message}}，到mounted钩子函数中的时候挂载已完成，所以挂载元素中显示的是message的值

---
### 5、beforeUpdate钩子函数和updated钩子函数间的生命周期
#### 当vue发现data中的数据发生变化，会触发对对应组件的重新渲染，当数据改变后调用beforeupdata，当渲染完成后调用updated钩子函数。
#### 我们可以通过在控制台输入`app.message=20`来触发update事件。输出如下图：

![update](https://upload-images.jianshu.io/upload_images/10187278-3708cfb855d9c45e.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 可以看到beforeUpdate和updated里面的message值都是20，所以data值改变后触发beforeUpdate钩子函数，当页面渲染完成后调用updated。这点可以通过在updated钩子函数中使用alert打断程序运行，可以看到页面中并没有更新，而且通过官方流程图也可以看出。

![1534238864402.jpg](https://upload-images.jianshu.io/upload_images/10187278-b8b5f1dc36a2b85f.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 注：通过试验证明，在mounted钩子函数中执行修改data的操作会触发beforeUpdate，而它之前的函数中只要不是可以跳出主线程的数据操作，都不会触发beforeUpdate。例如使用setTimeout会使其中代码跳出主线程到异步线程中，所以它的执行会在mounted之后，所以会触发beforeUpdate。

---
### 6、beforeDestroy和destroyed钩子函数间的生命周期。
####beforeDestroy钩子函数在实例销毁之前调用。在这一步实例仍然可用。destroyed钩子函数在Vue 实例销毁后调用。调用后，Vue 实例指示的所有东西都会解绑定，所有的事件监听器会被移除，所有的子实例也会被销毁。

![destroy](https://upload-images.jianshu.io/upload_images/10187278-1a7776897ac7597f.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 可以看到虽然我们还可以获取到app对象，但是对它的修改已经不能触发视图的渲染了。

---

#### 官网图片，展示整个流程。vue组件是可复用的vue实例，所以每个组件的创建到挂载展示都可以使用以上生命周期钩子函数。
![image](https://cn.vuejs.org/images/lifecycle.png)

---

#### keep-alive标签包裹的组件在它们第一次被创建的时候就被缓存下来。与此相关的有两个生命周期钩子函数：activated 和 deactivated。当组件在<keep-alive>内被切换时，activated 和 deactivated 这两个生命周期钩子函数将会被对应执行。
- activated:在组件被激活时调用，在组价第一次渲染时也会被调用，之后每次keep-alive激活时被调用。
- deactivated:在组件被停用时调用。
##### 注意：只有组件被 keep-alive 包裹时，这两个生命周期才会被调用，如果作为正常组件使用，是不会被调用的。

---

#### vue-router路由，它也有类似于生命周期钩子的函数，允许我们在路由变化的不同阶段进行一些操作，官网叫做导航守卫，本质也是在路由变化的过程中添加钩子函数。
##### 路由组件内可以直接定义路由导航守卫
```
  beforeRouteEnter (to, from, next) {
    # 在导航确认前被调用,即将挂载的新组件还没被创建。
    # 不能获取组件实例 `this`
    # 因为当守卫执行前，组件实例还没被创建
  },
  beforeRouteUpdate (to, from, next) {
    # 在当前路由改变，但是该组件被复用时调用
    # 可以访问组件实例 `this`
  },
  beforeRouteLeave (to, from, next) {
    # 导航离开该组件的对应路由时调用
    # 可以访问组件实例 `this`
  }
```
##### beforeRouteEnter 守卫不能访问this，但是我们可以传递给next方法一个回调，来访问组件实例。在导航被确认的时候执行回调，并且把组件实例作为回调方法的参数。
##### 注意 beforeRouteEnter 是支持给 next 传递回调的唯一守卫。对于 beforeRouteUpdate 和 beforeRouteLeave 来说，this 已经可用了，所以不支持传递回调，因为没有必要了。
#### 每个守卫方法接收三个参数：
- to:即将要进入的目标路由对象
- from:当前导航正要离开的路由
- next:function:一定要调用该方法来resolve钩子函数，否则程序将不许继续执行下去。

