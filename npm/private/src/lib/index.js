/*
 * Copyright (C) 2018 FarmFriend Co., Ltd. All rights reserved.
 */
import testPanel from './panel.vue'
import testToast from './toast.vue'
let test = {}
test.install = function (Vue, options) {
    let SIGN_REGEXP = /([yMdhsm])(\1*)/g
    let DEFAULT_PATTERN = 'yyyy-MM-dd'

    Vue.prototype.$msg = 'Hello I am test.js'
    Vue.prototype.format_time = {
        formats: function(date, pattern) {
            if (!date || date == 0) {
                return '-'
            }
            date = new Date(date * 1000)
            pattern = pattern || DEFAULT_PATTERN

            function padding(s, len) {
                /*eslint-disable */
                var len = len - (s + '').length
                for (var i = 0; i < len; i++) { s = '0' + s }
                return s
            }

            return pattern.replace(SIGN_REGEXP, function($0) {
                switch ($0.charAt(0)) {
                    case 'y':
                        return padding(date.getFullYear(), $0.length)
                    case 'M':
                        return padding(date.getMonth() + 1, $0.length)
                    case 'd':
                        return padding(date.getDate(), $0.length)
                    case 'w':
                        return date.getDay() + 1
                    case 'h':
                        return padding(date.getHours(), $0.length)
                    case 'm':
                        return padding(date.getMinutes(), $0.length)
                    case 's':
                        return padding(date.getSeconds(), $0.length)
                }
            })
        },
        format: function(date, pattern) {
            if (!date || date == 0) {
                return '-'
            }
            date = new Date(date)
            pattern = pattern || DEFAULT_PATTERN

            function padding(s, len) {
                /*eslint-disable */
                var len = len - (s + '').length
                for (var i = 0; i < len; i++) { s = '0' + s }
                return s
            }

            return pattern.replace(SIGN_REGEXP, function($0) {
                switch ($0.charAt(0)) {
                    case 'y':
                        return padding(date.getFullYear(), $0.length)
                    case 'M':
                        return padding(date.getMonth() + 1, $0.length)
                    case 'd':
                        return padding(date.getDate(), $0.length)
                    case 'w':
                        return date.getDay() + 1
                    case 'h':
                        return padding(date.getHours(), $0.length)
                    case 'm':
                        return padding(date.getMinutes(), $0.length)
                    case 's':
                        return padding(date.getSeconds(), $0.length)
                }
            })
        },
        parse: function(dateString, pattern) {
            var matchs1 = pattern.match(SIGN_REGEXP)
            var matchs2 = dateString.match(/(\d)+/g)
            if (matchs1.length == matchs2.length) {
                var _date = new Date(1970, 0, 1)
                for (var i = 0; i < matchs1.length; i++) {
                    var _int = parseInt(matchs2[i])
                    var sign = matchs1[i]
                    switch (sign.charAt(0)) {
                        case 'y':
                            _date.setFullYear(_int);
                            break
                        case 'M':
                            _date.setMonth(_int - 1);
                            break
                        case 'd':
                            _date.setDate(_int);
                            break
                        case 'h':
                            _date.setHours(_int);
                            break
                        case 'm':
                            _date.setMinutes(_int);
                            break
                        case 's':
                            _date.setSeconds(_int);
                            break
                    }
                }
                return _date
            }
            return null
        },
        getRecentTimeRange(type = 'date', days, defaultStartTime) {
            const formatDate = this.format
            const end = new Date()
            let start = new Date()

            if (days === undefined && !defaultStartTime) {
                start = '2017-01-01'
            } else if ((days || days === 0) && !defaultStartTime) {
                start.setTime(start.getTime() - 3600 * 1000 * 24 * days)
            } else {
                start = defaultStartTime
            }

            if (type == 'date') {
                return [formatDate(start), formatDate(end)]
            } else if (type == 'month') {
                return [formatDate(start, 'yyyy-MM'), formatDate(end, 'yyyy-MM')]
            } else if (type == 'year') {
                return [formatDate(start, 'yyyy'), formatDate(end, 'yyyy')]
            } else if (type == 'dateTime') {
                return [formatDate(start, 'yyyy-MM-dd hh:mm:ss'), formatDate(end, 'yyyy-MM-dd hh:mm:ss')]
            } else {
                return [formatDate(start), formatDate(end)]
            }
        },
        getFixedTimeRange(type = 'date', days, defaultStartTime) {
            const formatDate = this.format
            const end = new Date()
            let start = new Date()

            if (days === undefined && !defaultStartTime) {
                start = '2018-01-01'
            } else if ((days || days === 0) && !defaultStartTime) {
                start.setTime(start.getTime() - 3600 * 1000 * 24 * days)
            } else {
                start = defaultStartTime
            }

            if (type == 'date') {
                return [formatDate(start), formatDate(end)]
            } else if (type == 'month') {
                return [formatDate(start, 'yyyy-MM'), formatDate(end, 'yyyy-MM')]
            } else if (type == 'year') {
                return [formatDate(start, 'yyyy'), formatDate(end, 'yyyy')]
            } else {
                return [formatDate(start), formatDate(end)]
            }
        },
        getFixedTimeRangeInitSand() {
            var startDate = new Date()
            startDate.setDate(startDate.getDate())
            // var endDate = new Date()
            // endDate.setDate(endDate.getDate() + 10)
            return [this.format(startDate, 'yyyy-MM-dd'), this.format(startDate, 'yyyy-MM-dd')]
        },
        startTimeStamp(start) {
            console.log('start', start)
            let date = new Date(start)
            date.setHours(0)
            date.setMinutes(0)
            date.setSeconds(0)
            date.setMilliseconds(0)
            return String(date.getTime() / 1000)
        },
        endTimeStamp(end) {
            console.log('end', end)
            let date = new Date(end)
            date.setHours(23)
            date.setMinutes(59)
            date.setSeconds(59)
            date.setMilliseconds(0)
            return String(date.getTime() / 1000)
        },
        formatTimeRange(range, type = 'date') {
            const formatDate = this.format
            const start = range[0]
            const end = range[1]

            if (type == 'date') {
                return [formatDate(start), formatDate(end)]
            } else if (type == 'month') {
                return [formatDate(start, 'yyyy-MM'), formatDate(end, 'yyyy-MM')]
            } else if (type == 'year') {
                return [formatDate(start, 'yyyy'), formatDate(end, 'yyyy')]
            } else if (type == 'datetime') {
                return [formatDate(start, 'yyyy-MM-dd hh:mm:ss'), formatDate(end, 'yyyy-MM-dd hh:mm:ss')]
            } else {
                return [formatDate(start), formatDate(end)]
            }
        },
        /**
         * 距离当前多少个月之后的时间
         * duration 多少个月
         */
        monthFromNow(duration, type = 'dateTime') {
            const formatDate = this.format
            let dt = new Date()
            dt.setMonth(dt.getMonth() + duration)
            return formatDate(dt, 'yyyy-MM-dd hh:mm:ss')
            if (type == 'dateTime') {
                return formatDate(dt, 'yyyy-MM-dd hh:mm:ss')
            } else if (type == 'month') {
                return formatDate(dt, 'yyyy-MM')
            } else if (type == 'year') {
                return formatDate(start, 'yyyy')
            } else if (type == 'date') {
                return formatDate(dt)
            } else {
                return formatDate(dt)
            }
        },
        /**
         * 倒计时
         * @param {start} 开始时间(ms)
         * @param {duration} 时长(s)
         * @param {callback} 回调函数，参数是{timer, restTime, showTime}
         */
        countDown({ start, duration = 0, callback, nowTime }) {
            let during = duration * 1000;
            let end = during + start;

            function _formattedTime(mss) {
                let days = parseInt(mss / (1000 * 60 * 60 * 24));
                let hours = parseInt((mss % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = parseInt((mss % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = parseInt((mss % (1000 * 60)) / 1000);
                if (days <= 0) {
                    if (hours <= 0) {
                        if (minutes <= 0) {
                            return `( ${seconds} 秒 )`
                        }
                        return `( ${minutes} 分钟 ${seconds} 秒 )`
                    }
                    return `( ${hours} 小时 ${minutes} 分钟 ${seconds} 秒 )`
                }
                return `( ${days} 天 ${hours} 小时 ${minutes} 分钟 ${seconds} 秒 )`
            }
            // let now = null
            let now = nowTime || Date.parse(new Date())
            let mss = end - now
            const timer = setInterval(() => {
              mss -= 1000 
              // console.log(new Date(now),mss)
                // console.table({ start, now, end, duration, timer, mss, showTime: _formattedTime(mss) })
              callback({ timer, mss, showTime: _formattedTime(mss) })
            }, 1000)
        }    
    }
    Vue.component(testPanel.name, testPanel) // testPanel.name 组件的name属性
    Vue.component(testToast.name, testToast) // testPanel.name 组件的name属性
}
export default test