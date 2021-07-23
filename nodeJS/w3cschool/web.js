// Web 模块
 
let http = require('http');
let fs = require('fs');
let url = require('url');


http.createServer(function(request, response) {
  let pathname = url.parse(request.url).pathname;

  console.log('pathname::: ', pathname);

  fs.readFile(pathname.substr(1), function(err, data) {
    if (err) {
      console.log(err);
      response.writeHead(404, {'Content-Type': 'text/html'});
    } else {
      response.writeHead(200, {'Content-Type': 'text/html'});
      resopnse.write(data.toString());
    }
    response.end();
  })
}).listen(8081);

console.log('serve running at http://127.0.0.1:8081');
