import React from "react";
import {render} from "react-dom";
import Error from "./Error.js"
import State from "./State.js";
import Props from "./Props.js";
import Context from "./Context.js";//这块用什么名字接收下面就用什么名字，建议文件名，接收名一致

render(
    <div>
        <Error></Error>
        <State></State>
        <Props></Props>
        <Context color='red'></Context>
    </div>,
	document.getElementById('app-container')
	);