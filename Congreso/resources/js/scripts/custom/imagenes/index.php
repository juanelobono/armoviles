<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

//error_reporting(E_ALL | E_STRICT);
require('uploadHandler.php');

if(empty($_GET["idDB"])) exit();

$urlLlamada = $_SERVER['HTTP_REFERER'];


$uploadDir = dirname($_SERVER['SCRIPT_FILENAME']) .'/' .$_GET["idDB"]  .'/';
$uploadURL = get_url() .'/' .$_GET["idDB"]  .'/';
$scriptURL = get_url() .'/index.php?idDB=' .$_GET["idDB"];	

$options = array('upload_dir'=>$uploadDir, 'upload_url'=>$uploadURL, 'script_url' =>$scriptURL);
$upload_handler = new UploadHandler($options);

function get_url() {
    $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    return
        ($https ? 'https://' : 'http://').
        (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
        (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
        ($https && $_SERVER['SERVER_PORT'] === 443 ||
        $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
        substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
}

