<?php
class Test extends CI_Controller
{
    //public static $user;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('User');
        $this->load->library('session');

    }

    public function index()
    {
        $this->load->view('login');
    }

    public function myproject()   //学生：显示我的工程
    {
        $res = $this->User->mine($_SESSION['account']);
        if( $res['sel_prj'] == NULL && $res['par_prj'] == NULL )
        {
            $this->load->view("header");
            $this->load->view("nonproject");
            $this->load->view("footer");
        }
        else if( $res['sel_prj'] != NULL )
        {
            $data = $this->User->getcurrprj($res['sel_prj']);
            $this->load->view("header");
            $this->load->view("mineprj_sel", $data);
            $this->load->view("footer");
        }
        else{
            $data = $this->User->getcurrprj($res['par_prj']);
            $this->load->view("header");
            $this->load->view("mineprj_rep", $data);
            $this->load->view("footer");
        }
    }

    public function checkpass()   //登录检查
    {
        $type = $_POST['logintype'];
        if ($type == "student") {
            $user = $this->User->get_stu($_POST['account']);
            if ($_POST['password'] == $user['pwd']) {
                $user['type'] = '学生';
                $project = $this->User->get_stuprj($_POST['account']);
                if( $project['prj_name'] == NULL )
                {
                    $user['prj'] = $user['sel_prj'];
                }
                else
                {
                    $user['prj'] = $project['prj_name'];
                } 
                $this->session->set_userdata($user);
                $this->getprogress();
                $this->load->view('header');
                $this->load->view('stuindex');
                $this->load->view('footer');
            } else {
                echo 'failed';
            }
        }
        elseif( $type == "teacher" ){
            $user = $this->User->get_tch($_POST['account']);
            if( $_POST['password'] == $user['pwd']){
                $user['type'] = "老师";
                $this->session->set_userdata($user);
                $this->tchgetprogress();
                $this->load->view('tchheader');
                $this->load->view('tchindex');
                $this->load->view('footer');
            }
            else
            {
                echo "failed";
            }
        }
    }

    public function logout(){     //退出登录
        session_unset();//清除session数据
        session_destroy();//销毁session
        session_start();//重启session
        $this->load->view("login");
    }

    public function search()    //关键字寻找项目
    {
        $data['title'] = "Result";
        $data['prj'] = $this->User->get_prj($_POST["search"]);
        $this->getprogress();    
        $this->load->view("header");
        $this->load->view("searchpage",$data);
        $this->load->view("footer");
    }

    public function gotoregister()      //注册用户
    {
        $this->load->view("register");
    }

    public function register()          //注册用户的插入函数
    {
        $data['name'] = $_POST['stu_name'];
        $data['account'] = $_POST['account'];
        $data['password'] = $_POST['password'];
        $data['type'] = $_POST['logintype'];
        $res = $this->User->insert_user( $data );
        if( $res == TRUE )
            echo "<script>alert('创建成功！');</script>";
        else
            echo "<script>alert('创建失败！');</script>";
        $this->load->view("login");
    }

    public function choose($prj_num)        //学生选择项目
    {
        $array=$this->User->insert_select($prj_num,$_SESSION["account"]);

        $user = $this->User->get_stu($_SESSION['account']);
        $user['prj'] = $user['sel_prj'];
        $this->session->set_userdata($user);

        if ($array==TRUE )
        {
            echo "<script>alert('选择成功！');</script>";
            $this->load->view('header');
            $this->load->view('stuindex');
            $this->load->view('footer');
        }
        else
        {
            echo "<script>alert('已选择该项目');</script>";
            $this->load->view('header');
            $this->load->view('stuindex');
            $this->load->view('footer');
        }
    }

    public function del( $prj_num )     //退选科研项目
    {
        $this->User->del_sel( $_SESSION['account'], $prj_num );
        $this->load->view('header');
        $this->load->view('stuindex');
        $this->load->view('footer');
    }

    public function getprogress()   //学生的得到项目进度
    {
        $ispar = $_SESSION['par_prj'];
        if( $ispar != NULL )
        {
            $my_prj_num = $_SESSION['par_prj'];    //得到我的项目编号
            $my_prj = $this->User->getcurrprj($my_prj_num);  //得到我的项目信息
            if( $my_prj['final_report'] != NULL  )
            {
                $my_progress = 100;
            }
            else if( $my_prj['middle_report'] != NULL )
            {
                $my_progress = 50;
            }
            else if( $my_prj['begin_report'] != NULL )
            {
                $my_progress = 15;
            }
            else
            {
                $my_progress = 0;
            }
        }
        else
        {
            $my_progress = 0;
        }
        $this->session->set_userdata('progress', $my_progress);
    }

    public function tchgetprogress()   //学生的得到项目进度
    {
        $ispar = $_SESSION['my_prj'];
        if( $ispar != NULL )
        {
            $my_prj_num = $_SESSION['my_prj'];    //得到我的项目编号
            $my_prj = $this->User->getcurrprj($my_prj_num);  //得到我的项目信息
            if( $my_prj['final_report'] != NULL  )
            {
                $my_progress = 100;
            }
            else if( $my_prj['middle_report'] != NULL )
            {
                $my_progress = 50;
            }
            else if( $my_prj['begin_report'] != NULL )
            {
                $my_progress = 15;
            }
            else
            {
                $my_progress = 0;
            }
        }
        else
        {
            $my_progress = 0;
        }
        $this->session->set_userdata('progress', $my_progress);
    }

    public function up_begin_page()      //开题报告界面
    {
        $data = $this->User->getcurrprj( $_SESSION['par_prj'] );   //得到项目信息
        $leader_num = $this->User->getleader($_SESSION['par_prj']);
        $query = $this->User->get_stu( $leader_num );
        $leader_name = $query['name'];
        $data['leader_num'] = $leader_num;
        $data['leader_name'] = $leader_name;

        if( $data['begin_report'] == NULL ){
            $this->load->view("header");
            $this->load->view("upbegin", $data);
            $this->load->view("footer");
        }
        else
        {
            $this->load->view("header");
            $this->load->view("checkbegin", $data);
            $this->load->view("footer");           
        }
    }

    public function up_begin()    //提交开题报告函数
    {
        $this->User->upload_begin( $_POST["content"], $_SESSION['par_prj']);
        $this->getprogress();
        $this->up_begin_page();
    }

    public function up_mid_page()   //提交中期报告界面
    {
        $data = $this->User->getcurrprj( $_SESSION['par_prj'] );   //得到项目信息
        $leader_num = $this->User->getleader($_SESSION['par_prj']);
        $query = $this->User->get_stu( $leader_num );
        $leader_name = $query['name'];
        $data['leader_num'] = $leader_num;
        $data['leader_name'] = $leader_name;

        if( $data['middle_report'] == NULL ){
            $this->load->view("header");
            $this->load->view("upmid", $data);
            $this->load->view("footer");
        }
        else
        {
            $this->load->view("header");
            $this->load->view("checkmid", $data);
            $this->load->view("footer");           
        }       
    }

    public function up_mid()    //提交中期报告函数
    {
        $this->User->upload_mid( $_POST["content"], $_SESSION['par_prj']);
        $this->getprogress();
        $this->up_mid_page();
    }

    public function up_final_page()   //提交结题报告界面
    {
        $data = $this->User->getcurrprj( $_SESSION['par_prj'] );   //得到项目信息
        $leader_num = $this->User->getleader($_SESSION['par_prj']);
        $query = $this->User->get_stu( $leader_num );
        $leader_name = $query['name'];
        $data['leader_num'] = $leader_num;
        $data['leader_name'] = $leader_name;

        if( $data['final_report'] == NULL ){
            $this->load->view("header");
            $this->load->view("upfinal", $data);
            $this->load->view("footer");
        }
        else
        {
            $this->load->view("header");
            $this->load->view("checkfinal", $data);
            $this->load->view("footer");           
        }  
    }

    public function up_final()      //提交结题报告函数
    {
        $this->User->upload_final( $_POST["content"], $_SESSION['par_prj']);
        $this->getprogress();
        $this->up_final_page();
    }

    public function log_page()      //显示所有日志
    {
        $data = $this->User->getcurrprj( $_SESSION['par_prj'] );   //得到项目信息
        $this->load->view("header");
        $this->load->view("showlog", $data);
        $this->load->view("footer");
    }


    public function add_log_page()      //进入提交日志界面的函数
    {
        $data = $this->User->getcurrprj( $_SESSION['par_prj'] );   //得到项目信息
        $leader_num = $this->User->getleader($_SESSION['par_prj']); //得到组长学号
        $query = $this->User->get_stu( $leader_num );               //得到组长名字
        $leader_name = $query['name'];              
        $data['leader_num'] = $leader_num;
        $data['leader_name'] = $leader_name;
        $this->load->view("header");
        $this->load->view("addlog", $data);
        $this->load->view("footer");
    }

    public function add_log()   //提交日志函数
    {
        $content = $_POST['content'];
        $prj_num = $_SESSION['par_prj'];
        $this->User->upload_log( $content, $prj_num );
        $this->show_all_log($prj_num);
    }

    public function show_all_log( $prj_num )  //进入显示所有日志界面的函数
    {
        $data['log'] = $this->User->getlog( $prj_num );
        $query = $this->User->getcurrprj( $prj_num );
        $data['name'] = $query['prj_name'];
        $this->load->view("header");
        $this->load->view("showall", $data);
        $this->load->view("footer");
    }

}