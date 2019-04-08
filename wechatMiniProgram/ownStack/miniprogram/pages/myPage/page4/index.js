/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
const { pk , wraperPage } = require('../../../utils/history')

Page({
	nt5(){
		pk.navigateTo({
			url:'/pages/myPage/page5/index'
		})
	}
})