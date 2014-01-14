<?php
  // Remember () to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('php-sdk/facebook.php');

  $facebook = new Facebook(array(
		'appId'  => '706942112669859',
		'secret' => 'aed5fb900bdfd589cfa171c3ebdc7e18'
	));

  
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css.css">
		<link href='http://fonts.googleapis.com/css?family=Nova+Square' rel='stylesheet' type='text/css'>
		<title>SOCIAL-MASH</title>
	</head>
  <body>

<header style="box-shadow: 0px 0px 30px 30px #000;" align="center">

<h1 align="center" style="font-family: 'Nova Square', cursive;">SOCIAL-MASH</h1>
<nav align="center" style="font-family: 'Nova Square', cursive;">
  <a href="">Button 1</a> |
  <a href="">Button 2</a> |
  <a href="">Button 3</a> |
  <a href="">Button 4</a> |
  <a href="">Button 5</a>
</nav>
</header>


<div class="container"style="padding: 0px 0px 700px 0px;color:#000;font-family: 'Nova Square', cursive; ">
<br><br><br>
<div style="padding: 10px;">


  <?php
  $user_id = $facebook->getUser();
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $user_profile = $facebook->api('/me','GET');
        echo "<br><br>Name: " . $user_profile['name'];
		//$user_graph = $facebook->api('/me?fields=id,name,education,favorite_athletes,hometown,location,likes,feed.limit(30)','GET');
		$user_graph1 = $facebook->api('/me');
		echo "<br><br>From: " . $user_graph1['location']['name'];
		//
		if ($user_graph1['sports']):
			echo '<h3 style="color:#000;">Favorite Sports</h3>';
			echo '<ul style="color:#000;">';
			foreach ($user_graph1['sports'] as $key => $value) {
				echo '<li>',$value['name'],'</li>';
			}
			echo '</ul>';
		endif;
		//LIKES USING FQL
		echo"<h2 style='color'>USING FQL</h2>";
		
		
		
		
		
		//LIKES USING HTTPD PATHS
		echo"<h2 style='color'>USING GRAPH API PATHS</h2>";
		$user_movies = $facebook->api('/me?fields=movies');
	
		 		echo "<ul>";
		 	foreach ($user_movies['movies']['data'] as $moviekey => $movievalue) 
		 	{
				echo '<li>',$movievalue['name'],'</li>';
				
			}
			echo "</ul>";
			
			//Getting the user's likes
			$user_likes = $facebook->api('/me?fields=likes');
			//Books
			echo '<br><br><h3 style="color:#000;">Favorite Books</h3><ul>';	
		 	foreach ($user_likes['likes']['data'] as $likekey => $likevalue) 
		 	{
				//echo '<li>',$likevalue['name'],'</li>';
				if ($likevalue['category']=="Book")
				{	
					echo '<li>',$likevalue['name'],'</li>';	
				}
			}
			echo "</ul>";
			//Movies
			echo '<br><br><h3 style="color:#000;">Favorite Movies</h3><ul>';	
		 	foreach ($user_likes['likes']['data'] as $likekey => $likevalue) 
		 	{
				//echo '<li>',$likevalue['name'],'</li>';
				if ($likevalue['category']=="Movie")
				{	
					echo '<li>',$likevalue['name'],'</li>';	
				}
			}
			echo "</ul>";
			//TV Shows
			echo '<br><br><h3 style="color:#000;">Favorite TV Shows</h3><ul>';	
		 	foreach ($user_likes['likes']['data'] as $likekey => $likevalue) 
		 	{
				//echo '<li>',$likevalue['name'],'</li>';
				if ($likevalue['category']=="Tv show")
				{	
					echo '<li>',$likevalue['name'],'</li>';	
				}
			}
			echo "</ul>";
			//Sports Teams
			echo '<br><br><h3 style="color:#000;">Favorite Sports Teams</h3><ul>';	
		 	foreach ($user_likes['likes']['data'] as $likekey => $likevalue) 
		 	{
				//echo '<li>',$likevalue['name'],'</li>';
				if ($likevalue['category']=="Professional sports team")
				{	
					echo '<li>',$likevalue['name'],'</li>';	
				}
			}
			echo "</ul>";
			//Sports
			echo '<br><br><h3 style="color:#000;">Favorite Sports</h3><ul>';	
		 	foreach ($user_likes['likes']['data'] as $likekey => $likevalue) 
		 	{
				//echo '<li>',$likevalue['name'],'</li>';
				if ($likevalue['category']=="Sport")
				{	
					echo '<li>',$likevalue['name'],'</li>';	
				}
			}
			echo "</ul>";
			//Interest
			echo '<br><br><h3 style="color:#000;">Interests</h3><ul>';	
		 	foreach ($user_likes['likes']['data'] as $likekey => $likevalue) 
		 	{
				//echo '<li>',$likevalue['name'],'</li>';
				if ($likevalue['category']=="Interest")
				{	
					echo '<li>',$likevalue['name'],'</li>';	
				}
			}
			echo "</ul>";
			
			
			
			
		 //}
		
		/*if ($user_graph1['likes']):
			echo '<h2 style="color:#000;">Favorite Movies</h2>';
			echo '<ul style="color:#000;">';
			foreach ($user_graph1['likes']['data'] as $key => $value) 
			{			
					echo '<li">',$value['name'],'</li>';	
			}
			echo '</ul>';
		endif;
	
		*/
		
		//echo "<br><br><a href='",$user_graph['likes']['paging']['next'],"'>NEXT</a><br><br>";
		echo "<br><br><b>DATA:<b><br><br><br><pre>",print_r($user_graph1),"</pre>";
		

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $loginUrl = $facebook->getLoginUrl(array(
			'diplay'=>'popup',
			'scope'=>'email',
			'redirect_uri' => 'https://social-mash.herokuapp.com'
			//'redirect_uri' => 'http://apps.facebook.com/myappsourcephp'
		));
        echo '<p><a href="', $loginUrl, '" target="_top">login</a></p>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
      $loginUrl = $facebook->getLoginUrl(array(
			'diplay'=>'popup',
			//'scope'=>'read_mailbox,read_stream,read_friendlists,read_insights',
			'scope'=>'user_about_me, user_actions.books, user_actions.music, user_actions.news, user_actions.video, user_activities, user_birthday, user_checkins, user_education_history, user_events, user_friends, user_games_activity, user_groups, user_hometown, user_interests, user_likes, user_location, user_notes, user_online_presence, user_photo_video_tags, user_photos, user_questions, user_relationship_details, user_relationships, user_religion_politics, user_status, user_subscriptions, user_videos, user_website, user_work_history',
			'redirect_uri' => 'http://apps.facebook.com/myappsourcephp'
		));
      echo '<p><a href="', $loginUrl, '" target="_top">login</a></p>';

    }

  ?>
</div>
</div>

  <footer style="box-shadow: 0px 0px 10px 10px #000;"><nav align="center" style="font-family: 'Nova Square', cursive;">
  <a href="">Button 1</a> |
  <a href="">Button 2</a> |
  <a href="">Button 3</a> |
  <a href="">Button 4</a> |
  <a href="">Button 5</a>
</nav><h3 align="center" style="font-family: 'Nova Square', cursive;">Created by Your TATA</h3>
  </footer>
  
  </body>
</html>