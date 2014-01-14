<?php
	require 'php-sdk/facebook.php';
	$facebook = new Facebook(array(
		'appId'  => '706942112669859',
		'secret' => 'aed5fb900bdfd589cfa171c3ebdc7e18'
	));

	setcookie('fbs_'.$facebook->getAppId(),'', time()-100, '/', 'socialmash.net84.net');
	$facebook->destroySession();
	header('Location: index.php');
?>
