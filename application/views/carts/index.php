    <main class="ps-5 pe-4 ms-5 mb-5">
        <div class="row">
            <div id="item_list_container" class="col-lg-7"></div>
            <div id="order_info_container" class="col-lg-5 bg-white border rounded shadow-sm p-4">
                <form action="<?= site_url("cart/checkout"); ?>" method="post" id="shipping_form">
                    <div class="d-flex flex-wrap gap-4 justify-content-between align-items-center mb-3">
                        <p class="fs-4 mb-0 text-secondary">Shipping Information</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="same_billing" checked id="same_billing">
                            <label class="form-check-label" for="same_billing">Same in Billing</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" name="shipping_first_name" class="form-control" id="fname">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" name="shipping_last_name" class="form-control" id="lname">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address1" class="form-label">Address 1</label>
                        <input type="text" name="shipping_address_1" class="form-control" id="address1">
                    </div>
                    <div class="mb-3">
                        <label for="address2" class="form-label">Address 2</label>
                        <input type="text" name="shipping_address_2" class="form-control" id="address2">
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <input type="text" name="shipping_city" class="form-control" placeholder="City">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" name="shipping_state" class="form-control" placeholder="State">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" name="shipping_zip_code" class="form-control" placeholder="Zip Code">
                        </div>
                    </div>
                </form>
                <form action="#" method="post" id="billing_form" class="d-none">
                    <p class="fs-4 mb-3 text-secondary">Billing Information</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="billing_fname" class="form-label">First Name</label>
                            <input type="text" name="billing_first_name" class="form-control" id="billing_fname">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="billing_lname" class="form-label">Last Name</label>
                            <input type="text" name="billing_last_name" class="form-control" id="billing_lname">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="billing_address1" class="form-label">Address 1</label>
                        <input type="text" name="billing_address_1" class="form-control" id="billing_address1">
                    </div>
                    <div class="mb-3">
                        <label for="billing_address2" class="form-label">Address 2</label>
                        <input type="text" name="billing_address_2" class="form-control" id="billing_address2">
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <input type="text" name="billing_city" class="form-control" placeholder="City">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" name="billing_state" class="form-control" placeholder="State">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" name="billing_zip_code" class="form-control" placeholder="Zip Code">
                        </div>
                    </div>
                </form>
                <p class="fs-4 mb-3 text-secondary">Order Summary</p>
                <p class="mb-3">Items <span id="total_amount" class="float-end">&#36; <?= $total_amount; ?></span></p>
                <p class="mb-3 border-bottom pb-5">Shippin Fee <span id="shipping_fee" class="float-end">&#36; <?= $shipping_fee; ?></span></p>
                <p class="mb-3">Total Amount <span id="to_pay" class="float-end">&#36; <?= $total_amount + $shipping_fee; ?></span></p>
                <button type="button" id="checkout_btn" class="btn btn-bluegreen w-100">Proceed to Checkout</button>
            </div>
        </div>
    </main>
    <!-- Checkout Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Card Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="card_name" placeholder="card name">
                            <label for="card_name" class="text-secondary">Card Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="card_number" placeholder="Password">
                            <label for="card_number" class="text-secondary">Card Number</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="exp_date" placeholder="Password">
                                    <label for="exp_date" class="text-secondary">Exp Date</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cvc" placeholder="Password">
                                    <label for="cvc" class="text-secondary">CVC</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer py-4">
                    <p class="text-end">Total Amount <span>&#36; 55</span></p>
                    <input type="button" value="Pay" class="btn btn-bluegreen w-100 py-3">
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="remove_item_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="remove_item_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="remove_item_label">Remove Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url("cart/remove"); ?>" method="post" id="remove_form">
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
                        <input type="hidden" name="item_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="remove_item_btn" class="btn btn-bluegreen">Remove</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url("assets/js/customer/update-item.js"); ?>"></script>
    <script src="<?= base_url("assets/js/customer/cart-search.js"); ?>"></script>
    <script src="<?= base_url("assets/js/customer/checkout.js"); ?>"></script>
    <script src="<?= base_url("assets/js/toast.js"); ?>"></script>
    <?= $toast; ?>