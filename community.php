<?php require_once("./header.php"); ?>
<?php
$dbhost = "yuito.naviiiva.work";
$dbuser = "naviiiva_user";
$dbpass = "!Samurai1234";
$dbname = "yuito";
//$email = $_SESSION["id"];
$email = "";
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (@$_POST['roomEntry']) {
    $name = $_POST["namae"];
    $query = "insert into roomlist(email,name) values('".$email."','".$name."')";
    mysqli_query($link, $query);
  }
}
?>
<script>
  function openPopup(dialog) {
    var popup = document.getElementById(dialog);
    popup.style.display = "block";
  }
  function closePopup(dialog) {
    var popup = document.getElementById(dialog);
    popup.style.display = "none";
  }
</script>

<h2>community</h2>

  <div id="room">
    <div class="Title">部屋</div>
    <div class="Content">
      <div><button class="makeRoom" onClick="openPopup('popupRoom')">部屋作成</button></div>
<?php
$query = "select * from roomlist where email='".$email."'";
if ($result = mysqli_query($link, $query)) {
    foreach($result as $row) {
      $id=$row["id"];
      $name=$row["name"];
      echo "<div><form action='chatRoom.php' method='post'>";
      echo "<input type='hidden' name='id' value='".$id."'>";
      echo "<input type='submit' value='".$name."' class='Rooms'></form></div>";
    }
}
$query = "select roomlist.id,roomlist.name from roomuser left join roomlist on roomuser.roomid=roomlist.id where roomuser.email='".$email."'";
if ($result = mysqli_query($link, $query)) {
    foreach($result as $row) {
      $id=$row["id"];
      $name=$row["name"];
      echo "<div><form action='chatRoom.php' method='post'>";
      echo "<input type='hidden' name='id' value='".$id."'>";
      echo "<input type='submit' value='".$name."' class='Rooms2'></form></div>";
    }
}
mysqli_close($link);
?>
    </div>
  </div>
<div id="popupRoom">
  <h1>部屋の作成</h1>
  <form action="" method="post">
    <input type="hidden" name="userid" id="userid" value="<?php echo $email ?>">
    <p>部屋名: <input type="text" name="namae" id="namae"></p>
    <input type="submit" name="roomEntry" id="roomEntry" value="登録">
    <button id="Close" onClick="closePopup('popupRoom');">閉じる</button>
  </form>
</div>

<?php require_once("./footer.php"); ?>