<?php
//error_reporting(0);

function scrape_tt($url)
{
$divs=getElementByClassName($url,'ssImg');
if (strlen($divs)!=1)
{
$images = getimage($divs);
return $images;
}

};
?>


<?php 
function getimage($html)
{
$dom = new domDocument;
$dom->loadHTML($html);
$dom->preserveWhiteSpace = false;
$images = $dom->getElementsByTagName('img');
foreach ($images as $image) {
  $src= $image->getAttribute('src');
  $alt= $image->getAttribute('alt');
}
$imgdata = array ($src, $alt);
return $imgdata;
}
?>



<?php
function getElementByClassName($some_link,$attrValue)
{
$tagName = 'div';
$attrName = 'class';

$dom = new DOMDocument;
$dom->preserveWhiteSpace = false;
@$dom->loadHTMLFile($some_link);


 $html = '';
    $domxpath = new DOMXPath($dom);
    $newDom = new DOMDocument;
    $newDom->formatOutput = true;

    $filtered = $domxpath->query("//$tagName" . '[@' . $attrName . "='$attrValue']");
    // $filtered =  $domxpath->query('//div[@class="className"]');
    // '//' when you don't know 'absolute' path

    // since above returns DomNodeList Object
    // I use following routine to convert it to string(html); copied it from someone's post in this site. Thank you.
    $i = 0;
    while( $myItem = $filtered->item($i++) ){
        $node = $newDom->importNode( $myItem, true );    // import node
        $newDom->appendChild($node);                    // append node
    }
    $html = $newDom->saveHTML();


return $html;
}
?>

