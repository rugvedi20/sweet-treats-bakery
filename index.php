<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <title>Sweet Treats Bakery</title>
</head>

<body>

  <!-- Header -->
  <header class="header">
    <div class="header-content text-center">
      <h1>Welcome to Sweet Treats Bakery</h1>
      <p>Your go-to place for delicious pastries and cakes</p>
      <a href="https://www.swiggy.com/" class="btn btn-primary" target="_blank">Order Now</a>
    </div>
  </header>

  <!-- Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <a class="navbar-brand" href="#">Sweet Treats Bakery</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#menu">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reviews.html" target="_blank">Reviews</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="carousel-container my-5">
    <h2 class="carousel-title text-center">Featured Items</h2>

    <!-- Carousel -->
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/cake.jpeg" class="d-block w-100 img-fluid" alt="Cake">
        </div>
        <div class="carousel-item">
          <img src="assets/donuts.jpeg" class="d-block w-100 img-fluid" alt="Donuts">
        </div>
        <div class="carousel-item">
          <img src="assets/macarons.jpeg" class="d-block w-100 img-fluid" alt="Macarons">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <!-- About Section -->
  <section id="about" class="container mt-5">
    <!-- About content will be dynamically loaded here -->
  </section>

  <!-- Menu Section -->
  <section id="menu" class="container mt-5">
    <h2 class="text-center">Our Menu</h2>
    <div class="row">
        <?php
        // Enable error reporting for debugging
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Database connection settings
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bakery_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch products
        $sql = "SELECT id, name, description, image, price FROM products";
        $result = $conn->query($sql);

        // Check if products exist
        if ($result->num_rows > 0) {
            // Output data for each row in a Bootstrap card format
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="' . $row["image"] . '" class="card-img-top" alt="' . $row["name"] . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["name"] . '</h5>
                            <p class="card-text">' . $row["description"] . '</p>
                        </div>
                        <div class="card-footer">
                            <p class="price">Price: $' . $row["price"] . '</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<p class='text-center'>No products available.</p>";
        }

        $conn->close();
        ?>
    </div>
</section>


  <!-- Contact Section -->
  <section id="contact" class="container mt-5">
    <h2 class="text-center mb-4">Contact Us</h2>
    <div class="row">
      <div class="col-md-6">
        <h4>Get in Touch</h4>
        <p>Email us at: <a href="mailto:info@sweettreatsbakery.com">info@sweettreatsbakery.com</a></p>
        <p>Call us at: <a href="tel:+1234567890">+123 456 7890</a></p>
        <p>Visit us: 123 Bakery Lane, Sweet Town, ST 12345</p>

        <div class="social-links">
          <a href="https://facebook.com" target="_blank">Facebook</a> |
          <a href="https://instagram.com" target="_blank">Instagram</a> |
          <a href="https://twitter.com" target="_blank">Twitter</a>
        </div>

        <!-- Button to Toggle the Form -->
        <button id="contact-btn" class="btn btn-secondary mt-3">Contact Form</button>
      </div>

      <div class="col-md-6">
        <!--Contact Form-->
        <form id="contact-form" style="display: none;" method="get"> <!-- Initially hidden -->
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer-->
  <footer>
    <a href="http://localhost/sweet-treats-bakery/login.php">Admin</a>
    <p>&copy; 2024 Sweet Treats Bakery</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!-- Smooth scroll -->
  <script>
    $(document).ready(function () {
      $("a[href^='#']").on('click', function (event) {
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function () {
            window.location.hash = hash;
          });
        }
      });
    });
  </script>

  <!-- Contact form toggle button -->
  <script>
    $(document).ready(function () {
      $("#contact-btn").click(function () {
        $("#contact-form").toggle(400);
      });
    });
  </script>

  <!-- jQuery for menu items-->
<script>
  $(document).ready(function () {
    $.getJSON('menu.json', function (data) {
      var menuItems = data.menuItems;
      var htmlContent = '';
      $.each(menuItems, function (index, item) {
        htmlContent += `
          <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
              <img src="${item.image}" class="card-img-top" alt="${item.title}">
              <div class="card-body">
                <h5 class="card-title">${item.title}</h5>
                <p class="card-text">${item.description}</p>
                <a href="item-details.html?id=${item.id}" class="btn btn-primary">View Details</a>
              </div>
            </div>
          </div>
        `;
      });
      $('#menu-items').html(htmlContent);
    });
  });
</script>

  </script>

  <script>
    $(document).ready(function () {
      $.getJSON('menu.json', function (data) {
        var aboutContent = data.About[0]; // Assuming the first object contains the about information
        var aboutHtml = `
          <h2>About Us</h2>
          <p>${aboutContent.text}</p>
        `;
        $('#about').html(aboutHtml);
      });
    });
  </script>

</body>

</html>
