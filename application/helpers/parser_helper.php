<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CI Smarty
 *
 * Smarty templating for Codeigniter
 *
 * @package   CI Smarty
 * @author    Dwayne Charrington
 * @copyright Copyright (c) 2012 Dwayne Charrington and Github contributors
 * @link      http://ilikekillnerds.com
 * @license   http://www.apache.org/licenses/LICENSE-2.0.html
 * @version   2.0
 */

/**
 * Theme URL
 *
 * A helper function for getting the current theme URL
 * in a web friendly format.
 *
 * @param string $location
 * @return mixed
 */
function theme_url($location = '')
{
    $CI =& get_instance();

    return $CI->parser->theme_url($location);
}

/**
 * CSS
 *
 * A helper function for getting the current theme CSS embed code
 * in a web friendly format
 *
 * @param $file
 * @param $attributes
 */
function css($file, $attributes = array())
{
    $CI =& get_instance();

    echo $CI->parser->css($file, $attributes);
}
function pcss($file, $path='/', $t='',$attributes = array())
{
    $CI =& get_instance();

    echo $CI->parser->pcss($file, $path, $t, $attributes);
}

/**
 * JS
 *
 * A helper function for getting the current theme JS embed code
 * in a web friendly format
 *
 * @param $file
 * @param $attributes
 */
function js($file, $attributes = array())
{
    $CI =& get_instance();

    echo $CI->parser->js($file, $attributes);
}


function pjs($file, $path='/', $t='',$attributes = array())
{
    $CI =& get_instance();

    echo $CI->parser->pjs($file, $path, $t, $attributes);
}

function pahref($url, $content, $title='title', $target='_self', $attributes = array())
{
	$CI =& get_instance();

    echo $CI->parser->pahref($url, $content,$title, $target, $attributes);
	
}
/**
 * IMG
 *
 * A helper function for getting the current theme IMG embed code
 * in a web friendly format
 *
 * @param $file
 * @param $attributes
 */
function img($file, $attributes = array())
{
    $CI =& get_instance();

    echo $CI->parser->img($file, $attributes);
}