/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
const merge = require('webpack-merge');
const common = require('./webpack.common.js');

module.exports = merge(common,{
	devtool:'inline-source-map',
	devServer:{
		contentBase:'./dist'
	}
})