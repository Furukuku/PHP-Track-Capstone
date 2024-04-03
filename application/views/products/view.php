    <main class="ps-5 pe-4 ms-5">
        <a href="<?= site_url("products"); ?>" class="text-info"><i class="bi bi-arrow-left-short"></i>Go Back</a>
        <div class="row my-4 bg-white rounded border shadow-sm px-3 py-5">
            <div class="col-md-4 px-5 product_imgs">
                <div class="row mb-3 border rounded">
                    <img id="default_img" src="<?= base_url("uploads/products/{$images->default}"); ?>" class="h-100 object-fit-contain rounded" alt="product">
                </div>
                <ul class="row justify-content-start p-0 mb-0">
                    <li class="d-inline-block"><img src="<?= base_url("uploads/products/{$images->default}"); ?>" class="w-100 rounded border border-2 border-info object-fit-contain sub_image" alt="product"></li>
<?php
                    if (isset($images->subs)) {
                        foreach ($images->subs as $image) {
?>
                    <li class="d-inline-block"><img src="<?= base_url("uploads/products/{$image}"); ?>" class="w-100 rounded object-fit-contain sub_image" alt="product"></li>
<?php
                        }
                    }
?>
                </ul>
            </div>
            <div class="col-md-8 px-5">
                <p class="fs-2 mb-1"><?= $product["name"]; ?></p>
                <p class="mb-1 ratings">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <span>36 Rating(s)</span>
                </p>
                <p class="fs-4">&#36; <?= $product["price"]; ?></p>
                <p><?= $product["description"]; ?></p>
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="decrement"><i class="bi bi-dash-lg"></i></button>
                            <input type="number" min="1" max="50" value="1" class="form-control text-center">
                            <button class="btn btn-outline-secondary" type="button" id="increment"><i class="bi bi-plus-lg"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Total Amount</label>
                        <p class="m-0 p-2 border">&#36; 50</p>
                    </div>
                    <div class="col-md-3 align-items-end">
                        <button type="button" class="btn btn-bluegreen">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 bg-white rounded border shadow-sm px-3 py-5">
            <p class="fs-4">Similar Items</p>
            <div>
<?php
                for ($i = 0; $i < 10; $i++) {
?>
                <article class="border rounded bg-white shadow-sm d-inline-block mx-1 my-1 product_cards">
                    <a href="<?= site_url("products/1"); ?>">
                        <div class="border-bottom img_container">
                            <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="h-100 w-100 object-fit-cover rounded-top" alt="product">
                        </div>
                        <div class="row px-3 py-2 align-items-center">
                            <div class="col-9">
                                <p class="text-truncate">Carrots</p>
                                <p class="mb-0 ratings">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span>36 Rating(s)</span>
                                </p>
                            </div>
                            <div class="col-3">
                                <p>&#36; 25</p>
                            </div>
                        </div>
                    </a>
                </article>
<?php
                }
?>
            </div>
        </div>
    </main>
    <script src="<?= base_url("assets/js/product-images.js"); ?>"></script>