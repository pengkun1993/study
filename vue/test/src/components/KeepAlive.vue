<template>
	<div>
		<span v-if="$route.query.id==12">{{value}}</span>
		<input v-else type="text" v-model="value">
	</div>
</template>
<script>
	export default{
		name:'keep-alive',
		data(){
			return {
				value:'1111111111111',
				//show:1,
			}
		},
		activated(){
			/*if(this.$route.query.id==12){
				this.show=2
			}else{
				this.show=1
			}*/
			console.log('activatedaaaaaaaaaaaa')
		},
		deactivated(){
			console.log('deactivatedbbbbbbbbbbb')
		},
		beforeCreate(){
			console.log('beforeCreate000000000')
		},
		created(){
			console.log('created111111111111')
		},
		beforeMount(){
			console.log('beforeMount22222222222')
		},
		mounted(){
			console.log('mounted33333333333333')
		},
		beforeUpdate: function () {
    		console.log('beforeUpdate444444444')
	    },
	    updated: function () {
	    	console.log('updated555555555')
	    },
	    beforeDestroy: function () {
	    	console.log('beforeDestroy66666666666')
	    },
	    destroyed: function () {
	    	console.log('destroyed777777777')
	    }
	}
</script>









