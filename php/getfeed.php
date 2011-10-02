<?php
include("rss_php.php");
function getfeed($rsstoload)
{
$rss = new rss_php;
$rss->load($rsstoload);
$items = $rss->getItems();
return $items;
}
?>