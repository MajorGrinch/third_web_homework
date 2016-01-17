<?php
class User extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }
    public function get_stu($account)    //根据学号得到学生信息
    {
   
        $query = $this->db->get_where('Stu_User', array('account' => $account));
        return $query->first_row('array');
    }
    public function get_tch($slug)    //得根据工号到老师信息
    {
        $query = $this->db->get_where('Tch_User', array('account'=>$slug) );
        return $query->first_row('array');
    }
    public function  get_prj($slug)     //关键字检索工程
    {    
        $sql = "SELECT * FROM project WHERE prj_name LIKE '%".$this->db->escape_like_str($slug)."%'";
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    public function get_stuprj($account)     //根据我的学号获取我的项目编号
    {
        $query = $this->db->get_where('stu_prj', array('account' => $account) );
        return $query->first_row('array');
    }

    public function insert_select( $prj_num, $account )   //选择项目后插入数据库
    {
        $a = "SELECT sel_prj FROM stu_user WHERE account = ".$account;
        $query = $this->db->query($a);
        $res = $query->first_row('array');
        if( $res['sel_prj'] != NULL )
        {
            return false;
        }
        $s = "UPDATE stu_user SET sel_prj = " .$prj_num." WHERE account = ".$account;
        $this->db->query($s);
        $this->session->set_userdata('sel_prj', $prj_num );
        $sql = "UPDATE project SET curr_mem = curr_mem+1 WHERE prj_num = ".$prj_num;
        $this->db->query($sql);
        return TRUE;
    }

    public function insert_user( $data )      //注册用户
    {
        $type = $data['type'];
        if( $type == "student" )
        {
            $sql = "INSERT INTO stu_user (account, pwd, name) VALUES ('". $data['account']."','". $data['password']."','".$data['name']."')";
            $this->db->query($sql);
            return TRUE;
        }
        else if( $type == "teacher" )
        {
            $sql = "INSERT INTO tch_user (account, pwd, name) VALUES ('". $data['account']."','". $data['password']."','".$data['name']."')";
            $this->db->query($sql);
            return TRUE;
        }
        return FALSE;
    }

    public function mine( $account )       //根据学号得到我的信息
    {
        $query = $this->db->get_where('Stu_User', array('account' => $account));
        $res = $query->first_row('array');
        return $res;
    }

    public function getcurrprj($prj_num)    //根据项目编号得到项目信息
    {
        $query = $this->db->get_where('project', array('prj_num'=>$prj_num) );
        return $query->first_row('array');
    }

    public function getleader( $prj_num )   //根据项目编号获得组长学号
    {
        $query = $this->db->get_where('team', array('num' => $prj_num) );
        $res = $query->first_row('array');
        return $res['leader'];
    }

    public function del_sel( $account, $prj_num )
    {
        $sql = "UPDATE stu_user SET sel_prj=NULL WHERE account=".$account;
        $s = "UPDATE project SET curr_mem = curr_mem-1 WHERE prj_num = ".$prj_num;
        $this->db->query($sql);
        $this->db->query($s);
    }

    public function upload_begin( $content, $prj_num )
    {
        $sql = "UPDATE project SET begin_report = '".$content."' WHERE prj_num = ".$prj_num;
        $this->db->query($sql);
    }

    public function upload_mid( $content, $prj_num )
    {
        $sql = "UPDATE project SET middle_report = '".$content."' WHERE prj_num = ".$prj_num;
        $this->db->query($sql); 
    }

    public function upload_final( $content, $prj_num )
    {
        $sql = "UPDATE project SET final_report = '".$content."' WHERE prj_num = ".$prj_num;
        $this->db->query($sql); 
    }

    public function upload_log( $content, $prj_num )   //根据项目编号提交相应日志
    {
        $sql = "INSERT INTO prj_log (prj_num, content) VALUES('".$prj_num."','".$content."')";
        $this->db->query($sql);
    }

    public function getlog( $prj_num )   //根据项目编号得到项目所有日志
    {
        $query = $this->db->get_where('prj_log', array('prj_num'=>$prj_num) );
        return $query->result_array();      
    }

    public function getchoice( $prj_num ) //根据项目编号，得到所有已选学生信息
    {
        $query = $this->db->get_where('stu_user', array('sel_prj'=>$prj_num) );
        return $query->result_array();
    }

    public function tch_choose_stu( $prj_num, $account )    //老师选学生
    { 
        
        $ss = "SELECT * FROM team WHERE num = ".$prj_num;
        $query = $this->db->query($ss);
        $res = $query->first_row('array');
        if( $res['leader'] == NULL )
        {
            $sql = "UPDATE stu_user SET sel_prj=NULL, par_prj='".$prj_num."' WHERE account=".$account;   //更新学生表
            $this->db->query($sql);
            $s = "UPDATE team SET leader='".$account."' WHERE num = ".$prj_num;
            $this->db->query($s);
            return TRUE;
        }
        else if( $res['mber_1'] == NULL )
        {
            $sql = "UPDATE stu_user SET sel_prj=NULL, par_prj='".$prj_num."' WHERE account=".$account;   //更新学生表
            $this->db->query($sql);
            $s = "UPDATE team SET mber_1='".$account."' WHERE num = ".$prj_num;
            $this->db->query($s);
            return TRUE;
        }
        else if( $res['mber_2'] == NULL )
        {
            $sql = "UPDATE stu_user SET sel_prj=NULL, par_prj='".$prj_num."' WHERE account=".$account;   //更新学生表
            $this->db->query($sql);
            $s = "UPDATE team SET mber_2='".$account."' WHERE num = ".$prj_num;
            $this->db->query($s);
            return TRUE;
        }
        else if( $res['mber_3'] == NULL )
        {
            $sql = "UPDATE stu_user SET sel_prj=NULL, par_prj='".$prj_num."' WHERE account=".$account;   //更新学生表
            $this->db->query($sql);
            $s = "UPDATE team SET mber_3='".$account."' WHERE num = ".$prj_num;
            $this->db->query($s);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function tch_apply_prj( $prj_num )
    {
        $ss = "SELECT * FROM team WHERE num = ".$prj_num;
        $query = $this->db->query($ss);
        $res = $query->first_row('array');
        if( $res['leader'] == NULL )
        {
            return FALSE;
        }
        $sql = "UPDATE project SET selected = 1 WHERE prj_num = ".$prj_num;
        $flag = $this->db->query( $sql );
        return $flag;
    }

    public function post_prj($arr){
        $this->db->insert('project',$arr);
    }
    public function team_solve($team){
        $this->db->insert('team',$team);
    }

    public function update($prj_num, $account)
    {
        $sql = "UPDATE tch_user SET my_prj = '".$prj_num."' WHERE account = ".$account;
        return $this->db->query($sql);
    }

}