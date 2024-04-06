<form action="#" method="post" id="shipping_form">
    <div class="d-flex flex-wrap gap-4 justify-content-between align-items-center mb-3">
        <p class="fs-4 mb-0 text-secondary">Shipping Information</p>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="same_billing" <?= isset($values["same_billing"]) ? "checked" : ""; ?> id="same_billing">
            <label class="form-check-label" for="same_billing">Same in Billing</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" name="shipping_first_name" value="<?= isset($values["shipping_first_name"]) ? $values["shipping_first_name"] : ""; ?>" class="form-control" id="fname">
<?= isset($errors["shipping_first_name"]) ? $errors["shipping_first_name"] : ""; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" name="shipping_last_name" value="<?= isset($values["shipping_last_name"]) ? $values["shipping_last_name"] : ""; ?>" class="form-control" id="lname">
<?= isset($errors["shipping_last_name"]) ? $errors["shipping_last_name"] : ""; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="address1" class="form-label">Address 1</label>
        <input type="text" name="shipping_address_1" value="<?= isset($values["shipping_address_1"]) ? $values["shipping_address_1"] : ""; ?>" class="form-control" id="address1">
<?= isset($errors["shipping_address_1"]) ? $errors["shipping_address_1"] : ""; ?>
    </div>
    <div class="mb-3">
        <label for="address2" class="form-label">Address 2</label>
        <input type="text" name="shipping_address_2" value="<?= isset($values["shipping_address_2"]) ? $values["shipping_address_2"] : ""; ?>" class="form-control" id="address2">
<?= isset($errors["shipping_address_2"]) ? $errors["shipping_address_2"] : ""; ?>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <input type="text" name="shipping_city" value="<?= isset($values["shipping_city"]) ? $values["shipping_city"] : ""; ?>" class="form-control" placeholder="City">
<?= isset($errors["shipping_city"]) ? $errors["shipping_city"] : ""; ?>
        </div>
        <div class="col-md-4 mb-3">
            <input type="text" name="shipping_state" value="<?= isset($values["shipping_state"]) ? $values["shipping_state"] : ""; ?>" class="form-control" placeholder="State">
<?= isset($errors["shipping_state"]) ? $errors["shipping_state"] : ""; ?>
        </div>
        <div class="col-md-4 mb-3">
            <input type="text" name="shipping_zip_code" value="<?= isset($values["shipping_zip_code"]) ? $values["shipping_zip_code"] : ""; ?>" class="form-control" placeholder="Zip Code">
<?= isset($errors["shipping_zip_code"]) ? $errors["shipping_zip_code"] : ""; ?>
        </div>
    </div>
</form>
<form action="#" method="post" id="billing_form" class="d-none">
    <p class="fs-4 mb-3 text-secondary">Billing Information</p>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="billing_fname" class="form-label">First Name</label>
            <input type="text" name="billing_first_name" value="<?= isset($values["billing_first_name"]) ? $values["billing_first_name"] : ""; ?>" class="form-control" id="billing_fname">
<?= isset($errors["billing_first_name"]) ? $errors["billing_first_name"] : ""; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="billing_lname" class="form-label">Last Name</label>
            <input type="text" name="billing_last_name" value="<?= isset($values["billing_last_name"]) ? $values["billing_last_name"] : ""; ?>" class="form-control" id="billing_lname">
<?= isset($errors["billing_last_name"]) ? $errors["billing_last_name"] : ""; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="billing_address1" class="form-label">Address 1</label>
        <input type="text" name="billing_address_1" value="<?= isset($values["billing_address_1"]) ? $values["billing_address_1"] : ""; ?>" class="form-control" id="billing_address1">
<?= isset($errors["billing_address_1"]) ? $errors["billing_address_1"] : ""; ?>
    </div>
    <div class="mb-3">
        <label for="billing_address2" class="form-label">Address 2</label>
        <input type="text" name="billing_address_2" value="<?= isset($values["billing_address_2"]) ? $values["billing_address_2"] : ""; ?>" class="form-control" id="billing_address2">
<?= isset($errors["billing_address_2"]) ? $errors["billing_address_2"] : ""; ?>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <input type="text" name="billing_city" value="<?= isset($values["billing_city"]) ? $values["billing_city"] : ""; ?>" class="form-control" placeholder="City">
<?= isset($errors["billing_city"]) ? $errors["billing_city"] : ""; ?>
        </div>
        <div class="col-md-4 mb-3">
            <input type="text" name="billing_state" value="<?= isset($values["billing_state"]) ? $values["billing_state"] : ""; ?>" class="form-control" placeholder="State">
<?= isset($errors["billing_state"]) ? $errors["billing_state"] : ""; ?>
        </div>
        <div class="col-md-4 mb-3">
            <input type="text" name="billing_zip_code" value="<?= isset($values["billing_zip_code"]) ? $values["billing_zip_code"] : ""; ?>" class="form-control" placeholder="Zip Code">
<?= isset($errors["billing_zip_code"]) ? $errors["billing_zip_code"] : ""; ?>
        </div>
    </div>
</form>
<p class="fs-4 mb-3 text-secondary">Order Summary</p>
<p class="mb-3">Items <span id="total_amount" class="float-end">&#36; <?= $total_amount; ?></span></p>
<p class="mb-3 border-bottom pb-5">Shippin Fee <span id="shipping_fee" class="float-end">&#36; <?= $shipping_fee; ?></span></p>
<p class="mb-3">Total Amount <span id="to_pay" class="float-end">&#36; <?= $total_amount + $shipping_fee; ?></span></p>
<button type="button" id="checkout_btn" class="btn btn-bluegreen w-100">Proceed to Checkout</button>