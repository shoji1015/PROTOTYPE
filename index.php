<?php require_once("./header.php"); ?>

<div class="indexclass">
    <h2>home</h2>
</div>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $select = @$_POST["searchSite"];
    if ($select == "rakuten") {
        require_once("./search.php");
    } else {
        require_once("./search_cinii.php");
    }
} else {
?>
<p>ようこそ</p>
<?php
}
?>

<?php require_once("./footer.php"); ?>