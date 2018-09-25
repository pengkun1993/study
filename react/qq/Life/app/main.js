import React,{Component} from "react";
import {render} from "react-dom";
import App from "./App.js";
import App1 from "./App1.js";
import App2 from "./App2.js";

render(
        <div>
            <App />
            <App1 />
            <App2 />
        </div>,
        document.getElementById('app-container')
    )