<?php
	$news = array();
	foreach ($rssfeed->getElementsByTagName('item') as $n) 
            {
		$item = array ( 
			'title' => $n->getElementsByTagName('title')->item(0)->nodeValue,
			'link' => $n->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $n->getElementsByTagName('pubDate')->item(0)->nodeValue,
                        'des' => $n->getElementsByTagName('description')->item(0)->nodeValue,
			);
		array_push($news, $item);
            }
            
	for($x=0;$x<10;$x++) {
		$title = $news[$x]['title'];
		$link = $news[$x]['link'];
		$date = $news[$x]['date'];
                $description = $news[$x]['des'];
		echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
		echo '<small><em>Posted on '.$date.'</em></small></p>';
		echo '<p><font color=green>'.$description.'</font></p>';
	}
?>