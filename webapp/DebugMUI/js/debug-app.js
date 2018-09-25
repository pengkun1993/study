/****************************************************************
 * 返回键退出程序
 * 1秒内，连续两次按返回键，则退出应用
 ****************************************************************/
function YTHBackQuitApp() {
	var backFirst = null;
	this.QuitApp = function() {
		//首次按键，提示‘再按一次退出应用’
		if (!backFirst) {
			backFirst = new Date().getTime();
			mui.toast('再按一次退出应用程序');
			setTimeout(function() {
				backFirst = null;
			}, 1000);
		} else {
			if ((new Date()).getTime() - backFirst < 1000) {
				plus.runtime.quit();
			}
		}
	}
};


/****************************************************************
 * 新开页面
 ****************************************************************/
function YTHOpenWindow(url, id, animation) {
	this.WUrl = url;
	this.WId = id;
	this.WAni = Boolean(animation) ? animation : "slide-in-right"; //pop-in
};
//打开新页面
YTHOpenWindow.prototype.Open = function() {
	mui.openWindow({
		url: this.WUrl,
		id: this.WId,
		styles: {
			scrollIndicator: "none"
		},
		show: {
			autoShow: true,
			aniShow: this.WAni,
			duration: 100
		},
		waiting: {
			autoShow: true,
			title: '正在加载...'
		}
	});
};
//打开母版子页面
YTHOpenWindow.prototype.OpenSubMasterDef = function(subLevel, subTitle) {
	var wvHeader = plus.webview.getWebviewById("subMasterDefLv" + subLevel);
	mui.fire(wvHeader, 'updateHeader', {
		title: subTitle
	});
	wvHeader.show(this.WAni, 100);
	var wvContent = wvHeader.children()[0];
	if (wvContent.getURL() != this.WUrl) wvContent.loadURL(this.WUrl);
};


/****************************************************************
 * 获取WebView对象
 ****************************************************************/
function YTHWebViewObj() {};
YTHWebViewObj.prototype.GetAll = function() {
	var wvarr = [];
	var wvs = plus.webview.all();
	for (var i = 0; i < wvs.length; i++) {
		wvarr.push({
			"SN": (i + 1),
			"WId": wvs[i].id,
			"WUrl": wvs[i].getURL()
		});
	}
	return wvarr;
};
YTHWebViewObj.prototype.GetAllToHtml = function() {
	var wvres = "";
	var wvs = plus.webview.all();
	for (var i = 0; i < wvs.length; i++) {
		wvres += "<div>" + (i + 1) + "." + wvs[i].id + "</div>";
	}
	return wvres;
};