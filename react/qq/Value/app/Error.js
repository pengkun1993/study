import React,{Component} from "react";

class Error extends Component {
	//构造函数
	constructor() {
		super(); //必须调用super();
		this.a = 100; //这是给组件设置了一个属性，组件自己的属性变化 不会引起视图的变化
	}
	add() {
		this.a++;console.log('a='+this.a);
	}
	render() {
		let b = 99; //闭包属性变化也不会引起视图变化
		return <div>
                    <h1>我是error示例组件</h1>
    			 	<p>{this.a}</p>
    			 	<button onClick={(this.add).bind(this)}>+</button>	
    			 	<p>{b}</p>
    			 	<button onClick={()=>{b++;console.log('b='+b);}}>+</button>						
				</div>;
	}
}

export default Error;
// 上面的两种赋值，基本没有用处，主要用state,props,context