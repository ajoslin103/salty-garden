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

        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
        <script type="javascript">
			$(document).ready(function() {
				$('#search').on('change', () => {
					frag = $('#search').val()
					$('.post').each(function() {
						if ($this.text().includes(frag)) {
							$this.show();
						} else {
							$this.hide();
						}
					})
				})
			});
		</script>

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
?>
			<h2>
				<span><?php echo $site; ?></span>
				<span>&nbsp;&nbsp;&nbsp;</span>
				<span>
					<input type="text" id="search" size="25"/>
				</span>
			</h2>
<?php
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
    </body>
</html>