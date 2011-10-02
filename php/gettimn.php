<?php
include("getfeed.php");
include("feeds.php");
include("scrapetimn.php");
function gettimn($rfeed,$limit)
{
	
		$feed=array();
		$rssfeed=getfeed($rfeed);
		$x=1;
		foreach ($rssfeed as $rssitem)
		{	
			if ($x<$limit)
			{	
			$media=scrape_timn($rssitem["link"]);
			$feed[$x] = array(			
			$media[0],
			$media[1],
			$rssitem["link"],
			$rssitem["title"],
			$rssitem["description"]
									);
			$x++;
			}
		}
		return $feed; 
}



chdir("../");
//unlink("timn");
file_put_contents("timn", serialize(gettimn($thisismynext,15)));
$old = umask(0);
chmod("timn", 0777);
umask($old);

?>