
/**
 * 自己维护的页面栈
 * @type {Array}
 */
let history=[];
/**
 * 页面卸载的方式
 * normal正常卸载，系统方法
 * nrt 超过10层通过redirect实现的navigation:navigate-redirect-to
 * rt redirectTo卸载的
 * rl reLaunch卸载
 * st switchTab卸载
 * @type {String}
 */
let onUnloadType='normal';

//包裹page参数
const wraperPage=function(pageParamObj){
	//onLoad生命周期
	let originOnLoad=pageParamObj.onLoad;
	pageParamObj.onLoad=function(options){
		// 执行页面原始的生命期回调
    	originOnLoad && originOnLoad.call(currPage, options);
	}
	//onShow生命周期
	let originOnShow = pageParamObj.onShow;
	pageParamObj.onShow = function(){
		// 执行页面原始的生命周期回调
		originOnShow && originOnShow.call(currPage,options);
	}
	// onUnload生命周期
	let originOnUnload = pageParamObj.onUnload;
	pageParamObj.onUnload = function(){
		// 执行页面原始的生命周期回调
		originOnUnload && originOnUnload.call(currPage,options);
	}

	return pageParamObj 
}

/**
 * 自己的路由对象
 * @type {Object}
 */
const pk={
	navigateTo : function(obj){
		let pageStack = getCurrentPages();
		if(pageStack.length >= 10){
			onUnloadType="nrt";
			// 获取当前页面栈并压入history
			let currPage;
			if (pageStack.length > 0) {
				currPage = pageStack[pageStack.length - 1];
			}
			history.push({
				url:currPage.route,
				data:currPage.data
			});
			wx.redirectTo({
				url:obj.url,
				success:obj.success,
				fail:obj.success,
				complete:obj.complete
			})
		}else{
			onUnloadType='normal';
			wx.navigateTo({
				url:obj.url,
				success:obj.success,
				fail:obj.success,
				complete:obj.complete
			})
		}
	},
	redirectTo : function(obj){
		onUnloadType='rt';
		wx.redirectTo({
			url:obj.url,
			success:obj.success,
			fail:obj.success,
			complete:obj.complete
		})
	},
	reLaunch : function(obj){
		history=[];
		onUnloadType:'rl';
		wx.reLaunch({
			url:obj.url,
			success:obj.success,
			fail:obj.fail,
			complete:obj.complete
		})
	},
	switchTab : function(obj){
		history=[];
		onUnloadType:'st';
		wx.switchTab({
			url:obj.url,
			success:obj.success,
			fail:obj.fail,
			complete:obj.complete
		})
	}
}

module.exports = {
	pk,
	wraperPage
}












