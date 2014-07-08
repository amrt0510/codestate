<?php

require_once('simple_html_dom.php');
//$url  = 'http://www.google.com/search?hl=en&safe=active&tbo=d&site=&source=hp&q=site:elto.com/projects/&oq=site:elto.com/projects/&start=0&num=100';
// .com
//$url  = 'http://www.google.com/search?hl=en&safe=active&tbo=d&site=&source=hp&q=gravity%20forms%20reviews&oq=gravity%20forms%20reviews&start=0&num=100';
// .com.au


$term = 'yahoo search engine working';
$url = 'http://www.google.com/search?q=' . urlencode($term) . '&start=0&num=100';

$html = file_get_html($url);

$linkObjs = $html->find('h3.r a');

$array = array();
$i = 1;
foreach ($linkObjs as $linkObj) {
    $title = trim($linkObj->plaintext);
    $link = trim($linkObj->href);

    // if it is not a direct link but url reference found inside it, then extract
    if (!preg_match('/^https?/', $link) && preg_match('/q=(.+)&amp;sa=/U', $link, $matches) && preg_match('/^https?/', $matches[1])) {
        $link = $matches[1];
    } else if (!preg_match('/^https?/', $link)) { // skip if it is not a valid link
        continue;
    }
    $array[] = $link;
    echo '<p> ' . $i . '. Title: ' . $title . '<br />';
    echo 'Link: ' . $link . '</p>';
    $i++;
}

//echo json_encode($array);
?>
