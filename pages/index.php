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
                        echo '<p class="card-text-price">$' . $row['price'] . '</p>';
                
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
                        echo '<button class="btn btn-primary addToCartBtn" data-productid="' . $row['product_id'] . '">Add to Cart</button>';
                        echo '</div></div></div>';
                    }
                } else {
                    echo "0 results";
                }
                



                

                ?>

            </div>
        </section>
    </main>

<div class="cart-container">

<h1>Cart</h1>

<script>
document.addEventListener("click", (event) => {
    if (!event.target.closest(".cart-container") && !event.target.closest(".cart-btn")) {
        cart.classList.remove("active");
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var addToCartButtons = document.querySelectorAll('.addToCartBtn');
    var cartContainer = document.querySelector('.cart-container'); 

    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            var productId = this.getAttribute('data-productid');
            var productName = this.parentNode.querySelector('.card-title').innerText;
            var productDescription = this.parentNode.querySelector('.card-text').innerText;
            var productPrice = this.parentNode.querySelector('.card-text-price').innerText;

            if (!products[productId]) {
                products[productId] = {
                    name: productName,
                    description: productDescription,
                    price: productPrice,
                    quantity: 1
                };
            } else {
                products[productId].quantity++;
            }

            renderCart();
        });
    });
function renderCart() {
    if (cartContainer) {
        cartContainer.innerHTML = '';

        for (var productId in products) {
            var product = products[productId];

            cartContainer.innerHTML += '<div>' +
                '<h4>' + product.name + '</h4>' +
                '<p>' + product.description + '</p>' +
                '<div class="quantity-input" >' +
                '<label for="quantity">Quantity:</label>' +
                '<input type="number" min="1" value="' + product.quantity + '" data-productid="' + productId + '"id="quantity" onkeydown="return false" style= "border: none;">' +
                '<p>' + product.price + '</p>' +
                '<button class="removeFromCartBtn" data-productid="' + productId + '" style="background-color: #ff6347; color: #fff; border: none; padding: 8px 12px; cursor: pointer; border-radius: 4px;">Remove product</button>'
                '</div>' +
                '</div>';
        }
    }
}

var products = {};



    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeFromCartBtn')) {
            var productId = event.target.getAttribute('data-productid');

            if (products[productId]) {
                delete products[productId];
                renderCart();
            }
        }
    });
});





</script>
</div>


    
    <footer class="bg-light text-center py-3">
        <p>&copy; Store</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

 

</body>
</html>