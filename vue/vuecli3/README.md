# vuecli3 测试项目

##### 主要用于对vue-cli 3.0探索和基于vue-cli 3.0的测试研究

### vue-cli-service serve

##### vue-cli-service serve命令会启动一个开放服务器（基于[webpack-dev-serve](https://webpack.docschina.org/guides/development/#%E4%BD%BF%E7%94%A8-webpack-dev-server)）并附带开箱即用的热模块重载。

##### 除了通过命令行参数，也可以使用vue.config.js里的devServer字段配置开发服务器。

```bash

  用法： vue-cli-service serve [option] [entry]

  选项：
        --open 在服务器启动时打开浏览器
        --copy 在服务器启动时将URL复制到剪贴板
        --mode 指定环境模式（默认值：development)
        --host 指定host(默认值： 0.0.0.0)
        --port 指定port(默认值： 8080)
        --https 使用https(默认值： false)

```

### vue-cli-service build

##### vue-cli-service build 会在dist/目录产生一个可用于生产环境的包，带有js/css/html的压缩，和为更好的缓存而做的自动的vendor chunk splittion。它的chunk manifest会内联在html里。

```bash
  
  用法：vue-cli-service build [options] [entry|pattern]

  选项：
        --mode 指定环境模式（默认值：production)
        --dest 指定输出目录（默认值：dist)
        --modern 面向现代浏览器自动回退地构建应用
        --target app | lib | wc | wc-async (默认值：app)
        --name 库或Web Components 模式下的名字（默认值：package.json中的“name”字段或入口文件名）
        --no-clean 在构建项目之前不清除目标目录
        --report 生成report.html 以帮助分析包内容
        --report-json 生成report.json以帮助分析包内容
        --watch 监听文件变化

```

### vue-cli-service inspect

##### 可以使用vue-cli-service inspect来审查一个Vue CLI项目的webpack config。

```bash

  用法：vue-cli-service inspect [options] [...paths]

  选项：
        --mode 指定环境模式（默认值：development)

```

### HTML和静态资源

public/index.html文件是一个会被html-webpack-plugin处理的模板。在构建过程中，资源链接会被自动注入。另外，vue cli也会自动注入resource hint以及构建过程中处理的JavaScript和css文件的资源链接。

因为index文件被用作模板，所以可以使用lodash template语法插入内容，除了被html-webpack-plugin暴露的默认值外，所有客户端环境变量也可以直接使用。

```html

  <link rel="icon" href="<%= BASE_URL %>favicon.ico">

```

#### 处理静态资源

静态资源可以通过两种方式进行处理：

- 在JavaScript被导入或在template/css中通过相对路径被引用。这类引用会被webpack处理。
- 放置在public目录下或通过绝对路径被引用。这类资源将会直接被拷贝，而不会经过webpack的处理。

##### 从相对路径导入

当在JavaScript、css或*.vue文件中使用相对路径（必须以.开头）引用一个静态资源时，该资源将会被包含进webpack的依赖图中。在其编译过程中，所有诸如`<img src="...">`、`background:url(...)`和`@import`的资源URL都会被解析为一个模块依赖。

```javascript

  url(./image.png);  /*被翻译为*/ require('./image.png');

  <img src="./image.png">

  // 被翻译为：
   
  h('img', { attrs: {src: require('./image.png')}});

```

在其内部，通过file-loader用版本哈希值和正确的公共基础路径来决定最终的文件路径，再用url-loader将小于4kb的资源内联，以减少http请求的数量。

##### URL转换的规则

- 如果URL是一个绝对路径（例如`/images/foo.png`），它将会被保留不变。
- 如果URL以`.`开头，它会作为一个相对模块请求被解释且基于文件系统中的目录结构进行解析。
- 如果URL以`~`开头，其后的任何内容都会作为一个模块请求被解析。

##### public文件夹

任何放置在public文件夹的静态资源都会被简单的复制，而不经过webpack。需要通过绝对路径来引用它们。

public目录提供的是一个应急手段，当你通过绝对路径引用它时，留意应用将会部署到哪里。如果应用没有部署在域名的根部，那么需要为URL配置[publicPath](https://cli.vuejs.org/zh/config/#publicpath)前缀。

### CSS相关

vue CLI项目天生支持PostCSS、CSS Modules和包含Sass/Less/Stylus在内的预处理器。

所有编译后的CSS都会通过css-loader来解析其中的url()引用，并将这些引用未做模块请求来处理。这意味着可以根据本地的文件结构用相对路径来引用静态资源。

### webpack相关

##### 调整webpack配置最简单的方式就是在vue.config.js中的configureWebpack选项提供一个对象

```javascript

  module.exports = {
    configureWebpack: {
      plugins: [
        new MyAwesomeWebpackPlugin()
      ]
    }
  }

```

注：有些webpack选项是基于vue.config.js中的值设置的，所以不能直接修改。例如应该修改vue.config.js中的`outputDir`选项而不是修改`output.path`；应该修改vue.config.js中的`publicPath`选项而不是修改`output.publicPath`。这样做是因为vue.config.js中的值会被用在配置里的多个地方，以确保所有的部分都能正常工作。

##### 如果需要基于环境有条件地配置行为，或者想要直接修改配置，那就换成一个函数（该函数会在环境变量被设置之后懒执行）。该方法的第一个参数会收到已经解析好的配置。

```javascript

  module.exports = {
    configureWebpack: config => {
      if (process.env.NODE_ENV === 'production') {
        // 为生产环境配置
      } else {
        // 为开发环境配置
      }
    }
  }

```

##### 链式操作

Vue CLI内部的webpack配置是通过webpack-chain维护的。这个库提供了一个webpack原始配置的上层抽象，使其可以定义具名的loader规则和具名插件，并有机会在后期进入这些规则并对它们的选项进行修改。

它允许我们更细粒度的控制其内容配置。

```javascript

  module.exports = {
    chainWebpack: config => {
      // 修改loader选项
      config.module
        .rule('vue')
        .use('vue-loader')
          .loader('vue-laoder')
          .tap(options => {
            // 修改它的选项
            return options
          })
      // 添加一个新的loader
      config.module
        .rule('graphql')
        .test('/\.graphql$/')
        .use('graphql-tag/loader')
          .loader('graphql-tag/loader')
          .end()
      // 替换一个规则里的loader
      const svgRule = config.module.rule('svg');

      // 清除已有的所有loader
      // 如果不这样做，接下来的loader会附加在改规则现有的loader之后。
      svgRule.uses.clear()

      // 添加要替换的loader
      svgRule.use('vue-svg-loader').loader('vue-svg-loader')

      // 修改插件选项
      config
        .plugin('html')
        .tap(args => {
          return [/* 传递给 html-webpack-plugin's构造函数的新参数 */]
        })
    }
  }

```

##### 审查项目的webpack配置

因为`@vue/cli-service`对webpack配置进行了抽象，所以理解配置中包含的东西会比较困难。尤其是当打算自行对其调整的时候。

vue-cli-service暴露了inspect命令用于审查解析好的webpack配置。那个全局的vue可执行程序同样提供了inspect命令，这个命令只是简单的把`vue-cli-service inspect`代理到了项目中。

```bash

  // 将配置输出重定向到一个文件
  vue inspect > output.js

```

### 环境变量和模式

可以替换项目根目录中的下列文件来指定环境变量：

```bash

  .env # 在所有环境中被载入
  .env.local # 在所有的环境中被载入，但会被git忽略
  .env.[mode] # 只在指定的模式中被载入
  .env.[mode].local # 只在指定的模式中被载入，但会被git忽略

```

一个环境文件只包含环境变量的“键=值”对：

```

  FOO = bar
  VUE_APP_SECRET = secret

```

##### 模式

模式是Vue CLI项目中的一个重要的概念。默认情况下，一个Vue CLI项目有三个模式：

- `development`模式用于`vue-cli-service serve`
- `production`模式用于`vue-cli-service build`和`vue-cli-service test:e2e`
- `test`模式用于`vue-cli-service test:unit`

注： 模式不同于`NODE_ENV`，一个模式可以包含多个环境变量。也就是说，每个模式都会将`NODE_ENV`的值设置为模式的名称。

可以通过传递`--mode`选项参数为命令行覆写默认的模式。

```json

  # 例如，在构建命令中使用开发环境变量

  "dev-build": "vue-cli-service build --mode development"

```

示例：假设有一个应用包含`.env`文件：`VUE_APP_TITLE=My App`和`.env.staging`文件：`NODE_ENV=production;VUE_APP_TITLE=My App`

则加载规则如下：

- `vue-cli-service build`会加载可能存在的`.env/.evn.production/.env.production.local`文件然后构建出生产环境的应用
- `vue-cli-service build --mode staging`会在staging模式下加载可能存在的`.env/.env.staging/.evn.staging.local`文件然后构建出生产环境的应用

这两种情况根据`NODE_ENV`构建出的应用都是生产环境的。

##### 在客户端侧代码中使用环境变量

只有以`VUE_APP_`开头的变量会被`webpack.DefinePlugin`静态嵌入到客户端侧的包中。在应用中可以按照如下访问：

```javascript

  console.log(process.env.VUE_APP_SECRET);

```

除了`VUE_APP_*`变量之外，在你的应用代码中始终可用的还有两个特殊的变量：

- `NODE_ENV` - 会是`development/production/test`中的一个。具体的值取决于运行的模式。
- `BASE_URL` - 会和`vue.config.js`中的`publicPath`选项相符，即应用会部署到基础路径。

所有解析出来的环境变量都可以在`public/index.html`中以[HTML插值](https://cli.vuejs.org/zh/guide/html-and-static-assets.html#%E6%8F%92%E5%80%BC)的方式使用。





















