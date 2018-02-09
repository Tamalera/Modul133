<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please Sign in or Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Body -->
      <div class="modal-body">
          <form class="form-signin" id="signInForm">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control mb-2" placeholder="Email address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
          </form>
          <button class="btn btn-link" onclick="toggleRegister()">New here? Register</button>
            <div id="registering" style="display: none;">
                <?php 
                  include "register.php"; 
                ?> 
            </div>
      </div>
      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script language="JavaScript">
function toggleRegister() {
    var x = document.getElementById("registering");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    var y = document.getElementById("signInForm");
    if (y.style.display === "none") {
        y.style.display = "block";
    } else {
        y.style.display = "none";
    }
}
</script>