<?php 
	require 'php-sdk/facebook.php';
	$facebook = new Facebook(array(
		'appId'  => '706942112669859',
		'secret' => 'aed5fb900bdfd589cfa171c3ebdc7e18'
	));
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>SOCIAL-MASH</title>
</head>
<body>
<h1>SOCIAL-MASH</h1>
<h2>IT WORKS!!!!</h2>
<?php
	
	$user = $facebook->getUser();
	
	if ($user): 
		echo '<p>User ID: ', $user, '</p>';
	
		
		
		echo '<p><a href="logout.php">logout</a></p>';
	else:
		$loginUrl = $facebook->getLoginUrl(array(
			'diplay'=>'popup',
			'scope'=>'read_mailbox,read_stream',
			'redirect_uri' => 'http://apps.facebook.com/myappsourcephp'
		));
		echo '<p><a href="', $loginUrl, '" target="_top">login</a></p>';
	endif; 
?>
</body>
</html>