<?php
	class m3u  {

	/**
		* Conver URL every episode to playlist m3u
		* @param int $n size of list episode
		* @param array $episode list episode
		* @param string $name name of anime if has
		* @return m3u string format
	*/

	private $n;
	private $episode;
	private $name;
	function __construct($n = 0, $episode = null, $name = "") {
		$this->n = $n;
		if ($episode == null) 
			$this->episode = array();
		$this->episode = array();
		$this->name = $name;
	}

	public function addEpisode($url) {
		$this->episode[] = $url;
		$this->n++;
	}

	public function getEpisode($i) {
		if ($i > $n) return -1;
		return $this->episode[$i];
	}
	public function getN() {
		return $this->n;
	}
	public function toString()  {
		$string = "#EXTM3U\n";
		if ($this->name != "")
		$string .= "\n#PLAYLIST:" . $this->name . "\n";
		for ($i = $this-> n - 1; $i >= 0;$i--) {
			$string .= "#EXTINF:-1 tvg_name = \" Tập " . $i+1 . "\", Tập ". $i + 1 . "\n" . $this->episode[$i] . "\n";
		}

		return $string;
	}
}
?>