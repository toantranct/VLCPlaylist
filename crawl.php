<?php
/**
	* Crawl all episode from URL
	* @return Array all ID of link to episodes
*/

// header('Set-Cookie: server_watching=Hydrax');

function get_all_episode($url) {
	$resp = curl($url);
	$dom = new DOMDocument();
	@$dom->loadHTML($resp);
	$xpath = new DOMXPATH($dom);
	$listEpisodeURL = $xpath->query("/html/body/div[2]/div[2]/div[4]/div[4]/div[1]/div[2]/a[@href]");
	$episodes = array();
	foreach ($listEpisodeURL as $episode) {
	    array_push($episodes, $episode->getAttribute("href"));
	}
	return $episodes;
}

// After has link episodes, find URL VPRO and continue process
function get_URL_ep_VPRO_server($url_episode) {
	$resp = curl($url_episode);
	$dom = new DOMDocument();
	@$dom->loadHTML($resp);
	$html = $dom->saveHTML();
	$first_pos =  strpos($html, "https://suckplayer.xyz");
	$link = explode("\"", substr($html, $first_pos, 200))[0];
	return $link;
}

function test($url_episode) {
	$resp = curl($url_episode);

	$scriptContainer = [];
	$str = preg_replace_callback ("#<script([^>]*)>(.*?)</script>#s", function ($matches) use (&$scriptContainer) {
	     $scriptContainer[md5($matches[2])] = $matches[2];
	        return "<script".$matches[1].">".md5($matches[2])."</script>";
	    }, $resp);
	$dom = new \DOMDocument();
	@$dom->loadHTML($str);
	$final = strtr($dom->saveHTML(), $scriptContainer); 
	return $final;
}





?>