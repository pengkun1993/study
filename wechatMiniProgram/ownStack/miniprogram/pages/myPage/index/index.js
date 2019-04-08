/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
const { pk, wraperPage } = require('../../../utils/history');
Page(wraperPage({
	data:{
		name:'index'
	},
	nt1(){
		pk.navigateTo({
			url:'/pages/myPage/page1/index'
		})
	}
}))