<?php
define("APPLICATION_ID",'1051004596913573416');
define("APPLICATION_SEACRET",'');
define("AFFILIATE_ID",'');
define("ACCESS_URL",'https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404?');

$params = array();
$params['format'] = 'json';
$params['applicationId'] = APPLICATION_ID;

// $params['title'] = urlencode($_POST['search']);
// $params['author'] = urlencode($_POST['search']);
// $params['publisherName'] = urlencode($_POST['search']);
// $params['isbn'] = $_POST['search'];

$params['author'] = urlencode('村上春樹');
// $params['isbn'] = '9784101092058';

$requestURL = ACCESS_URL;
foreach($params as $key => $param){
    $requestURL .= "&{$key}={$param}";
}

$request = file_get_contents($requestURL);
$info = json_decode($request, true);

var_dump($info);
var_dump(count($info));

if (count($info) != 0) {
    foreach ($info as $key => $Items) {
        if ($key == "Items") {
            
            // $Item = $Items[0]['Item'];
            
            $title = $key['']['Item']['title'];
            // $author = $Items['Item']['author'];
            // $manufacuturer  = $Items['Item']['publisherName'];
            // $imgURL = $Items['Item']['mediumImageUrl'];
            // $bookURL = $Items['Item']['itemUrl'];
            
            echo $title;
        }
    }
} else {
    // error
}
?>