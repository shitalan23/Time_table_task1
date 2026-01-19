<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
$db_select = mysqli_select_db($conn, 'cards-order') or die(mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style_card.css">
</head>
<body>

<div class="container">

  <!-- Sidebar -->
  <aside class="sidebar">
    <h2 class="logo">Dashboard</h2>

    <ul class="menu">
      <li>
        <a href="manage-admin.php" >Admin Panel</a>
      </li>
       <li>
        <a href="manage-order.php" >Order Details</a>
      </li>

      <li class="cards-item">
        <a href="#" class="cards-link" onclick="toggleCards(event)">
          <span class="cards-left">
            <span class="hamburger">&#9776;</span>
            <span class="cards-text">Cards</span>
          </span>
          <span class="arrow">&#9654;</span>
        </a>

        <ul class="submenu" id="cardsMenu">
          <li><a href="#" onclick="showAddCard()">+ Add Card</a></li>
          <li><a href="#" onclick="showAllCards()">All Cards</a></li>
        </ul>
      </li>
    </ul>


    <a href="logout.php" class="logout">Logout</a>
  </aside>

  <!-- Main Content -->
  <main class="main">
    <h1>Admin Panel</h1>

    <!-- Add Card -->
    <div class="card-box" id="addCardSection">
      <h2>Add New Card</h2>
      <br><br>
      <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // remove after showing once
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']); // remove after showing once
            }
            if (isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']); // remove after showing once
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']); // remove after showing once
            }
            if (isset($_SESSION['no-card-found'])) {
                echo $_SESSION['no-card-found'];
                unset($_SESSION['no-card-found']); // remove after showing once
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']); // remove after showing once
            }
            
    
                    
      ?>

      <form action="" method="POST" enctype="multipart/form-data">
        <label>Upload Image</label>
        <input type="file" name="image" id="imageInput" accept="image/*">

        <div class="image-preview">
          <img id="previewImg">
        </div>

        <label>Title</label>
        <input type="text" name="title" placeholder="Card title">

        <label>Price</label>
        <input type="number" name="price" placeholder="Card price" step="0.01">


        <label>Description</label>
        <textarea name="description" placeholder="Card description"></textarea>

        <button name="submit" class="submit-btn">Submit</button>
      </form>

        <?php
        if(isset($_POST['submit'])){

            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = mysqli_real_escape_string($conn, $_POST['price']);


            // IMAGE HANDLING
            if(isset($_FILES['image']['name']) ){

                $image_name = $_FILES['image']['name'];
                if($image_name != ""){

                


                
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);


                    // Rename image (important)
                    $image_name = "card_" . rand(000,999) . '.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "assets/cards/" . $image_name;

                    // Upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload == false){
                        $_SESSION['upload'] = "<span style='color:red;'>Failed to upload image</span>";
                        header("Location: add-card.php");
                        exit;
                        die();
                    }
                }

            }else{
                $image_name = "";
            }
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);


            // INSERT INTO DATABASE
            $sql = "INSERT INTO tbl_cards SET
              title='$title',
              price='$price',
              description='$description',
              image='$image_name'
            ";


            $res = mysqli_query($conn, $sql);

            if($res == true){
                $_SESSION['add'] = "<span style='color:green;'>Card Added Successfully</span>";
                header("Location: add-card.php");
                exit;
            }else{
                $_SESSION['add'] = "<span style='color:red;'>Failed to add card</span>";
                header("Location: add-card.php");
                exit;
            }
        }
        ?>

    </div>

    <!-- All Cards -->
    <div class="card-box" id="allCardsSection">
      <h2>Cards</h2>

      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Image</th>
              <th>Title</th>
              <th>Price</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>

            <?php
            $sql = "SELECT * FROM tbl_cards";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sno = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id=$row['id'];
                    $image = $row['image'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    ?>
                    <tr>
                        <td><?php echo $sno++; ?></td>

                        <td>
                            <?php if ($image != "") { ?>
                                <img src="assets/cards/<?php echo $image; ?>" class="table-img">
                            <?php } else { ?>
                                <span style="color:red;">No Image</span>
                            <?php } ?>
                        </td>

                        <td><?php echo $title; ?></td>
                        <td>₹<?php echo $row['price']; ?></td>
                        <td><?php echo $description; ?></td>

                        <td class="actions">
                            <a href="update-card.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" 
                                class="btn edit">
                                Update
                            </a>
                            <a href="delete-card.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" 
                                class="btn delete"
                                onclick="return confirm('Are you sure you want to delete this card?');">
                                Delete
                            </a>

                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" style="text-align:center; color:#777; padding:20px;">
                        🚫 No cards added yet
                    </td>
                </tr>
                <?php
            }
            ?>



          <!-- <tbody>
            <tr>
              <td>01</td>
              <td><img src="assets/preview.png" class="table-img"></td>
              
              <td>BATMAN</td>
              <td>Sample description</td>
              <td class="actions">
                <a href="#" class="btn edit">Update</a>
                <a href="#" class="btn delete">Delete</a>
              </td>
            </tr>
          </tbody> -->
        </table>
      </div>
    </div>

  </main>

</div>

<script src="script.js"></script>
</body>
</html>
