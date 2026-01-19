<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
mysqli_select_db($conn, 'cards-order') or die(mysqli_error());
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Card</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
/* same CSS – unchanged */
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{min-height:100vh;background:#f2f5f7;display:flex;justify-content:center;align-items:center;padding:20px;}
.update-box{background:#fff;width:100%;max-width:480px;padding:30px;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.08);}
.update-box h2{text-align:center;margin-bottom:25px;color:#333;}
.form-group{margin-bottom:18px;}
label{display:block;margin-bottom:6px;font-size:14px;color:#555;}
input,textarea{width:100%;padding:12px;border:1px solid #ccc;border-radius:6px;font-size:14px;}
textarea{resize:none;height:100px;}
.current-image{display:flex;align-items:center;gap:15px;margin-top:10px;}
.current-image img{width:90px;height:90px;object-fit:cover;border-radius:8px;border:1px solid #ddd;}
.note{font-size:13px;color:#777;}
.update-btn{width:100%;padding:12px;border:none;border-radius:6px;background:#f39c12;color:#fff;font-size:15px;cursor:pointer;}
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

</style>
</head>

<body>
    <button class="back-btn" onclick="history.back()">← Back</button>


<div class="update-box">
<h2>Update Card</h2>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_cards WHERE id=$id";
    $res = mysqli_query($conn,$sql);

    if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);
        $current_image = $row['image'];
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
    } else {
        header("Location: add-card.php");
        exit;
    }
}
?>

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
<label>Current Image</label>
<div class="current-image">
<?php if($current_image!=""){ ?>
    <img src="assets/cards/<?php echo $current_image; ?>">
    <span class="note"><?php echo $current_image; ?></span>
<?php } else { echo "<span style='color:red'>No Image</span>"; } ?>
</div>
</div>

<div class="form-group">
<label>Upload New Image</label>
<input type="file" name="new_image">
</div>

<div class="form-group">
<label>Title</label>
<input type="text" name="title" value="<?php echo $title; ?>">
</div>
<div class="form-group">
<label>Price</label>
<input type="number" name="price" step="0.01" value="<?php echo $price; ?>">
</div>


<div class="form-group">
<label>Description</label>
<textarea name="description"><?php echo $description; ?></textarea>
</div>

<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

<button type="submit" name="submit" class="update-btn">Update Card</button>

</form>
</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $current_image = $_POST['current_image'];
    $image = $current_image;

    if(isset($_FILES['new_image']['name']) && $_FILES['new_image']['name']!=""){

        $image_name = $_FILES['new_image']['name'];
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $image = "card_" . rand(100,999) . "." . $ext;

        $source = $_FILES['new_image']['tmp_name'];
        $destination = "assets/cards/".$image;
        move_uploaded_file($source,$destination);

        if($current_image!=""){
            unlink("assets/cards/".$current_image);
        }
    }

    $sql2 = "UPDATE tbl_cards SET 
                image='$image',
                title='$title',
                price='$price',
                description='$description'
             WHERE id='$id'";

    $res2 = mysqli_query($conn,$sql2);

    if($res2){
        $_SESSION['update'] = "Updated successfully";
        header("Location: add-card.php");
        exit;
    }
}
?>
