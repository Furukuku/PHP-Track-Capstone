    <main class="ps-5 pe-4 ms-5">
        <div class="row">
            <div class="col-lg-7">
<?php
                for ($i = 0; $i < 10; $i++) {
?>
                <article class="d-flex flex-wrap justify-content-between align-items-center mb-3 border py-2 px-3 bg-white shadow-sm rounded items_in_cart">
                    <div class="d-flex align-items-center cart_item_img">
                        <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="h-100 object-fit-cover rounded" alt="item">
                        <div class="ps-3">
                            <p class="mb-0">Carrots</p>
                            <p>&#36; 25</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-items-end">
                        <div class="z-0">
                            <label for="quantity" class="form-label">Quantity</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" id="decrement"><i class="bi bi-dash-lg"></i></button>
                                <input type="number" min="1" max="50" value="1" class="form-control text-center">
                                <button class="btn btn-outline-secondary" type="button" id="increment"><i class="bi bi-plus-lg"></i></button>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Total Amount</label>
                            <p class="m-0 p-2 border">&#36; 50</p>
                        </div>
                        <i class="bi bi-cart-x fs-3 remove_to_cart"></i>
                    </div>
                </article>
<?php
                }
?>
            </div>
            <form action="" method="post" class="col-lg-5">
                <div class="bg-white border rounded shadow-sm p-4">
                    <div class="d-flex flex-wrap gap-4 justify-content-between align-items-center mb-3">
                        <p class="fs-4 mb-0 text-secondary">Shipping Information</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked id="sam_billing">
                            <label class="form-check-label" for="sam_billing">Same in Billing</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address1" class="form-label">Address 1</label>
                        <input type="text" class="form-control" id="address1">
                    </div>
                    <div class="mb-3">
                        <label for="address2" class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="address2">
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="City">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="State">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="Zip Code">
                        </div>
                    </div>
                    <p class="fs-4 mb-3 text-secondary">Billing Information</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="billing_fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="billing_fname">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="billing_lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="billing_lname">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="billing_address1" class="form-label">Address 1</label>
                        <input type="text" class="form-control" id="billing_address1">
                    </div>
                    <div class="mb-3">
                        <label for="billing_address2" class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="billing_address2">
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="City">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="State">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" placeholder="Zip Code">
                        </div>
                    </div>
                    <p class="fs-4 mb-3 text-secondary">Order Summary</p>
                    <p class="mb-3">Items <span class="float-end">&#36; 50</span></p>
                    <p class="mb-3 border-bottom pb-5">Shippin Fee <span class="float-end">&#36; 5</span></p>
                    <p class="mb-3">Total Amount <span class="float-end">&#36; 55</span></p>
                    <input type="button" value="Proceed to Checkout" class="btn btn-bluegreen w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                </div>
            </form>
        </div>
    </main>

<!-- Modal -->
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