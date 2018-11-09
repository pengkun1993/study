# NodeJS学习笔记

>参考文档：[菜鸟教程](http://www.runoob.com/nodejs/nodejs-tutorial.html)

#### 简单的说Node.js就是运行在服务器端的JavaScript。
#### Node.js是一个基于Chrome JavaScript运行时建立的一个平台。
#### Node.js是一个事件驱动I/O服务端JavaScript环境，基于Google的V8引擎，V8引擎执行JavaScript的速度非常快，性能非常好。

#### node的安装与配置：[http://www.runoob.com/nodejs/nodejs-install-setup.html](http://www.runoob.com/nodejs/nodejs-install-setup.html)

>## 创建第一个应用

#### node.js不仅仅在实现一个应用，同时还实现了整个Http服务器。事实上，我们的web应用以及对应的web服务器基本上是一样的。

#### node.js由以下几个部分组成：

1. **引入required模块**：使用require指令来载入Node.js模块。
2. **创建服务器**：服务器可以监听客户端的请求，类似于Apache/Nginx等HTTP服务器。
3. **接受请求与相应请求**：服务器很容易创建，客户端可以使用浏览器或终端发送HTTP请求，服务器接收请求后相应数据。

#### 使用`http.createServer()`方法创建服务器，并使用listen方法绑定8888端口。函数通过request,response参数来接收和响应数据。

```javascript
	//server.js
	let http = require('http');

	http.createServer(function(request,response){
		response.writeHead(200,{'Content-Type':'text/plain'});
		response.end('Hello World\n');
	});
	
	console.log('Server running at http:127.0.0.1:8888');

	//在命令行中启动服务器
	node server.js
	//接下来打开浏览器就可以看到'Hello World'的网页。
```

#### 分析Node.js的HTTP服务器：
- 第一行请求Node.js自带的HTTP模块，并且把它赋值给http变量。
- 接下来我们调用http模块提供的函数：createServer。这个函数会返回一个对象，这个对象有一个叫做listen的方法，这个方法有一个数值参数，指定这个HTTP服务器监听的端口号。

>## NPM使用介绍

#### NPM是随同NodeJS一起安装的包管理工具，能解决NodeJS代码部署上的很多问题。

```bash	
	#查看npm版本
	npm -v
	#升级npm版本
	npm install npm -g
	cnpm install npm -g
	#使用npm安装模块提示一下错误：npm err!Error:connect ECONNREFUSED 127.0.0.1:8087，解决方法如下：
	npm config set proxy null
	#查看安装信息
	npm list -g
	#安装模块
	npm install webpack #本地安装
	npm install webpack -g #全局安装
	#查看某个模块的版本号，如webpack
	npm list webpack
	#卸载模块
	npm uninstall express
	#查看所有模块
	npm ls
	#更新模块
	npm update express
	#注册用户
	npm adduser
	#发布模块
	npm publish
	#使用淘宝npm镜像
	npm install -g cnpm --registry=https://registry.npm.taobao.org
```

#### package.json位于模块的目录下，用于定义包的属性。
#### package.json属性说明：
- name -包名
- version -包的版本号
- description -包的描述
- homepage -包的官网url
- author -包的作者姓名
- contributors -包的其他贡献者姓名
- dependencies -依赖包列表。如果依赖包没有安装，npm会自动将依赖包安装在node_module目录下。
- repository -包代码存放的地方的类型，可以是git或svn，git可在github上。
- main -main字段指定了程序的主入口文件，`require('moduleName')`就会加载这个文件。这个字段的默认值是模块根目录下面的index.js。
- keywords - 关键字

#### NPM包版本号。NPM使用语义版本号来管理代码，语义版本号分为X.Y.Z三位，分别代表主版本号、次版本号、和补丁版本号。当代码更新时，版本号按以下规则更新。
- 如果只是修复bug，需要跟新Z位。
- 如果是新增功能，但是向下兼容，需要更新Y位。
- 如果有大变动，向下不兼容，需要跟新X位。

>## Node.js REPL（交互式解释器）

#### node.js REPL(Read Eval Print Loop:交互式解释器)表示一个电脑的环境，类似windo系统的终端或Unix/Linux shell，我们可以在终端中输入命令，并接收系统的响应。

- 读取 - 读取用户输入，解析输入了JavaScript数据结构并存储在内存中。
- 执行 -执行输入的数据结构
- 打印 -输出结果
- 循环 -循环操作以上步骤直到用户两次按下ctrl-c按钮退出

#### Node的交互式解释器可以很好的调试JavaScript代码。

```bash
	# 启动Node终端
	node
	#接下来就会停留在Node.js REPL的命令行窗口中
```

#### ERPL命令

- ctrl+c -退出当前终端
- ctrl+c 按下两次 - 退出Node REPL。
- ctrl+d - 退出Node REPL。
- 向上/向下键 - 查看输入的历史命令
- tab - 列出当前命令
- .help - 列出使用命令
- .break - 退出多行表达式
- .clear - 退出多行表达式
- .save filename - 保存当前的Node REPL会话到指定文件
- .load filename - 载入当前Node REPL会话的文件内容

>## Node.js回调函数

#### Node.js异步编程的直接体现就是回调。
#### 异步编程依托于回调来实现，但不能说使用了回调后程序就异步化了。
#### 回调函数在完成任务后就会被调用，Node使用了大量的回调函数，Node所有Api都支持回调函数。
#### 例如，我们可以一边读取文件，一边执行其他命令，在文件读取完成后，我们将文件内容作为回调函数的参数返回。这样在执行代码时就没有阻塞或等待文件 I/O 操作。这就大大提高了 Node.js 的性能，可以处理大量的并发请求。

```javascript
	function foo1(name,age,callback){}
	function foo2(value,callback1,callback2){}
```

>## Node.js事件循环

#### Node.js是单进程单线程应用程序，但是因为V8引擎提供的异步执行回调接口，通过这些接口可以处理大量的并发，所以性能非常高。
#### Node.js几乎每个API都是支持回调函数的。
#### Node.js基本上所有的事件机制都是用设计模式中观察者模式实现。
#### Node.js单线程类似进入一个while(true)的事件循环，直到没有事件观察者退出，每个异步事件都生成一个事件观察者，如果有事件发生就调用该回调函数。

#### 事件驱动程序

#### Node.js使用事件驱动模型，当web server接收到请求，就把它关闭然后进行处理，然后服务下一个web请求。
#### 当这个请求完成，它被放回处理队列，当到达队列开头，这个结果被返回给用户。
#### 这个模型非常高效扩展性非常强，因为webserver一直接收请求而不等待任何读写操作。（这也被称为非阻塞试IO或者事件驱动IO）。
#### 在事件驱动模型中，会生成一个主循环来监听事件，当检测到事件时触发回调函数。