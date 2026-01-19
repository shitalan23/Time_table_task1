<?php include('partials-front/menu.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Batman</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body{
      background: #fff;
      color: #333;
    }

    /* ===== NAVBAR ===== */
    /* .navbar{
      background: #fff;
      padding: 20px 80px;
      border-bottom: 1px solid #eee;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .navbar img{
      width: 45px;
      margin-bottom: 10px;
    }

    .nav-links a{
      text-decoration: none;
      color: #333;
      margin: 0 15px;
      font-size: 13px;
      letter-spacing: 1px;
    }

    .nav-links a:hover{
      font-weight: 600;
    } */

    /* ===== HERO ===== */
    .hero{
      height: 55vh;
      background: url('https://wallpapercave.com/wp/wp1818626.jpg') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .hero::after{
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.65);
    }

    .hero-text{
      position: relative;
      color: #fff;
      text-align: center;
      max-width: 600px;
    }

    .hero-text h1{
      font-size: 48px;
      letter-spacing: 3px;
      margin-bottom: 15px;
    }

    .hero-text p{
      font-size: 14px;
      color: #ddd;
      line-height: 1.6;
    }

    /* ===== ABOUT CONTENT ===== */
    .about{
      padding: 80px 120px;
      text-align: center;
    }

    .about h2{
      font-size: 22px;
      letter-spacing: 2px;
      margin-bottom: 30px;
    }

    .about p{
      max-width: 900px;
      margin: auto;
      font-size: 14px;
      line-height: 1.9;
      color: #555;
    }

    .about blockquote{
      margin-top: 40px;
      font-style: italic;
      color: #222;
      font-size: 15px;
    }

    /* ===== FOOTER ===== */
    /* footer{
      background: #333;
      color: #ccc;
      padding: 30px;
      text-align: center;
      margin-top: 60px;
      font-size: 12px;
    } */
    
      

    /* ===== RESPONSIVE ===== */
    @media(max-width: 768px){
      .about{
        padding: 50px 25px;
      }

      .navbar{
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <!-- <header class="navbar">
    <img src="https://upload.wikimedia.org/wikipedia/commons/1/1b/Batman-Logo.svg">
    <nav class="nav-links">
      <a href="index.html">HOME</a>
      <a href="about.html">ABOUT</a>
      <a href="contact.html">CONTACT</a>
    </nav>
  </header> -->

  <!-- HERO -->

  <section class="hero">
    <div class="hero-text">
      
      <h1>BATMAN</h1>
      <p>The Dark Knight of Gotham City</p>
    </div>
  </section>

  <!-- ABOUT -->
  <section class="about">
    <h2>Something About Batman</h2>
    <p>
      Batman is a fictional superhero appearing in DC Comics. Known as the Dark Knight,
      he is the protector of Gotham City. Unlike most superheroes, Batman does not possess
      any superhuman abilities. His strength lies in intelligence, discipline, detective
      skills, and unwavering determination.
      <br><br>
      After witnessing the tragic murder of his parents as a child, Bruce Wayne dedicated
      his life to fighting crime. Through years of physical and mental training, he became
      a symbol of fear for criminals and a symbol of hope for the innocent.
      <br><br>
      Batman operates under a strict moral code. He believes justice must be served without
      becoming the very evil he fights. His presence in Gotham is not just about strength,
      but about inspiring order in chaos.
    </p>

    <blockquote>
      “It’s not who I am underneath, but what I do that defines me.”
    </blockquote>
  </section>

  <!-- FOOTER -->
  <!-- <footer>
    © 2026 Batman Fan Website | All Rights Reserved
  </footer> -->

</body>
</html>
<?php include('partials-front/footer.php');?>