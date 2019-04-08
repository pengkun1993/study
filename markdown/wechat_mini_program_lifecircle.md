### 小程序生命周期

> #### 运行机制
 
> ##### 小程序什么时候会被销毁
##### 当小程序进入后台，客户端会维持一段时间的运行状态，超过一定时间后（目前是5分钟）会被微信主动销毁。
##### 当短时间内（5s）连续收到两次以上收到系统内存告警，会进行小程序的销毁。
> ##### 再次打开逻辑
##### 用户打开小程序的预期有以下两类场景：
- A. 打开首页：场景值有1001，1019，1022，1023，1038，1056
- B. 打开小程序指定的某个页面：场景值为除A以外的其他

#### 当再次打开一个小程序逻辑如下：

|上一次的场景|当前打开的场景|效果|
|:-:|:-:|:-:|
|A|A|保留原来的状态|
|B|A|清空原来的页面栈，打开首页（相当于执行wx.reLaunch到首页）|
|A或B|B|清空原来的页面栈，打开指定页面（相当于执行wx.reLaunch到指定页|

---

> #### 小程序的生命周期
##### App()函数注册一个小程序。接受一个Object参数，其指定小程序的生命周期回调等。这里的生命周期针对整个小程序项目，而不是哪个页面。
##### object参数说明：
###### **前台、后台定义：** 当用户点击左上角关闭，或者按了设备Home键离开微信，小程序并没有直接销毁，而是进入了后台；当在此进入微信或再次打开小程序，又会从后台进入前台。

##### 下面是一个示例，代码如下：
```javascript
	//app.js
	App({
	  onLaunch: function (options) {
	    // 小程序初始化完成时触发，全局只触发一次。
	    // options说明：
	    // path:打开小程序的路径
	    // query 打开小程序的query
	    // scene 打开小程序的场景值
	    // shareTicket 转发信息相关
	    // referrerInfo 当场景为由另一个小程序或公众号或App打开时，返回此字段
	     console.log('app >> onLaunch ， options::',options);
	  },
	  onShow: function(options){
	    // 小程序启动，或从后台进入前台显示时触发
	    // 参数与onLaunch一致
	    console.log('app >> onShow， options :: ',options);
	  },
	  onHide:function(){
	    //小程序从前台进入后台时触发。
	    console.log('app >> onHide');
	  },
	  onError:function(error){
	    // 小程序发生脚本错误，或者api调用失败时触发。
	    // error String 错误信息，包含堆栈信息
	    console.log('app >> onError ， error::'+error);
	  },
	  onPageNotFound(Object){
	    // 基础库1.9.90开始支持
	    // 小程序要打开的页面不存在时触发。
	    // Object参数说明：
	    // path String 不存在的页面路径
	    // query object 打开不存在页面的query
	    // isEntryPage Boolean 是否本次启动的首个页面
	    console.log('app >> onPageNotFound , Object :: ',Object);
	    //注：如果开发者没有添加 onPageNotFound 监听，当跳转页面不存在时，将推入微信客户端原生的页面不存在提示页面。
	    // 如果 onPageNotFound 回调中又重定向到另一个不存在的页面，将推入微信客户端原生的页面不存在提示页面，并且不再回调 onPageNotFound。
	  }
	});
```

##### 当启动小程序时，在开发者工具中可以看到控制台打印如下信息

![app](https://upload-images.jianshu.io/upload_images/10187278-4c94545a588b4564.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

---

> #### 页面的生命周期
#### Page(Object)函数用来注册一个页面。接受一个Object类型参数，其指定页面的初始数据、生命周期回调、时间处理函数等。

#### 下面用一个示例来尝试下小程序的生命周期流程
##### 该示例有4个页面pageA/pageB/pageC/pageD，其中pageA和pageB是两个tab页面，即通过底部标签切换的页面。而pageC和pageD是两个普通页面。示例页面如下：

![pageA](https://upload-images.jianshu.io/upload_images/10187278-eee3464e77e76f26.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)![pageB](https://upload-images.jianshu.io/upload_images/10187278-0aea9ca847ec327b.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)![pageC](https://upload-images.jianshu.io/upload_images/10187278-dcf55044c45c3f4f.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)![pageD](https://upload-images.jianshu.io/upload_images/10187278-b3070b4e97043639.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 四个页面如图所示，有一些按钮分别表示不同的路由跳转方式。

##### 下面是pageA相关的部分页面代码，其他页面类似

```javascript
	Page({
		data:{

		},
		onLoad:function(options){
			//页面加载时触发。一个页面只会调用一次，可以在onLoad的参数中获取打开当前路径中的参数。
			//参数 options Object 打开当前页面路径中的参数
			console.log('pageA >> onLoad , options ::',options);
		},
		onReady:function(){
			//页面初次渲染完成时触发。一个页面只会调用一次，代表页面已经准备妥当，可以和视图层进行交互。
			console.log('pageA >> onReady');
		},
		onShow:function(){
			//页面显示/切入前台时触发
			console.log('pageA >> onShow');
		},
		onHide:function(){
			//页面隐藏/切入后台时触发。
			console.log('pageA >> onHide');
		},
		onUnload:function(){
			//页面卸载时触发。
			console.log('pageA >> onUnload');
		},
		// 自定义方法
		navigateToC:function(){
			//保留当前页面，跳转到应用内的某个页面，但是不能跳到 tabbar 页面。使用 wx.navigateBack 可以返回到原页面。
			console.log('%cpageA==========navigateToC===========','color:red');
			wx.navigateTo({
				url:'/pages/page-c/index'
			});
		},
		redirectToC:function(){
			//关闭当前页面，跳转到应用内的某个页面，但是不允许跳转到tabbar页面
			console.log('%cpageA==========redirectToC===========','color:red');
			wx.redirectTo({
				url:'/pages/page-c/index'
			});
		},
		reLaunchToC:function(){
			//关闭所有页面，打开到应用内的某个页面
			console.log('%cpageA==========reLaunchToC===========','color:red');
			wx.reLaunch({
				url:'/pages/page-c/index'
			})
		}
	});


```

#### 下面是各种情况下的试验结果：

|当前页面|路由后页面|跳转方式|触发的生命周期（按顺序）|说明|
|:---:|:---:|:---:|:---:|:---:|
|A|A|首次打开|![first](https://upload-images.jianshu.io/upload_images/10187278-c56fbdb34f75fdb9.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|执行小程序的`onlaunch>onShow`，然后执行页面的`onLoad>onShow>onReady`|
|A|B|点击tab标签|![AtoB](https://upload-images.jianshu.io/upload_images/10187278-ee3d0782bbc8ddd2.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|pageA隐藏，pageB加载|
|A|B(再次打开)|点击tab标签|![AtoB2](https://upload-images.jianshu.io/upload_images/10187278-a8efa0e3519adb6c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|pageA隐藏，pageB显示|
|A|C|navigateTo|![An2C](https://upload-images.jianshu.io/upload_images/10187278-64c4a4d1243146fc.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|pageA隐藏，pageC加载|
|A|C|redirectTo|![Ar2C](https://upload-images.jianshu.io/upload_images/10187278-66760394b96f2c07.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|pageA卸载，pageC加载|
|A|C|reLaunchTo|![AL2c](https://upload-images.jianshu.io/upload_images/10187278-881ee8d9aa2df0e7.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|卸载所有页面，pageC加载|
|C|A|switchTabTo|![Cs2A](https://upload-images.jianshu.io/upload_images/10187278-6fd983623cb80f22.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|卸载所有非tab页面，pageA显示|
|D|C|navigateBack|![Db2C](https://upload-images.jianshu.io/upload_images/10187278-f87e72dd4f27e788.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|pageD卸载，pageC显示|
|D|B|switchTabTo|![Ds2B](https://upload-images.jianshu.io/upload_images/10187278-c7dcf1380db0cb4d.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|卸载所有非tab页面，pageC显示,pageA任然存在|
||D|关闭小程序|![image.png](https://upload-images.jianshu.io/upload_images/10187278-c061b115fa70c476.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)|打开A/B/C/D，从pageD关闭小程序，可以看到执行的D和App的`onHide`，小程序并没有真正退出|

##### 上面说到的情况都较为简单的流程，从官方文档便可以理解到，下面试验一些复杂的流程。

> ##### 第一种 `A->C->D-B`，其实这个过程按正常思维便可以理解，下图为整个过程的展示：

![ACDB](https://upload-images.jianshu.io/upload_images/10187278-611c3605166348b3.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 上面的图片展示了小程序从打开到走完这个流程的所有生命周期，其余都好理解，值得注意的是，D`switchTabTo`B的时候，会干掉所有其他非tabBar页面，所以pageC和pageD都会触发`onUnload`

> ##### 第二种 `A->C->C->C`，这种情况下我们从C页面继续跳转到C页面，为了看下小程序是新创建一个C页面，还是复用之前的C页面，我们在C页面中加一个input用来识别页面是否被复用。试验结果如下图：

![ACCC](https://upload-images.jianshu.io/upload_images/10187278-71fdeb79182d1ad7.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 事实证明每次我们都打开了一个新的页面，我们的输入框是空白的，而我每次分别输入了1/2/3，从生命周期函数也可以看到每次C都执行了onHide但没有执行`onUnload`说明之前的页面还在，而每次打开C都执行了`onLoad/onShow/onReady`说明我们打开的是一个新的页面，但是打开控制台看页面栈信息，截图如下：

![trace](https://upload-images.jianshu.io/upload_images/10187278-d50d55c4fa0ab0fe.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 页面栈树中只有A和C两个，不过我们跳转时打开这里可以看到C的`__webviewId__`是在变化的，也证明了我们打开的是一个新的页面。虽然从控制台AppData的Tree看上去有要两个，实际上我们跳转够10次还是会受到微信页面深度最大为10层的限制。下面按微信左上角的返回键，看下生命周期流程：

![Cback](https://upload-images.jianshu.io/upload_images/10187278-93b0b852fb321266.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 可以看到依次执行了C页面的`onUnload/onShow`，也就是之前的多个C页面被一一卸载掉了。这里注意一点，对于二级页面，使用navigateBake或者微信自己的返回按键都会卸载掉当前页面，所以离开页面只有navigateTo的时候会保留当前页面，其他情况都会卸载掉当前页面。(自我总结：对于二级页面，只有从下一个页面返回自身的情况下，不调用onLoad其他任何情况进入二级页面，都会触发onLoad。没有想到其他情况，顾作此总结，欢迎指正)。

> #### 组件的生命周期函数

##### 小程序支持自定义组件，使用Component构造器定义组件，使用Component构造器时可以定义组件的属性、数据、方法等。这里整理下生命周期相关函数。

##### 组件的生命周期函数有两种形式，除了写在外面，还可以统一写在`lifetimes`中，在下面的示例代码备注中可以看到。

```javascript
	Component({
		properties:{
			innerText:{
				type:String
			}
		},
		data:{

		},
		methods:{

		},
		created:function(){
			// 组件生命周期函数，在组件实例进入页面节点树时执行，注意此时不能调用setData
			console.log('Component-1 >> created');
		},
		attached:function(){
			// 组件生命周期函数，在组件实例进入页面节点树时执行。
			console.log('Component-1 >> attached');
		},
		ready:function(){
			// 在组件布局完成后执行，此时可以获取节点信息
			console.log('Component-1 >> ready');
		},
		moved:function(){
			// 在组件实例被移动到节点树另一个位置时执行
			console.log('Component-1 >> moved');
		},
		detached:function(){
			// 在组件实例被从页面节点树移除时执行
			console.log('Component-1 >> detached');
		},
		lifetimes:{
			// 组件生命周期声明对象，将组件的生命周期收归到该字段进行声明，原有声明方式仍旧有效，如同时存在两种声明方式，则lifetimes字段内声明方式优先级最高
			created:function(){
				console.log('Component-1 lifetimes >> created');
			},
			attached:function(){
				console.log('Component-1 lifetimes >> attached');
			},
			ready:function(){
				console.log('Component-1 lifetimes >> ready');
			},
			moved:function(){
				console.log('Component-1 lifetimes >> moved');
			},
			detached:function(){
				console.log('Component-1 lifetimes >> detached');
			}
		},
		pageLifetimes:{
			// 组件所在页面的生命周期声明对象，目前仅支持页面的show和hide两个生命周期
			show:function(){
				console.log('Component-1 pageLifetimes >> Show');
			},
			hide:function(){
				console.log('Component-1 pageLifetimes >> Hide');
			}
		}

	});

```

#### 分别在B页面和C页面引入该组件， 从以下几种情况看下生命周期函数的执行过程
> #### 第一种情况同时引入上面所有生命周期函数，由A通过tab切换到B，再由B通过navigateTo切换到C，生命周期执行打印如下：

![Components](https://upload-images.jianshu.io/upload_images/10187278-b3050dea66892d22.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 可以看到组件中只执行了`lifetimes`中的生命周期函数，外层的生命周期函数并没有执行。而且可以看到先执行组件的`created/attached`函数，随后执行页面的`onLoad/onShow`，再执行之间的`ready`，最后执行页面的的`onReady`，这是页面中引入组件时组件的生命周期函数执行顺序。

##### lifetimes中的生命周期函数执行了，外层的生命周期函数没有执行，所有当两者同时存在时，lifetimes中的优先级要高。

##### 这里组件中的`pageLifetimes`没有执行，不清楚具体原因，官网说是2.2.3版本以上支持，我在2.3.0的环境还是没有执行，不清楚具体原因，求解！

> #### 第二种情况，不引入lifetimes的生命周期函数，只使用外层的生命周期函数，执行结果如下图所示：

![COMPONENT](https://upload-images.jianshu.io/upload_images/10187278-fe98b9cc506d1678.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 可以看到，生命周期函数执行顺序没有变，外层的生命周期生效。

> #### 第三种情况，在B页面中使用两个组件，这里我把lifetimes中的created生命周期注释掉了，看生命周期的执行情况，这里组件1和组件2的代码相同，执行结果情况如下图：

![image.png](https://upload-images.jianshu.io/upload_images/10187278-27f85a9a7a8acc91.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 从执行的结果来看，整个生命周期的执行顺序不变，只是要在每个阶段执行所有组件的相应生命周期，如上图，现行玩所有组件的created，再执行所有组件的attached,然后执行页面的onLoad和onShow，再执行所有组件的ready，最后执行页面的onReady。


> #### 总结：通过这些试验，对小程序相关的生命周期有了一个基本的认识。
##### 1、小程序初次打开会执行小程序的生命周期钩子函数：`onLaunch->onShow`，而且这些钩子函数只会执行一次。关闭小程序，小程序并不会真正退出，所以执只行了`onHide`。
##### 2、页面的初次打开会执行页面的生命周期钩子函数：`onLoad->onShow->onReady`，通过`navigateTo`离开页面会保留该页面，此时只执行`onHide`，其他方式离开（包括navigateBack）都会干掉当前页面，此时会执行`onHide>onUnload`。特殊情况:`switchTabTo`会干掉所有非tab页面，但是保留所有已经加载的tab页面。
##### 3、包含组件的页面，先执行所有组件的`created`，再执行所有组件的`attached`，然后执行页面的`onLoad>onshow`，再执行所有组件的`ready`，随后执行页面的`onReady`。当页面被卸载时，先执行页面的`onUnload`，再执行组件的`detached`。页面不卸载，不会触发组件的`detached`。

#### 初次接触小程序，能力有限，欢迎指正！[/抱拳]

> 参考文档：https://developers.weixin.qq.com/miniprogram/dev/framework/custom-component/component.html