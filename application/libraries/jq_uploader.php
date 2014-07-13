<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'jqueryfileuploader/UploadHandler.php';

class jq_uploader 
{
	
	
  public function __construct() 
  {
    $upload_handler = new UploadHandler();
  }
}