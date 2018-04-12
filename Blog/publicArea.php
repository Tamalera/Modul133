<div class="container">
  <div class="row row-offcanvas row-offcanvas-right">
   <!-- Blogs: -->

 <?php

//Get all Blogs, already sorted by blogger and date
$queryAllBlogs = "SELECT * FROM `blog` ORDER BY user_id, blogDate DESC";
$resultAllBlogs = mysqli_query($connection, $queryAllBlogs) or die(mysqli_error($connection));

$old = "";

//Start list for displaying blogs
echo '<div class="card m-1 col-12">';
  echo  '<ul class="list-group list-group-flush">';

//Loop through blogs
while($row = mysqli_fetch_array($resultAllBlogs))
{  
    //Sort by user
    if ($old != $row['user_id'])
    {
      echo '<li class="randomBackground list-group-item mt-1"><strong>Post from: '.$row['user_id'].'</strong></li>';
      $old = $row['user_id'];
    }
    echo '<div class="card m-1">';
      echo '<div class="card-header">
              Posted on: '.$row['blogDate'].'
              <div class="text-right">'.$row['likes'].' likes</div>
            </div>';
      echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$row['title'].'</h5>';                
        echo '<p class="card-text">'.$row['blogText'].'</p>';          
      echo '</div>';
    echo '</div>';
}

//End of list
  echo  '</ul>';
echo '</div>';
?>
  </div>
</div>

