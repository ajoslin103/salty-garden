<div class="content">

 <?php

 $url = "https://salty-garden-64703.herokuapp.com/feed.xml";

 $invalidurl = false;
 if(@simplexml_load_file($url)){
	$feeds = simplexml_load_file($url);
 }else{
	$invalidurl = true;
	echo "<h2>Invalid RSS feed URL.</h2>";
 }


 $i=0;
 if(!empty($feeds)){

	$site = $feeds->channel->title;
	$sitelink = $feeds->channel->link;

	echo "<h2>".$site."</h2>";
	foreach ($feeds->channel->item as $item) {

	$enclosure = $item->enclosure[0];

	$title = $item->title;
	$link = $enclosure->url;
	$description = $item->description;
	$postDate = $item->pubDate;
	$pubDate = date('D, d M Y',strtotime($postDate));


	if($i>=5) break;
	?>
	<div class="post">
		<div class="post-head">
			<h2><a class="feed_title" href="<?php echo $link; ?>"><?php echo $title; ?></a></h2>
			<span><?php echo $pubDate; ?></span>
		</div>
		<div class="post-content">
			<?php echo implode(' ', array_slice(explode(' ', $description), 0, 20)) . "..."; ?> <a href="<?php echo $link; ?>">Read more</a>
		</div>
	</div>

	<?php
		$i++;
	}
 }else{
	if(!$invalidurl){
		echo "<h2>No item found</h2>";
	}
 }
 ?>
</div>
