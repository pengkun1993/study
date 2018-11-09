/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const webpack = require('webpack');

module.exports = {
	mode:'development',
	entry:{
		app:'./src/index.js',
	},
	output:{
		filename:'[name].bundle.js',
		path:path.resolve(__dirname,'dist'),
		publicPath:'/'//publicPath也会在服务器脚本用到，以确保文件资源能够在http://localhost:3000下正确访问。
	},
	devtool:'inline-source-map',
	plugins:[
		new HtmlWebpackPlugin({
			title:'hello world'
		}),
		new CleanWebpackPlugin(['dist']),
		new webpack.NamedModulesPlugin(),//当开启HMR的时候使用该插件会显示模块的相对路径，建议用于开发环境
		new webpack.HotModuleReplacementPlugin(),
		//HotModuleReplacementPlugin热模块替换插件，也被称为HMR，永远不要在生产环境下启用HMR。
	],
	devServer:{
		contentBase:'./dist',
		hot:true
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