<form action="<?= site_url("product/update"); ?>" method="post" enctype="multipart/form-data" id="edit_product_form" class="p-2">
    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
    <input type="hidden" name="id" value="<?= $product["id"]; ?>">
    <div class="mb-3">
        <label for="edit_name" class="form-label">Name</label>
        <input type="text" name="name" value="<?= $product["name"]; ?>" class="form-control" id="edit_name">
<?= isset($errors["name"]) ? $errors["name"] : "" ?>
    </div>
    <div class="mb-3">
        <label for="edit_description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="edit_description"><?= $product["description"]; ?></textarea>
<?= isset($errors["description"]) ? $errors["description"] : "" ?>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <label for="edit_category" class="form-label">Category</label>
            <select name="category" id="edit_category" class="form-select">
<?php
                foreach ($categories as $category) {
?>
                <option value="<?= $category["id"]; ?>" <?= $product["category_id"] == $category["id"] ? "selected" : ""; ?>><?= $category["name"]; ?></option>
<?php
                }
?>
            </select>
<?= isset($errors["category"]) ? $errors["category"] : "" ?>
        </div>
        <div class="col-md-3">
            <label for="edit_price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="<?= $product["price"]; ?>" min="1" id="edit_price">
<?= isset($errors["price"]) ? $errors["price"] : "" ?>
        </div>
        <div class="col-md-3">
            <label for="edit_inventory" class="form-label">Inventory</label>
            <input type="number" name="inventory" class="form-control" value="<?= $product["inventory"]; ?>" min="0" id="edit_inventory">
<?= isset($errors["inventory"]) ? $errors["inventory"] : "" ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-4">
            <label for="edit_images" class="form-label">Upload Images (5 Max)</label>
            <input type="file" accept="image/*" name="images[]" id="edit_images" class="form-control" multiple>
<?= $images; ?>
        </div>
<?= isset($errors["default_img"]) ? $errors["default_img"] : "" ?>
        <div class="col-lg-12">
            <p>Choose default image to be displayed</p>
            <div id="edit_uploaded_img_container" class="d-flex flex-wrap gap-3">
<?php
                if (isset($images_name->subs)) {
                    foreach ($images_name->subs as $image) {
?>
                <img src="<?= base_url("uploads/products/{$image}"); ?>" id="<?= $image; ?>" class="rounded <?= $image === $images_name->default ? "border border-3 border-info" : ""; ?> uploaded_imgs" alt="product">
<?php
                    }
                }
?>
            </div>
            <input type="hidden" name="default_img" value="<?= $images_name->default; ?>" id="edit_default_img">
        </div>
    </div>
</form>