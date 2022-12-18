<?php
/**
      * From id of video from website, process and convert to URL video import to VLC
*/

function get_id_url_stream($id_vid) {
   $url = "https://suckplayer.xyz/player/index.php?data=" . $id_vid . "&do=getVideo";

   $curl = curl_init($url);
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_POST, true);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

   $headers = array(
      "authority: suckplayer.xyz",
       "content-type: application/x-www-form-urlencoded; charset=UTF-8","Content-Type: application/json",
      "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36",
      "x-requested-with: XMLHttpRequest",
   );
   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

   $data = "hash=".$id_vid."&r=https://animehay.pro/";

   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
   $resp = curl_exec($curl);
   curl_close($curl);
   $output = json_decode($resp)->videoSource;
   $id_url_stream = explode("/", $output)[5];
   return $id_url_stream;
}


function get_url_stream_for_best($id_url_stream) {
    // get conntent file m3u
    $url = "https://suckplayer.xyz/cdn/hls/".$id_url_stream."/master.txt";
    $resp = curl($url);
     /*
    Dang file resp nhu sau:

     #EXTM3U
    #EXT-X-VERSION:3
    ## [ FirePlayer ] by Neron (c) 2018~ | firevideoplayer.com | Skype : neronsilence ##
    #EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=700000,RESOLUTION=640x360,NAME="360p",CODECS="avc1.4D4015,mp4a.40.2"
    link1
    #EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=3500000,RESOLUTION=1280x720,NAME="720p",CODECS="avc1.4D401F,mp4a.40.2"
    link2
    #EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=5800000,RESOLUTION=1920x1080,NAME="1080p",CODECS="avc1.640028,mp4a.40.2"
    link3


    tra ve 3 link tuong duong voi 360p,720p, va 1080p;
     */
   // lay video co do phan giai cao nhat
    $array = explode("\n", $resp);
    // print_r(count($array));
    return $array[count($array) - 1];
}


function conver_ID_to_hls($id_vid) {
   $id_url_stream = get_id_url_stream($id_vid);
   $url_stream = get_url_stream_for_best($id_url_stream);
   return $url_stream;
}
?>
