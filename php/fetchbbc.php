<?php
include("getfeed.php");
include("feeds.php");
include("scrapeforimage.php");
function fetchfeed($arrayoffeeds,$limit)
{
	$bbcfeed=array();
	foreach($arrayoffeeds as $feed)
	{	
		
		$bbcfeed[$feed]=array();
		$rssfeed=getfeed($feed);
		$x=0;
		foreach ($rssfeed as $rssitem)
		{
			if ($x<$limit)
			{
			$media=scrape_bbc($rssitem["link"]);
			$bbcfeed[$feed][$x] = array(			
			$media[0],
			$media[1],
			$rssitem["link"],
			$rssitem["title"],
			$rssitem["description"]
									);
			
			$x++;
			}
		}
	}
	return $bbcfeed;

}
chdir("../");
unlink("bbc");
file_put_contents("bbc", serialize(fetchfeed($bbc,15)));
$old = umask(0);
chmod("bbc", 0777);
umask($old);
?>