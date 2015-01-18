<?php
	require_once('Zend/Loader.php');
	Zend_Loader::registerAutoload();

	$controller = Zend_Controller_Front::getInstance();
	$controller->setParam('useDefaultControllerAlways', true);
	$controller->setControllerDirectory('../include/Controllers');
	$controller->dispatch();

?>
