/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const webpack = require('webpack');

module.exports = {
	entry:'./src/index.js',
	output:{
		filename:'[name].js',
		path:path.resolve(__dirname,'dist')
	},
	plugins:[
		new HtmlWebpackPlugin({
			title:'hello world'
		}),
		new CleanWebpackPlugin(['dist']),
		new webpack.NamedModulesPlugin(),
		new webpack.HotModuleReplacementPlugin()
	],
	devServer:{
		contentBase:'./dist',
		open:true,
		hot:true
	}
}