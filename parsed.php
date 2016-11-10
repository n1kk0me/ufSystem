<?php
	//suppress errors
	error_reporting(0);

	//parse target
	$xmlTarget=("http://www.gmanetwork.com/news/rss/scitech/weather");

	$thisXMLDoc = new DOMDocument();
	$thisXMLDoc->load($xmlTarget);

	//loop to get news inside item tag
	$x=$thisXMLDoc->getElementsByTagName('item');
	for ($i = 0; $i <= 15; $i++) {
		$thisItemTitle = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
		$thisItemDescription = $x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
		$thisItemDate = $x->item($i)->getElementsByTagName('pubDate')->item(0)->childNodes->item(0)->nodeValue;

		$thisItemDate = str_replace("+0800", "", $thisItemDate);

		if (strpos($thisItemTitle, 'Visayas') !== false) {
			echo $thisItemTitle . "<br>";
			echo $thisItemDescription;
		}
	}
?>