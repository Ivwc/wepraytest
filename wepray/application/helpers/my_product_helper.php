<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('chk_product_is_templeid'))
{
	function chk_product_is_templeid($templeid,$pid)
	{	
		
		$CI =& get_instance();
		$CI->load->model('mod_product');
		if ($CI->mod_product->chk_once_product($templeid,$pid)) {
            return true;
        }else{
            return false;
        }

		
	}
}
?>