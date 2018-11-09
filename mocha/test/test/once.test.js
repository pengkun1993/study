/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
import {assert } from 'chai';
import sinon from 'sinon';
import once from '../src/once';

describe('测试Once函数',function(){
	it('传入Once的函数会被调用',function(){
		let callback = sinon.spy();
		let proxy = once(callback);

		proxy();

		assert(callback.called);
	});
	it('对原有函数的spy封装，可以监听原有函数的调用情况',function(){
		const obj = {
			func:()=>{
				return 1+1;
			}
		}
		sinon.spy(obj,'func');
		obj.func(3);

		assert(obj.func.calledOnce);
		assert.equal(obj.func.getCall(0).args[0],3);
	});
	it('对原有函数stub封装，可以监听原有函数的调用情况，以及模拟返回',function(){
		const obj = {
			func:()=>{
				console.info(1);
			}
		}
		sinon.stub(obj,'func').returns(42);
		const result = obj.func(3);

		assert(obj.func.calledOnce);
		assert.equal(obj.func.getCall(0).args[0],3);
		assert.equal(result,42);
	});
	it('mock测试',function(){
		let myAPI = {
			method:function(){
				console.info('运行method');
			},
			func:function(){
				console.log('运行func');
			}
		};
		let mock = sinon.mock(myAPI);
		mock.expects('method').once().returns(2);
		mock.expects('func').twice();

		myAPI.method();
		myAPI.func();
		myAPI.func();

		mock.verify();
	})
})

