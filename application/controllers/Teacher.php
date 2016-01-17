<?php
class Teacher extends CI_Controller
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
    	$this->load->view('tchheader');
        $this->load->view('tchindex');
        $this->load->view('footer');
    }

    public function myproject()
    {
    	$res = $this->User->get_tch($_SESSION['account']);		//找到老师的信息
    	$prj_num = $res['my_prj'];
    	$query = $this->User->getcurrprj( $prj_num );
    	if( $query == NULL )
    	{
            $this->load->view("tchheader");
            $this->load->view("teacher/noproject");
            $this->load->view("footer");    		
    	}
    	else if( $query['selected'] == 0 )
        {
        	$data = $this->User->getcurrprj(  $_SESSION['account'] ); //根据老师工号找到项目信息
            $this->load->view("tchheader");
            $this->load->view("teacher/applyprj_page", $query);
            $this->load->view("footer");  
        }
        else
        {
        	$this->load->view("tchheader");
            $this->load->view("teacher/checklog_page", $query);
            $this->load->view("footer");
        }
    }

    public function show_all_log()  //进入显示所有日志界面的函数
    {
        $data['log'] = $this->User->getlog( $_SESSION['my_prj'] );
        $query = $this->User->getcurrprj( $_SESSION['my_prj']);
        $data['name'] = $query['prj_name'];
        $this->load->view("tchheader");
        $this->load->view("showall", $data);
        $this->load->view("footer");
    }

    public function choose_stu_page( $prj_num )   	//进入选择学生界面
    {
    	$data['stu'] = $this->User->getchoice($prj_num);
    	$query = $this->User->getcurrprj( $prj_num );
    	$data['name'] = $query['prj_name'];
        $this->load->view("tchheader");
    	$this->load->view("teacher/choose_stu", $data );
    	$this->load->view("footer");
    }

    public function choose_stu( $account )
    {
    	$flag = $this->User->tch_choose_stu( $_SESSION['my_prj'], $account );
    	if( $flag ){
    		echo "<script>alert('选择成功！');</script>";
    		$this->choose_stu_page( $_SESSION['my_prj'] );
    	}
    	else{
    		echo "<script>alert('人数已满！');</script>";
    	}
    	
    }

    public function apply_prj()    //老师立项函数
    {
    	$flag = $this->User->tch_apply_prj( $_SESSION['my_prj'] );   //老师立项函数对数据库操作
    	if( $flag )
    	{
    		echo "<script>alert('立项成功！');</script>";
    		$this->myproject();

    	}
    	else
    	{
    		echo "<script>alert('至少选一名学生！');</script>";
    	}
    }
    public function postprj()//来自tIndex.php----"发布新项目"按钮调用
    {
        $this->load->view('tchheader');
        $this->load->view('teacher/addprj'); 
        $this->load->view('footer');       
    }
    public function poprj()//addprj.php---"发布项目"调用
    {       
        $arr=array('prj_name' =>    $_POST["title"],
                   'prj_num' =>     $_POST["prj_num"],
                   'instructor' =>  $_POST["instructor"],
                   'applicant' =>   $_POST["applicant"],
                   'fina_lv' =>     $_POST["final_lv"],
                   'property' =>    $_POST["property"],
                   'start_date'=>   $_POST['start_date'],
                   'finish_date'=>  $_POST['finish_date'],
                   'intro'=>        $_POST['text'],
                   'selected' => 0,
                   'curr_mem' => 0
                    );
        $team=array('num'=>         $_POST["prj_num"],
                    'leader'=>      NULL,
                    'mber_1'=>      NULL,
                    'mber_2'=>      NULL,
                    'mber_3'=>      NULL
                    );
        if(!$this->User->post_prj($arr) && !$this->User->team_solve($team))
        {
        	if ($this->User->update($_POST['prj_num'], $_SESSION['account']) ){
            	header("location:myproject");
            }
            else
            	return;
        }
    }

    public function up_begin_page()      //开题报告界面
    {
        $data = $this->User->getcurrprj( $_SESSION['my_prj'] );   //得到项目信息
        $leader_num = $this->User->getleader($_SESSION['my_prj']);
        $query = $this->User->get_stu( $leader_num );
        $leader_name = $query['name'];
        $data['leader_num'] = $leader_num;
        $data['leader_name'] = $leader_name;

        if( $data['begin_report'] == NULL ){
            $this->load->view("tchheader");
            $this->load->view("teacher/nonbegin");
            $this->load->view("footer");
        }
        else
        {
            $this->load->view("tchheader");
            $this->load->view("checkbegin", $data);
            $this->load->view("footer");           
        }
    }

    public function up_mid_page()      //中期报告界面
    {
        $data = $this->User->getcurrprj( $_SESSION['my_prj'] );   //得到项目信息
        $leader_num = $this->User->getleader($_SESSION['my_prj']);
        $query = $this->User->get_stu( $leader_num );
        $leader_name = $query['name'];
        $data['leader_num'] = $leader_num;
        $data['leader_name'] = $leader_name;

        if( $data['middle_report'] == NULL ){
            $this->load->view("tchheader");
            $this->load->view("teacher/nonmid");
            $this->load->view("footer");
        }
        else
        {
            $this->load->view("tchheader");
            $this->load->view("checkmid", $data);
            $this->load->view("footer");           
        }
    }

    public function up_final_page()      //结题报告界面
    {
        $data = $this->User->getcurrprj( $_SESSION['my_prj'] );   //得到项目信息
        $leader_num = $this->User->getleader($_SESSION['my_prj']);
        $query = $this->User->get_stu( $leader_num );
        $leader_name = $query['name'];
        $data['leader_num'] = $leader_num;
        $data['leader_name'] = $leader_name;

        if( $data['final_report'] == NULL ){
            $this->load->view("tchheader");
            $this->load->view("teacher/nonfinal");
            $this->load->view("footer");
        }
        else
        {
            $this->load->view("tchheader");
            $this->load->view("checkfinal", $data);
            $this->load->view("footer");           
        }
    }


}