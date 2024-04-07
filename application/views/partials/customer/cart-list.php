<?php
foreach ($items as $key => $item) {
?>
<article class="d-flex flex-wrap justify-content-between align-items-center mb-3 border py-2 px-3 bg-white shadow-sm rounded items_in_cart">
    <div class="d-flex align-items-center cart_item_img">
        <img src="<?= base_url("/uploads/products/{$item["img"]}"); ?>" class="h-100 object-fit-cover rounded" alt="item">
        <div class="ps-3 product_details">
            <p class="mb-0"><?= $item["name"]; ?></p>
            <p>&#36; <span id="price<?= $key; ?>"><?= $item["price"]; ?></span></p>
        </div>
    </div>
    <div class="d-flex gap-3 align-items-end">
        <form action="<?= site_url("cart/update"); ?>" method="post" class="z-0 cart_item_update_form">
            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
            <input type="hidden" name="item_id" value="<?= $item["id"]; ?>">
            <input type="hidden" name="product_id" value="<?= $item["product_id"]; ?>">
            <label class="form-label">Quantity</label>
            <div class="input-group">
                <button class="btn btn-outline-secondary decrement" data-key="<?= $key; ?>" type="button"><i class="bi bi-dash-lg"></i></button>
                <input type="number" name="quantity" readonly min="1" max="<?= $item["stocks"]; ?>" value="<?= $item["quantity"]; ?>" class="form-control text-center" data-key="<?= $key; ?>">
                <button class="btn btn-outline-secondary increment" data-key="<?= $key; ?>" type="button"><i class="bi bi-plus-lg"></i></button>
            </div>
        </form>
        <div class="amount_container">
            <label class="form-label">Total Amount</label>
            <p class="m-0 p-2 border">&#36; <span id="total_amount<?= $key; ?>"><?= $item["amount"]; ?></span></p>
        </div>
        <i class="bi bi-cart-x fs-3 remove_to_cart" data-name="<?= $item["name"]; ?>" data-bs-toggle="modal" data-bs-target="#remove_item_modal"></i>
    </div>
</article>
<?php
}
?>