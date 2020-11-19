<?php require_once("./header.php"); ?>
<?php
@session_start();

$room=$_POST['id'];
//$email=$_SESSION['id'];
$email="";
?>
<script>
function sendChat() {
  var room = "<?php echo $room; ?>";
  var user = "<?php echo $email; ?>";
  var chat = document.getElementById("chatmsg");
  var ajax = new XMLHttpRequest();
  ajax.open('post', 'chatajax.php');
  ajax.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' )
  ajax.responseType = "json";
  var sendMsg = "room="+room+"&user="+user+"&msg="+chat.value;
  ajax.send(sendMsg); // 通信させます。
  chat.value="";
}
function recvAJAX() {
  var ajax = new XMLHttpRequest();
  ajax.open("get", "chatajax.php?room=<?php echo $room ?>");
  ajax.responseType = "json";
  ajax.send(); // 通信させます。
  ajax.addEventListener("load", function(){ // loadイベントを登録します。
    var msg = document.getElementById("msgArea");
    var json = this.response;
    var html = "";
    for(var i = 0; i < json.length; i++) {
      if (json[i].user == "<?php echo $email ?>") {
        html += "<div class='line'><p class='mine'>" + json[i].msg + "</p></div>";
      } else {
        html += "<div class='line'><p class='other'>" + json[i].msg + "</p></div>";
      }
    }
    msg.innerHTML = html;
  }, false);
}
</script>
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$dbhost = "yuito.naviiiva.work";
$dbuser = "naviiiva_user";
$dbpass = "!Samurai1234";
$dbname = "yuito";
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$query = "select * from roomlist where id=".$room;
$name="";
if ($result = mysqli_query($link, $query)) {
    foreach($result as $row) {
      $name=$row["name"];
      break;
    }
}
mysqli_close($link);
} else {
  header("location: community.php");
}
?>
<div id="chatRoom-container">
  <div id="chatTitle">
    <?php echo $name."の部屋"; ?>
  </div>
  <div id="chatMessage">
    <div id="msgArea"></div>
    <input type="text" name="chatmsg" id="chatmsg">
    <button id="chatSend" onClick="sendChat();">送る</button>
  </div>
</div>
<button OnClick="window.history.back(-1);return false;">戻る</button>
<script>
setInterval(recvAJAX, 200);
</script>
<?php require_once("./footer.php"); ?>
