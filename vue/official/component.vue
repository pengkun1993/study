<div id="components-demo">
	<button-counter></button-counter>
</div>
<script>
	Vue.component('button-counter',{
		data:function(){
			return {
				count:0
			}
		},
		template:'<button v-on:click="count++">You clicked me {{count}} times.<button>'
	})
</script>