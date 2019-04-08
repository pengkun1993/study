/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */

const { pk , wraperPage } = require('../../../utils/history')

Page({
	nt7(){
		pk.navigateTo({
			url:'/pages/myPage/page7/index'
		})
	}
})