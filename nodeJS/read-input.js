/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
let fs = require('fs');

fs.readFile('input.txt',function(err,data){
	if(err){
		console.log(err);
		return;
	}
	console.log(data.toString());
})

console.log('程序执行完毕');