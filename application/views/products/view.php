    <main class="ps-5 pe-4 ms-5">
        <a href="<?= site_url("products"); ?>" class="text-info"><i class="bi bi-arrow-left-short"></i>Go Back</a>
        <div class="row my-4 bg-white rounded border shadow-sm px-3 py-5">
            <div class="col-md-4 px-5 product_imgs">
                <div class="row mb-3 border rounded">
                    <img id="default_img" src="<?= base_url("uploads/products/{$images->default}"); ?>" class="h-100 object-fit-contain rounded" alt="product">
                </div>
                <ul class="row justify-content-start p-0 mb-0">
<?php
                    if (isset($images->subs)) {
                        foreach ($images->subs as $image) {
?>
                    <li class="d-inline-block"><img src="<?= base_url("uploads/products/{$image}"); ?>" class="w-100 rounded object-fit-contain <?= $image === $images->default ? "border border-2 border-info" : ""; ?> sub_image" alt="product"></li>
<?php
                        }
                    }
?>
                </ul>
            </div>
            <div class="col-md-8 px-5">
                <p class="fs-2 mb-1"><?= $product["name"]; ?></p>
                <p class="mb-1 ratings">
                    <i class="bi bi-list-columns-reverse text-warning"></i>
                    <span>36 Review(s)</span>
                </p>
                <p class="fs-4">&#36; <span id="price"><?= $product["price"]; ?></span></p>
                <p><?= $product["description"]; ?></p>
                <p class="mb-1 fst-italic"><?= $product["inventory"]; ?> Stocks</p>
<?php
                if ($product["inventory"] > 0) {
?>
                <form action="<?= site_url("cart/add"); ?>" method="post" id="add_to_cart" class="row align-items-end">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
                    <div class="col-md-3">
                        <input type="hidden" name="product_id" value="<?= $product["id"] ?>">
                        <label for="quantity" class="form-label">Quantity</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary z-1" type="button" id="decrement"><i class="bi bi-dash-lg"></i></button>
                            <input type="number" name="quantity" min="1" max="<?= $product["inventory"]; ?>" value="1" class="form-control text-center">
                            <button class="btn btn-outline-secondary z-1" type="button" id="increment"><i class="bi bi-plus-lg"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Total Amount</label>
                        <p class="m-0 p-2 border">&#36; <span id="total_amount"><?= $product["price"]; ?></span></p>
                    </div>
                    <div class="col-md-3 align-items-end">
                        <input type="submit" value="Add to Cart" class="btn btn-bluegreen">
                    </div>
                </form>
<?php
                } else {
?>
                <p>Not Available</p>
<?php
                }
?>
            </div>
        </div>
        <div class="row mb-4 bg-white rounded border shadow-sm px-3 py-5">
            <p class="fs-4">Similar Items</p>
            <div id="similar_products_container" class="px-2">
<?php
                foreach ($similar_products as $similar_product) {
?>
                <article class="border rounded bg-white shadow-sm d-inline-block mx-1 my-1 product_cards">
                    <a href="<?= site_url("products/view/{$similar_product["id"]}"); ?>">
                        <div class="border-bottom img_container">
                            <img src="<?= base_url("uploads/products/{$similar_product["display_img"]}") ?>" class="h-100 w-100 object-fit-cover rounded-top" alt="product">
                        </div>
                        <div class="row px-2 py-2">
                            <div class="col-7">
                                <p class="text-truncate mb-0"><?= $similar_product["name"]; ?></p>
                            </div>
                            <div class="col-5">
                                <p class="text-end text-truncate mb-0">&#36; <?= $similar_product["price"]; ?></p>
                            </div>
                        </div>
                        <p class="mb-0 px-2 mb-2 ratings">
                            <i class="bi bi-list-columns-reverse text-warning"></i>
                            <span>36 Review(s)</span>
                        </p>
                    </a>
                </article>
<?php
                }
?>
            </div>
        </div>
    </main>
    <script src="<?= base_url("assets/js/customer/product-images.js"); ?>"></script>
    <script src="<?= base_url("assets/js/customer/add-to-cart.js"); ?>"></script>
    <script src="<?= base_url("assets/js/customer/search-similar-products.js"); ?>"></script>
    <script src="<?= base_url("assets/js/toast.js"); ?>"></script>