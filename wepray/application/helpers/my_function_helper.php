<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('loadView'))
{
	function loadView($viewName)
	{
		$CI =& get_instance();
		$CI->load->view($viewName);
	}
}
if ( ! function_exists('getAsset'))
{
	function getAsset()
	{
		return base_url()."asset/";
	}
}
if ( ! function_exists('setImportAsset'))
{
	function setImportAsset($val)
	{
		if (strpos($val, '.css') !== false) {
			echo '<link rel="stylesheet" href="'.base_url()."asset/css/".$val."?".time().'">';
		}else if (strpos($val, '.js') !== false) {
			echo '<script src="'.base_url()."asset/js/".$val."?".time().'"></script>';
		}
	}
}

if ( ! function_exists('getAssetImagePath'))
{
	function getAssetImagePath()
	{
		return base_url()."asset/img/";
	}
}

if ( ! function_exists('getAssetImage'))
{
	function getAssetImage()
	{
		return "asset/img/";
	}
}
if ( ! function_exists('checkString'))
{
    function checkString($s1,$s2){

        return strcmp($s1,$s2);
    }
}

if ( ! function_exists('getProductImagePath'))
{
	function getProductImagePath()
	{
		$parts = parse_url(base_url());
		// return $parts['scheme']."://".$parts['host'] . $parts['path'];
		return "../wepray_img/product_img/";
	}
}
if ( ! function_exists('getProductImageFile'))
{
	function getProductImageFile($id)
	{
		$parts = parse_url(base_url());
		// return $parts['scheme']."://".$parts['host'] . $parts['path'];
		return $parts['scheme']."://".$parts['host'] ."/wepray_img/product_img/".$id;
	}
}