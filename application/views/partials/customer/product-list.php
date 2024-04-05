<p><?= $category_label; ?></p>
<div class="overflow-y-auto border-top mb-4 products_container">
<?php
    if (!empty($products)) {
        foreach ($products as $product) {
?>
    <article class="border rounded bg-white shadow-sm d-inline-block mx-1 my-1 product_cards">
        <a href="<?= site_url("products/view/{$product["id"]}"); ?>">
            <div class="border-bottom img_container">
                <img src="<?= base_url("uploads/products/" . trim($product["display_img"], '"')); ?>" class="h-100 w-100 object-fit-cover rounded-top" alt="product">
            </div>
            <div class="row px-3 py-2 align-items-center">
                <div class="col-9">
                    <p class="text-truncate"><?= $product["name"]; ?></p>
                    <p class="mb-0 ratings">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <span>36 Rating(s)</span>
                    </p>
                </div>
                <div class="col-3">
                    <p>&#36; <?= $product["formatted_price"]; ?></p>
                </div>
            </div>
        </a>
    </article>
<?php
        }
    } else {
?>
    <h3 class="text-center mt-5">No available products</h3>
<?php
    }
?>
</div>