/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
export default function once(fn){
	let returnValue, called = false;
	return function(){
		if(!called){
			called = true;
			returnValue = fn.apply(this,arguments);
		}
		return returnValue;
	}
}