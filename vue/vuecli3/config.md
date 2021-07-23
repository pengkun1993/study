# Vue CLI配置参考

有些针对`@vue/cli`的全局配置，例如惯用的包管理器和本地保存的preset，都保存在home目录下一个名叫`.vuerc`的JSON文件。可以直接用编辑这个文件来更改已保存的选项。

可以使用`vue config`命令审查或修改全局的cli配置。

### vue.config.js

vue.config.js是一个可选的配置文件，如果项目根目录(和package.json同级)存在这个文件，那么`@vue/cli-service`会自动加载它。也可以使用package.json中的vue字段，但是注意这种写法需要严格遵照JSON的格式来写。

```javascript

  // vue.config.js
  module.exports = {
    // 选项
  }

```

### publicPath

- type: `String`
- Default: `'/'`

部署应用包时的基本URL。用法和webpack本身的`output.publicPath`一致，但是vue cli在一些其他地方也需要用到这个值，所以要始终使用`publicPath`而不要直接修改webpack的`output.publicPath`。

默认情况下，vue cli会假设应用部署在一个域名的根路径上，如：`https://www.my-app.com/`。如果应用部署在一个字路径上，就需要用这个选项指定这个子路径。如：`https://www.my-app.com/my-app/`，则设置publicPath为`/my-app/`。

这个值也可以被设置为空字符串(`''`)或者相对路径(`./`)，这样所有的资源都会被链接为相对路径，这样打出来的包可以部署在任意路径。

注： 一下情况应避免使用相对publicPath: 

- 当使用基于html5`history.pushState`的路由时
- 当使用`page`选项构建多页面应用时

示例：这个值在开发环境下同样生效，如果想开发服务器架设在根路径，而生产服务器不在，可如下设置

```javascript

  module.exports = {
    publicPath: process.env.NODE_ENV === 'production'
      ? '/production-sub-path'
      : '/'
  }

```

### outputDir

- type: `String`
- Default: `'dist'`

当运行`vue-cli-service build`时生成的生产环境构建文件的目录。注意目标目录会在构建之前被清除（构建时传入`--no-clean`可关闭该行为）

### assetsDir

- type: `String`
- default: `''`

放置生成的静态资源(js/css/img/fonts)的（相对于`outputDir`的）目录

### inputPath

- type: `String`
- default: `'index.html'`

指定生成的index.html的输出路径（相对于outputDir)。也可以是一个绝对路径。

### filenameHashing

- type: `Boolean`
- default: `true`

默认情况下，生成的静态资源在它们的文件名中包含了hash以便更好的控制缓存。然而，这要求index的html是被vue cli自动生成的。如果无法使用vue cli生成的index HTML，可以通过将这个选项设置为`false`来关闭文件哈希。

### pages

- type: `Object`
- default: `undefined`

在multi-page模式下构建应用。每个page应该有一个对应的JavaScript入口文件。其值应该是一个对象，对象的key是入口的名字，value是：

- 一个指定`entry/template/filename/title/chunks`的对象（除了`entry`之外都是可选的)
- 或一个指定entry的字符串

```javascript

  module.exports = {
    pages: {
      index: {
        // page的入口
        entry: 'src/index/main.js',
        // 模板来源
        template: 'public/index.html',
        // 在dist/index.html的输出
        filename: 'index.html',
        // 当使用title选项时，template中的title标签需要是<title><%= htmlWebpackPlugin.options.title %></title>
        title: 'Index Page',
        // 在这个页面中包含的块，默认情况下会包含提取出来的通用chunk和vendor chunk
        chunks: ['chunk-vendors', 'chunk-common', 'index']
      },
      // 如果使用只有入口的字符串格式时，模板会被推到为`public/subpage.html`,并且如果找不到的话，就回退到`public/index.html`,输出文件名会被推导为`subpage.html`
      subpage: 'src/subpage/main.js'
    }
  }

```

### lintOnSave

- type: `Boolean | 'error'`
- defualt: `true`

是否在开发环境下通过eslint-loader在每次保存时lint代码。这个值会在`@vue/cli-plugin-eslint`被安装之后生效。

设置为`true`时，`eslint-loader`会将lint错误输出为编译警告。默认情况下，警告仅仅会被输出到命令行，且不会使得编译失败。

如果希望让lint错误在开发时直接显示在浏览器中，可以使用`lintOnSave: 'error'`。这会强制`eslint-loader`将lint错误输出为编译错误，同时也意味着lint错误将会导致编译失败。

或者，可以通过设置让浏览器overlay同时显示警告和错误：

```javascript

  // vue.config.js
  
  module.exports = {
    devServer: {
      overlay: {
        warnings: true,
        errors: true
      }
    }
  }

```

当`lintOnSave`是一个truthy的值时，`eslint-loader`在开发和生成构建下都会被启用。如果想要在生产构建时禁用`eslint-loader`，配置如下：

```javascript

  // vue.config.js
  module.exports = {
    lintOnSave: process.env.NODE_ENV !== 'production'
  }

```

### runtimeCompiler

- type: `Boolean`
- default: `false`

是否使用包含运行时编译器的vue构建版本。设置为true后就可以在vue组件中使用`template`选项了，但是这会让你的应用额外增加10kb左右。

### transpileDependencies

- type: `Array<string | RegExp>`
- default: `[]`

默认情况下`babel-loader`会忽略所有`node_modules`中的文件。如果想要通过babel显式转译一个依赖，可以在这个选项中列出来。

### productionSourceMap

- type: `Boolean`
- default: `true`

如果需要生产环境的source map，可以将其设置为`false`以加速生成环境的构建。

### crossorigin

- type: `String`
- default: `undefined`

设置生成的HTML中`<link rel="stylesheet">`和`<script>`标签的`crossorigin`属性。

需要注意的是该选项仅影响由`html-webpack-plugin`在构建时注入的标签-直接卸载模板(`public/index.html`)中的标签不受影响。

### integrity

- type: `Boolean`
- default: `false`

在生成的html中的`<link rel="stylesheet">`和`<script>`标签上启用subresource integrity(SRI)。如果构建后的文件时部署在CDN上的，启用该选项可以提供额外的安全性。

注：该选项仅影响`html-webpack-plugin`在构建时注入的标签-直接写在模板中的标签不受影响。

### configureWebpack

- type: `Object | Function`

如果这个值是一个对象，则会通过webpack-merge合并到最终的配置中。

如果这个值是一个函数，则会接收解析的配置作为参数。该函数及可以修改配置并不返回任何东西，也可以返回一个被克隆或合并过的配置版本。

### chainWebpack

- type: `Function`

是一个函数，会接收一个基于webpack-chain的ChainableConfig实例。允许对内部的webpack配置进行更细粒度的修改。

### css.requireModuleExtension

- type: `Boolean`
- default: `true`

默认情况下，只有`*.module.[ext]`结尾的文件才会被视为CSS Modules模块。设置为false后就可以去掉文件名中的`.module`并将所有的`*.(css|scss|sass|styl(us)?)`文件视为CSS Modules模块。

### css.extract

- type: `Boolean | Object`
- default: 生产环境是`true`，开发环境是`false`

是否将组件中的CSS提取至一个独立的CSS文件中(而不是动态注入到JavaScript中的inline代码)。

同样当构建Web Components组件时它总是会被禁用

当作为一个库构建时，可以将其设置为`false`免得用户自己导入css

提取CSS在开发环境模式下是默认不开启的，因为它和CSS热重载不兼容。

### css.sourceMap

- type: `Boolean`
- default: `false`

是否为css开启source map。设置为`true`之后可能会影响构建的性能。

### css.loaderOptions

- type: `Object`
- default: `{}`

向css相关的loader传递选项。例如：

```javascript

  module.exports = {
    css: {
      loaderOptions: {
        css: {
          // 这里的选项会传递给 css-loader
        },
        postcss: {
          // 这里的选项会传递给 postcss-loader
        }
      }
    }
  }

```

支持的loader有 `css-loader/postcss-loader/sass-loader/less-loader/stylus-loader`

另外，也可以使用`scss`选项，针对`scss`语法进行单独配置(区别于`sass`语法)。

### devServer

- type: `Object`

所有的`webpack-dev-server`的选项都支持。

注：有些值像 `host/port/https`可能会被命令行参数覆写。有些值像`publicPath`和 `historyApiFallback`不应该被修改，应为它们需要和开发服务器的publicPath同步以保障正常的工作。

### devServer.proxy

- type: `String | Object`

如果前端应用和后端api服务器没有运行在同一个主机上，需要在开发环境下将api请求代理到api服务器。这个问题可以通过`vue.config.js`中的`devServer.proxy`选项来配置

```javascript

  module.exports = {
    devServer: {
      proxy: 'http://localhost: 4000'
    }
  }

```

这会告知开发服务器将任何未知请求（没有匹配到静态文件的请求）代理到`http://localhost:4000`

如果想要更多的代理控制行为，可以使用一个`path: options`成对的对象。完成的选项可以查看[webpack配置](https://webpack.docschina.org/configuration/dev-server/#devserver-proxy)

### parallel

- type: `Boolean`
- default: `require('os').cpus().length > 1`

是否为Babel或TypeScript使用`thread-loader`。该选项在系统的CPU有多于一个内核时自动启用，仅作用于生产构建。

### pwa

- type: `Object`

向[PWA插件](https://github.com/vuejs/vue-cli/tree/dev/packages/%40vue/cli-plugin-pwa)传递选项。

### pluginOptions 

- type: `Object`

这是一个不进行任何schema验证的对象，因此它可以用来传递任何第三方插件选项。如：

```javascript

  module.exports = {
    pluginOptions: {
      foo: {
        // 插件可以作为`optinos.pluginOptions.foo`访问这些选项
      }
    }
  }

```

### Babel

babel可以通过`babel.config.js`进行配置

vue cli使用了Babel7中的新配置格式`babel.config.js`。和`.babelrc`或`package.json`中的`babel`字段不同，这个配置文件不会使用基于文件位置的方案，而是会一致地运用到项目跟目录以下的所有文件，包括`node_modules`内部的依赖。推荐在vuecli项目中始终使用`babel.config.js`取代其他格式。

### ESLint

ESLint可以通过`.eslintrc`或`package.json`中的`eslintConfig`字段来配置。
















