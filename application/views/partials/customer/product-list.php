<p><?= $category_label; ?></p>
<div class="overflow-y-auto border-top mb-4 products_container">
<?php
    if (!empty($products)) {
        foreach ($products as $product) {
?>
    <article class="border rounded bg-white shadow-sm d-inline-block mx-1 my-1 product_cards">
        <a href="<?= site_url("products/view/{$product["id"]}"); ?>">
            <div class="border-bottom img_container">
                <img src="<?= base_url("uploads/products/{$product["display_img"]}"); ?>" class="h-100 w-100 object-fit-cover rounded-top" alt="product">
            </div>
            <div class="row px-2 py-2">
                <div class="col-7">
                    <p class="text-truncate mb-0"><?= $product["name"]; ?></p>
                </div>
                <div class="col-5">
                    <p class="text-end text-truncate mb-0">&#36;<?= $product["formatted_price"]; ?></p>
                </div>
            </div>
            <p class="mb-0 px-2 mb-2 ratings">
                <i class="bi bi-list-columns-reverse text-warning"></i>
                <span>36 Reviews(s)</span>
            </p>
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