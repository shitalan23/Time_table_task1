<?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
$db_select = mysqli_select_db($conn, 'cards-order') or die(mysqli_error());

// -------- PROCESS FORM FIRST --------
if(isset($_POST['submit'])) {

    $product = mysqli_real_escape_string($conn,$_POST['product']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    $customer_name = mysqli_real_escape_string($conn,$_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn,$_POST['customer_contact']);
    $customer_email = mysqli_real_escape_string($conn,$_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn,$_POST['customer_address']);

    $total = $price * $quantity;
    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered";

    $sql2 = "INSERT INTO tbl_order SET
        product='$product',
        price='$price',
        quantity='$quantity',
        total='$total',
        order_date='$order_date',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address',
        status='$status'
    ";

    $res2 = mysqli_query($conn, $sql2);

    if($res2){
        
        $_SESSION['order'] = "Order Placed Successfully!";
        header("Location: index.php");
        exit();
    } else {
        
        $_SESSION['order'] = "<span style='color:green;'>Failed to Place Order!</span>";
        header("Location: index.php");
        exit();
    }
}

// -------- GET CARD DATA --------
if(isset($_GET['card_id'])){
    $card_id = intval($_GET['card_id']);
    $sql = "SELECT * FROM tbl_cards WHERE id=$card_id";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) == 1){
        $row = mysqli_fetch_assoc($res);
        $image = $row['image'];
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirm Your Order</title>

<style>
:root {
    --primary: #ff4d2d;
    --dark: #333;
    --light: #777;
    --bg: #f4f6f8;
    --white: #fff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: var(--bg);
    padding: 30px 15px;
}

/* PAGE TITLE */
.page-title {
    text-align: center;
    margin-top: 80px;
    margin-bottom: 30px;
}

.page-title h2 {
    color: var(--dark);
    margin-bottom: 8px;
}

.page-title p {
    color: var(--light);
    font-size: 14px;
}

/* MAIN CONTAINER */
.order-wrapper {
    max-width: 1100px;
    margin: auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

/* COMMON CARD STYLE */
.card-box {
    background: var(--white);
    border-radius: 12px;
    padding: 22px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s;
}

.card-box:hover {
    transform: translateY(-4px);
}

/* LEFT CARD DETAILS */
.card-image img {
    width: 100%;
    height: 380px;
    object-fit: cover;
    object-position: top;   /* Show top part */
    border-radius: 10px;
    margin-bottom: 15px;
}


.card-info h3 {
    color: var(--dark);
    margin-bottom: 8px;
}

.price {
    color: var(--primary);
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
}

.card-info p {
    color: var(--light);
    font-size: 14px;
    line-height: 1.6;
}

/* FORM */
.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    font-size: 13px;
    margin-bottom: 6px;
    color: var(--dark);
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary);
}

textarea {
    resize: none;
    height: 90px;
}

/* QUANTITY BOX */
.qty-box {
    display: flex;
    align-items: center;
    gap: 10px;
}

.qty-box input {
    width: 60px;
    text-align: center;
    padding: 8px;
    font-size: 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
}

.qty-btn {
    width: 36px;
    height: 36px;
    border: none;
    background: #1e88e5; /* dark blue */
    color: #fff;
    font-size: 18px;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
}

.qty-btn:hover {
    background: #222;
}

/* BUTTON */
.confirm-btn {
    width: 100%;
    padding: 12px;
    background: var(--primary);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.confirm-btn:hover {
    background: #e03e00;
}
.back-btn {
    background: #8e44ad;
    color: #fff;
    border: none;
    padding: 10px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s ease;
    margin-left:50px;
    margin-top:30px;
}

.back-btn:hover {
    background: #732d91;
}
    

/* RESPONSIVE */
@media (max-width: 900px) {
    .order-wrapper {
        grid-template-columns: 1fr;
    }

    .card-image img {
        height: 220px;
    }
}
</style>

</head>
  <button class="back-btn" onclick="window.location.href='card-service.php'">← Back</button>

<body>

<div class="page-title">
    <h2>Confirm Your Card Order</h2>
    <p>Please review the card details and fill the form</p>
</div>

<div class="order-wrapper">

    <!-- CARD DETAILS -->
    <div class="card-box">
        <div class="card-image">
            <?php if($image==""){ echo "<p>Image not available</p>"; } 
            else { ?>
                <img src="assets/cards/<?php echo $image; ?>" alt="<?php echo $title; ?>">
            <?php } ?>
        </div>

        <div class="card-info">
            <h3><?php echo $title; ?></h3>
            <div class="price">₹<?php echo $price; ?></div>
            <p><?php echo $description; ?></p>
        </div>
    </div>

    <!-- ORDER FORM -->
    <div class="card-box">
        <form action="" method="POST">
            <input type="hidden" name="product" value="<?php echo htmlspecialchars($title); ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="customer_name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="customer_contact" placeholder="Enter phone number" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="customer_email" placeholder="Enter email address" required>
            </div>

            <div class="form-group">
                <label>Delivery Address</label>
                <textarea name="customer_address" placeholder="Enter full delivery address" required></textarea>
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <div class="qty-box">
                    <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                    <input type="number" name="quantity" value="1" min="1" id="quantity">
                    <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                </div>
            </div>

            <button class="confirm-btn" type="submit" name="submit">Confirm Order</button>
        </form>
    </div>

</div>

<script>
// Quantity buttons
function changeQty(val){
    let qtyInput = document.getElementById('quantity');
    let current = parseInt(qtyInput.value);
    let next = current + val;
    if(next < 1) next = 1;
    qtyInput.value = next;
}
</script>
<?php if(isset($_SESSION['user_logged_in'])) { ?>
    <a href="logout.php" 
    style="
        position: fixed;        /* stays fixed at bottom left */
        bottom: 50px;           /* distance from bottom */
        left: 50px;             /* distance from left */
        padding: 12px 24px;     /* button size */
        background-color: #f04e3e; /* solid red-orange color */
        color: #fff;            /* text color */
        border: none;           /* no border */
        border-radius: 8px;     /* slightly rounded corners */
        text-decoration: none;  /* remove underline */
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    "
    onmouseover="this.style.background='#e04335';"
    onmouseout="this.style.background='#f04e3e';"
    >
    Logout
    </a>

<?php } ?>


</body>
</html> 