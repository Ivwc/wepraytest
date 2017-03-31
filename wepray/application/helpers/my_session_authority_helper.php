<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('check_session_authority'))
{
    function check_session_authority(){
        $CI =& get_instance();
        $CI->load->library('session');
        if (isset($CI->session->userdata['logged_in'])) {
            $level = ($CI->session->userdata['logged_in']['level']);
            if($level==9){
                redirect('login', 'reflash');
            }else{
                return $level;
            }
        } else {
            redirect('login', 'reflash');
        }
    }
}
if ( ! function_exists('get_session_id'))
{
    function get_session_id(){
        $CI =& get_instance();
        $CI->load->library('session');
        if (isset($CI->session->userdata['logged_in'])) {
            $accountId = ($CI->session->userdata['logged_in']['accountId']);
            return $accountId;
        } else {
            return "";
        }
    }
}
if ( ! function_exists('get_session_name'))
{
    function get_session_name(){
        $CI =& get_instance();
        $CI->load->library('session');
        if (isset($CI->session->userdata['logged_in'])) {
            $account = ($CI->session->userdata['logged_in']['account']);
            return $account;
        } else {
            return "";
        }
    }
}
if ( ! function_exists('set_session'))
{
    function set_session($result){
        $session_data = array(
            'accountId' => $result[0]->accountId,
            'account' => $result[0]->accountName,
            'level' => $result[0]->accountLevel,
            );
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->set_userdata('logged_in', $session_data);
        clear_session_errorcount();
    }
}
if ( ! function_exists('unset_userdata'))
{
    function unset_userdata(){
        $session_data = array(
            'accountId' => '',
            'account' => '',
            'level' => '',
            );
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->unset_userdata('logged_in', $session_data);
        redirect('login', 'reflash');
    }
}
if ( ! function_exists('set_session_errorcount'))
{
    function set_session_errorcount(){
        $CI =& get_instance();
        $CI->load->library('session');
        if (isset($CI->session->userdata['session_errorcount'])) {
            $errorcount = ($CI->session->userdata['session_errorcount']['errorcount'])+1;
        } else {
            $errorcount=1;
        }
        $session_data = array(
            'errorcount' => $errorcount,
            );
        $CI->session->set_userdata('session_errorcount', $session_data);
    }
}

if ( ! function_exists('get_session_errorcount'))
{
    function get_session_errorcount(){
        $CI =& get_instance();
        $CI->load->library('session');
        if (isset($CI->session->userdata['session_errorcount'])) {
            $errorcount = ($CI->session->userdata['session_errorcount']['errorcount']);
            return $errorcount;
        } else {
            return 0;
        }
    }
}
if ( ! function_exists('clear_session_errorcount'))
{
    function clear_session_errorcount(){
        $CI =& get_instance();
        $CI->load->library('session');
        $session_data = array(
            'errorcount' => 0,
            );
        $CI->session->set_userdata('session_errorcount', $session_data);
    }
}
