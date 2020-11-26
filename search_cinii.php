<section>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    define("ACCESS_URL",'https://ci.nii.ac.jp/opensearch/search?count=20&start=1&lang=ja&title=library&format=json&q=');
    $requestURL = ACCESS_URL.urlencode($_POST['search']);;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $requestURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_OPTIONS, CURLSSLOPT_ALLOW_BEAST);
    $request = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    if ($curl_errno > 0) { echo "cURL Error ($curl_errno): $curl_error\n";}
    curl_close($ch);
    //$request = file_get_contents($requestURL);
    $info = json_decode($request, true);
    
    //var_dump($info);
    
    if (@count($info["@graph"]) != 0) {
        $Items = $info["@graph"][0]["items"];
    //    var_dump($Items);
        for ($i = 0; $i < count($Items); $i++) {
            $Item = $Items[$i];
            
            $title = $Item['title'];
            $author = $Item['dc:creator'][0]['@value'];
            $manufacuturer  = @$Item['dc:publisher'];
    //        $imgURL = $Item['mediumImageUrl'];
            $bookURL = $Item['link']['@id'];
            
            $title  = mb_convert_kana($title, "as", "UTF-8");
            
            echo "<h3>No." . ($i+1) . "</h3>";
            echo "<h3>" . $title . "</h3>";
            echo "<h3>" . $author . "</h3>";
            echo "<h3>" . $manufacuturer . "</h3>";
            echo "<h3>" . $bookURL . "</h3>";
            // echo "<img src=$Item['mediumImageUrl']>";
        }
    } else {
        // error
    }
}
?>
</section>

<!--<h3><?php echo $Item['title']; ?></h3>-->
<!--<h3><?php echo $Item['author']; ?></h3>-->
<!--<h3><?php echo $Item['publisherName']; ?></h3>-->
<!--<img src="<?php echo $Item['mediumImageUrl']; ?>">-->
