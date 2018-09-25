<?php

/**
 * Class and Function List:
 * Function list:
 * Classes list:
 * - UserModel extends Model
 */
namespace Validates\Model;

use Think\Model;

class UserModel extends Model
{
    protected $patchValidate = true;
    
    protected $_validate = array(
        array(
            'username',
            'require',
            '用户名必须填写',
            self::EXISTS_VALIDATE,
            'regex',
            self::MODEL_INSERT
        ) ,
        array(
            'username',
            '/^jike_[A-Za-z_]+$/',
            '用户名必须以(jike_)开头'
        ) ,
        array(
            'username',
            'filter_username',
            '含有敏感字眼',
            self::EXISTS_VALIDATE,
            'function'
        ) ,
        array(
            'username',
            '',
            '用户名被别人占用了',
            self::EXISTS_VALIDATE,
            'unique',
            self::MODEL_INSERT
        ) ,
        array(
            'password',
            'require',
            '密码必须填写'
        ) ,
        array(
            'confirm_password',
            'password',
            '确认密码不一致',
            self::MUST_VALIDATE,
            'confirm',
            self::MODEL_INSERT
        ) ,
        array(
            'email',
            'require',
            '电子邮件必须填写'
        ) ,
        array(
            'email',
            'email',
            '电子邮件格式不对'
        ) ,
        array(
            'email',
            '',
            '邮箱被别人占用了',
            self::EXISTS_VALIDATE,
            'unique',
            self::MODEL_INSERT
        ) ,
        array(
            'sex',
            '0,1,2',
            '请不要篡改性别',
            self::VALUE_VALIDATE,
            'in',
            self::MODEL_BOTH
        ) ,
        array(
            'birthday',
            'checkBirthday',
            '生日超出可能范围',
            self::VALUE_VALIDATE,
            'callback',
            self::MODEL_BOTH
        ) ,
        array(
            'birthday',
            'require',
            '生日必须填写'
        ) ,
        array(
            'friends',
            'checkMaxCount',
            '不可能更多了',
            self::VALUE_VALIDATE,
            'callback',
            self::MODEL_BOTH
        ) ,
    );
    
    /**
     * [checkBirthday description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    function checkBirthday($value) {
        
        $start = strtotime('1900-1-1');
        $end = NOW_TIME;
        $value_time = strtotime($value);
        
        return $value_time >= $start && $value_time <= $end;
    }
    
    /**
     * 检测当前用户的数量
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    function checkMaxCount($value) {
        $count = $this->count();
        return $value <= $count;
    }
    
    protected $_auto = array(
        array(
            'password',
            'md5',
            self::MODEL_BOTH,
            'function'
        ) ,
        array(
            'create_time',
            'time',
            self::MODEL_INSERT,
            'function'
        ) ,
        array(
            'status',
            1
        ) ,
        array(
            'ip',
            'get_client_ip',
            self::MODEL_BOTH,
            'function'
        )
    );
}
