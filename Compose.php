<?php
require_once "includes/db.php";
require_once "includes/starting_html_links.php";
require_once "includes/header.php";
$title = mysqli_real_escape_string($connection, $_REQUEST['title']);
$text = mysqli_real_escape_string($connection, $_REQUEST['text']);
$sql = "INSERT INTO `articles` (`title`, `text`) VALUES ('$title', '$text')";
if(mysqli_query($connection, $sql)){
  echo     "<h2>Records added successfully.</h2>";
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
?>
<section id="body" style="padding:100px 200px 100px 200px; color:#C9C3AE;">
<div> 
<h1 style="font-style: Montserrat;font-weight: 800; ">Greating your first blog</h1>
    <form action="Compose.php" method="post">
      <div class="form-group">
        <label>Title</label>
        <input class="form-control" type="text" name="title">
        <label>Post</label>
        <textarea class="form-control" name="text" rows="5" cols="30"></textarea>
      </div>
      <button class="btn btn-primary" type="submit" name="button" style="margin:30px 0 0 874px; background:#C9C3AE; border:none; font-weight:bold;">Publish</button>
    </form>
</div>
</section>

<?php
require_once "includes/footer.php"
?>
