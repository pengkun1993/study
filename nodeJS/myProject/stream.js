var fs = require('fs');
var data='';
// 创建可读流
var readerStream = fs.createReadStream('input.txt');

// 设置编码为utf-8
readerStream.setEncoding('UTF8');

// 处理流事件 --> data,end,and Error
readerStream.on('data',function(chunk){
	data += chunk;
	console.log('data:::',data,chunk);
})

readerStream.on('end',function(){
	console.log('end:::',data);
})

readerStream.on('error',function(err){
	console.log('err:::',err.stack);
})

console.log('读程序执行完毕');

var data2='随便写点什么吧';

// 创建可以写入的流
var writerStream = fs.createWriteStream('output.txt');
// 使用utf-8编码写入数据
writerStream.write(data2,'UTF8');
// 标记文件末尾
writerStream.end();
// 处理流事件 --> data,end,and error
writerStream.on('finish',function(){
	console.log('写入完成。');
});

writerStream.on('error',function(err){
	console.log('error::::',err.stack);
})

console.log('写程序执行完成');













