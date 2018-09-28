/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
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
		console.log('Component-2 >> created');
	},
	attached:function(){
		// 组件生命周期函数，在组件实例进入页面节点树时执行。
		console.log('Component-2 >> attached');
	},
	ready:function(){
		// 在组件布局完成后执行，此时可以获取节点信息
		console.log('Component-2 >> ready');
	},
	moved:function(){
		// 在组件实例被移动到节点树另一个位置时执行
		console.log('Component-2 >> moved');
	},
	detached:function(){
		// 在组件实例被从页面节点树移除时执行
		console.log('Component-2 >> detached');
	},
	lifetimes:{
		// 组件生命周期声明对象，将组件的生命周期收归到该字段进行声明，原有声明方式仍旧有效，如同时存在两种声明方式，则lifetimes字段内声明方式优先级最高
		/*created:function(){
			console.log('Component-2 lifetimes >> created');
		},*/
		attached:function(){
			console.log('Component-2 lifetimes >> attached');
		},
		ready:function(){
			console.log('Component-2 lifetimes >> ready');
		},
		moved:function(){
			console.log('Component-2 lifetimes >> moved');
		},
		detached:function(){
			console.log('Component-2 lifetimes >> detached');
		}
	},
	pageLifetimes:{
		// 组件所在页面的生命周期声明对象，目前仅支持页面的show和hide两个生命周期
		onShow:function(){
			console.log('Component-2 pageLifetimes >> onShow');
		},
		onHide:function(){
			console.log('Component-2 pageLifetimes >> onHide');
		}
	}

})