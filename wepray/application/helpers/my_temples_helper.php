<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getInformation'))
{
    function getInformation($id){
        $CI =& get_instance();
        $CI->load->model('wepray_temples_model');
        return $CI->wepray_temples_model->get_my_temples($id);
    }
}
if ( ! function_exists('getInformationModify'))
{
    function getInformationModify($id){
        $CI =& get_instance();
        $CI->load->model('wepray_temples_model');
        return $CI->wepray_temples_model->get_my_temples_info_modify_byId($id);
    }
}
if ( ! function_exists('getMapModify'))
{
    function getMapModify($id){
        $CI =& get_instance();
        $CI->load->model('wepray_temples_model');
        return $CI->wepray_temples_model->get_my_temples_map_modify_byId($id);
    }
}

if ( ! function_exists('setViewForUpdateInformationDiv'))
{
    function setViewForUpdateInformationDiv($type,$name,$modifyName){
        $sName='';
        if($type==0){
            $sName='行政区';
        }else if($type==1){
            $sName='名称';
        }else if($type==2){
            $sName='地址';
        }else if($type==3){
            $sName='电话';
        }else if($type==4){
            $sName='介绍';
        }
        $str='<br/><br/>';
        $str=$str.'<table class="table"><tbody>';
        $str=$str.'<tr class="active" ><td width="150">修改'.$sName.'前</td><td>'.$name.'</td></tr><tr class="active"><td>修改'.$sName.'后</td><td>'.$modifyName.'</td></tr>';
        $str=$str.'</tbody> </table>';
        echo  $str;
    }
}