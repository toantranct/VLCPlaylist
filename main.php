<?php
   include 'curl.php';
   include 'process.php'; // find url stream 
   include 'm3u.php';     // create and add url stream to m3u file
   include 'crawl.php';    // find all link ep
   /**
   * Has URL of anime series, process and return m3u file to use
   * Current support server VPRO
*/
   
   $url_movie = "https://animehay.pro/thong-tin-phim/yuusha-party-wo-tsuihou-sareta-beast-tamer-saikyoushu-no-nekomimi-shoujo-to-deau-3599.html";
   $episodes = get_all_episode($url_movie);

   $m3u = new m3u();

   foreach ($episodes as $url_episode) {
      // process for onec url ep      
      $url_ep =  get_URL_ep_VPRO_server($url_episode);
      $list = explode("/", $url_ep);
      $id_vid = $list[count($list) - 1];   
      $output = conver_ID_to_hls($id_vid);
      $m3u->addEpisode($output);
   }

// echo $m3u->toString();
echo "content saved to test.m3u!";
file_put_contents("test.m3u", $m3u->toString());

?>
