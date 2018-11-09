# 生产环境构建——webpack官网推荐的最佳实践

#### 开发环境和生产环境的构建目标差异很大。
#### 在开发环境中，我们需要具有强大的、具有实时重载或热模块替换能力的source map 和 localhost server。
#### 在生产环境中，我们的目标则转向于关注更小的bundle，更轻量的source map，以及更优化的资源，以改善加载时间。
#### 由于要遵循逻辑分离，通常建议为每个环境编写彼此独立的webpack配置。
#### 虽然我们将生产环境和开发环境做了略微区分，但是，我们还是会遵循不重复原则，保留一个“通用”的配置。

>## 指定环境

####通常library通过与`process.env.NODE_ENV`环境变量关联，以决定library中应该引入哪些内容。这里可以使用webpack内置的`DefinePlugin`为所有的依赖定义这个变量。

```javascript
	//webpack.prod.js
	const webpack = require('webpack');

	module.exports = merge(common,{
		plugins:[
			new webpack.DefinePlugin({
				'process.env.NODE_ENV':JSON.stringify('production')
			})
		]
	})
```

#### `NODE_ENV`是一个由node.js暴露给执行脚本的系统环境变量。通常用于决定在开发环境与生产环境下，服务器工具、构建脚本和客户端library的行为。然而，与预期不同的是，无法再构建脚本webpack.config.js中，将process.env.NODE_ENV设置为'production'，因此，例如`process.env.NODE_ENV === 'production' ? '[name].[hash].bundle.js' : '[name].bundle.js'` 这样的条件语句，在 webpack 配置文件中，无法按照预期运行。

>### DefinedPlugin用法

#### DefinedPlugin允许创建一个在编译时可以配置的全局变量。
#### 这样对开发模式和发布模式的构建允许不同行为非常有用。如果在开发构建中，而不再发布构建中执行日志记录，则可以使用全局常量来决定是否记录日志。这就是DefinedPlugin的用处，设置它，就可以顽疾开发阿和发布构建的规则。 

```javascript
	new webpack.DefinedPlugin({
		//definitions...
	})
```

#### 每个传进`DefinedPlugin`的键值都是一个标志符或者多个用`.`连接起来的标志符。

- 如果这个值是一个字符串，它会被当做是一个代码片段来使用。
- 如果这个值不是字符串，它会被转化为字符串(包括函数)。
- 如果这个值是一个对象，它所有的key会被同样的方式定义。
- 如果在一个key前面加了typeof，它会被定义为typeof调用。

#### 这些值会被内联进那些允许传一个代码压缩参数的代码中，从而减少冗余的条件判断。

```javascript
	new webpack.DefinedPlugin({
		PRODUCTION:JSON.stringify(true),
		VERSION:JSON.stringify('5fakj'),
		BROWSER_SUPPORTS_HTML5:true,
		TWO:"1+1",
		"typeof window": JSON.stringify('object')//对于这个定义还未了解到如何引用
	})
	//上面定义的变量可以在所有js文件中直接打印
```

#### 注：因为这个插件直接执行文本替换，给定的值必须包含字符串本身内的实际引号。通常，有两种方式来达到这个效果，使用'"production"'，或者使用JSON.stringify('production')。

#### cli替代处理，以上描述可以在命令行实现，例如：`--optimize-minimize`标记将在后台引用`UglifyJSPlugin`。和以上描述的`DefinePlugin`实例相同，`--define process.evn.NODE_ENV = '"procution"'`也会做同样的事情。并且`webpack -p`将自动地调用上述这些标记，从而调用需要引入的插件。

#### 不推荐上面的做法，还是写在配置文件中能让我们更清晰地了解自己的逻辑。

>## 代码分离

#### 代码分离是webpack中最引人注目的特性之一，此特性能够把代码分离到不同的bundle中，然后可以按需加载或并行加载这些文件。代码分离可以用于获取跟小的bundle，以及控制资源加载优先级。如果使用合理，会极大影响加载时间。

#### 有三种常用的代码分离方法：
- 入口起点：使用entry配置手动地分离代码。
- 防止重复：使用CommonsChunkPlugin去重和分离chunk。
- 动态导入： 通过模块的内联函数调用来分离代码。


>### 入口起点

#### 这是目前最简单、最直观的分离代码的方式。不过这种方式手动配置较多，并且有一些陷阱。

- 如果入口chunks之间包含重复的模块，那些重复模块都会被引入到各个bundle中。
- 这种方法不够灵活，并且不能将核心应用程序逻辑进行动态拆分代码。

#### 以上两点中，第一点例如我们在`index.js`和`another.module.js`中都引用了，这样就会造成重复引用，所以接下来就需要使用`CommonsChunkPlugin`来移除重复的模块。

>### 防止重复

#### CommonsChunkPlugin插件可以将公共的依赖模块提取到已有的入口chunk中，或者提取到一个新生成的chunk。

```javascript
	//webpack.config.js
	const webpack = require('webpack');
	plugins:[
		new webpack.optimize.CommonsChunkPlugin({
			name:'common'//指定公共bundle的名称
		})
	]
```

#### 注意：按照官网试验后提示：`Error: webpack.optimize.CommonsChunkPlugin has been removed, please use config.optimization.splitChunks instead.`，应该已经弃用，使用splitChunks了。

>### 动态导入
