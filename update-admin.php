
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

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
      .form-container {
        padding: 20px;
      }

      h2 {
        font-size: 18px;
      }
    }
  </style>
</head>
<body>
  <button class="back-btn" onclick="history.back()">← Back</button>


  <div class="form-container">
    <h2>Update Admin</h2>
    <br><br>
    <?php
        session_start();
        $id = $_GET['id'];

        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        $conn = mysqli_connect('localhost' , 'root' , '') or die(mysqli_error());
        $db_select = mysqli_select_db($conn , 'cards-order') or die(mysqli_error());
        $res = mysqli_query($conn,$sql);
        if($res == TRUE){
            $count=mysqli_num_rows($res);
            if($count==1){
                $row=mysqli_fetch_assoc($res);
                $full_name=$row['full_name'];
                $username=$row['username'];
                

            }
            

            // $_SESSION['add'] = "<span style='color:green;'>Admin added successfully</span>";

            // header("Location: http://localhost/batman_cards_order/manage-admin.php");
            // exit;

            

        }
        else{
            echo "not updated";
            // $_SESSION['add'] = "<span style='color:red;'>Failed to add admin</span>";

            header("Location: http://localhost/batman_cards_order/add-admin.php");
            exit;

        }        

    ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="full_name" value="<?php echo $full_name; ?>" required>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
      </div>

      <input type="hidden" name="id" value="<?php echo $id; ?>">



      <button type="submit" name="submit" class="submit-btn">Update Admin</button>
    </form>
  </div>

</body>
</html>


<?php
    
    if(isset($_POST['submit'])){
        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        

        $sql = "UPDATE  tbl_admin SET 
            full_name = '$full_name',
            username = '$username'
            WHERE id='$id'   
        ";
        


        // $conn = mysqli_connect('localhost' , 'root' , '') or die(mysqli_error());
        // $db_select = mysqli_select_db($conn , 'cards-order') or die(mysqli_error());



        $res = mysqli_query($conn,$sql) or die(mysqli_error());
        if($res == true){

            $_SESSION['update'] = "<span style='color:blue;'>Admin Updated successfully</span>";

            header("Location: http://localhost/batman_cards_order/manage-admin.php");
            exit;

            

        }
        else{
            $_SESSION['update'] = "<span style='color:red;'>Failed to update admin</span>";

            header("Location: http://localhost/batman_cards_order/add-admin.php");
            exit;


        }


    }
    
?>
