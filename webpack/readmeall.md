# webpack配置整理
## 开始准备

---

```bash
	npm init -y
	npm install webpack webpack-cli --save-dev

	npx webpack --config webpack.config.js #可以将脚本作为入口起点，然后输出为main.js，如果webpack.config.js存在，将默认使用它，这里使用--config是为了表明可以传递任何名称的配置文件。

	#上面的方式是通过cli运行本地webpack，为了方便我们可以在package.json添加一个npm 脚本 ：
	"scripts":{
		"build":"webpack"
	}
	#这时我们就可以使用npm run build命令来替代我们之前使用的npx命令。
```

### 为了从JavaScript模块中import一个CSS文件，需要在module配置中安装并添加style-loader和css-loader，并引入规则。同样的道理，加载图片也需要使用图片加载器file-loader。

```javascript
	//npm install --save-dev style-loader css-loader file-loader
	
	module.exports = {
		entry: './src/index.js',
		output:{
			filename:'bundle.js',
			path:path.resolve(__dirname,'dist')
		},
		module:{
			rules:[
				{
					test:/\.css$/,
					use:[
						'style-loader',
						'css-loader'
					]
				},{
					test:/\.(png|svg|jpg|gif)$/,
					use:[
						'file-loader'
					]
				}
			]
		}
	}

	//webpack根据正则表达式，来确定应该查找哪些文件，并将其提供给指定的loader。
```
---

## 入口分离
###在entry添加新的入口起点，然后修改output，则会根据入口生成多个js文件。

```javascript
	const path = require('path');
	module.exports = {
		entry:{
			app:'./src/index.js',
			print:'./src/print.js'
		},
		output:{
			filename:'[name].bundle.js',
			path:path.resolve(__dirname,'dist')
		}
	}
```

## 自动创建并更新html文件

---

### HtmlWebpackPlugin简化html文件的创建。自动匹配不断变化的文件，省去了手动维护。

```javascript
	let HtmlWebpackPlugin = require('html-webpack-plugin');
	const path = require('path');

	module.exports = {
		entry:'index.js',
		output:{
			path:path.resolve(__dirname,'./dist'),
			filename:'[name].js'
		},
		plugins:[
			new HtmlWebpackPlugin()
		]
	}
```

### HtmlWebpackPlugin配置

|name|type|default|description|
|:-:|:-:|:-:|:-:|
|title|string|Webpack App|用于生成html文档的标题|
|filename|string|index.html|要写入html的文件，默认为'index.html'，在这里可以指定一个目录(eg:assets/admin.html)|
|template|string|``|webpack需要模板的路径|
|templateParameters|Boolean/Object/Function|``|允许重写template中引用的参数|
|templateContent|string/function|``|一个String/Function包含template内容的字符串。template和templateContent不可同时使用|
|inject|Boolean/String|true|true/head/body/false将所有的assets注入到给定的template或templateContent。当传入`true/body`时，所有JavaScript资源将放置在body的底部。传入`head`将把脚本放在head中|
|favicon|String|``|向html输出facicon路径|
|meta|Object|{}|允许注入meta标签|
|minify|Boolean/Object|false|将html-minifiler的配置作为对象来缩小输出|
|hash|Boolean|false|如果为`true`，则将唯一的webpack编译hash追加到所有包含js和css文件中。这对于缓存崩溃是有用的|
|cache|Boolean|true|仅在文件被更改时才发出该文件|
|showErrors|Boolean|true|错误详情将被写到html页面|
|chunks|{?}|?|允许只添加一些chunks|
|chunksSortMode|String/Function|auto|允许控制chunks被包含到html之前应该如何排序。允许值：`none/auto/dependency/manual/function`|
excludeChunks|Array|``|允许跳过一些chunks|
xhtml|Boolean|false|如果为`true`设置link标签为自动关闭|

## 清理dist文件夹，clean-webpack-plugin

---

### 由于过去的代码会遗留在dist中，导致dist目录非常混乱，webpack无法追踪到哪些文件是实际在项目中用到的。因此推荐在每次构建前清理dist文件夹，如此便只会生成用到的文件，下面的插件可以实现这个功能：
### `npm i clean-webpack-plugin --save-dev`

```javascript
	const CleanWebpackPlugin = require('clean-webpack-plugin');
	//webpack config
	{
		plugins:[
			new CleanWebpackPlugin(paths[,{options}])
		]
	}
        
	//options and defaults(Options)，下面是该插件的一些配置选项，不需要再项目中都配置。
	{
		//wepack根文件夹的绝对路径，默认：package的根目录
		root:__dirname,
		//向console写日志
		werbose:true,
		//使用'true'来测试或仿真删除（将不会移除文件）
		//默认值：'false'，移除文件
		dry:false,
		//如果为'true'，则删除文件重新编译
		watch:false,
		// Instead of removing whole path recursively,
  		// remove all path's content with exclusion of provided immediate children.
  		// Good for not removing shared files from build directories.
  		exclude: [ 'files', 'to', 'ignore' ],
  		// 允许插件清理webpack目录以外的文件夹
  		allowExternal:false,
  		//在文件被发送的output文件夹之前执行清理
  		beforeEmit:false
	}
```

## 使用source map

---

### 当webpack打包源代码时，可能会很难追踪到错误和警告在源代码中的原始位置。例如，如果将三个源文件（a.js,b.js和c.js）打包到一个bundle中，而其中一个源文件包含一个错误，那么堆栈跟踪就会简单地指向到bundle.js。这并没有太多帮助，因为你可能需要准确地知道错误来自于哪个源文件。

### 为了更容易地追踪错误和警告，JavaScript提供了source map功能，将编译后的代码映射回原始源代码。

### source map有很多不同的选项可用，如下：

|devtool|构建速度|重新构建速度|生产环境|品质|
|-:|:-:|:-:|:-:|:-:|
|(none)|+++|+++|yes|打包后的代码|
|eval|+++|+++|no|生成后的代码|
|eval-source-map|--|+|no|原始源代码|
|cheap-eval-source-map|+|++|no|转换过的代码（仅限行）|
|cheap-module-eval-source-map|o|++|no|原始源代码（仅限行）|
|source-map|--|--|yes|原始源代码|
|inline-source-map|--|--|no|原始源代码|
|hidden-source-map|--|--|yes|原始源代码|
|nosources-source-map|--|--|yes|无源代码内容|
|cheap-source-map|+|o|no|转换过的代码（仅限行）|
|cheap-module-source-map|o|-|no|原始源代码（仅限行）|
|inline-cheap-source-map|+|o|no|转换过的代码（仅限行）|
|inline-cheap-module-source-map|o|-|no|原始源代码（仅限行）|

*注： `+++` 非常快，`++` 快速，`+` 比较快，`o` 中等，`-` 比较慢，`--` 慢* 

### 其中一些值适用于开发环境，一些适用于生产环境。对于开发环境，通常希望更快的source map，需要添加到bundle中以增加体积为代价，但是对于生产环境，则希望更精确的source map，需要从bundle中分离并独立存在。

### 品质说明

###### `打包后的代码 `-将所有生成的代码视为一大块代码，你看不到相互分离的模块。
###### `生成后的代码` - 每个模块相互分离，并用模块名称进行注释。可以看到webpack生成的代码。示例：你会看到类似 `var module_WEBPACK_IMPORTED_MODULE_1__=__webpack_require__(42);module__WEBPACK_IMPORTED_MODULE_1__.a();` 而不是 `import {test} from "module"; test();`
###### `转换过的代码` - 每个模块相互分离，并用模块名称进行注释。可以看到webpack转换前、loader转译后的代码。示例：会看到类似`import {test} from "module"; var A = function(_test) { ... }(test);` 而不是 `import {test} from "module"; class A extends test {}`
###### `原始源代码` - 每个模块相互分离，并用模块名称进行注释。可以看到转译之前的代码，正如编写它时。这取决于loader支持。
###### `无源代码内容` - source map中不包含源代码内容。浏览器通常会尝试从web服务器或文件系统加载源代码。必须保证正确设置`output.devtoolModuleFilenameTemplate`，以匹配源代码的url。
###### `（仅限行）` - source map 被简化为每行执行一个映射。这通常意味着每个语句只有一个映射。这会妨碍你在语句级别上调试执行，也会妨碍你在每行的一些列上设置断点。与压缩后的代码组合后，映射关系是不可能实现的，因为压缩工具通常只会输出一行。

### 对于开发环境，以下选项非常适合开发环境：

##### `eval` - 每个模块都是用eval()执行，并且都有`//@ sourceURL` 。此选项会非常快地构建。主要缺点是：由于会映射到转换后的代码，而不是映射到原始代码（没有从loader中获取source map），所以不能正确的显示行数。

##### `eval-source-map` - 每个模块使用`eval()`执行，并且source map转换为DataUrl后添加到eval()中。初始化source map时比较慢，但是会在重新构建时提供比较快的速度，并且生成实际的文件。行数能够正确映射，因为会映射到原始代码中。它会生成用于开发环境的最佳品质的source map。

##### `cheap-eval-source-map` - 类似eval-source-map，每个模块使用eval()执行。这是"cheap(低开销)"的source map，应为它没有生成列映射，只是映射行数。它会忽略源自loader的source map，并且仅显示转译后的代码，就像`eval`devtool.

##### `cheap-module-eval-source-map` - 类似 `cheap-eval-source-map` ，并且在这种情况下，源自loader的source map会得到更好的处理结果。然而，loader  source map会被简化为每行一个映射。

### 对于生产环境，以下选项通常用在生产环境中：

##### `(none)` - 不生成source map。这是一个不错的选择。

##### `source-map` - 整个source map 作为一个独立的文件生成。它为bundle添加了一个引用注释，以便开发工具知道到在哪里可以找到它。注：此时应该将服务器设置为不允许普通用户访问srouce map 文件！

##### `hidden-soucr-map` - 与`source-map`相同，但不会为bundle添加引用注释。如果你只想source map映射那些源自错误报告的错误堆栈跟踪信息源自错误报告的堆栈跟踪信息，但不想为浏览器开发工具暴露你的source map，这个选项会很有用。

##### `nosources-srouce-map` - 创建的source map不包含sroucesContent(源代码内容)。它可以映射客户端上的堆栈跟踪，而无需暴露所有的源代码。可以将source map 文件部署到web服务器。注：这仍然会暴露反编译后的文件名和结果，但它不会暴露原始代码。

### 特殊场景
#### 以下选项对于开发环境和生产环境并不理想。他们是一些特定场景下需要的，例如，针对一些第三方工具。

##### `inline-source-map` - source map转换为dataUrl后添加到bundle中。
##### `cheap-source-map` - 没有列映射的source map，忽略loader source map 。
##### `inline-cheap-source-map` - 类似`cheap-srouce-map`，但是source map转换为DataUrl后添加到bundle中。
##### `cheap-module-source-map` - 没有列映射的source map，将loader source map简化为每行一个映射。
##### `inline-cheap-module-source-map` - 类似`cheap-module-source-map`，但是source map转换为DataUrl添加到bundle中。

## 使用观察者模式

---

### 上面的每次修改我们都需要运行`npm run build`来重新编译项目，观察者模式会自动为我们监听文件的修改，不过不会触发浏览器刷新，还是需要我们手动刷新页面。

```json
   //package.json
   {
   		"scripts":{
   			"watch":"webpack --watch"
   		}
   }
   //如此直接运行npm run watch就可以监听变化了
```

## 使用webpack-dev-serve

---

### webpack-dev-serve提供了一个简单的web服务器，并且能够实时重新加载。

```javascript
	//安装开发依赖 npm install --save-dev webpack-dev-server
	//webpack.config.js，告诉dev server在哪里查找文件
	module.exports = {
		devServer:{
			contentBase:'./dist'
		}
	}
	//package.json
	{
		"start":"webpack-dev-server --open"
	}
```

#### 上面的配置告诉webpack-dev-server，在localhost:8080下建立服务器，将dist目录下的文件作为可访问文件。此时文件更改不仅受到监听，同时还能触发浏览器的自动刷新。

#### webpack-dev-server带有许多可配置的选项。

```javascript
	{
		//提供在服务器内部的所有其他中间件执行之前执行自定义中间件的能力，这可以用来自定义处理操作。
		before(app){
			app.get('/some/path',function(req,res){
				res.json({custom:'response'})
			})
		},
		//提供在服务器内部的所有其他中间件执行完之后执行自定义中间件的能力
		after(app){

		},
		//设置允许访问devServer服务器的白名单，以.开头可以作为子域名通配符。例如'.host1.com'，将匹配'host.com'/'www.host.com'等
		// 也可以在CLI中进行配置，如下
		//webpack-dev-server --entry /entry/file --output-path /output/path --allowed-hosts .host.com,host2.com
		allowedHosts:[
			'host.com',
			'subdomain.host.com',
			'subdomain2.host.com',
			'host2.com',
			'.host1.com'
		],
		// This option broadcasts the server via ZeroConf networking on start
		bonjour:true,
		//当使用内联模式时，在开发者工具的控制台将显示消息，如：在重新加载之前，在一个错误之前，或者模块热替换启用时，这可能显得很繁琐，可以阻止所有这些消息。可能的值有：none,error,warning或者info（默认值）
		clientLogLevel:"none",
		// 一切服务都启用gzip压缩,use in CLI: webpack-dev-server --compress
		compress : true,
		// 告诉服务器从哪里提供内容。只有在你想要提供静态文件时才需要。
		// 默认情况下使用当前工作目录作为提供内容的目录，但是可以自定义为其他目录，推荐使用绝对路径，也可以从多个目录提供内容，设置为false则表示禁用contentBase
		contentBase:path.join(__dirname,'public'),
		//当设置为true时，该选项绕过主机检查。这是不推荐的，因为不检查主机的应用程序易受DNS重新绑定攻击的影响。
		disableHostCheck:true,
		//在惰性模式中，此选项可以减少编译。默认在惰性模式，每个请求结果都会产生全新的编译。使用filename，可以只在某个文件被请求时编译。在不使用惰性模式的情况下filename没有效果。
		//如果output.filename设置为bundle.js，filename使用如下：
		lazy:true,
		filename:"bundle.js",//现在只有在请求bundle.js时候，才会编译bundle
		// 在所有响应中添加首部内容：
		headers:{
			'X-Custom-Foo':'bar'
		},
		// 当使用HTML5 History API时，任意的404响应都可能需要被替代为index.html，通过传入以下启用
		historyApiFallback:true
		//通过传入一个对象，比如使用rewrites这个选择，此行为可进一步控制：
		historyApiFallback: {
			 rewrites: [
			    { from: /^\/$/, to: '/views/landing.html' },
			    { from: /^\/subpage/, to: '/views/subpage.html' },
			    { from: /./, to: '/views/404.html' }
			 ]
		},
		// 指定使用一个host。默认是localhost。如果希望服务器外部可访问，指定如下：
		host:'0.0.0.0',
		// 启用webpack的模块热替换特性
		hot:true,
		// 启用热模块替换，在生成失败的情况下，没有页面刷新作为回退
		hotOnly:true,
		//默认情况下，dev-server通过HTTP提供服务。也可以选择带有HTTPS的HTTP/2提供服务：
		https:true,
		//以上设置使用了自签名证书，可以提供自己的：
		https:{
			 key: fs.readFileSync("/path/to/server.key"),
			 cert: fs.readFileSync("/path/to/server.crt"),
			 ca: fs.readFileSync("/path/to/ca.pem"),
		},
		// 索引文件的文件名
		index:'index.html',
		// 在dev-server的两种不同模式之间切换。默认情况下，应用程序启用内联模式。这意味着一段处理实时重载的脚本被插入到bundle中，并且构建消息将会出现在浏览器控制台。也可以使用iframe模式，它在通知栏下面使用<iframe>标签，包含了关于构建的消息。切换到iframe模式如下：
		inline: false,
		// 惰性模式，这意味着webpack不会监听任何文件的改动，启用如下：
		lazy:true,
		// 启用noInfo后，诸如【启动时和每次保存后，那些显示的webpack包(bundle)信息】的消息将被隐藏。错误和警告仍然会显示。启用如下：
		noInfo:true,
		// 当open为可用，dev server将打开浏览器
		// use in CLI: webpac-dev-server --open ['Google Chrome']
		open:true,
		// 指定在打开浏览器时导航到的页面
		// use in CLI: webpack-dev-server --open-page "/different/page"
		openPage: '/different/page',
		//在存在编译器错误或警告时在浏览器中全屏覆盖显示。默认情况下禁用，如果只显示编译器错误：
		overlay:true,
		// 如果想显示警告和错误
		overlay:{
			warnings:true,
			errors:true
		},
		// 指定要监听请求的端口号
		port: 8080,
		// 如果有单独的后端开发服务器API，并且希望在同域名下发送API请求，那么代理某些URL会很有用。
		// dev-server使用了非常强大的http-proxy-middleware包。http-proxy-middleware文档：https://github.com/chimurai/http-proxy-middleware#options
		// 在localhost:3000上有后端服务的话，可以这样启动代理：
		proxy:{
			"/api":"http://localhost:3000",
		},
		//上面设置后，请求到/api/users会被代理到请求http://localhost:3000/api/users。如果不想始终传递api，则如下：
		proxy:{
			"/api":{
				target:"http://localhost:3000",
				pathRewrite:{"^/api":""}
			}
		},
		// 默认情况下，不接受运行在HTTPS上，且使用了无效证书的后端服务器。如果想要接受，修改配置如下：
		proxy:{
			"/api":{
				target:"https://other-server.example.com",
				secure:false
			}
		},
		// 有时不想代理所有的请求，可以基于一个函数的返回值绕过代理。
		// 在函数中可以访问请求体、响应体和代理选项。必须返回false或路径，来跳过代理请求。
		// 例如：对于浏览器请求，想要提供一个HTML页面，但是对于API请求则保持代理。如下操作：
		proxy:{
			"/api":{
				targe:'http://localhost:3000',
				bypass:function(req,res,proxyOptions){
					if(req.headers.accept.indexOf("html")!== -1){
						console.log("Skipping proxy for browser request.");
						return "/index.html";
					}
				}
			}
		}
		// 将运行进度输出到控制台，只能用在命令行工具(CLI)中：webpack-dev-server --progress
		// 当使用内联模式并代理dev-server时，内联的客户端脚本并不总是知道要连接到什么地方。它会尝试根据window.location来猜测服务器的URL，但是如果失败，你需要这样。
		// 例如，dev-server被代理到nginx并且在myapp.test上可用：
		public:"myapp.test:80",
		// 设置可以在浏览器中访问的打包文件
		// 假设服务器运行在http://localhost:8080并且output.filename被设置为bundle.js。默认publicPath是"/"，所以bundle可以通过http://localhost:8080/bundle.js访问，可以修改publicPath将bundle放在一个目录：
		publicPath:"/assets/",//如此包可以通过http://localhost:8080/assets/bundle.js访问。确保publicPath总是以斜杠(/)开头和结尾。
		// 也可以使用一个完整的URL，这是模块热替换所必须的
		publicPath:"http://localhost:8080/assets/",
		// 启用quet后，除了初始启动信息外的任何内容都不会被打印到控制台。
		// useage via the CLI : webpack-dev-server --quiet
		quiet:true,
		// 用于访问express APP 对象，并添加自己的自定义中间件，示例：
		setup(app){
			app.get('/some/path',function(req,res){
				res.json({custom:'response'});
			})
		}
		//还有部分配置项，详情见：https://www.webpackjs.com/configuration/dev-server/
	}
```

## 使用webpack-dev-middleware

---

### webpack-dev-middle是一个容器，它可以把webpack处理后的文件传递给一个服务器。webpack-dev-server在内部使用了它，它也可以作为一个独立的包来使用，以便进行更多自定义设置来实现更多的需求。（注：开发中发现当安装有webpack-dev-server的时候可以直接使用webpack-dev-middleware）

#### 下面是一个使用webpack-dev-middleware配合express server的示例。

```javascript
	//安装开发依赖：npm install --save-dev express webpack-dev-middleware
	//注：安装过webpack-dev-server的不需要再安装webpack-dev-middleware，而且实际测验中安装webpack-dev-middleware后开发中会报错，语法不够新
	// 配置webpack.config.js
	const path = require('path');
	const HtmlWebpackPlugin = require('html-webpack-plugin');
	const CleanWebpackPlugin = require('clean-webpack-plugin');

	module.exports = {
		mode:'development',
		entry:{
			app:'./src/index.js',
			print:'./src/print.js'
		},
		output:{
			filename:'[name].bundle.js',
			path:path.resolve(__dirname,'dist'),
			publicPath:'/'//publicPath也会在服务器脚本用到，以确保文件资源能够在http://localhost:3000下正确访问。
		},
		devtool:'inline-source-map',
		plugins:[
			new HtmlWebpackPlugin({
				title:'hello world'
			}),
			new CleanWebpackPlugin(['dist'])
		],
		module:{
			rules:[
				{
					test:/\.css$/,
					use:['style-loader','css-loader']
				}
			]
		}
	}

	// 配置server.js服务器文件，需要自己创建
	const express = require('express');
	const webpack = require('webpack');
	const webpackDevMiddleware = require('webpack-dev-middleware');

	const app = express();
	const config = require('./webpack.config.js');
	const compiler = webpack(config);

	// Tell express to use the webpack-dev-middleware and use the webpack.config.js
	// configuration file as a base.
	app.use(webpackDevMiddleware(compiler, {
	  publicPath: config.output.publicPath
	}));

	// Serve the files on port 3000.
	app.listen(3000, function () {
	  console.log('Example app listening on port 3000!\n');
	});
	//添加一个npm script,package.json
	{
		"scripts":{
			...
			"server:express":"node server.js"
		}
	}
	//运行npm run server:express 便一个在浏览器中通过访问localhost:3000访问到该服务器
```

## 热模块替换（Hot Module Replacement 或 HRM）

---

### HRM是webpack提供的最有用的功能之一。它允许运行时更新各种模块，而无需进行完全刷新。

```javascript
	//webpack.config.js
	const path = require('path');
	const HtmlWebpackPlugin = require('html-webpack-plugin');
	const CleanWebpackPlugin = require('clean-webpack-plugin');
	const webpack = require('webpack');

	module.exports = {
		mode:'development',
		entry:{
			app:'./src/index.js',
		},
		output:{
			filename:'[name].bundle.js',
			path:path.resolve(__dirname,'dist'),
			publicPath:'/'//publicPath也会在服务器脚本用到，以确保文件资源能够在http://localhost:3000下正确访问。
		},
		devtool:'inline-source-map',
		devServer:{
			contentBase:'./dist',
			hot:true
		},
		plugins:[
			new HtmlWebpackPlugin({
				title:'hello world'
			}),
			new CleanWebpackPlugin(['dist']),
			new webpack.NamedModulesPlugin(),
			new webpack.HotModuleReplacementPlugin(),
		],
		module:{
			rules:[
				{
					test:/\.css$/,
					use:['style-loader','css-loader']
				}
			]
		}
	}
```

#### HotModuleReplacementPlugin插件，开启热模块替换插件，也被称为HMR，永远不要在生产环境下启用HMR。

#### 启用HMR非常简单，在大多数情况下也不需要配置

```javascript
	new webpack.HotModuleReplacementPlugin({
		//options....
		// multiStep(boolean):设置为true时，插件会分成两步构建文件。首先编译加载chunks，之后再编译剩余的通常的资源
		// fullBuildTimeout(number)：当multiStep启用时，表示两步构建之间的延时
		// requestTimeout(number)：下载manifest的延时
		// 这些选项属于实验性内容，因此以后可能会被弃用。就如同上文所说的那样，这些选项通常情况下都是没有必要设置的，仅仅是设置一下 new webpack.HotModuleReplacementPlugin() 在大部分情况下就足够了。
	})
```

#### NamedModulesPlugin插件，当开启HMR的时候使用该插件会显示模块的相对路径，建议用于开发环境

#### 上面的代码中，我们将print.js从入口处去掉，只留下了index.js一个入口文件，此时运行npm start 当我们修改index.js的文件时，浏览器中的页面会自动变化，而修改print.js时，浏览器中的页面并不会触发变化，因为print.js的修改没有改变index.js的事件绑定。

#### 下面修改index.js，以便print.js发生变化时可以告诉webapck接受更新的模块。

```javascript
	//index.js
	import _ from 'lodash';
	import printMe from './print';
	import './style.css'

	function component(){
		let element = document.createElement('div');
		element.innerHTML = _.join(['hello','world'],' ');
		element.classList.add('red_text');

		let btn = document.createElement('button');
		btn.innerHTML = 'click to print something';
		btn.onclick = printMe;

		element.appendChild(btn);

		return element;
	}

	let element = component();
	document.body.appendChild(element);

	if(module.hot){
		module.hot.accept('./print.js',function(){
			console.log('Accepting the updated printMe module!');
			document.body.removeChild(element);
			element = component();
			document.body.appendChild(element);
		})
	}
```

### 通过Node.js API

#### 当使用webpack dev server 和 Node.js API 时，不要将dev server选项放在webpack配置对象中。而是，在创建选项时，将其作为第二个参数传递。例如：
`new webpackDevServer(compiler,options)`

#### 想要启用 HMR，还需要修改 webpack 配置对象，使其包含 HMR 入口起点。webpack-dev-server package 中具有一个叫做 addDevServerEntrypoints 的方法，你可以通过使用这个方法来实现。这是关于如何使用的一个小例子：

```javascript
	//dev-server.js
	const webpackDevServer = require('webpack-dev-server');
	const webpack = require('webpack');

	const config = require('./webpack.config.js');
	const options = {
		contentBase:'./dist',
		hot:true,
		host:'localhost'
	}

	webpackDevServer.addDevServerEntrypoints(config,options);
	const compiler = webpack(config);
	const server = new webpackDevServer(compiler,options);

	server.listen(5000,'localhost',()=>{
		console.log('dev server listening on port 5000');
	})
```