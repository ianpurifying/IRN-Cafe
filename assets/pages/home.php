<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        /* Import custom font: Rubik Vinyl */
        @font-face {
            font-family: "Rubik Vinyl";
            src: url("assets/fonts/RubikVinyl-Regular.woff") format("woff"),
                 url("assets/fonts/RubikVinyl-Regular.ttf") format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        /* Reset body margin and apply default font */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
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
            font-family: "Rubik Vinyl", Arial, sans-serif;
            position: relative;
        }

        .home_text {
            border-radius: 30px;
            background: linear-gradient(145deg, #8CB1D5, #D0852D);
            box-shadow: 15px 15px 30px rgba(0, 0, 0, 0.4),
                        -15px -15px 30px rgba(255, 255, 255, 0.2);
            padding: 2rem;
            max-width: 600px;
            margin: 0 auto;
            color: #ffffff;
        }

        .home_text h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: rgb(203, 115, 21);
        }

        .home_text p {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .home_text .btn {
            padding: 0.75rem 2rem;
            font-size: 1rem;
            color: #ffffff;
            background-color: #D0852D;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .home_text .btn:hover {
            background-color: #EAAA64;
            transform: scale(1.05);
        }

        /* Menu Section */
        #menu {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #8CB1D5;
            text-align: center;
            color: #ffffff;
        }

        #menu h1 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            font-family: "Rubik Vinyl", Arial, sans-serif;
            color: rgb(203, 115, 21);
        }

        .menu-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem; /* Spacing between buttons */
        }

        #menu .btn {
            padding: 1rem 2rem;
            font-size: 1.2rem;
            color: white;
            background-color: #D0852D;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #menu .btn:hover {
            background-color: #EAAA64;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

    <!-- Home Section -->
    <section id="home">
        <div class="home_text">
            <h1>Welcome to IRN Cafe</h1>
            <p>Your cozy spot for the best coffee and chill vibes.</p>
            <button class="btn" onclick="location.href='#menu'">Order Now</button>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu">
        <h1>Our Menu</h1>
        <div class="menu-buttons">
            <button class="btn" onclick="location.href='index.php?page=chicken'">Chicken</button>
            <button class="btn" onclick="location.href='index.php?page=pork'">Pork</button>
            <button class="btn" onclick="location.href='index.php?page=desserts'">Desserts</button>
            <button class="btn" onclick="location.href='index.php?page=drinks'">Drinks</button>
        </div>
    </section>

</body>
</html>
