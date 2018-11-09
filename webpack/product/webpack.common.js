/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = {
	entry:{
		app:'./src/index',
	},
	plugins:[
		new CleanWebpackPlugin(['dist']),
		new HtmlWebpackPlugin({
			title:'Production'
		})
	],
	output:{
		filename: '[name].bundle.js',
		path:path.resolve(__dirname,'dist'),
		chunkFilename: '[name].bundle.js'
	}
}
