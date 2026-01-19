<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
$db_select = mysqli_select_db($conn, 'cards-order') or die(mysqli_error());
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Management Table</title>
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
      /* max-width: 1000px; */
      margin: 100px;
      background: #ffffff;
      padding: 20px;
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
    /* Status colors */
    .status-Ordered {
      color: #2980b9; /* blue */
      font-weight: 600;
    }

    .status-On-Delivery {
      color: #f39c12; /* orange */
      font-weight: 600;
    }

    .status-Delivered {
      color: #27ae60; /* green */
      font-weight: 600;
    }

    .status-Cancelled {
      color: #e74c3c; /* red */
      font-weight: 600;
    }

    /* dropdown styling */
    select.status-select {
      padding: 6px 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-weight: 600;
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

      <h2>Order Management</h2>
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
           
            
                   

           

        ?>
        <br>
        <br>
        <br>
    </div>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>S.N</th>
            <th>Product</th>
            <th>price</th>
            <th>quantity</th>
            <th>total</th>
            <th>order_date</th>
            
            <th>customer_name</th>
            <th>contact</th>
            <th>email</th>
            <th>address</th>
            
            <th>status</th>
          </tr>
        </thead>
        <?php
          $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
          $res = mysqli_query($conn,$sql);

          if($res == TRUE){
            $count=mysqli_num_rows($res);
            $sn=1;
            if($count > 0){
                
                while($rows = mysqli_fetch_assoc($res)){
                    $id = $rows['id'];
                    $product = $rows['product'];
                    $price = $rows['price'];
                    $quantity = $rows['quantity'];
                    $total = $rows['total'];
                    $order_date = $rows['order_date'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_address = $rows['customer_address'];
                    $status = $rows['status'];
                    ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo $product; ?></td>
                      <td><?php echo $price; ?></td>
                      <td><?php echo $quantity; ?></td>
                      <td><?php echo $total; ?></td>
                      <td><?php echo $order_date; ?></td>
                      
                      <td><?php echo $customer_name; ?></td>
                      <td><?php echo $customer_contact; ?></td>
                      <td><?php echo $customer_email; ?></td>
                      <td><?php echo $customer_address; ?></td>
                      <td>
                        <form action="update-order.php" method="POST">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">

                          <select 
                            name="status" 
                            class="status-select status-<?php echo str_replace(' ', '\\ ', $status); ?>" 
                            required
                          >
                            <option value="Ordered" <?php if($status=='Ordered') echo 'selected'; ?>>
                              Ordered
                            </option>

                            <option value="On-Delivery" <?php if($status=='On-Delivery') echo 'selected'; ?>>
                              On Delivery
                            </option>

                            <option value="Delivered" <?php if($status=='Delivered') echo 'selected'; ?>>
                              Delivered
                            </option>

                            <option value="Cancelled" <?php if($status=='Cancelled') echo 'selected'; ?>>
                              Cancelled
                            </option>
                          </select>

                          <button type="submit" class="btn btn-update" style="margin-top:5px;">
                            Update
                          </button>
                        </form>
                      </td>
               <!-- <td>
                            
                        <div class="actions">
                            <a href="update-order.php?id=<?php echo $id; ?>" 
                                class="btn btn-update">
                                Update
                            </a>

                            <a href="delete-order.php?id=<?php echo $id; ?>" 
                                class="btn btn-delete"
                                onclick="return confirm('Are you sure you want to delete this order?');">
                                Delete
                            </a>

                        </div>
                      </td> -->
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
