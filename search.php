<?php require_once("./header.php"); ?>

<section>
<?php
define("APPLICATION_ID",'1051004596913573416');
define("APPLICATION_SEACRET",'');
define("AFFILIATE_ID",'');
define("ACCESS_URL",'https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404?');

$params = array();
$params['format'] = 'json';
$params['applicationId'] = APPLICATION_ID;

$params['title'] = urlencode(@$_POST['search']);

$requestURL = ACCESS_URL;
foreach($params as $key => $param){
    $requestURL .= "&{$key}={$param}";
}

$request = @file_get_contents($requestURL);
$info = json_decode($request, true);

// var_dump($info);

// @でエラー回避
// isset

if (@count($info) != 0) {
    $dbhost = "yuito.naviiiva.work";
    $dbuser = "naviiiva_user";
    $dbpass = "!Samurai1234";
    $dbname = "yuito";
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    echo "<table>";
    echo "<tr>";
    echo "<th>No.</th>";
    echo "<th>画像</th>";
    echo "<th>タイトル</th>";
    echo "<th>著者</th>";
    echo "<th>出版社</th>";
    echo "<th>ISBN</th>";
    echo "<th>コメント</th>";
    echo "</tr>";
    foreach ($info as $key => $Items) {
        if ($key == "Items") {
            for ($i = 0; $i < count($Items); $i++) {
                $Item = $Items[$i]['Item'];
                
                $title = $Item['title'];
                $author = $Item['author'];
                $manufacuturer  = $Item['publisherName'];
                $isbn = $Item['isbn'];
                $imgURL = $Item['mediumImageUrl'];
                $bookURL = $Item['itemUrl'];
                
                // $title  = mb_convert_kana($title, "as", "UTF-8");
                $comment = "";
                $query = "select * from search_result_book where isbn = '".$isbn."'";
                if ($result = mysqli_query($link, $query)) {
                    if (mysqli_num_rows($result)==0) {
                        // 未登録
                        $query2 = "insert into search_result_book(isbn,title,author,manufacuturer,imgURL,bookURL) ";
                        $query2 .= "values('".$isbn."','".$title."','".$author."','".$manufacuturer."','".$imgURL."','".$bookURL."')";
                        mysqli_query($link, $query2);
                    } else {
                        // 登録済
                        foreach($result as $row) {
                            $comment = $row['comment'];
                            break;
                        }
                    }
                }
                echo "<tr>";
                echo "<td>" . ($i+1) . "</td>";
                echo "<td><img src='".$imgURL."'></td>";
                echo "<td><a href=bookdata.php?isbn=".$isbn.">".$title. "</a></td>";
                echo "<td>".$author . "</td>";
                echo "<td>".$manufacuturer . "</td>";
                echo "<td>".$isbn. "</td>";
                echo "<td>".$comment . "</td>";
                echo "</tr>";
            }
        }
    }
    echo "</table>";
    mysqli_close($link);
} else {
    // error
}
?>
</section>

<?php require_once("./footer.php"); ?>