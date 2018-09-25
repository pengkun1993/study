import React from "react";
import {render} from "react-dom";
import App from "./App.js";//这块用什么名字接收下面就用什么名字，建议文件名，接收名一致

render(
	<App></App>,
	document.getElementById('app-container')
	);