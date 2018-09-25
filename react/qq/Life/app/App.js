import React,{Component} from "react";

class App extends Component{
    constructor(props,context){
        super();
        props.name='kun';
        this.state={
            s_a:'aa',
            random_num:1,
        };
        this.props={//这种方法不行，此处this.props为未定义，setProps()也没用
            t_a:'p',
        }
    }
    getInitialState(){//这个方法，在这里并没有用处
        return {
            get_i_s:'get',
        }
    }
    getDefaultProps(){//这个方法，在这里也没有用
        return {
            get_d_p:'props',
        }
    }
    //组件挂载前将被调用
    componentWillMount(){
        alert('will Mount');
    }
    //组件挂载后将被调用，对DOM节点的初始化操作应该放在这里
    componentDidMount(){
        alert('Did Mount');
    }
    //当组件作出是否更新DOM的决定的时候被调用，必须返回true或false,实现该函数可以优化this.props和nextprops，以及this.state和nextState比较。
    shouldComponentUpdate(nextProps,nextState){//参数是一个对象，包含所有的属性值，不论是否发生变化
        if(nextState.random_num>0.5){
            return true;//更新
        }
        alert('本次为'+nextState.random_num+'没有大于0.5，不予显示');    
        return false;//不更新
    }
    //在更新将要发生时调用，更新的发生已是必然，无法阻止
    componentWillUpdate(){
        alert('will update');
    }
    //在更新发生之后调用
    componentDidUpdate(){
        alert('Did update');
    }
    //在组件将被移除之前调用
    componentWillUnmount(){
        alert('will unmount');
    }
    // shouldRevice
    render(){
        return(
                <div>
                    <h1>组件的生命周期</h1>
                    <p>props默认属性：{this.props.name}</p>
                    <p>'this.props'不能设置值：{this.props.t_a}</p>
                    <p>state默认值：{this.state.s_a}</p>
                    <p>'getInitalState'在这里也没用：{this.state.get_i_s}</p>
                    <h2>可变化的state值：{this.state.random_num}</h2>
                    <button style={{width:100,height:40}} onClick={()=>{this.setState({random_num:Math.random()})}}>点击</button>
                </div>
            );
    }
}

export default App;