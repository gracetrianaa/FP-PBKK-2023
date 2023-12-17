<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?=base_url("css/transactionform_style.css")?>" />
  <script src="<?=base_url("js/transactionform.js")?>" defer></script>
  <title>Order Form</title>
  <style>
    .input-group label[for="paidPrice"] {
      color: green;
      font-weight: bold;
    }
  </style>  
</head>
<body>
<?php
  // Retrieve the transaction total price based on the customer ID
  $customerId = $customerId ?? null; // Get the customer ID from the route or set it to null if not available

  $transactionModel = new \App\Models\Transaction();
  $transaction = $transactionModel->where('customer_cst_id', $customerId)->orderBy('created_at', 'DESC')->first();
  $totalPrice = 0;
  if (isset($transaction['tsc_totalprice'])) {
    $totalPrice = $transaction['tsc_totalprice'];
  }

  $discount = 0;
  if ($totalPrice >= 150000) {
      $discount = $totalPrice * 0.1;
  }

  $totalPriceWithDiscount = $totalPrice - $discount;
?>
  <form action="<?= site_url('customer/payment/information/total/' . $customerId) ?>" class="form">
    <h1 class="text-center">Payment Form</h1>
    <!-- Progress bar -->
    <div class="progressbar">
        <div class="progress" id="progress"></div>
        <div
        class="progress-step progress-step-active"
        data-title="Service"
      ></div>
      <div class="progress-step progress-step-active" data-title="Delivery"></div>
      <div class="progress-step progress-step-active" data-title="Total"></div>
      <div class="progress-step" data-title="Payment"></div>
    </div>

    <!-- Steps -->
    <div class="form-step form-step-active">
      <div class="input-group">
        <label for="confirmPassword">Payment Information</label>
        <span class="warning-text">Information below is the total you have to pay!</span>
      </div>
      <div class="input-group">
        <label for="totalPrice">Total Price</label>
        <input type="text" name="totalPrice" id="totalPrice" value="<?= $transaction['tsc_totalprice'] ?>" readonly />
      </div>
      <div class="input-group">
        <label for="discount">Discount</label>
        <input type="text" name="discount" id="discount" value="<?= $discount ?>" readonly />
      </div>
      <div class="input-group">
        <label for="paidPrice">Paid Price</label>
        <input type="text" name="paidPrice" id="paidPrice" value="<?= $totalPriceWithDiscount ?>" readonly />
      </div>      
      <div class="btns-group">
        <a href="<?= route_to('transaction.processorderform', $customerId) ?>" class="btn btn-prev">Previous</a>
        <a href="<?= route_to('payment.forminfo', $customerId) ?>" class="btn btn-next">Next</a>
      </div>
    </div>
  </form>
</body>
</html>
