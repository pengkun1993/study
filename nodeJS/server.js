/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
let http = require('http');

http.createServer(function(request,response){
	response.writeHead(200,{'Content-Type':'text/plain'});

	response.end('Hello World\n');
}).listen(8888);

console.log('Server running at http://127.0.0.1:8888')