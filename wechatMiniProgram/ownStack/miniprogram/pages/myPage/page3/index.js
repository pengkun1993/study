/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */

const { pk , wraperPage } = require('../../../utils/history')

Page({
	nt4(){
		pk.navigateTo({
			url:'/pages/myPage/page4/index'
		})
	}
})