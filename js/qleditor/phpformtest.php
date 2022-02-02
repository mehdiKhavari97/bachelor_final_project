<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Form Submit</title>
  <link rel='stylesheet' href='./quill.snow.css'>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="form-container" class="container" style="direction: rtl; text-align: right;">
  <form method="post" action="">
      <input name="content" type="hidden">
      <div id="editor-container">
        <?php
        if (isset($_POST['content']))
        {
          echo $_POST['content'];
        }
        ?>       
      </div>
      <input type="submit" name="ddddddd" value="sssssssss">
  </form>
</div>
<!-- partial -->
<script src='./jquery.min.js'></script>
<script src='./quill.min.js'></script>
<script  src="./script.js"></script>

<?php
@ $opppps = $_POST['content']; // {"ops":[{"insert":"A robot who has developed sentience, and is the only robot of his kind shown to be still functioning on Earth.\n"}]}
echo $opppps;

?>

</body>
</html>