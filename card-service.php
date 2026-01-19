<?php 
include('partials-front/menu.php'); 
?>

<style>
/* Cards Layout */
/* .cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 25px;
    padding: 20px;
}

.card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

.card-img img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card-content {
    padding: 18px;
}

.card-content h3 {
    font-size: 20px;
    margin-bottom: 8px;
}

.price {
    color: #ff4500;
    font-weight: 700;
    margin-bottom: 10px;
}

.card-content p {
    font-size: 14px;
    color: #555;
    margin-bottom: 15px;
} */

/* Order Button */
.order-btn {
    display: inline-block;
    padding: 10px 18px;
    background: linear-gradient(135deg, #ff5722, #ff9800);
    color: #fff;
    text-decoration: none;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-bottom:10px;
}

.order-btn:hover {
    background: linear-gradient(135deg, #e64a19, #fb8c00);
    transform: scale(1.05);
}

/* Footer text */
/* .card-footer {
    margin-top: 12px;
    font-size: 12px;
    color: #888;
    text-align: right;
} */
</style>

<section class="cards-section">

<?php
$search = "";

// Search logic
if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM tbl_cards 
            WHERE title LIKE '%$search%' 
            OR description LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM tbl_cards";
}

$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) > 0){
    echo '<div class="cards">';
    while($row = mysqli_fetch_assoc($res)){
        ?>
        <div class="card">

            <div class="card-img">
                <?php if($row['image']!=""){ ?>
                    <img src="assets/cards/<?php echo $row['image']; ?>">
                <?php } else { ?>
                    <img src="assets/no-image.png">
                <?php } ?>
            </div>

            <div class="card-content">
                <h3><?php echo $row['title']; ?></h3>
                <div class="price">₹<?php echo number_format($row['price'],2); ?></div>
                <p><?php echo $row['description']; ?></p>

                <?php
                if(isset($_SESSION['user_logged_in'])){
                ?>
                    <a href="order.php?card_id=<?php echo $row['id']; ?>" class="order-btn">Order Now</a>
                <?php
                } else {
                    $_SESSION['redirect_after_login'] = "order.php?card_id=".$row['id'];
                ?>
                    <a href="login.php" class="order-btn">Order Now</a>
                <?php
                }
                ?>

                <div class="card-footer">Since 1990</div>
            </div>

        </div>
        <?php
    }
    echo '</div>';
}
else{
    echo "<p style='text-align:center'>No cards found</p>";
}
?>

</section>

<?php include('partials-front/footer.php'); ?>
