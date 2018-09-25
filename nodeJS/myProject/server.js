var https=require('https');
var url = require('url');

function start(route){
	function onRequest(request,response){
		console.log(request,response);
		var pathname = url.parse(request.url).pathname;
		console.log('request for ' + pathname + ' received.');

		route(pathname);

		response.writeHead(200,{'Content-Type':'text/plain'});
		response.write('hello world');
		response.end();
	}

	https.createServer(onRequest).listen(8888);
	console.log('server has started.')
}
exports.start = start;
