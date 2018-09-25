var beginTime=new Date("2016/07/10 0:0:0");
var dday;
var dhour;
var dmin;
var dsecond;
var ourTime;
var timer1;
window.onload=function(){
	//获取各个元素节点
	var page_load=document.getElementById('page_load');
	var page1=document.getElementById('page1');
	var page2=document.getElementById('page2');
	var page3=document.getElementById('page3');	
	ourTime=document.getElementById('ourTime');
	var music=document.getElementById('music');
	var audio=document.getElementsByTagName('audio')[0];
	/*if(!audio.paused){
		page_load.style.display='none';
		page_load.style.zIndex='-99';
		page1.style.display='block';
	}*/
	//设置点击碟片图标开始暂停音乐
	music.addEventListener("touchstart",function(event){
		if(audio.paused){
			music.setAttribute("class","play");
			this.style.animationPlayState="running";
			audio.play();
		}else{
			music.setAttribute("class","");
			this.style.animationPlayState="paused";
			audio.pause();
		}
	},false);
	//音乐播放完毕后，使碟片回归原位
	audio.addEventListener("ended",function(event){
			music.setAttribute("class","");
	},false);
	//点击第一页进入第二页
	page1.addEventListener("touchstart",function(){
		page1.style.display="none";
		page2.style.display="block";
		page3.style.display="block";
		page3.style.top="100%";
		setTimeout(function(){
			page2.setAttribute("class","page fadeOut");
			page3.setAttribute("class","page fadeIn");
			writeLetter();
		},5000);

	},false);
	
	
	loop();
}
window.requestAnimFrame = (function() {
	return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame ||
		function( /* function FrameRequestCallback */ callback, /* DOMElement Element */ element) {
			return window.setTimeout(callback, 1000 / 60);
		};
})();
function loop() {
	window.requestAnimFrame(loop);
	var nowTime=new Date();
	var chaTime=nowTime.getTime()-beginTime.getTime();
	chaTime=parseInt(chaTime/1000);
	dday=parseInt(chaTime/(24*3600));
	var eday=chaTime-dday*(24*3600);
	dhour=parseInt(eday/3600);
	var ehour=eday-dhour*3600;
	dmin=parseInt(ehour/60);
	dsecond=ehour-dmin*60;

	ourTime.innerHTML="我们在一起<br/>"+dday+"天"+dhour+"小时"+dmin+"分钟"+dsecond+"秒了";
}	