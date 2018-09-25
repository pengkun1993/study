import React,{Component} from "react";

class App1 extends Component{
    constructor(){
        super();
        this.state={
            'text':'',
        };
    }
    handleChange(event){
        this.setState({text:event.target.value});
    }
    render(){
        return(
                <div>
                    <h1>我是app1,演示双向绑定</h1>
                    <input type="text" value={this.state.text} onChange={(this.handleChange).bind(this)}/>
                    <p>这里和输入框中内容一样：{this.state.text}</p>
                </div>
            )
    }
}

export default App1;