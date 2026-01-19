<?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
$db_select = mysqli_select_db($conn, 'cards-order') or die(mysqli_error());

// Handle form submission
if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // encrypt password
    $role = "Admin"; // default role for this page

    // Insert into database
    $sql = "INSERT INTO tbl_admin SET 
        full_name = '$full_name',
        username = '$username',
        password = '$password',
        role = '$role'
    ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if($res){
        $_SESSION['add'] = "<span style='color:green;'>Admin added successfully</span>";
        header("Location: manage-admin.php");
        exit;
    } else {
        $_SESSION['add'] = "<span style='color:red;'>Failed to add admin</span>";
        header("Location: add-admin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- You can move this CSS to your style_1.css -->
  <style>
    * { margin:0; padding:0; box-sizing:border-box; font-family: 'Poppins', sans-serif; }

    body {
      min-height: 100vh;
      background: #f4f6f9;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .form-container {
      background: #fff;
      width: 100%;
      max-width: 420px;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
      position: relative;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .form-group {
      margin-bottom: 18px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      color: #555;
    }

    input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      outline: none;
      transition: 0.3s;
    }

    input:focus {
      border-color: #2980b9;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      background: #2980b9;
      color: #fff;
      font-size: 15px;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 10px;
    }

    .submit-btn:hover {
      background: #1f6391;
    }

    .back-btn {
      position: fixed;
      top: 20px;
      left: 20px;
      background: #8e44ad;
      color: #fff;
      border: none;
      padding: 10px 16px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      transition: 0.3s ease;
      z-index: 1000;
    }

    .back-btn:hover {
      background: #732d91;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .form-container { padding: 20px; }
      h2 { font-size: 18px; }
    }
  </style>
</head>
<body>

  <!-- Back button -->
  <button class="back-btn" onclick="history.back()">← Back</button>

  <!-- Form -->
  <div class="form-container">
    <h2>Add Admin</h2>

    <form action="" method="POST">
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="full_name" placeholder="Enter full name" required>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter username" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
      </div>

      <button type="submit" name="submit" class="submit-btn">Add Admin</button>
    </form>
  </div>

</body>
</html>
