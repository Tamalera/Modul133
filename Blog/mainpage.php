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
  $data = file("blogData.txt");
  foreach ($data as $line){
  $lineArray = explode(":", $line);
  list($lAuthor, $lTitle, $lDatum, $lContent) = $lineArray;
  print <<< HERE
  <div class="card m-1">
    <div class="card-header">
      $lAuthor posted on $lDatum
    </div>
    <div class="card-body">
      <h5 class="card-title">$lTitle</h5>
      <p class="card-text">$lContent</p>
    </div>
  </div>
HERE;
  }
 ?>
  </div>
</div>
