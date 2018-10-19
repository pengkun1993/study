/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');

module.exports = {
	mode:'development',
	entry:{
		app:'./src/index.js',
		print:'./src/print.js'
	},
	output:{
		filename:'[name].bundle.js',
		path:path.resolve(__dirname,'dist')
	},
	devtool:'eval',
	plugins:[
		new HtmlWebpackPlugin({
			title:'hello world'
		}),
		new CleanWebpackPlugin(['dist'])
	],
	devServer:{
		contentBase:'./dist'
	},
	module:{
		rules:[
			{
				test:/\.css$/,
				use:['style-loader','css-loader']
			}
		]
	}
}