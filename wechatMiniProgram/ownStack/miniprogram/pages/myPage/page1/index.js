/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */

const { pk , wraperPage } = require('../../../utils/history')

Page({
	data:{
		input:''
	},
	nt2(){
		pk.navigateTo({
			url:'/pages/myPage/page2/index'
		})
	}
})