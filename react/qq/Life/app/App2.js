import React,{Component} from "react";

class App2 extends Component{
    constructor(){
        super();
    }
    handleChange(event){
        this.refs.box.style.backgroundColor='yellow';
    }
    render(){
        let temp_style={
            box:{
                width:200,
                height:200,
                margin:20,
                backgroundColor:'red',
            },
            btn:{
                width:160,
                height:50,
                marginLeft:20,
            }
        }
        return(
                <div>
                    <h1>这是app2组件，演示DOM钩子refs</h1>
                    <button style={temp_style.btn} onClick={(this.handleChange).bind(this)}>点击我修改下面盒子颜色</button>
                    <div ref='box' style={temp_style.box}></div>
                </div>
            );
    }
}
export default App2;