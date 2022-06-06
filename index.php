<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="cleartype" content="on">

        <!-- iPad and iPad mini (with @2× display) iOS ≥ 8 -->
        <link rel="apple-touch-icon-precomposed" sizes="180x180" href="img/touch/apple-touch-icon-180x180-precomposed.png">
        <!-- iPad 3+ (with @2× display) iOS ≥ 7 -->
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/touch/apple-touch-icon-152x152-precomposed.png">
        <!-- iPad (with @2× display) iOS ≤ 6 -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/touch/apple-touch-icon-144x144-precomposed.png">
        <!-- iPhone (with @2× and @3 display) iOS ≥ 7 -->
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/touch/apple-touch-icon-120x120-precomposed.png">
        <!-- iPhone (with @2× display) iOS ≤ 6 -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch/apple-touch-icon-114x114-precomposed.png">
        <!-- iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7 -->
        <link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/touch/apple-touch-icon-76x76-precomposed.png">
        <!-- iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6 -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch/apple-touch-icon-72x72-precomposed.png">
        <!-- Android Stock Browser and non-Retina iPhone and iPod Touch -->
        <link rel="apple-touch-icon-precomposed" href="img/touch/apple-touch-icon-57x57-precomposed.png">
        <!-- Fallback for everything else -->
        <link rel="shortcut icon" href="img/touch/apple-touch-icon.png">

        <link rel="icon" sizes="192x192" href="img/touch/touch-icon-192x192.png">
        <link rel="icon" sizes="128x128" href="img/touch/touch-icon-128x128.png">

        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileImage" content="img/touch/apple-touch-icon-144x144-precomposed.png">
        <meta name="msapplication-TileColor" content="#222222">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>

		<div class="content">

 <?php

		$url = "https://salty-garden-64703.herokuapp.com/feed.xml";

		$invalidurl = false;
		if(@simplexml_load_file($url)){
			$feeds = simplexml_load_file($url);
		} else {
			$invalidurl = true;
			echo "<h2>Invalid RSS feed URL.</h2>";
		}

		$i=0;
		if(!empty($feeds)) {

			$site = $feeds->channel->title;

			echo "<h2>".$site."</h2>";
			foreach ($feeds->channel->item as $item) {

				$title = $item->title;
				$link = (string) $item->enclosure->attributes()->url;
				$description = $item->description;
				$postDate = $item->pubDate;
				$pubDate = date('D, d M Y',strtotime($postDate));
 ?>
				<div class="post">
					<div class="post-head">
						<h2><a class="feed_title" href="<?php echo $link; ?>"><?php echo $title; ?></a></h2>
						<span><?php echo $pubDate; ?></span>
					</div>
					<div class="post-content">
						<?php echo $description; ?>
					</div>
				</div>

 <?php
				$i++;
			}
		} else {
			if(!$invalidurl){
				echo "<h2>No item found</h2>";
			}
		}
 ?>
        <script src="js/vendor/jquery-2.1.3.min.js"></script>
        <script src="js/helper.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>