<style>
    @font-face {
        font-family: "Rubik Vinyl";
        src: url("assets/fonts/RubikVinyl-Regular.woff") format("woff"),
             url("assets/fonts/RubikVinyl-Regular.ttf") format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    /* Home Section */
    #home {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        text-align: center;
        background: url('assets/img/homepage_img.jpg') no-repeat center center;
        background-size: cover;
        position: relative;
        overflow: hidden;
        color: white;
    }

    #home::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .home_text {
        border-radius: 30px;
        padding: 2rem;
        max-width: 650px;
        margin: 0 auto;
        z-index: 2;
        background-color: rgba(0, 0, 0, 0.6); /* Adds a darker background for readability */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        transform: translateY(50px);
        opacity: 0;
        animation: fadeInUp 1s forwards;
    }

    .home_text h1 {

    }

    /* Add a typewriter effect */
@keyframes typing {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}

.home_text h1 {
    font-size: 3rem;
        margin-bottom: 1.5rem;
        font-weight: bolder;
        color: rgb(203, 115, 21);
        font-family: "Rubik Vinyl", Arial, sans-serif !important;
    
        overflow: hidden; /* Ensures the text is clipped */
  white-space: nowrap; /* Prevents text from wrapping */
  border-right: 3px solid #333; /* Adds the cursor effect */
  width: 0; /* Start width at 0 */
  animation: typing 2s steps(30) 1s forwards; /* Adjust animation speed and steps */
}

/* Optional: Adjust the cursor to simulate typing effect */
.home_text h1::after {
  content: '|'; /* Simulates the blinking cursor */
  animation: blink 0.7s step-end infinite;
}

@keyframes blink {
  50% {
    opacity: 0;
  }
}


    .home_text p {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        font-weight: 600;
        line-height: 1.8;
        color: #f5f5f5;
    }

    .home_text .btn {
        padding: 1rem 2.5rem;
        font-size: 1.2rem;
        color: #fff;
        background-color: rgb(197, 138, 71);
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .home_text .btn:hover {
        background-color: #EAAA64;
        transform: scale(1.1);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Animations */
    @keyframes fadeInUp {
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<!-- Home Section -->
<section id="home">
    <div class="home_text">
        <h1>Welcome to IRN Cafe</h1>
        <p>Your cozy spot for the best coffee and chill vibes. Indulge in your favorite brew and unwind with us!</p>
        <button class="btn" onclick="location.href='index.php?page=menu'">ORDER NOW</button>
    </div>

   
</section>

<section id='about'>
<?php include PAGE_PATH . 'about.php';?>
</section>
