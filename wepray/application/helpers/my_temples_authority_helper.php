<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('check_temples_authority'))
{
    function check_temples_authority(){
        $CI =& get_instance();
        $CI->load->library('session');
        if (isset($CI->session->userdata['temples_inf'])) {
            $templeId = ($CI->session->userdata['temples_inf']['templeId']);
            return $templeId;
        } else {
            redirect('pages', 'reflash');
        }
    }
}
if ( ! function_exists('get_temples_id'))
{
    function get_temples_id(){
        $CI =& get_instance();
        $CI->load->library('session');
        if (isset($CI->session->userdata['temples_inf'])) {
            $templeId = ($CI->session->userdata['temples_inf']['templeId']);
            return $templeId;
        } else {
            return 0;
        }
    }
}
if ( ! function_exists('set_temples'))
{
    function set_temples($templeId){
        $session_data = array(
            'templeId' => $templeId,
            );
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->set_userdata('temples_inf', $session_data);
    }
}
if ( ! function_exists('unset_templesdata'))
{
    function unset_templesdata(){
        $session_data = array(
            'templeId' => '',
            );
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->unset_userdata('temples_inf', $session_data);
    }
}
