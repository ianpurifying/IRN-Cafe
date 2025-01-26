<style>

  .container {
    width: 100%;
    max-width: 1600px;
    margin: 0 auto;
  }

  .footer {
    position: relative;
    margin-top: 300px;
    padding: 3rem 0;
    color: #fff;
    background: #000;
  }

  .footer__columns {
    display: flex;
    justify-content: space-between;
  }

  .footer__col-title {
    font-size: 1.6rem;
    margin-bottom: 2rem;
    text-transform: uppercase;
    display: flex;
    align-items: center;
  }

  .footer__col-title span {
    margin-left: 1rem;
  }

  .footer a {
    display: flex;
    align-items: center;
    color: #fff;
    text-decoration: none;
  }

  .footer a span {
    margin-left: 1rem;
  }

  .footer__nav-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    list-style: none; /* Removes bullet points */
    padding: 0; /* Removes default padding */
    margin: 0; /* Removes default margin */
  }

  .footer__copyrights {
    padding-top: 3rem;
    margin-top: 3rem;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
  }

  .footer__copyrights p {
    display: flex;
  }

  .footer__copyrights p a {
    margin-left: 0.5rem;
  }

  @keyframes parralax {
    0% {
      background-position: 260px;
    }
    100% {
      background-position: -10000vw;
    }
  }

  @keyframes moto {
    0%,
    98% {
      transform: translateY(0) rotate(0);
    }
    5% {
      transform: translateY(0) rotate(-5deg);
    }
    25%,
    75% {
      transform: translateY(60px) rotate(-20deg);
    }
    49% {
      transform: translateY(0) rotate(-1deg);
    }
    51% {
      transform: translateY(0) rotate(1deg);
    }
    80% {
      transform: translateY(60px) rotate(0);
    }
  }

  @keyframes voiture {
    0%,
    50%,
    100% {
      transform: rotate(0);
    }
    25% {
      transform: rotate(-5deg);
    }
    75% {
      transform: rotate(5deg);
    }
  }

  .footer__parralax {
    position: absolute;
    left: 0;
    top: -300px;
    height: 300px;
    width: 100%;
    overflow: hidden;
  }

  .footer__parralax-trees,
  .footer__parralax-premierplan,
  .footer__parralax-secondplan {
    position: absolute;
    inset: 0;
    background-repeat: repeat-x;
    background-position-y: 100% !important;
    animation: parralax 600s linear infinite;
  }

  .footer__parralax-moto {
    position: absolute;
    bottom: 80px;
    left: 50%;
    margin-left: -250px;
    height: 200px;
    width: 150px;
    background: url(https://i.ibb.co/JCGfFJd/moto-net.gif) no-repeat;
    transform-origin: 50% 80%;
    animation: moto 5s linear infinite;
  }

  .footer__parralax-voiture {
    position: absolute;
    bottom: 10px;
    left: 50%;
    margin-left: 250px;
    height: 114px;
    width: 206px;
    background: url(https://i.ibb.co/0Qhp4DN/voiture-fumee.gif) no-repeat;
    animation: voiture 1s linear infinite;
  }

  .footer__parralax-trees {
    background-image: url(https://i.ibb.co/nQM4PGJ/arbres.png);
    bottom: -60px;
    animation-duration: 1000s;
  }

  .footer__parralax-premierplan {
    background-image: url(https://i.ibb.co/RQhDWbk/premierplanv3.png);
    animation-duration: 500s;
  }

  .footer__parralax-secondplan {
    background-image: url(https://i.ibb.co/J3TjC4W/second-plan.png);
    animation-duration: 600s;
  }
</style>

<footer class="footer">
  <div class="footer__parralax">
    <div class="footer__parralax-trees"></div>
    <div class="footer__parralax-moto"></div>
    <div class="footer__parralax-secondplan"></div>
    <div class="footer__parralax-premierplan"></div>
    <div class="footer__parralax-voiture"></div>
  </div>
  <div class="container">
    <div class="footer__columns">
      <div class="footer__col">
        <h3 class="footer__col-title">
          <i data-feather="shopping-bag"></i> <span>IRN Cafe</span>
        </h3>
        <nav class="footer__nav">
          <ul class="footer__nav-list">
            <li><a href="#">Legal notices</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms and Conditions</a></li>
            <li><a href="#">Deliveries and returns</a></li>
          </ul>
        </nav>
      </div>
      <div class="footer__col">
        <h3 class="footer__col-title">
          <i data-feather="share-2"></i> <span>Our Networks</span>
        </h3>
        <nav class="footer__nav">
          <ul class="footer__nav-list">
          <li><a href="https://github.com/ianpurifying/IRN-Cafe" target="_blank"><i class="bi bi-github"></i><span>GitHub</span></a></li>
            <li><a href="https://www.youtube.com/shorts/SXHMnicI6Pg" target="_blank"><i class="bi bi-youtube"></i><span>YouTube</span></a></li>
            <li><a href="https://web.facebook.com/ianpurifying" target="_blank"><i class="bi bi-facebook"></i><span>Facebook</span></a></li>
            
          </ul>
        </nav>
      </div>
      <div class="footer__col">
        <h3 class="footer__col-title">
          <i data-feather="send"></i> <span>Contact</span>
        </h3>
        <nav class="footer__nav">
          <ul class="footer__nav-list">
              <li><span>ianpurificacion2002@gmail.com</span></li>
              <li><span>dandorica95@gmail.com</span></li>
              <li><span>nicolevillapando26@gmail.com</span></li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="footer__copyrights">
      <p>&copy; <?php echo date("Y"); ?> <a href="https://web.facebook.com/ianpurifying" target="_blank">IRN Cafe</a>. All rights reserved.</p>
    </div>
  </div>
</footer>

<script>
  feather.replace();
</script>
