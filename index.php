<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testing Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Apparel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cart</a>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <main class="container py-4">
        <section class="products">
            <h2 class="text-center mb-4">Our Products</h2>
            <div class="row">
                <?php
                $host = 'talsprddb02.int.its.rmit.edu.au';
                $username = 'COSC3046_2302_G12';
                $password = 'GeMn6IwViEOE';
                $database = 'COSC3046_2302_G12';

                $conn = new mysqli($host, $username, $password, $database);
                
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-lg-4 col-md-6 mb-4">';
                        echo '<div class="card h-100">';
                        echo '<img src="' . $row['image_url'] . '" class="card-img-top" alt="Product Image">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['product_name'] . '</h5>';
                        echo '<p class="card-text">' . $row['description'] . '</p>';
                        echo '<p class="card-text">$' . $row['price'] . '</p>';
                        echo '<p class="card-text">Size: ' . $row['size'] . '</p>';
                        echo '<p class="card-text">Color: ' . $row['color'] . '</p>';
                        echo '</div></div></div>';
                    }
                } else {
                    echo "0 results";
                }
                



                $conn->close();

                ?>

            </div>
        </section>
    </main>
    
    <footer class="bg-light text-center py-3">
        <p>&copy; Store</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
