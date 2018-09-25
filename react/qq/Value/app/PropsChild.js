import React,{Component} from "react";
import PropTypes from "prop-types";

class PropsChild extends Component{
    constructor(props,context){//构造函数会传入两个参数，第一个是props属性，第二个是context属性
        super();
        console.log('我来自constructor:'+props.a);

        this.state={
            b:props.b,
            d:props.d,
        };
    }
    changeD(){
        this.setState({d:this.state.d+1});

        this.props.setD(this.state.d+1);//此处this.state.d还是上一个，不是加一以后的，所以还要用+1，但d的值不会多加一，因为只有setState可以修改state的值
    }
    /*接收到的props属性只读，不可在子组件中修改，用state接收，改变state实现修改效果*/
    render(){
        return (
            <div>
                <h2>我是props子组件</h2>
                <p>我接收到一个属性值：{this.props.a}</p>
                <p>{this.state.b}</p>
                <button onClick={()=>{this.setState({b:this.state.b+1})}}>+</button>
                <p>我是传递给父组件的值：{this.state.d}</p>
                <button onClick={(this.changeD).bind(this)}>+</button>
            </div>
            );
    }
}
//验证传入的props属性
PropsChild.propTypes={
    a:PropTypes.string.isRequired,
    b:PropTypes.number.isRequired
}
export default PropsChild;