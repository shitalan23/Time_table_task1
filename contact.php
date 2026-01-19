<?php include('partials-front/menu.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us | Batman</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body{
      background: #0b0b0b;
      color: #fff;
    }

    /* NAVBAR */
    .navbar{
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 60px;
      background: #000;
      border-bottom: 1px solid #222;
    }

    .logo{
      font-size: 24px;
      font-weight: bold;
      color: #f1c40f;
      letter-spacing: 2px;
    }

    .nav-links a{
      color: #fff;
      text-decoration: none;
      margin-left: 25px;
      font-size: 14px;
      transition: 0.3s;
    }

    .nav-links a:hover{
      color: #f1c40f;
    }

    /* CONTACT SECTION */
    .contact-section{
      min-height: calc(100vh - 140px);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
    }

    .contact-box{
      background: #111;
      max-width: 900px;
      width: 100%;
      display: flex;
      gap: 30px;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.6);
    }

    /* LEFT INFO */
    .contact-info{
      flex: 1;
    }

    .contact-info h2{
      color: #f1c40f;
      margin-bottom: 15px;
      font-size: 26px;
    }

    .contact-info p{
      color: #ccc;
      font-size: 14px;
      line-height: 1.7;
      margin-bottom: 20px;
    }

    .info-item{
      margin-bottom: 12px;
      font-size: 14px;
      color: #bbb;
    }

    .info-item span{
      color: #f1c40f;
      font-weight: 600;
    }

    /* FORM */
    .contact-form{
      flex: 1;
    }

    .contact-form h3{
      margin-bottom: 20px;
      font-size: 22px;
      color: #fff;
    }

    .form-group{
      margin-bottom: 15px;
    }

    .form-group input,
    .form-group textarea{
      width: 100%;
      padding: 12px;
      border-radius: 6px;
      border: 1px solid #333;
      background: #0b0b0b;
      color: #fff;
      font-size: 14px;
      outline: none;
    }

    .form-group textarea{
      resize: none;
      height: 120px;
    }

    .form-group input:focus,
    .form-group textarea:focus{
      border-color: #f1c40f;
    }

    .submit-btn{
      width: 100%;
      padding: 12px;
      background: #f1c40f;
      border: none;
      border-radius: 6px;
      color: #000;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    .submit-btn:hover{
      background: #d4ac0d;
    }

    /* FOOTER */
    footer{
      background: #000;
      text-align: center;
      padding: 15px;
      font-size: 13px;
      color: #777;
    }

    /* RESPONSIVE */
    @media(max-width: 768px){
      .contact-box{
        flex-direction: column;
        padding: 25px;
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
    <div class="logo">BATMAN</div>
    <nav class="nav-links">
      <a href="index.php">HOME</a>
      <a href="#">ABOUT</a>
      <a href="#">SERVICE</a>
      <a href="contact.php">CONTACT</a>
    </nav>
  </header> -->

  <!-- CONTACT -->
  <section class="contact-section">
    <div class="contact-box">

      <!-- INFO -->
      <div class="contact-info">
        <h2>Contact XYZ Organization</h2>
        <p>
          Have a message for Gotham’s Dark Knight?  
          Reach out to us for collaborations, fan queries, or Bat-signals.
        </p>

        <div class="info-item"><span>📍 Location:</span> Gotham City</div>
        <div class="info-item"><span>📧 Email:</span> batman@gotham.com</div>
        <div class="info-item"><span>📞 Phone:</span> +91 90000 00000</div>
      </div>

      <!-- FORM -->
      <div class="contact-form">
        <h3>Send a Message</h3>

        <form>
          <div class="form-group">
            <input type="text" placeholder="Your Name" required>
          </div>

          <div class="form-group">
            <input type="email" placeholder="Your Email" required>
          </div>

          <div class="form-group">
            <textarea placeholder="Your Message" required></textarea>
          </div>

          <button class="submit-btn">Send Message</button>
        </form>
      </div>

    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    © 2026 Batman | Gotham City
  </footer>

</body>
</html>


