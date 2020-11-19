<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="include/style.css">
    <script type="text/javascript" src="">
    // 空欄、スペースで実行しない
    
        // function check(){
        //   var textFormValue = document.searchform.search.value;
        //   if(textFormValue == ""){
        //     return false;
        //   }else if(!textFormValue.match(/\S/g)){
        //     return false;
        //   }
        // }
    </script>
    <style>
    th {
      background-color: green;
      color: white;
      text-align: center;
    }
    td {
      background-color: white;
      border: 1px solid black;
      text-align: left;
    }
    </style>
</head>
<body>
<header>
    <h1><a href="./index.php">PROTOTYPE</a></h1>
    
    <div>
        <form action="search.php" method="post" name="searchform" onSubmit="">
            <select name="searchSite">
                <option value="rakuten" selected="selected">楽天書籍検索</option>
                <option value="cinii">cinii論文検索</option>
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