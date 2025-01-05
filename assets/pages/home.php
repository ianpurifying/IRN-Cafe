<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
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
            color: white;
            text-align: center;
            background: url('assets/img/homepage_img.jpg') no-repeat center center;
            background-size: cover;
        }

        #home h1 {
            font-size: 3rem;
            margin: 0;
        }

        #home p {
            font-size: 1.25rem;
            margin: 1rem 0;
        }

        #home .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Menu Section */
        #menu {
            padding: 2rem 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        #menu h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        #menu .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: white;
            background-color: #6c757d;
            border: none;
            border-radius: 5px;
            margin: 0.5rem;
            cursor: pointer;
        }

        #menu .btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

    <!-- Home Section -->
    <section id="home">
        <div>
            <h1>Welcome to IRN Cafe</h1>
            <p>Your cozy spot for the best coffee and chill vibes.</p>
            <button class="btn" onclick="location.href='#menu'">Order Now</button>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu">
        <div>
            <h2>Our Menu</h2>
            <div>
                <button class="btn" onclick="location.href='index.php?page=chicken'">Chicken</button>
                <button class="btn" onclick="location.href='index.php?page=pork'">Pork</button>
                <button class="btn" onclick="location.href='index.php?page=desserts'">Dessert</button>
                <button class="btn" onclick="location.href='index.php?page=drinks'">Drinks</button>
            </div>
        </div>
    </section>

</body>
</html>
