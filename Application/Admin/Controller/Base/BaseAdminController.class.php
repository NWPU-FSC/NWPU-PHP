<?php
/**
 * Created by PhpStorm.
 * User: Banixc
 * Date: 2016/8/7
 * Time: 8:49
 */



namespace Admin\Controller\Base;

class BaseAdminController extends BaseController{

    protected function _initialize()
    {
        //判断是否需要登录
        if(C('NEED_LOGIN'))
        if($this->_get_user_access_level()<C('LOGIN_ADMIN_LEVEL'))
            $this->error('操作失败,请登录!',C('USER_AUTH_GATEWAY'));
    }

    protected function get_current_user_id(){
        return session('user_id');
    }

    public function count_page($page,$all){
        $current = $page+1;
        $all_page = floor($all / C('PER_PAGE_NUMBER'));
        $all_page += ($all - $all_page * C('PER_PAGE_NUMBER')) >0?1:0;
        $this->assign_page($current,$all_page);
    }

    public function assign_page($current,$page){

        $this->assign('page_number',$page);
        $this->assign('page_current',$current);

    }

    public function echo_page(){

    }

    public function set_title($title){
        $this->assign("title",$title);
    }

    public function display($templateFile = '', $charset = '', $contentType = '', $content = '', $prefix = '')
    {
        $this->assign("ACCESS",$this->_get_user_access_level());
        parent::display($templateFile, $charset, $contentType, $content, $prefix); // TODO: Change the autogenerated stub
    }


}