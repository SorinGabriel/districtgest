<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sortareNumarCamere'))
{

	function sortareNumarCamere($x,$y) 
	{
		return strcmp($x->numar, $y->numar);
	}

}

?>