<div class="container">
  <div class="row row-offcanvas row-offcanvas-right">

    <!-- Main Article Of Page -->
    <div class="jumbotron">
      <h1>Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
      <p class="lead mb-0"><a href="Blog/singleBlog.php" class="font-weight-bold">Continue reading...</a></p>
    </div>

    <!-- Single Blogs -->
<?php

//Get all Blogs, already sorted by blogger and date
$getAllBlogsByBloggerSQL = "SELECT * FROM blog LEFT JOIN benutzer ON benutzer.userID = blog.user_id ORDER BY user_id, blogDate DESC";
$statementGetAllBlogsByBlogger = $PDOconnection->prepare($getAllBlogsByBloggerSQL);
$statementGetAllBlogsByBlogger->execute();
$allBlogs = $statementGetAllBlogsByBlogger->fetchAll();

$old = "";

//Start list for displaying blogs
echo '<div class="card m-1 col-12">';
  echo  '<ul class="list-group list-group-flush">';

//Loop through blogs
foreach($allBlogs as $blog)
{  
    //Sort by user
    if ($old != $blog->user_id)
    {
      echo '<li class="randomBackground list-group-item mt-1"><strong>Post from: '.$blog->user_id.'</strong></li>';
      $old = $blog->user_id;
    }
    echo '<div class="card m-1">';
      echo '<div class="card-header">
        Posted on: '.$blog->blogDate.'
        <button onclick="this.disabled = true" class="btn btn-outline-warning btn-sm active">Like</button>
        '.$blog->likes.'
      </div>';
      echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$blog->title.'</h5>';                
        echo '<p class="card-text">'.$blog->blogText.'</p>';  
        //If user is logged in usr -> blogs can be edited
        if ($blog->username == $_SESSION["username"]) {
          echo '<a href="Edit_Blog/edit.php" class="btn btn-info" value='.$blog->user_id.'>Edit</a>';
        }
      echo '</div>';
    echo '</div>';
}

//End of list
  echo  '</ul>';
echo '</div>';
?>
  </div>
</div>
