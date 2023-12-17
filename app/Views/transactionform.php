<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?=base_url("css/transactionform_style.css")?>" />
    <script src="<?=base_url("js/transactionform.js")?>" defer></script>
    <title>Order Form</title>
  </head>
  <body>
    <form action="{{ route('transaction.processorderform', ['customerId' => $customerId]) }}" method="POST" class="form">
      @csrf
      <h1 class="text-center">Order Form</h1>
      <!-- Progress bar -->
      <div class="progressbar">
        <div class="progress" id="progress"></div>
        
        <div
          class="progress-step progress-step-active"
          data-title="Service"
        ></div>
        <div class="progress-step" data-title="Delivery"></div>
        <div class="progress-step" data-title="Total"></div>
        <div class="progress-step" data-title="Payment"></div>
      </div>

      <!-- Steps -->
      <div class="form-step form-step-active">
        <!-- First form step -->
        <div class="formwrapper">
            <div id="FormItems">
              <tr>
                <td>
                    <select name="addmore[0][service]" class="service form-control">
                        <option value="cuci kering">Cuci kering</option>
                        <option value="cuci basah">Cuci basah</option>
                        <option value="cuci setrika">Cuci setrika</option>
                    </select>
                </td>
                <td><input type="text" name="addmore[0][qty]" placeholder="Enter your Qty" class="form-control" /></td>
            </tr>
            </div>
            <input type="button" value="Add More" class="Addmore">
            <a href="#" class="btn btn-next">Next</a>
        </div>
      </div>
      <div class="form-step">
        <div class="input-group">
          <label for="delivery">Do you need delivery?</label>
          <div class="radio-group">
            <input type="radio" name="delivery" id="delivery-yes" value="yes" required />
            <label for="delivery-yes">Yes</label>
            <input type="radio" name="delivery" id="delivery-no" value="no" required />
            <label for="delivery-no">No</label>
          </div>
        </div>        
        <div class="input-group">
          <label for="address">Address Optional</label>
          <input type="text" name="address" id="address" />
        </div>
        <div class="btns-group">
            <a href="#" class="btn btn-prev">Previous</a>
            <input type="submit" value="Submit" class="btn" />
        </div>
      </div>
    </form>
  </body>
</html>