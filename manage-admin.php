<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
$db_select = mysqli_select_db($conn, 'cards-order') or die(mysqli_error());
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Management Table</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #f4f6f9;
      padding: 20px;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background: #ffffff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 10px;
    }

    h2 {
      color: #333;
    }

    .add-admin {
      text-decoration: none;
      background: #2980b9;
      color: #fff;
      padding: 10px 16px;
      border-radius: 6px;
      font-size: 14px;
      transition: 0.3s ease;
    }

    .add-admin:hover {
      background: #1f6391;
    }

    .table-wrapper {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }

    thead {
      background: #2c3e50;
      color: #fff;
    }

    th, td {
      padding: 14px 16px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      text-transform: uppercase;
      font-size: 14px;
      letter-spacing: 0.5px;
    }

    tbody tr:hover {
      background-color: #f1f5ff;
    }

    .actions {
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .btn {
      padding: 7px 14px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      transition: 0.3s ease;
      color: #fff;
    }

    .btn-update {
      background-color: #27ae60;
    }
    .password {
      background-color: #1176b9ff;
    }
    .password:hover {
      background: #1f6391;
    }

    .btn-update:hover {
      background-color: #219150;
    }

    .btn-delete {
      background-color: #e74c3c;
    }

    .btn-delete:hover {
      background-color: #c0392b;
    }
    .back-btn {
      background: #2980b9;
      color: #fff;
      border: none;
      padding: 10px 16px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      transition: 0.3s ease;
    }

    .back-btn:hover {
      background: #1f6391;
    }


    /* Responsive */
    @media (max-width: 600px) {
      .header {
        flex-direction: column;
        align-items: flex-start;
      }

      h2 {
        font-size: 18px;
      }

      th, td {
        padding: 10px;
        font-size: 13px;
      }

      .btn {
        font-size: 12px;
        padding: 6px 10px;
      }
    }
  </style>
</head>
<button class="back-btn" onclick="history.back()">← Back</button>

<body>

  <div class="container">
    <div class="header">
      <h2>Admin Management</h2>
      <br>
      <br>
        <?php
            
          
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // remove after showing once
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']); // remove after showing once
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']); // remove after showing once
            }
            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']); // remove after showing once
            }
            if (isset($_SESSION['password-not-matched'])) {
                echo $_SESSION['password-not-matched'];
                unset($_SESSION['password-not-matched']); // remove after showing once
            }
            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']); // remove after showing once
            }
                   

           

        ?>
        <br>
        <br>
        <br>
      <a href="add-admin.php" class="add-admin">+ Add Admin</a>
    </div>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>S.N</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>
          </tr>
        </thead>
        <?php
          $sql = "SELECT * FROM tbl_admin WHERE role='admin'";
          $res = mysqli_query($conn,$sql);

          if($res == TRUE){
            $count=mysqli_num_rows($res);
            $sn=1;
            if($count > 0){
                
                while($rows = mysqli_fetch_assoc($res)){
                    $id = $rows['id'];
                    $full_name = $rows['full_name'];
                    $username = $rows['username'];
                    $role=$rows['role'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        
                        <td>
                            
                            <div class="actions">
                                <a href="update-password.php?id=<?php echo $id; ?>" class="btn password">Change Password</a>
                                <a href="update-admin.php?id=<?php echo $id; ?>" 
                                    class="btn btn-update">
                                    Update
                                </a>

                                <a href="delete-admin.php?id=<?php echo $id; ?>" 
                                    class="btn btn-delete"
                                    onclick="return confirm('Are you sure you want to delete this admin?');">
                                    Delete
                                </a>

                            </div>
                        </td>
                    </tr>                                               
                    
                    <?php
                

                }
            }
            else{
                echo "we don't have data";
            }
          }
        ?>

        
      </table>
    </div>
  </div>

</body>
</html>
