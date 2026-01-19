<?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
$db_select = mysqli_select_db($conn, 'cards-order') or die(mysqli_error());

// ---------- LOGIN PROCESS ----------
if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // (OK for now)
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "SELECT * FROM tbl_admin 
            WHERE username='$username' 
            AND password='$password' 
            AND role='$role'";

    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) == 1){

        // LOGIN SUCCESS
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_role'] = $role;
        $_SESSION['username'] = $username;

        // If user came from Order Now
        if(isset($_SESSION['redirect_after_login'])){
            $redirect = $_SESSION['redirect_after_login'];
            unset($_SESSION['redirect_after_login']);
            header("Location: $redirect");
            exit;
        }

        // Default redirects
        if($role == 'admin'){
            header("Location: add-card.php");
        } else {
            header("Location: index.php");
        }
        exit;
    }
    else{
        $_SESSION['login'] = "<span style='color:red;'>Invalid username, password or role</span>";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:Arial, sans-serif;
}
body{
  min-height:100vh;
  background:linear-gradient(135deg,#2980b9,#6dd5fa);
  display:flex;
  justify-content:center;
  align-items:center;
  padding:20px;
}
.login-box{
  background:#fff;
  width:100%;
  max-width:380px;
  padding:30px;
  border-radius:10px;
  box-shadow:0 10px 25px rgba(0,0,0,0.15);
}
.login-box h2{
  text-align:center;
  margin-bottom:25px;
}
.form-group{
  margin-bottom:18px;
}
label{
  display:block;
  margin-bottom:6px;
  font-size:14px;
}
input, select{
  width:100%;
  padding:12px;
  border:1px solid #ccc;
  border-radius:6px;
}
.login-btn{
  width:100%;
  padding:12px;
  border:none;
  border-radius:6px;
  background:#2980b9;
  color:#fff;
  font-size:15px;
  cursor:pointer;
}
.login-btn:hover{
  background:#1f6391;
}
.register-text{
  text-align:center;
  margin-top:12px;
}
.register-text a{
  color:#2980b9;
  font-weight:bold;
  text-decoration:none;
}
.back-btn{
  position:fixed;
  top:20px;
  left:20px;
  background:black;
  color:#fff;
  border:none;
  padding:10px 16px;
  border-radius:6px;
  cursor:pointer;
}
@media(max-width:480px){
  .login-box{ padding:20px; }
}
</style>
</head>

<body>

<button class="back-btn" onclick="window.location.href='index.php'">← Back</button>

<div class="login-box">
<h2>Login</h2>

<?php
if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}
?>

<form method="POST">
  <div class="form-group">
    <label>Username</label>
    <input type="text" name="username" required>
  </div>

  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" required>
  </div>

  <div class="form-group">
    <label>Role</label>
    <select name="role" required>
      <option value="">Select Role</option>
      <option value="admin">Admin</option>
      <option value="user">User</option>
    </select>
  </div>

  <button type="submit" name="submit" class="login-btn">Login</button>
</form>

<div class="register-text">
  Don’t have an account? <a href="signup.php">Register</a>
</div>

</div>
</body>
</html>
