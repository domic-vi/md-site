<?php

#show($_SERVER);

$rootDir = dirname(__DIR__);
chdir($rootDir);

$uri = @$_SERVER['REQUEST_URI'];
if (!strlen($uri)) $uri = '/';

if (preg_match('/(\.\.| |%)/', $uri)) error_html_raise(403, "Broken url");

if (preg_match('/\/$/', $uri)) $uri .= 'Home';

require("lib/config.php");
if (defined('ICWIK_PATH') && ICWIK_PATH && ICWIK_PATH !== '/' && strpos($uri, ICWIK_PATH) === 0) {
	$uri = substr($uri, strlen(ICWIK_PATH));
}

$filename =  '.' . $uri . ".md";

if (!is_file($filename)) error_html_raise(404, "Not found");

if (!is_readable($filename)) error_html_raise(403, "Access to $uri is denied");
$mdText = file_get_contents($filename);
if (!$mdText) error_html_raise(403, "$uri : file is empty");

#die($filename);

require("lib/Parsedown.php");
$Parsedown = new Parsedown();

$mdText = strtr($mdText, array(
		# Вырезаем #! перед кодом, которые навставлял bitbucket
		"#!\n" => '',
		"#!\r\n" => '',
	));

$mdHtml = $Parsedown->text($mdText);
require("lib/template.php");


/** htmlspecialchars */
function html_var($var) {
    if (!is_array($var) && !is_object($var)) return htmlspecialchars($var, ENT_QUOTES);
    $a = [];
    foreach ($var as $key => $value) $a[$key] = html_var($value);
    return $a;
}


/** Little debug tool */
function show($var, $exit=true) {
	$var = print_r($var, true);
	
		$var = html_var($var);
		$p = "<pre>\n";
		$p2 = "\n</pre>";

	echo "{$p}==============\n".$var."\n=============={$p2}";
	if ($exit) die();
}

/**
 * Генерирует ошибку HTML
 * 
 * @param int $errcode Код ошибки
 * 
 */
function error_html_raise($errcode, $msg=null) {
	static $error_descs = array(
		403 => '403 Forbidden',
		404 => '404 Not Found',
		500 => '500 Internal Server Error',
	);

	$descCode = isset($error_descs[$errcode]) ? $error_descs[$errcode] : "$errcode Unknown Error";
	header("HTTP/1.0 $descCode");

	if (!$msg) $msg = $descCode;
	die($msg);
}
