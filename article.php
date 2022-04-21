<?php
require_once "includes/db.php";
require_once "includes/starting_html_links.php";
require_once "includes/header.php";
$name = mysqli_real_escape_string($connection, $_REQUEST['name']);
$nickname = mysqli_real_escape_string($connection, $_REQUEST['nickname']);
$email= mysqli_real_escape_string($connection, $_REQUEST['email']);
$text = mysqli_real_escape_string($connection, $_REQUEST['text']);
$pubdate = mysqli_real_escape_string($connection, $_REQUEST['pubdate']);


$sql = "INSERT INTO `comments` (`name`, `nickname`,  `email`, `text`, `pubdate` ) VALUES ($name, $nickname, $email, $text, date('Y-m-d'))";
if(mysqli_query($connection, $sql)){
  echo     "<h2>Records added successfully.</h2>";
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
?>
?>

<?php 

$article = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = " . (int) $_GET['id']);
if(mysqli_num_rows($article) <= 0){

?>


<div id="content">
<div class="container">
<div class ="row">
    <section class="col-md-8">
        <div class="block">
<h3>Blog not found</h3>
<div class="blog_content">
    <div class="full-text">
      Searching page is not found
    </div>
</div>
</div>
</section>
</div>
</div>
</div>
<?php
}else
{
$art =mysqli_fetch_assoc($article);
mysqli_query($connection,"UPDATE `articles` SET `views` =`views` + 1 WHERE `id`= " . (int) $art['id']);
    ?>
<div id="content article-t">  
<div class="container" style="background:#C9C3AE;margin:50px 100px;padding:100px; text-align:center;border-radius:10px;"> 
   <div style="padding-bottom:50px;">
   <a style="color:#010101;"><?php echo $art['views'];?>:views</a> 
   </div>
         <div class="row">
            <section>
                <div class ="block">                           
                         <div class = "blog_content">     
                         <img src="static/images/<?php echo $art['image']; ?>" alt="img" style="max-width:30%; border-radius:10%;">
                         <div class="full-text"style="border-color:#fff;">
                           <h3 style="font-style:Montserrat; font-weight: 800; margin:30px;"><?php echo $art['title']; ?></h3>
                           <?php echo $art['text']; ?>
                        </div>
                    </div>  
                </div>
            </section>
        </div>
    </div>
</div>

<div style ="background:#C9C3AE; padding:50px 300px;margin:0px 110px; border-radius:10px;">
<h3>Last comments</h3> 
<a>Add commentary</a>
 <?php
$comments = mysqli_query($connection, "SELECT * FROM `comments`");
?>
   <?php 
      while($comment = mysqli_fetch_assoc($comments)) 
   {
   ?>
   
<div class="card sm-3" style="max-width:600px; margin-bottom:20px;">
  <div class="row g-0">
    <div class="col-sm-4">
      <img href="https://ru.gravatar.com/avatar/<?php echo md5($comment['email']);?>" class="img-fluid rounded-start card-img" alt="image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <a class="card-title dis_each0" href="/article.php?id=<?php echo $comment['articles_id'];?>" style="color:#C9C3AE;"><?php echo $comment['author'];?></a><br>
        <p class="card-text dis_each1" style="color:#010101;"><?php echo mb_substr($comment['text'], 0, 20, 'utf-8'); ?></p>
      </div>
    </div>
  </div>
</div>
    <?php 
      }
    ?>  

</div>


<div style="padding:100px 300px 100px 300px; color:#C9C3AE;"> 
    <h2>Add comment</h2>
     <form class="" action="/article.php" method="post" >
      <div class="form-group">
        <label>Name</label>
        <input class="form-control"  name="name">
        <label>Nickname</label>
        <input class="form-control"  name="nickname">
        <label>Email</label>
        <input class="form-control"  name="email">
        <label>Comment</label>
        <textarea class="form-control" name="text" rows="5" cols="30"></textarea>
      </div>
      <button class="btn btn-primary" type="submit" name="button" style=" margin-top:20px;background:#C9C3AE; border:none; font-weight:bold;">Add comment</button>
    </form>
</div>


<?php
}       
?>

<?php
require_once "includes/footer.php"
?>
