<?php
include("getfeed.php");
include("feeds.php");
include("scrapett.php");
function fetchfeed($arrayoffeeds,$limit)
{
	$ttfeed=array();
	foreach($arrayoffeeds as $feed)
	{	
		
		$ttfeed[$feed]=array();
		$rssfeed=getfeed($feed);
		$x=0;
		foreach ($rssfeed as $rssitem)
		{
			if ($x<$limit)
			{
			$media=scrape_tt($rssitem["link"]);
			$ttfeed[$feed][$x] = array(			
			$media[0],
			$media[1],
			$rssitem["link"],
			$rssitem["title"],
			preg_replace("/<img[^>]+\>/i", "", ($rssitem["description"]))
									);
			
			$x++;
			}
		}
	}
	return $ttfeed;

}
chdir("../");
unlink("tt");
file_put_contents("tt", serialize(fetchfeed($thetimes,5)));
$old = umask(0);
chmod("tt", 0777);
umask($old);
?>