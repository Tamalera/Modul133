<?php 
include "PageManagement/header.php"; 
?> 

<!-- Navigation -->
<div class="nav-scroller py-1 mb-2">
  <nav class="nav d-flex justify-content-left">
    <a class="p-2 text-muted" href="#">Thema 1</a>
    <a class="p-2 text-muted" href="#">Thema 2</a>
    <a class="p-2 text-muted" href="#">Thema 3</a>
    <a class="p-2 text-muted" href="#">Thema 4</a>
  </nav>
</div>

<!-- Main Article Of Page -->
<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
  <div class="col-md-6 px-0">
    <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
    <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
    <p class="lead mb-0"><a href="Blog/singleBlog.php" class="text-white font-weight-bold">Continue reading...</a></p>
  </div>
</div>

<!-- Single Blogs -->
<div class="row mb-2">
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <h3 class="mb-0">
          <h2 class="text-dark">TITEL1</h2>
        </h3>
        <p class="card-text mb-auto">TEXT OF BLOG1</p>
        <a href="#">Continue reading...</a>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <h3 class="mb-0">
          <h2 class="text-dark">TITEL2</h2>
        </h3>
        <p class="card-text mb-auto">TEXT OF BLOG2</p>
        <a href="#">Continue reading...</a>
      </div>
    </div>        
  </div>
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <h3 class="mb-0">
          <h2 class="text-dark">TITEL3</h2>
        </h3>
        <p class="card-text mb-auto">TEXT OF BLOG3</p>
        <a href="#">Continue reading...</a>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <h3 class="mb-0">
          <h2 class="text-dark">TITEL4</h2>
        </h3>
        <p class="card-text mb-auto">TEXT OF BLOG4</p>
        <a href="#">Continue reading...</a>
      </div>
    </div>        
  </div>
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <h3 class="mb-0">
          <h2 class="text-dark">TITEL5</h2>
        </h3>
        <p class="card-text mb-auto">TEXT OF BLOG5</p>
        <a href="#">Continue reading...</a>
      </div>
    </div>
  </div>
</div>
</div>

<?php 
include "PageManagement/footer.php"; 
?> 