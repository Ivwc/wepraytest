<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getCountry'))
{
	function getCountry()
	{
	    $CI =& get_instance();
	    $CI->load->model('address_model');
	    return $CI->address_model->get_country();
	}
}

if ( ! function_exists('getProvince'))
{
	function getProvince()
	{
	    $CI =& get_instance();
	    $CI->load->model('address_model');
	    return $CI->address_model->get_province();
	}
}

