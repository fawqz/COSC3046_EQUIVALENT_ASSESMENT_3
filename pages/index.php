<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ECHO Apparel</title>
    <!-- Bootstrap Tag -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- External JavaScript -->
    <script src="scripts.js" defer></script>
</head>
<body>
    <!-- Header/Navbar Section -->
    <header >
        <nav class="navbar navbar-expand-lg " style="background-color: #eef5ff;" >
            <div class="container">
                <!-- Website title  -->
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
    
    <main class="container py-4" >
        <section class="products">
            <!-- Product section  -->
            <h2 class="text-center mb-4">Our Products</h2>
            <div class="row">
                <?php

                // Details to gain access to database
                $host = 'talsprddb02.int.its.rmit.edu.au';
                $username = 'COSC3046_2302_G12';
                $password = 'GeMn6IwViEOE';
                $database = 'COSC3046_2302_G12';

                $conn = new mysqli($host, $username, $password, $database);
                
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);
                // Loop to go through the database and display all the products with HTML strucutre 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-lg-4 col-md-6 mb-4">';
                        echo '<div class="card h-100">';
                        echo '<img src="' . $row['image_url'] . '" class="card-img-top" alt="Product Image">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['product_name'] . '</h5>';
                        echo '<p class="card-text">' . $row['description'] . '</p>';
                        echo '<p class="card-text-price">$' . $row['price'] . '</p>';
                // Size selection
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

<h1>Your Cart</h1>

<script>

// Closes cart when user clicks outside of it    
document.addEventListener("click", (event) => {
  if (!event.target.closest(".cart-container") && !event.target.closest(".cart-btn")) {
      cart.classList.remove("active");
  }
});

document.addEventListener('DOMContentLoaded', function() {
    var addToCartButtons = document.querySelectorAll('.addToCartBtn');
    var cartContainer = document.querySelector('.cart-container'); 

    // Event listener for 'Add to Cart' button 
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Retrives all the data from the respective button 
            var productId = this.getAttribute('data-productid');
            var productName = this.parentNode.querySelector('.card-title').innerText;
            var productDescription = this.parentNode.querySelector('.card-text').innerText;
            var productPrice = this.parentNode.querySelector('.card-text-price').innerText;


            //Adds to an array and keeps track of quantity 
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
    //Store the details of the products and their quantities to display in the cart 
    var products = {};

// Displays the added products in the cart 
function renderCart() {
    if (cartContainer) {
      var cartHTML= '<div class="cart-title">' +
                            '<h1>Your Cart</h1>' +
                        '</div>';
        //Loop to display the all the added products in cart
        for (var productId in products) {
            var product = products[productId];
            // HTML structure for all added products
            cartHTML += '<div>' +
                '<h4>' + product.name + '</h4>' +
                '<p>' + product.description + '</p>' +
                '<div class="quantity-input" >' +
                '<label for="quantity">Quantity:</label>' +
                '<input type="number" min="1" value="' + product.quantity + '" data-productid="' + productId + '"id="quantity" onkeydown="return false" style= "border: none; margin-bottom:10px">' +
                '<p>' + product.price + '</p>' +
                '<button class="removeFromCartBtn" data-productid="' + productId + '" style="background-color: #ff6347; color: #fff; border: none; padding: 8px 12px; cursor: pointer; border-radius: 4px; margin-bottom:10px;">Remove product</button>'
                '</div>' +
                '</div>';
        }
        //Displays the products in the 'cart-container' div
        cartContainer.innerHTML= cartHTML;
        //Checkout button
        var checkoutLink = document.createElement('a');
        checkoutLink.href = 'checkout.php'; 
        //Styling for button
        var checkoutButton = document.createElement('button');
        checkoutButton.id = 'proceedToCheckoutBtn';
        checkoutButton.textContent = 'Proceed to Checkout';
        checkoutButton.style.backgroundColor = '#428bca';
        checkoutButton.style.color = '#fff';
        checkoutButton.style.border = 'none';
        checkoutButton.style.padding = '8px 12px';
        checkoutButton.style.cursor = 'pointer';
        checkoutButton.style.borderRadius = '4px';

        checkoutLink.appendChild(checkoutButton);
        cartContainer.appendChild(checkoutLink);


    }
}

    //Remove product from cart
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeFromCartBtn')) {
            var productId = event.target.getAttribute('data-productid');
            //Removing the product from product object
            if (products[productId]) {
                delete products[productId];
                renderCart();
            }
        }
    });
});





</script>


</div>


    <!-- Footer -->
    <footer class="text-center py-3" style="background-color: #eef5ff;" >
        <p>ECHO Appearl Store</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

 

</body>
</html>