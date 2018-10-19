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

document.body.appendChild(component());