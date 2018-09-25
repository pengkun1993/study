import React,{Component} from "react";
import Context1 from "./Context1.js";
import PropTypes from "prop-types";

class Context extends Component{
    constructor(){
        super();
        this.state={
            a:11,
        };
    }
    render(){
        return (
                <div>
                    <h1>我是Context组件</h1>
                    <Context1 {...this.props}></Context1>
                </div>
            )
    }
    //得到孩子的上下文环境，返回一个对象，实际上表示一直设置，家族体系共享的。
    getChildContext(){
        return {
            a:this.state.a,
            b:12
        };
    }
}
//设置child的上文的类型
Context.childContextTypes={
    a:PropTypes.number.isRequired,
    b:PropTypes.number.isRequired,
}

export default Context;

// context值类型，主要是可以跨级传递，放入上下文中
// 当祖先元素中更改了上下文的数据，此时所有的子孙元素中的数据都会更改，视图也会更新；
// 反之不成立，可以认为上下文的数据在子孙元素中是只读的。此时又需要使用函数，就是在context中共享一个操作祖先元素的函数，子孙元素哦谈过上下文获取这个函数，从而操作祖先元素的值。
// state是自治的不涉及传值的事儿，props是单向的，父亲->儿子;context也是单向的，祖先->后代。如果要反向就传入一个函数。
// 若传递的是一个引用类型的值，则一变都变