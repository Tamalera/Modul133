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
      echo '<li class="randomBackground list-group-item mt-1"><strong>Post from: '.$blog['user_id'].'</strong></li>';
      $old = $blog['user_id'];
    }
    echo '<div class="card m-1">';
      echo '<div class="card-header">
              Posted on: '.$blog['blogDate'].'
              <div class="text-right">'.$blog['likes'].' likes</div>
            </div>';
      echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$blog['title'].'</h5>';                
        echo '<p class="card-text">'.$blog['blogText'].'</p>';          
      echo '</div>';
    echo '</div>';
}

//End of list
  echo  '</ul>';
echo '</div>';
?>

