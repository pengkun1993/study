/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
const path = require('path');

module.exports = {
	entry:'./index.js',
	output:{
		filename:'bundle.js',
		path:path.resolve(__dirname,'dist')
	}
}