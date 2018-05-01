<!-- Main Article Of Page -->
    <div class="jumbotron">
      <h2>LOGIN</h2>
      <h1>Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
      <p class="lead mb-0"><a href="Blog/singleBlog.php" class="font-weight-bold">Continue reading...</a></p>
    </div>

    <!-- Single Blogs -->
<?php

$old = "";

//Start list for displaying blogs
echo '<div class="card m-1 col-12">';
  echo  '<ul class="list-group list-group-flush">';

//Loop through blogs
foreach($blogs as $blog)
{  
    //Sort by user
    if ($old != $blog['user_id'])
    {
      echo '<li class="randomBackground list-group-item mt-1"><strong>Post(s) from: '.$blog['user_id'].'</strong></li>';
      $old = $blog['user_id'];
    }
    echo '<div class="card m-1">';
      echo '<div class="card-header d-flex justify-content-between">
        Posted on: '.$blog['blogDate'].'
        <form method="post" action="index.php">
          <input type="submit" name="like_button" class="btn btn-outline-warning btn-sm active" value="Like">
          <input type="hidden" name="bid_likes" value="'.$blog['blogID'].'"/>
        </form>
      </div>';
      echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$blog['title'].'</h5>';                
        echo '<p class="card-text">'.$blog['blogText'].'</p>';  
        //If user is logged in: user -> blogs can be edited
        if ($blog['username'] == $_SESSION["username"]) {
          echo '
          <div>
            <form method="post" action="Edit_Blog/edit.php" class="d-flex justify-content-between">
              <input type="submit" class="btn btn-info" name="action" value="Edit"/>
              <input type="hidden" name="id" value="'.$blog['blogID'].'"/>
            </form>
            <form method="post" action="index.php">
                <input type="submit" class="btn btn-danger btn-sm mt-1" name="action" value="X"/>
                <input type="hidden" name="bid_del" value="'.$blog['blogID'].'"/>
            </form>
          </div>';
        }
        echo '<h6>Likes: <span class="badge badge-secondary m-1">'.$blog['likes'].'</span></h6>';
      echo '</div>';
    echo '</div>';
}

//End of list
  echo  '</ul>';
echo '</div>';
?>