import React,{Component} from "react";
import PropTypes from "prop-types";

class Context2 extends Component{
    constructor(props,context){
        super();
        console.log(context);
    }
    render(){
        return(
                <div>
                    <h3>这是context1的组件</h3>
                    <p>获取到context传递的值：{this.context.a}</p>
                    <p>通过“...”获得context的color值：{this.props.color}</p>
                </div>
            )
    }
    //获取上下文环境
    getContext(){

    }
}
//获取上下文环境，并决定接收哪些值
Context2.contextTypes={
    a:PropTypes.number.isRequired,
}
export default Context2;