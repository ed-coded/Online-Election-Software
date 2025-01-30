<?php

session_start();
//login authentication..
@include 'connectDB.php';

if (isset($_POST['login'])) {
  $student_id = mysqli_real_escape_string($connectDB, $_POST['student_id']);
  $password = $_POST['password'];

  $query = "SELECT * FROM students WHERE student_id = '$student_id'";
  $result = mysqli_query($connectDB, $query);

  if ($result) {
    if ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['student_id'] = $row['student_id'];
        $_SESSION['student_name'] = $row['student_name'];
        header("Location: user_dashboard.php");
      } else {
        echo '<div class="alert-error" id="error">incorrect password.</div>';
      }
    } else {
      echo '<div class="alert-error" id="error">user does not exist.</div>';
    }
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Votech | Student Register/ Login</title>
  <link rel="icon" href="../assets/icons/votech-logo.png">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');


    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: linear-gradient(90deg, #e2e2e2, #c9d6ff);
    }

    .container {
      position: relative;
      width: 950px;
      height: 550px;
      background: #fff;
      border-radius: 30px;
      box-shadow: 0 0 30px rgba(0, 0, 0, .2);
      overflow: hidden;
    }

    .form-box {
      position: absolute;
      right: 0;
      width: 50%;
      height: 100%;
      background: #fff;
      display: flex;
      align-items: center;
      color: #333;
      text-align: center;
      padding: 20px;
      z-index: 1;
      transition: 1s ease-in-out;
    }

    .form-box.login {
      visibility: visible;
    }

    .container.active .form-box.login {
      right: 50%;
    }

    .container.active .form-box.register {
      visibility: hidden;
      right: 0;
    }

    form {
      width: 100%;
    }

    .container h1 {
      font-size: 37px;
      margin: -11px 0;
    }

    .input-box {
      position: relative;
      margin: 30px 0;
    }

    .input-box input {
      width: 95%;
      padding: 14px;
      background: #eee;
      border-radius: 10px;
      border: none;
      outline: none;
      font-size: 18px;
      color: #333;
      font-weight: 500;
    }

    .input-box input::placeholder {
      color: #888;
      font-weight: 400;
    }

    .input-box i {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 20px;
      color: #000;
    }

    .btn {
      width: 60%;
      height: 48px;
      background: rgba(7, 13, 21, 0.267);
      border-radius: 10px;
      border: none;
      cursor: pointer;
      font-size: 16px;
      color: #fff;
      font-weight: 600;
      margin-top: 15px;
    }

    .btn:hover {
      background-color: rgb(15, 86, 192);
    }

    .container p {
      font-size: 15px;
      margin: 16px 0;
    }

    .social-icon {
      display: flex;
      justify-content: center;
    }

    .social-icon a {
      display: inline-flex;
      padding: 10px;
      border: 3px solid #ccc;
      border-radius: 8px;
      font-size: 24px;
      color: #333;
      text-decoration: none;
      margin: 0 8px;
    }

    .toggle-box {
      position: absolute;
      width: 100%;
      height: 100%;
    }

    .toggle-box::before {
      content: '';
      position: absolute;
      left: -250%;
      width: 300%;
      height: 100%;
      background: steelblue;
      border-radius: 150px;
      z-index: 2;
      transition: 1s ease-in-out;
    }

    .container.active .toggle-box::before {
      left: 50%;
    }

    .toggle-panel {
      position: absolute;
      width: 50%;
      height: 100%;
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      z-index: 2;
      transition: .6s ease-in-out;
    }

    .toggle-panel.toggle-left {
      left: 0;
      transition-delay: 0.6s;
    }

    .container.active .toggle-panel.toggle-left {
      left: -50%;
      transition: 0.6s;
    }

    .toggle-panel.toggle-right {
      right: -50%;
      transition-delay: 0.4s;
    }

    .container.active .toggle-panel.toggle-right {
      right: 0;
      transition-delay: 0.6s;
    }

    .toggle-panel p {
      margin-bottom: 20px;
    }

    .toggle-panel .btn {
      width: 160px;
      height: 46px;
      background: transparent;
      border: 2px solid #fff;
      box-shadow: none;
    }

    .login-btn:hover,
    .register-btn:hover {
      background: #eeeeee3f;
    }





    /* errors*/
    .alerts p {
      font-size: 14px;
      text-align: center;

    }

    #password-match {
      color: #155724;
      display: none;
      z-index: 1;
    }

    #password-mismatch {
      color: #721c24;
      display: none;
      z-index: 1;
    }


    .alert-success {
      background-color: #d4edda;
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
      color: #155724;
      border: 1px solid #c3e6cb;
      padding: 15px 20px;
      border-radius: 8px;
      position: fixed;
      top: 10px;
      right: 20px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      opacity: 1;
      transition: opacity 0.5s ease, transform 0.5s ease;
      transform: translateY(0);

    }

    .alert-error {
      background-color: rgb(238, 202, 202);
      font-family: 'Poppins', sans-serif;
      font-size: 17px;
      color: rgb(196, 45, 45);
      border: 1px solidrgb(230, 202, 195);
      padding: 15px 20px;
      border-radius: 8px;
      position: fixed;
      top: 10px;
      right: 20px;
      box-shadow: 0 4px 15px rgba(131, 69, 69, 0.1);
      z-index: 1000;
      opacity: 1;
      transition: opacity 0.5s ease, transform 0.5s ease;
      transform: translateY(0);

    }

    @media only screen and (max-width: 768px) {
      .container {
        width: 90%;
        height: auto;
        padding: 20px;
      }

      .form-box {
        width: 100%;
        position: relative;
        padding: 20px;
      }

      .form-box input {
        font-size: 16px;
        padding: 10px;
      }

      .form-box h1 {
        font-size: 24px;
      }

      .btn {
        width: 80%;
        font-size: 14px;
        padding: 10px;
      }

      .toggle-panel .toggle-box {
        display: none;
      }


      .alert-error,
      .alert-success {
        position: fixed;
        z-index: 99999;
        top: 5px;
        font-size: 12px;
      }







    }
  </style>

  <!--This is the external icon css-->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <!-- login form-->
    <div class="form-box login">
      <form method="POST" action="user_LR.php">
        <h1>Login</h1>
        <div class="input-box">
          <input type="text" placeholder="Student ID: eg(..4231232456)" required name="student_id" pattern="4[0-9]{9}" title="id must start with 4 and have exactly 10 digits." />

          <i class="bx bxs-user"></i>
        </div>

        <div class="input-box">
          <input
            type="password"
            placeholder="password"
            required
            name="password"
            maxlength="15"
            minlength="7"
            title="password must be 7-15 characters long!" />

          <i class="bx bxs-lock-alt"></i>
        </div>

        <button type="submit" name="login" class="btn">login</button>
      </form>
    </div>

    <!-- Register forms -->
    <div class="form-box register">
      <form method="POST" action="user_LR.php" id="registration-form">
        <h1>Registration</h1>
        <div class="input-box">
          <input type="text" placeholder="Student ID: eg(..4231232456)" required name="student_id" pattern="4[0-9]{9}" title="id must start with 4 and have exactly 10 digits." />
          <i class="bx bxs-user"></i>
        </div>
        <div class="input-box">
          <input type="text" placeholder="full name" required name="student_name" />
          <i class="bx bxs-user"></i>
        </div>
        <div class="input-box">

          <input
            type="password"
            id="password"
            placeholder="password"
            required
            name="password"
            maxlength="15"
            minlength="7"
            title="password must be 7-15 characters long" />

          <i class="bx bxs-lock-alt"></i>
        </div>

        <div class="input-box">
          <input type="password" placeholder="confirm password" required name="password_confirm" id="confirm-password" />
          <i class="bx bxs-lock-alt"></i>
        </div>

        <div class="alerts">
          <p id="password-mismatch">passwords mismatch</p>
          <p id="password-match">passwords match</p>
        </div>

        <button type="submit" name="register" class="btn" id="reg-btn">Register</button>
      </form>


    </div>

    <!-- cover forms  -->
    <div class="toggle-box">
      <div class="toggle-panel  toggle-right">
        <h1>Hello, Welcome!</h1>
        <p>Don't have an account?</p>
        <button class="btn register-btn">Register</button>
      </div>
      <div class="toggle-panel toggle-left">
        <h1>Welcome Back!</h1>
        <p>Already have an account?</p>
        <button class="btn login-btn">Login</button>
      </div>
    </div>
  </div>


  <script>
    function validatePasswords() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm-password").value;

      var confirmPasswordError = document.getElementById("password-mismatch");
      var confirmPasswordSuccess = document.getElementById("password-match");

      if (confirmPassword !== "") {
        if (password !== confirmPassword) {
          confirmPasswordError.style.display = "block";
          confirmPasswordSuccess.style.display = "none";
          reg_btn = document.getElementById("reg-btn");
          reg_btn.addEventListener("mouseenter", () => {
            reg_btn.style.background = "rgba(7, 13, 21, 0.267)";
            reg_btn.style.cursor = "not-allowed";
          })
        } else {
          confirmPasswordError.style.display = "none";
          confirmPasswordSuccess.style.display = "block";
          reg_btn = document.getElementById("reg-btn");
          reg_btn.addEventListener("mouseenter", () => {
            reg_btn.style.background = "rgb(15, 86, 192)";
            reg_btn.style.cursor = "pointer";
          })

        }

        setTimeout(function() {
          confirmPasswordError.style.display = "none";
          confirmPasswordSuccess.style.display = "none";
        }, 5000);
      } else {
        confirmPasswordError.style.display = "none";
        confirmPasswordSuccess.style.display = "none";
      }
    }


    function handleFormSubmission(e) {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm-password").value;

      if (password !== confirmPassword) {
        e.preventDefault();
      }
    }


    function resetForms() {
      document.querySelectorAll("form input").forEach(function(input) {
        input.value = "";
      });
      document.getElementById("password-mismatch").style.display = "none";
      document.getElementById("password-match").style.display = "none";
    }


    var container = document.querySelector(".container");
    var registerBtn = document.querySelector(".register-btn");
    var loginBtn = document.querySelector(".login-btn");
    var passwordField = document.getElementById("password");
    var confirmPasswordField = document.getElementById("confirm-password");
    var registrationForm = document.getElementById("registration-form");

    passwordField.addEventListener("keyup", validatePasswords);
    confirmPasswordField.addEventListener("keyup", validatePasswords);
    registrationForm.addEventListener("submit", handleFormSubmission);


    registerBtn.addEventListener("click", function() {
      container.classList.toggle("active");
      resetForms();
    });

    loginBtn.addEventListener("click", function() {
      container.classList.toggle("active");
      resetForms();
    });

    document.addEventListener("load", resetForms)
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const success = document.getElementById("success");
      const err = document.getElementById("error");

      if (success) {
        setTimeout(() => {
          success.style.display = "none";
        }, 2000);
      }

      if (err) {
        setTimeout(() => {
          err.style.display = "none";
        }, 2000);
      }
    });
  </script>

</body>

</html>




<?php

//register authentication..

include 'connectDB.php';

if (isset($_POST['register'])) {
  $student_id = mysqli_real_escape_string($connectDB, $_POST['student_id']);
  $student_name = mysqli_real_escape_string($connectDB, $_POST['student_name']);
  $password = $_POST['password'];


  $hashed_password = password_hash($password, PASSWORD_DEFAULT);


  $duplicate_id = "SELECT * FROM students WHERE student_id = '$student_id'";
  $get_rows = mysqli_query($connectDB, $duplicate_id);
  $rows_count = mysqli_num_rows($get_rows);

  if ($rows_count > 0) {
    echo '<div class="alert-error" id="error">student id already exists.</div>';
  } else {
    $inject = "INSERT INTO students (student_id, student_name, password, voted) 
    VALUES ('$student_id', '$student_name', '$hashed_password', 'NO')";


    if (mysqli_query($connectDB, $inject)) {
      echo '<div class="alert-success" id="success">you are registered successfully.</div>';
      exit;
    } else {
      echo '<div class="alert-error" id="error">an unknown error occured.</div>';
    }
  }
}
?>