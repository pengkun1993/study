import React,{Component} from "react";

class State extends Component{
    constructor(){
        super();

        this.state={//state属性的改变可以引起视图的变化，即重新渲染
            a:100
        }
    }
    getInitialState(){//初始默认状态设置,这里似乎不可用，h1中并不显示
        return {
            cc:'122'
        }
    }
    add(){
        this.setState({a:this.state.a+1});//不能写this.state.a++，state属性只读，只能通过setState修改
    }
    render(){
        return (
                <div>
                    <h1>我是State组件{this.state.cc}</h1>
                    <p>状态{this.state.a}</p>
                    <button onClick={(this.add).bind(this)}>+</button>
                </div>
            )
    }
}
export default State;