<?php include('partials-front/menu.php');?>
  



  <!-- HERO -->
  <section class="hero">
    
    <div class="hero-text">
      <h1>BATMAN</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, earum!</p>
    </div>
  </section>

  <!-- ABOUT -->
  <section class="about">
    <h2>SOMETHING ABOUT BATMAN</h2>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure eum beatae id minima nihil ab,
      voluptates mollitia molestias. Fuga, ratione, molestiae magnam expedita nam debitis sequi
      reprehenderit nemo quidem veniam nisi consectetur rerum dignissimos tempora ducimus rem
      voluptatibus est necessitatibus.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
    </p>
  </section>
  <section class="cards-section">
    <h2>THE BATMAN TRIOLOGY</h2>

    <?php
      $sql = "SELECT * FROM tbl_cards LIMIT 3";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);

      if($count > 0){
        echo '<div class="cards">'; // ✅ ONE flex container

        while($row = mysqli_fetch_assoc($res)){
          $image = $row['image'];
          $title = $row['title'];
          $description = $row['description'];
          ?>
            <div class="card">
              <?php
                if($image == ""){
                  echo "<p>Image not available</p>";
                } else {
              ?>
                <img src="assets/cards/<?php echo $image; ?>" alt="<?php echo $title; ?>">
              <?php } ?>

              <h3><?php echo $title; ?></h3>
              <p><?php echo $description; ?></p>
              <span>1990</span>
            </div>
          <?php
        }

        echo '</div>'; // ✅ close .cards
      }
      else{
        echo "<p>Card not added</p>";
      }
    ?>
  </section>


    <!-- FOOTER -->
    
<?php include('partials-front/footer.php');?>