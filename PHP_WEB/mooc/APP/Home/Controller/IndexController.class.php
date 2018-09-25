<?php
namespace Home\Controller;
use Home\Model\AdminModel;
use Think\Controller;
use Think\Model; 
class IndexController extends Controller {
    public function index(){
    //c方法显示变量
    //	echo  c('name');
    /************session操作(cookie操作相同)*********/
        /*session('name',value,有效时间)//赋值保存到session
        session('name')//获取session值
        session('name',null)//删除session
        session(null)//清空全部session*/
	/************URL_MODULE   URL模式*********/
    	/*1默认模式pathinfo模式 1
    		http://localhost/test/index.php/Home/index/user/id/1.html
    	*0普通模式
    		http://localhost/test/index.php?m=Home&c=index&a=user&id=1
    	*2重写模式
    		http://localhost/test/Home/index/user/id/1.html
    	*3兼容模式
    		http://localhost/test/index.php?s=/Home/index/user/id/1.html
        */
        //输出默认的URL模式
        //echo C('URL_MODEL');
        //U方法 ('模块/方法',array('id'=>1),'后缀xxx html xml htm stml',??是否自动跳转true/false??,'地址子域名')
        //echo U('index/user',array('id'=>'1'),'html',true);
        //show();//common.php试验失败
	//$arr= array(1,2,3,4,5);
	//var_dump($arr);//传统查看数组方法
	//dump($arr);//ThinkPHP提供的方法,自动换行，显示效果好


    /***********模板赋值或视图赋值***********/
        /*
        $name='pengkun';
        $sex='man';
        $today=date('Y-m-d');
        //$this->name=$name;一次只可以赋值一个变量
        $this->assign('name',$name)->assign('sex',$sex)->assign('today',$today);//$this->assign('变量名',变量值)可以多个赋值*/
        /*$me['name']='pengkun';
        $me['sex']='boy';
        $me['age']=24;
        $this->now=time();//$this—>这是向模板或视图传值
        $this->assign('me',$me);
        */
        /*$person = array(
            1=>array('name'=>'Jack','age'=>'15'),
            2=>array('name'=>'Tom','age'=>'16'),
            3=>array('name'=>'Peter','age'=>'19'),
            4=>array('name'=>'Mary','age'=>'20'),
         );
        $this->person=$person;
        $num=11;
        $this->num=$num;
        $mingzi='xiaohong';
        $this->assign('mingzi',$mingzi);
        $this->display();*/ //$this->display('index/test');//可以跨文件夹显示静态页面
        //$this-display();显示它所在方法名命名的html文件


    /***********测试运行速度效率***********/
        /*
        G('run');
        for ($i=0; $i<100000; $i++) { 
            $count+=$i;
        }
        echo G('run','end');*/


    /**********实例化模型***********/
    //1.实例化基础模型
        /*$user=M('user');
        $data=$user->select();
        dump($data);*/
    //2.实例化用户自定义模型
        /*$user=D('user');
        //相当于 $user=new \Home\Model\UserModel();
        $data=$user->getinfo();*/
    //3.实例化公共模型
        /*$user=D('User');//创建一个公共模型，用2中的模型继承
        echo $user->strmake('aaaa');*/
    //4.实例化空模型
        /*$model=M();
        $data=$model->execute('update mk_user set user_name="zhangsan" where id="01"');
        //写入  update insert 返回影响行数
        //$data=$model->query('select * from mk_user');//读取日常 select
        dump($data);*/


/**********数据库的增删改查******数据库的CURD操作*******/
    /**********add增加一条或多条数据********/
        //1.增加一条
            /*$data = array(  
                'user_name'=>'lisi',
                'nice_name'=>'李四',
                'password'=>md5('123456'),
                'create_date'=>date('Y-m-d H-i-s'),
                'update_date'=>date('Y-m-d H-i-s'), 
                );
            echo M('User')->add($data);//先实例化user表，然后可进行操作，返回发生变化的id号*/
        //2.增加多条
            /*$data = array(    
                0=>array(
                    'user_name'=>'wangwu',
                    'nick_name'=>'王五',
                    'password'=>md5('123456'),
                    'score'=>78,
                    'create_date'=>date('Y-m-d H:i:s'),
                    'update_date'=>date('Y-m-d H:i:s'), 
                    ),
                1=>array(
                    'user_name'=>'zhaoliu',
                    'nick_name'=>'赵六',
                    'password'=>md5('123456'),
                    'score'=>72,
                    'create_date'=>date('Y-m-d H:i:s'),
                    'update_date'=>date('Y-m-d H:i:s'), 
                    ),
                2=>array(  
                    'user_name'=>'lisi',
                    'nick_name'=>'李四',
                    'password'=>md5('123456'),
                    'score'=>55,
                    'create_date'=>date('Y-m-d H:i:s'),
                    'update_date'=>date('Y-m-d H:i:s'), 
                    )
                );
                echo M('user2')->addAll($data);//只返回被修改的第一个id值,addAll只适用mysql数据库*/
        /************select查询语句*************/
            //1.直接适用字符串进行查找
                //$data=M('user')->where('id=1')->select();
            //2.适用数组进行查询
                /*$where['id']=123;
                $where['user_name']='lisi';
                $where['_logic']='or';//默认的查询逻辑是&，用这个可以修改查询逻辑
                $data=M('user')->where($where)->select();
                dump($data);*/
            //3.表达式查询 eg neg gt ngt lt nlt between not between..
                //$where['字段名']=array(表达式，查询条件)；
                //$where['id']=array('gt',100);
                //$where['id']=array('between','100,200');
                //$where['id']=array('not in','100,125,129');
                //$where['user_name']=array('like',array('%si','wang%'));
                //$where['id']=array(array('lt',50),array('gt',126),'or');
            //4.混合使用
                /*$where['id']=array('gt',100);
                //$data=M('user')->where($where.'id<127')->select();这是错误的方法
                $where['_string']='id<127';
                $data=M('user')->where($where)->select();*/
            //5.统计用法
                //count统计数量  字段名可选插入或不插
                //$data=M('user')->count();
                //max最大值 min 最小值 必须插入字段名
                //$data=M('user')->max('id');
                //avg平均值 必须插入字段名
                //$data=M('user')->avg('id');
                //sum求和  必须插入字段名
                //$data=M('user')->sum('id');
                //dump($data);
    /**********update更新语句***********/
        /*$update['user_name']='lihao';
        $where['id']=125;
        //$data=M('user')->where($where)->save($update);
        $data=M('user')->where($where)->select();//查看是否修改更新
        dump($data);*/
        /*自增运算，sorce增加3，setInc/setDec
         $data=M('user')->where($where)->setInc('sorce',3);*/
    /***************delete删除***********/
        //带条件删除
            /*$where['id']=126;
            $data=M('user')->where($where)->delete();
            dump($data);*/
        //直接按照主键删除
            //echo M('user')->delete(125);//这里只能插入主键删除


/*********连续操作***********/
    //1.order排序 order(字符串) 多个条件的话用英文逗号隔开
        /*$data=M('user')->order('create_date asc,id desc')->select();
        dump($data);*/
    //2.field($string,false) $string传入多个字段名用英文逗号隔开，默认是false，$string里有几个字段就显示几个字段,改为true的话就是过滤掉$string里的字段，显示其他字段。
        /*$data=M('user')->field('id,user_name')->order('id desc')->select();
        dump($data);*/
    //3.limit(start,length)  显示条数从第start条开始,显示length条,只写一个数表示start为0
        /*$data=M('user')
        ->field('id,user_name')
        ->order('id desc')
        ->limit(2,1)
        ->select();//必须放在最后面
        dump($data);*/
    //4.page(显示的页码，每页显示的条数=默认20条) 分页显示，用的不多有别的分页方法
        /*$data=M('user')
        ->field('id,user_name')
        ->order('id desc')
        ->page(2,1)
        ->select();//必须放在最后面
        dump($data);*/
    //5.group分组，having只能配合group适用，限定在哪个条件下分组
        /*$data=M('user')
        ->group('create_date')
        ->having('id > 127')
        ->field('id,create_date,count(*) as total')//这里不写id报错
        ->select();
        dump($data);*/
    //6.多表查询
        //1.table(array('表名'=>'别名'))表名需要加前缀，写完整
            /*$data=M()
            ->table(array('mk_user'=>'user1','mk_user2'=>'user2'))
            ->where('user1.user_name=user2.user_name')
            ->select();
            dump($data);*/
        //2.jion()  支持字符串和数组
            //$data=M('user')->join('mk_user2 On mk_user2.user_name=mk_user.user_name')
            //->select();//默认的左匹配
            //$data=M('user')->join('Right join mk_user2 On mk_user2.user_name=mk_user.user_name')
            //->select();右匹配
            //$data=M('user')->join('inner join mk_user2 On mk_user2.user_name=mk_user.user_name')
            //->select();右匹配
            //$data=M('user')->join(array('Right join mk_user2 On mk_user2.user_name=mk_user.user_name')//数组，用逗号隔开添加多个
            //->select();右匹配
        //3.union('string/array',true/false)默认是false,表示union查询去掉重复的，true表示union all查询
            /*$data=M('user')
            ->field('user_name')//必须有
            //->union('select user_name,id from mk_user2')
            ->union(array('field'=>'user_name','table'=>'mk_user2'))
            ->select();
            //->union(array('field'=>'user_name','table'=>'mk_user3'),true)
            dump($data);*/
    //7.过滤查询 distinct
            /*$data=M('user2')->distinct(true)->field('score')->order('score asc')->select();
            dump($data);//自动去掉重复的*/ 
/******建立索引再进行连贯操作能大大提高效率*****/

/********命名范围查询使用************/
    //首先在表所对应的模型建立一个命名范围的标准数组  示例在userModel.class.php
        $user=D('user');
        $user->scope('jige,ziduan')->where('user_id<50')->select();//可以混合适用，后面覆盖前面
/*******调试查看sql语句执行********/
        //echo M()->getLastSql();//获取最后一条SQL语句，笨方法
        //Trace调试  在debug中设置为真
        $this->display();//没有这句不显示trace调试结果


    }
    public function user(){
     	//echo "id is:".$GET['id'].'<br/>';
     	//echo "这里是INDEX模块儿的user方法";
        $this->display();
     }
     
}