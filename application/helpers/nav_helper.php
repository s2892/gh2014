<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('nav_menu'))
{	
	function nav_menu($component,$module)
	{
		$data = '';
		$data.='<ul>';
		$data.='<li class="active">';
		$data.='		<span title="Inner Navigation">';
        $data.='           <i class="icon-home"></i>';
        $data.='         	<span class="nav-title">'.$component.'</span>';
        $data.='      	</span>';
        $data.='         <ul class="inner-nav">';
		$data.='    <li class="active">
<a href="sales">
<i class="icol-dashboard"></i>
Menu 1
</a>
</li>
<li >
<a href="sales2">
<i class="icol-dashboard"></i>
Menu 1
</a>
</li>   

        ';
		$data.='</ul>';
		$data.='</li>';
		$data.='</ul>';
		return $data;
	}
	
}

if ( ! function_exists('breadcrumbs_nav'))
{	
	function breadcrumbs_nav($component,$module)
	{
		$data = '
		<ul class="breadcrumb">
                            	
                            	
                                	<li>
                                    	<i class="icon-home"></i>MoonCake
                                        <span class="divider">&raquo;</span>
                                    </li>
                                    <li>
                                    	<a href="#">Empty Page</a>
                                    </li>
                                </ul>
		
		
		
		';
		return $data;
	}
	
}