<?php
$select="rakuten";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $select = @$_POST["searchSite"];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="include/style.css">
</head>
<body>
<header>
    <h1><a href="./index.php">PROTOTYPE</a></h1>
    
    <div>
        <form action="index.php" method="post" name="searchform" onSubmit="">
            <select name="searchSite">
<?php
    if ($select == "rakuten") {
        echo '                <option value="rakuten" selected="selected">楽天書籍検索</option>';
        echo '                <option value="cinii">cinii論文検索</option>';
    } else {
        echo '                <option value="rakuten">楽天書籍検索</option>';
        echo '                <option value="cinii" selected="selected">cinii論文検索</option>';
    }
?>
            </select>
            <input type="text" name="search" placeholder="書籍情報・タグを検索">
            <input type="submit" value="検索">
        </form>
    <div>
        
    <nav>
        <div>
            <ul>
                <li><a href="./index.php">home</a></li>
                <li><a href="./management.php">management</a></li>
                <li><a href="./community.php">community</a></li>
                <li><a href="./friend.php">friend</a></li>
            </ul>
        </div>
    </nav>
    
</header>