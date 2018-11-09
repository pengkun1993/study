/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
import _ from 'lodash';
import printMe from './print';
import './style.css'

function component(){
	let element = document.createElement('div');
	element.innerHTML = _.join(['hello','world'],' ');
	element.classList.add('red_text');

	let btn = document.createElement('button');
	btn.innerHTML = 'click to print something';
	btn.onclick = printMe;

	element.appendChild(btn);

	return element;
}

let element = component();
document.body.appendChild(element);
console.log(module.hot,999999999999)
if(module.hot){
	module.hot.accept('./print.js',function(){
		console.log('Accepting the updated printMe module!');
		document.body.removeChild(element);
		element = component();
		document.body.appendChild(element);
	})
}