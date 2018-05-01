<div class="container">
  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Register</h4>
      <form method="POST" action="login/register" class="needs-validation" id="test" novalidate>

        <div class="mb-3">
          <label for="email">Username</label>
          <input type="email" name="emailreg" class="form-control" id="email" placeholder="you@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>

        <div class="mb-3">
          <label for="password">Password</label>
          <input name="passwordreg" class="form-control" type="password" placeholder="Password" id="password" data-toggle="tooltip" data-placement="top" title="Password has to contain at least one number, a capital letter, a lower case letter, a special character (eg. $,!.&?_), and has a minimal lenght of 8" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
          <div class="invalid-feedback">
            Please enter valid passwort
          </div>
        </div>

        <div class="mb-3">
          <label for="confirm_password">Repeat Password</label>
          <input class="form-control" type="password" placeholder="Confirm Password" id="confirm_password" required>
          <div class="invalid-feedback">
            Passwords do not match
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="language">Language</label>
            <select class="custom-select d-block w-100" id="language" required>
              <option>French</option>
              <option>German</option>
              <option selected>English</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid language.
            </div>
          </div>
        </div>

        <div class="d-block my-3">
          <label for="gender">Gender</label>
          <div class="custom-control custom-radio">
            <input id="female" name="gender" type="radio" class="custom-control-input">
            <label class="custom-control-label" for="female">Female</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="male" name="gender" type="radio" class="custom-control-input">
            <label class="custom-control-label" for="male">Male</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="apache" name="gender" type="radio" class="custom-control-input">
            <label class="custom-control-label" for="apache">Other</label>
          </div>
        </div>

        <label>Hobbies</label>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="hobby-1">
          <label class="custom-control-label" for="hobby-1">Gaming</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="hobby-2">
          <label class="custom-control-label" for="hobby-2">Sports</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="hobby-3">
          <label class="custom-control-label" for="hobby-3">Reading</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="hobby-4">
          <label class="custom-control-label" for="hobby-4">Music</label>
        </div>

        <hr class="mb-4">

        <button name="register" class="btn btn-success btn-lg btn-block" type="submit">Register</button>
      </form>
    </div>
  </div>
</div>

<script>
  // Disabling form submissions if there are invalid fields
  (function() {
    'use strict';

    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');

      //Password matching
      var password = document.getElementById("password"), 
      confirm_password = document.getElementById("confirm_password");

      function validatePassword(){
        if(password.value != confirm_password.value) {
          confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
          confirm_password.setCustomValidity('');
        }
      }

      password.onchange = validatePassword;
      confirm_password.onkeyup = validatePassword;

      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false); 
      });
    }, false);
  })();

//Tooltip for Password
(function () {
  ('[data-toggle="tooltip"]').tooltip()
});
</script>
