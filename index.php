<?php

// use curlspot.orchestra.io to launch

// $url = 'http://www.indeed.com/rc/clk?jk=ca819a6473e3c8a9';
$j = preg_replace("/[^a-zA-Z0-9\s]/", "", $_GET["j"]);

if (strlen($j) > 6) {
		$url = 'http://www.indeed.com/rc/clk?jk='.$j;
		echo curlme($url);
}

function curlme($url) {
		$proxy = ''; //'205.251.154.158:80';
		$ch = curl_init();
		if($proxy !== null){		
		    // no need to specify PROXYPORT again
		    curl_setopt($ch, CURLOPT_PROXY, $proxy);
				// to make the request go through as though proxy didn't exist
		    curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);		
		}
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$a = curl_exec($ch);
		if(preg_match('#Location: (.*)#', $a, $r))
		 $l = trim($r[1]);
		
		if (isset($l) && (preg_match('#indeed.com#', $a, $r))) {
    		curl_setopt($ch, CURLOPT_URL, $l);
				$a = curl_exec($ch);
				if(preg_match('#Location: (.*)#', $a, $r))
		 		$l = trim($r[1]);
		}
		
		return $l;
}

?>