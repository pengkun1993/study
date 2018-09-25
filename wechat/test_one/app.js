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
})



