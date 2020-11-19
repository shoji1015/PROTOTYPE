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

// $params['author'] = urlencode('宮沢賢治');
$params['isbn'] = '9784101092058';

$requestURL = ACCESS_URL;
foreach($params as $key => $param){
    $requestURL .= "&{$key}={$param}";
}

$request = file_get_contents($requestURL);
$info = json_decode($request, true);

// var_dump($info);

if (count($info) != 0) {
    foreach ($info as $key => $Items) {
        if ($key == "Items") {
            
            $Item = $Items[0]['Item'];
            
            $title = $Item['title'];
            $author = $Item['author'];
            $manufacuturer  = $Item['publisherName'];
            $imgURL = $Item['mediumImageUrl'];
            $bookURL = $Item['itemUrl'];
            // DBで管理しやすいように文字コードの宣言やスペースの削除等を行う
            $title  = mb_convert_kana($title, "as", "UTF-8");
        }
    }
} else {
    // error
}
?>

<h3><?php echo $Item['title']; ?></h3>
<h3><?php echo $Item['author']; ?></h3>
<h3><?php echo $Item['publisherName']; ?></h3>
<img src="<?php echo $Item['mediumImageUrl']; ?>">