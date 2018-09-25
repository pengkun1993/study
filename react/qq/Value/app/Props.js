import React,{Component} from "react";
import PropsChild from "./PropsChild.js";

class Props extends Component{
    constructor(props){
        super();
        this.state={
            d:1
        }
        props.name='run';
        this.name='runboob';
    }
    setD(num){console.log(this);
        this.setState({d:num});
    }
    //a传过去是字符串，b传过去是数字
    render(){
        return (
                <div>
                    <h1>我是props组件</h1>
                    <PropsChild a='666' b={666} setD={(this.setD).bind(this)} d={this.state.d}></PropsChild>
                    <p>我是一个可以被子组件改变的值，我的值是：{this.state.d}</p>
                    <p>默认属性name:{this.props.name}</p>
                </div>
            )
    }
}
export default Props;

// 子组件要把数据返回给父组件，就只能通过父组件传一个函数给子组件，子组件通过传参调用函数从而修改父组件中的state等值