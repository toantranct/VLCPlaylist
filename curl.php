<?php
	function curl($url,$vars = NULL,$method = 'GET',$fl = 0,$head = 0,$nobody = 0)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		if ($method == 'POST') {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
		}
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,$fl);
		curl_setopt($ch, CURLOPT_HEADER,$head);
		curl_setopt($ch, CURLOPT_NOBODY,$nobody);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		// curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
		//curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
		ob_start();
		$result = curl_exec($ch);
		curl_close($ch);
		ob_end_clean();
		return $result;
	}

?>