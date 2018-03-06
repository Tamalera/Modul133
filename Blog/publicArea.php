<div class="container">
  <div class="row row-offcanvas row-offcanvas-right">
   <!-- Blogs: -->

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