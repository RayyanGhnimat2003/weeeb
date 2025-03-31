<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Page</title>
</head>

<body>
    <header>
        <header>
            <img src="./images/AlamalClothes.png" alt="Alamal Clothes Logo" width="50">
            <h1>Alamal Clothes</h1>
        </header>
        <nav>
            <ul>
                <li><a href="products.php">Home</a></li>
                <li><a href="add.php">Add</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <hr>

    <main>
        <section>
            <h2>Contact Us</h2>
            <p>Hello, welcome to the contact page</p>
            <figure>
                <img src="./images/contact.jpg" alt="contact img" width="400">
            </figure>
        </section>

        <section>
            <h2>Opening Hours</h2>
            <p>Saturday - Friday: 2PM - 10PM</p>
        </section>

        <section>
            <h2>Address</h2>
            <p>Jenin, on Al-Irsal Street</p>
            <p>Telephone Number: <a href="tel:+970599794963">+970 599 794 963</a></p>
            <p><strong>Email:</strong><br>
                <a href="mailto:ameeraghnimat@gmail.com">ameeraghnimat@gmail.com</a>
            </p>
        </section>

        <section>
            <h2>Contact Form</h2>
            <form>
                <input type="text" placeholder="Full Name" name="Full-Name"><br><br>
                <input type="email" placeholder="Email Address" name="Email-Address"><br><br>
                <input type="text" placeholder="Sender Location (City)" name="senderLocation"><br><br>
                <input type="text" placeholder="Subject" name="Subject"><br><br>
                <textarea cols="30" rows="10" name="The-Message" placeholder="Type Your Message Here..."></textarea><br><br>
                <input type="submit" value="Submit Now">
                <input type="reset" value="Reset">
            </form>
        </section>
    </main>

    <footer>
        <p>Last Updated: <?php echo date('d-m-Y'); ?></p>
        <p>Store Address: Jenin, on Al-Irsal Street</p>
        <p>Telephone Number: <a href="tel:+970599794963">+970 599 794 963</a></p>
        <p>Email: <a href="mailto:ameeraghnimat@gmail.com">ameeraghnimat@gmail.com</a></p>
        <p><a href="contact.php">Contact Us</a></p>
    </footer>

</body>

</html>
