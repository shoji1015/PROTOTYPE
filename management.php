<?php require_once("./header.php"); ?>

<h2>management</h2>

<?php
$dbhost = "yuito.naviiiva.work";
$dbuser = "naviiiva_user";
$dbpass = "!Samurai1234";
$dbname = "yuito";
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = "select * from search_result_book where comment is not null";
if ($result = mysqli_query($link, $query)) {
    echo "<table>";
    foreach($result as $row) {
        echo "<tr>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['author']."</td>";
        echo "<td>".$row['manufacuturer']."</td>";
        echo "<td><img src='".$row['imgURL']."'></td>";
        echo "<td>".$row['bookURL']."</td>";
        echo "<td>".$row['comment']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
<?php require_once("./footer.php"); ?>