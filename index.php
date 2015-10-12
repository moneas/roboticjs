<?php session_start(); ?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> Robotics position</title>
  
  
  <script type='text/javascript' src='http://code.jquery.com/jquery-1.6.2.js'></script>
    <script type='text/javascript' src="https://jquery-rotate.googlecode.com/files/jquery.rotate.1-1.js"></script>

  
  <link rel="stylesheet" type="text/css" href="/css/normalize.css">
  
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.js"></script>
  
  <link rel="stylesheet" type="text/css" href="/css/result-light.css">
  
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
             $.post( "save.php", { rotate: sel.value } ); 

        }//<![CDATA[
$(window).load(function(){
$('#box').draggable({
   grid: [20, 20],
   snap: ".drop-target",
   stop: function(event, ui) {
      $.post( "save.php", { posx: $(this).css('left'), posy: $(this).css('top') } ); 
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

