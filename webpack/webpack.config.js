const path = require('path');

module.exports={
	mode:'production',//'production' | 'development' | 'none'
	//chosen node tells webpack to use its built-in optimizations accordingly
	entry:'./app/entry',// string | object | array
	//这里应用程序开始执行
	//webpack开始打包

	output:{
		// webpack 如何输出结果的相关选项
		
		path:path.resolve(__dirname,'dist'),
		//所有输出文件的目标路径
		//必须是绝对路径（使用Node.js的path模块）
	}
}