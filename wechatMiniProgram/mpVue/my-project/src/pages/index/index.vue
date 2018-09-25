<template>
  <div class="top">
  	<img src="/static/index/banner.jpg" alt="">
  	<div class="grid">
  		<ul>
  			<li>
  				<span class="icon"><img src="/static/image/icon_API.png" alt="" /></span>
  				<span class="title">点击</span>
  			</li>
  		</ul>
  	</div>
  </div>
</template>

<script>
	export default {
		data(){
			return {
				lala:'peng'
			}
		}
	}
</script>

<style scoped>
	.top{
		width: 750rpx;
		height: 350rpx;
	}
	.top img{
		width: 100%;
		height: 100%;
	}
	.grid ul{
		display: flex;
		flex-direction:row;
		flex-wrap: wrap;
		justify-content: center;
		align-items: center;
		height: 350rpx;
	}
	.grid ul li{
		width: 150rpx;
		height: 200rpx;
		margin: auto 15rpx;
		text-align: center;
	}
</style>








