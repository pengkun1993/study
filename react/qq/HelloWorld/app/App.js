import React, {Component} from "react";
//自定义组件必须是大写字母开头
////必须继承Component
class App extends Component{//若上面没有{component},此处用React.Component
	haha(){
		return <ul>
				<li>你好</li>
				<li>你好</li>
				<li>你好</li>
			   </ul>;
	}
	render(){//注意此处用 “方法名（参数）{}”
		let xixi= ()=>{
			return	(<ol>
						<li>xixi</li>
					</ol>);
		};
		return <div>
					<h1>我是React，hello people</h1>
					{this.haha()}
					{xixi()}
				</div>;
	}
}
//向外暴露，也可以直接放在加载第4行class前面 
export default App;