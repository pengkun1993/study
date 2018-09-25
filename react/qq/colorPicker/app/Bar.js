import React,{Component} from "react";

class Bar extends Component{
    constructor(props){
        super();
        this.state={
            value:0,
        }

        this.handleChange=(this.handleChange).bind(this);

    }
    handleChange(event){
        this.setState({value:event.target.value});

        this.props.v(this.props.color,event.target.value);
    }
    render(){
        let theStyles={
            range:{
                width:100,
                height:20,
                margin:10,
                verticalAlign:'middle',
            },
            number:{
                width:50,
                height:20,
                verticalAlign:'middle',
            }
        }
        return(
                <div>
                    <input style={theStyles.range} type="range" value={this.state.value} onChange={this.handleChange} min='0' max='255'/>
                    <input style={theStyles.number} type="number" min='0' max='255' value={this.state.value} onChange={this.handleChange} />
                </div>
            )
    }
}

export default Bar;