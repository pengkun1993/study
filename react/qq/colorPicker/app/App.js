import React,{Component} from "react";
import Bar from "./Bar";

class App extends Component{
    constructor(){
        super();
        this.state={
            r:0,
            g:0,
            b:0,
        }

        this.getValue=(this.getValue).bind(this);

        this.bars=['r','g','b'].map((value,index)=>{
           return <Bar color={value} v={this.getValue} />
        });
    }
    getValue(col,val){
        this.setState({[col]:parseInt(val)});
        console.log(this.state);
    }
    render(){
        let theStyles={
            colorBox:{
                width:200,
                height:200,
                
                backgroundColor:`rgb(${this.state.r},${this.state.g},${this.state.b})`,
                boxShadow:'0 0 10px #000',
                margin:'10px 0',
            }
        }
        return(
                <div>
                   <div style={theStyles.colorBox}></div>
                   {this.bars}
                </div>
            )
    }
}

export default App;