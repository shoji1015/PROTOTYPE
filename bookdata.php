<?php require_once("./header.php"); ?>

<section>
<?php

$isbn = @$_GET['isbn'];

$dbhost = "yuito.naviiiva.work";
$dbuser = "naviiiva_user";
$dbpass = "!Samurai1234";
$dbname = "yuito";
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = "select * from search_result_book where isbn = '".$isbn."'";
if ($result = mysqli_query($link, $query)) {
    foreach($result as $row) {
        $title = $row['title'];
        $author = $row['author'];
        $manufacuturer = $row['manufacuturer'];
        $imgURL = $row['imgURL'];
        $bookURL = $row['bookURL'];
        $comment = $row['comment'];
        break;
    }
    echo "<table>";
    echo "<tr>";
    echo "<td rowspan='3'><img src='".$imgURL."'></td><td>".$title."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>".$author."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>".$manufacuturer."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>コメント</td><td><textarea name='comment' rows='5' cols='40'>".$comment."</textarea></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='2'><a href='".$bookURL."'>楽天ページへ</a></td>";
    echo "</tr>";
    echo "</table>";
}
?>
</section>

<?php require_once("./footer.php"); ?>