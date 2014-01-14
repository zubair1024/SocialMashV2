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
	<title>Facebook PHP</title>
</head>
<body>
<h1>IT WORKS!!!!</h1>
<?php
	//get user from facebook object
	$user = $facebook->getUser();
	
	if ($user): //check for existing user id
		echo '<p>User ID: ', $user, '</p>';
	
		
		//print logout link
		echo '<p><a href="logout.php">logout</a></p>';
	else: //user doesn't exist
		$loginUrl = $facebook->getLoginUrl(array(
			'diplay'=>'popup',
			'scope'=>'read_mailbox,read_stream,read_friendlists,read_insights',
			'redirect_uri' => 'http://apps.facebook.com/myappsourcephp'
		));
		echo '<p><a href="', $loginUrl, '" target="_top">login</a></p>';
	endif; //check for user id
?>
</body>
</html>