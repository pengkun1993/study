import React,{Component} from "react";
import Context2 from "./Context2.js";

class Context1 extends Component{
    constructor(props,context){
        super();
        console.log(context);
    }
    render(){
        return(
                <div>
                    <h2>这是context的组件</h2>
                    <Context2 {...this.props}></Context2>
                </div>
            )
    }
}

export default Context1;