<?php session_start(); 
include_once('db.php'); 
if(!isset($_SESSION['started'])){
  //we save a new session
  $ip = $_SERVER['REMOTE_ADDR'];
  $starttime = date('Y-m-d H:i:s');
  mysqli_query($con,"INSERT INTO tb_session (session_start,session_finish,ip_address) VALUES ('$starttime','starttime','$ip')");
  if (mysqli_connect_errno())
  {
  echo "SQL Error";
  }
  $_SESSION['sessid'] = $con->insert_id;
  $_SESSION['started'] = 1;
}
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> Robotics position</title>
  
  
  <script type='text/javascript' src='http://code.jquery.com/jquery-1.6.2.js'></script>
  <script type='text/javascript' src="https://jquery-rotate.googlecode.com/files/jquery.rotate.1-1.js"></script>

  
  
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.js"></script>
  
  
  <style type='text/css'>
  .drop-target{
    width:500px;
    height:500px;
    background:whitesmoke url('https://s3.amazonaws.com/com.appgrinders.test/images/grid_20.png') repeat;
  }
    div
    {
    width:40px;
    height:40px;
    background: url('robot.png') no-repeat;
    background-size: cover;
    }
  </style>
  



<script type='text/javascript'>
function rotatecntrl(sel) {
            var rotate = "rotate(" + sel.value + "deg)";

            var trans = "all 0.3s ease-out";

            $("#box").css({

                "-webkit-transform": rotate,

                "-moz-transform": rotate,

                "-o-transform": rotate,

                "msTransform": rotate,

                "transform": rotate,

                "-webkit-transition": trans,

                "-moz-transition": trans,

                "-o-transition": trans,

                "transition": trans

            });
            savePos();
}

function savePos(){
  var xpos = $('#box').css('left');
  var ypos = $('#box').css('top');
  var varrotate = $('#selectrotate').val();
  var varsessid = '<?php echo $_SESSION['sessid'] ;?>';
  $.post( "save.php", { posx: xpos, posy: ypos, rotate : varrotate, sessid : varsessid}); 
  return true;
}

function updateFinish(){
    var varsessid = '<?php echo $_SESSION['sessid'] ;?>';
    $.post( "update.php", {sessid : varsessid}); 
    return true;
}

$(window).load(function(){
$('#box').draggable({
   grid: [20, 20],
   snap: ".drop-target",
   stop: function(event, ui) {
    savePos();
    }
});
<?php 
  if(isset($_SESSION['posx'])){
    echo 'var posx = "'.$_SESSION['posx'].'";';
  }
  else{
    echo 'var posx = 0;';
  }
  if(isset($_SESSION['posy'])){
    echo 'var posy = "'.$_SESSION['posy'].'";';
  }
  else{
    echo 'var posy = 0;';
  }
  if(isset($_SESSION['rotate'])){
    echo 'var varrotate = '.$_SESSION['rotate'].';';
  }
  else{
    echo 'var varrotate = 0;';
  }
?>
if(posx != 0){
    $('#box').css('left', posx);
}else{
    $('#box').css('left', '0px');
}
if(posy != 0){
    $('#box').css('top', posy);
}else{
    $('#box').css('top', '0px');
}

  
if(varrotate != 0){
  var rotate = "rotate(" + varrotate + "deg)";

            var trans = "all 0.3s ease-out";

            $("#box").css({

                "-webkit-transform": rotate,

                "-moz-transform": rotate,

                "-o-transform": rotate,

                "msTransform": rotate,

                "transform": rotate,

                "-webkit-transition": trans,

                "-moz-transition": trans,

                "-o-transition": trans,

                "transition": trans

            });
  $("#selectrotate").val(varrotate);
}
setInterval(function () {
    updateFinish();
},3000); 
});//]]> 

 

</script>

</head>
<body>
  <div class="drop-target">
    <div class="drag-item" style="" id="box"></div>
</div>
Rotate :

        <select id="selectrotate" onchange="rotatecntrl(this);">

            <option value="0">North</option>

            <option value="90">East</option>

            <option value="180">South</option>

            <option value="270">West</option>

        </select>
</body>
</html>

