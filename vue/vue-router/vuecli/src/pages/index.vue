<template>
	<div class="layout">
		<div class="sidebar">
			<side-bar></side-bar>	
		</div>
		<div class="container">
			<router-view></router-view>
		</div>
	</div>
</template>
<script>
	import sideBar from './index/index'
	export default{
		components:{
			sideBar
		}
	}
</script>