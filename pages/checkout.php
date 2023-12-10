<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2>Checkout</h2>
  <form id="checkoutForm" method="post" action="process_form.php">
    <div class="form-group">
      <label for="cardNumber">Card Number</label>
      <input type="number" class="form-control" id="cardNumber" name="cardNumber" placeholder="XXXX-XXXX-XXXX-XXXX" maxlength="16"required>
    </div>
    
    <div class="form-group">
      <label for="expiryDate">Expiry Date (MM/YY)</label>
      <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" maxlength="5" required>
    </div>

    <div class="form-group">
      <label for="cvv">CVV</label>
      <input type="number" class="form-control" id="cvv" name="cvv" placeholder="XXX" maxlength="3" required>
    </div>

    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" class="form-control" id="address" name="address" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>