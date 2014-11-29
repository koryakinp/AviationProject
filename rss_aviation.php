<?php
require_once 'auxiliary/Database.php';
include_once 'Model/News.php';
header('Content-type:text/xml');
$newss = DataBase::getNews();
//var_dump($newss->fetch());
$aviationrss = '<?xml version="1.0" encoding="ISO-8859-1"?>';
$aviationrss .= '<rss version="2.0">';
$aviationrss .= '<channel>';
$aviationrss .= '<title>Aviation RSS</title>';
//$aviationrss .= '<link>http://localhost/Aashish/AviationRSS/</link>';
$aviationrss .= '<pubDate>Sat, 1 Nov 2014 12:34:12</pubDate>';
$aviationrss .= '<description> Project XML </description>';
$aviationrss .= '<language>en-gb</language>';



foreach ($newss as $rss){
    $aviationrss .= '<item>';
    $aviationrss .= '<title>' . $rss['newsTitle'] . '</title>';
    $aviationrss .= '<pubDate>' . $rss['datePosted'] . '</pubDate>';
    $aviationrss .= '</item>';
}
$aviationrss .= '</channel>';
$aviationrss .= '</rss>';

echo $aviationrss;
?>
