<li id="category_all" class="mb-2 border rounded-3 bg-light-subtle border-light shadow-sm position-relative category_list">
    <form action="#" method="get" class="p-3 form_categories">
        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
        <input type="hidden" name="category" value="All">
        <i class="bi bi-list-ul"></i>
        <span class="ms-4">All Products</span>
        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count"><?= $product_count; ?></span>
    </form>
</li>
<?php
foreach ($categories as $category) {
?>
<li id="category<?= $category["id"]; ?>" class="mb-2 border rounded-3 bg-light-subtle shadow-sm position-relative category_list">
    <form action="#" method="get" class="p-3 form_categories">
        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
        <input type="hidden" name="category" value="<?= $category["id"]; ?>">
        <i class="bi bi-gift-fill"></i>
        <span class="ms-4"><?= $category["name"]; ?></span>
        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count"><?= $category["product_count"]; ?></span>
    </form>
</li>
<?php
}
?>