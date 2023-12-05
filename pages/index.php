<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ECHO Apparel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Echo Apparel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart-btn" href="#">Cart</a>
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
                
                        $product_id = $row['product_id'];
                        $sql_sizes = "SELECT size FROM product_sizes WHERE product_id = $product_id";
                        $result_sizes = $conn->query($sql_sizes);
                
                        echo '<select class="form-select mb-3" id="sizeSelect">';
                        if ($result_sizes->num_rows > 0) {
                            while ($size_row = $result_sizes->fetch_assoc()) {
                                echo '<option value="' . $size_row['size'] . '">' . $size_row['size'] . '</option>';
                            }
                        } else {
                            echo '<option value="">No sizes available</option>';
                        }
                        echo '</select>';
                
                        echo '<p class="card-text">Color: ' . $row['color'] . '</p>';
                        echo '<button class="btn btn-primary addToCartBtn">Add to Cart</button>';
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

<div class="cart-container">

<h1>Cart</h1>

</div>


    
    <footer class="bg-light text-center py-3">
        <p>&copy; Store</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>

let cartBtn = document.querySelector(".cart-btn");
let cart= document.querySelector(".cart-container");

cartBtn.onclick = () => {
cart.classList.add("active");
}

  </script>

</body>
</html>
