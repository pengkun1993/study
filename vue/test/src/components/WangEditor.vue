<template>
	<div id="editorA">
		<p>欢迎使用 wangEditor 富文本编辑器</p>
	</div>
</template>
<script>
	import E from 'wangeditor'
	export default{
		name:'wang-editor',
		data(){
			return {

			}
		},
		created(){
			this.$nextTick(function(){
				var editor = new E('#editorA')
				editor.create()
				editor.customConfig.onchange=function(html){
					console.log(html)
				}
			})
		}
	}
</script>