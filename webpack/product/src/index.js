/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
import _ from 'lodash';

function component(){
	let element = document.createElement('div');
	let button = document.createElement('button');
	let br = document.createElement('br');
	button.innerHTML = 'Click me and look at the console';
	element.innerHTML = _.join(['Hello','webpack'],' ');
	element.appendChild(br);
	element.appendChild(button);
	button.onclick = e=> import('./print').then(module=>{
		console.log(module,9999999999)
		let print = module.default;
		print();
	})
	return element;
}

document.body.appendChild(component());