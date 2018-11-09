/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
import {assert} from 'chai';
import addNum from '../src/index';

describe('测试index.js',function(){
	describe('测试addNum函数',function(){
		it('两个数相加结果为两个数字的和',function(){
			assert.equal(addNum(1,2),3)
		})
	})
})