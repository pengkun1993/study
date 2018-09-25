#### 小程序
##### 小程序自身接口调用失败
```javascript

	//wx.redirectTo(),wx.reLaunch(),wx.swithTab()
	wx.navigateTo({
		url:'',
		success:function(){

		},
		fail:function(){

		},
		complete:function(){

		}
	});
	wx.getNetworkType({
		success:function(){

		},
		fail:function(){

		}
	});

```

#### 管理后台请求错误提示统一

```javascript
	this.listLoading = true;//打开加载动画，若有
	//url统一需要以'/'开头，baseUrl为：https://ceshi.farmfriend.com.cn
	restfulRequest().then(res=>{
		if(res.errno==0){
			this.listLoading = false;//关闭加载动画，若有
			try{
				//数据整理操作，影响流程的数据错误抛出，仅用于展示非至关重要的参数如不存在或格式错误赋默认合理值
				//简单示例
				if(!res.data){
					console.warn('xxx is null , do nothing');
					throw '服务器数据返回错误';
					return;
				}
				
				if(!Array.isArray(users)){
					console.warn('xxx should be Array , xxx :: '+users);
					throw '服务器数据返回错误';
				}
				
			}catch(err){
				console.warn('xxx() restfulRequest() data wrong , res :: '+err);
				this.$notify({
		            title: '错误',
		            message: err,
		            type: 'error'
        		})
			}
		}else{
			this.listLoading = false;//关闭加载动画，若有
			console.warn('xxx() restfulRequest() errno != 0 , res :: '+JSON.stringify(res));
			this.$notify({
          		title: '错误',
	            message: res.errmsg || res.message || '未知网络异常',
	            type: 'info'
	          });
		}
	}).catch(err=>{
		this.listLoading = false;//关闭加载动画，若有
		console.warn('xxx() restfulRequest() catch error , err :: '+JSON.stringify(err));
		this.$notify({
          title: '错误',
          message: error.errmsg || error.message || '未知网络错误',
          type: 'error'
        })
	});
	//console.warn('[函数名] [方法名] 简单错描述 ， 打印某些有用数据')；这块可自行优化
```




