/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
const express = require('express');
const webpack = require('webpack');
const webpackDevMiddleware = require('webpack-dev-middleware');

const app = express();
const config = require('./webpack.config.js');
const compiler = webpack(config);

//告知express使用webpack-dev-middleware并且使用webpack.config.js作为基础配置
app.use(webpackDevMiddleware(compiler,{
	publicPath:config.output.publicPath
}));

app.listen(3000,function(){
	console.log('example app listening on port 3000!\n');
})