<?php

$timn = unserialize(file_get_contents("../timn"));
	
function display($feed)
{
		foreach ($feed as $rssitem)
		{
						
			$imagesrc=$rssitem[0];
			$imagealt=$rssitem[1];
			$link=$rssitem[2];
			$title=$rssitem[3];
			$description=$rssitem[4];

			if ($imagesrc!='')
			{?>
<li><div class="front" style="display: block; -webkit-transform: skew(0deg, 0deg) scale(1, 1); ">
<?php 			
			//front			
			echo ('<article>');
			echo ('<h2>'.$title.'</h2>');
			if ($imagesrc!='')
			{
			echo ('<figure><img src="'.$imagesrc.'" alt="'.$imagealt.'"/><imgmask/></figure>');
			}
			echo ('</article>');
			?></div><div class="back" style="left: 0px; display: none; -webkit-transform: skew(0deg, 0deg) scale(1, 1); ">
<?php
			//back			
			echo ('<article>');
			echo ('<a href="'.$link.'">');
			echo ('<h3>'.$title.'</h3>');
			echo ('</a>');			
			echo ('<summary>');
			echo ('<span>'.$description.'</span>');						
			echo ('</summary>');
			echo ('</article>');
			
			?></div></li>
		

			<?php
			} 
		}
}

display($timn);
?>
<script type="text/javascript" src="js/jquery.flippy.init.js"></script>