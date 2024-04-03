<form action="<?= site_url("product/create"); ?>" method="post" enctype="multipart/form-data" id="create_product_form" class="p-2">
    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name">
<?= isset($errors["name"]) ? $errors["name"] : "" ?>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description"></textarea>
<?= isset($errors["description"]) ? $errors["description"] : "" ?>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select">
<?php
                foreach ($categories as $category) {
?>
                <option value="<?= $category["id"]; ?>"><?= $category["name"]; ?></option>
<?php
                }
?>
            </select>
<?= isset($errors["category"]) ? $errors["category"] : "" ?>
        </div>
        <div class="col-md-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="1" min="1" id="price">
<?= isset($errors["price"]) ? $errors["price"] : "" ?>
        </div>
        <div class="col-md-3">
            <label for="inventory" class="form-label">Inventory</label>
            <input type="number" name="inventory" class="form-control" value="1" min="1" id="inventory">
<?= isset($errors["inventory"]) ? $errors["inventory"] : "" ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-4">
            <label for="images" class="form-label">Upload Images (5 Max)</label>
            <input type="file" accept="image/*" name="images[]" id="images" class="form-control" multiple>
<?= $images; ?>
        </div>
<?= isset($errors["default_img"]) ? $errors["default_img"] : "" ?>
        <div class="col-lg-12 d-none">
            <p>Choose default image to be displayed</p>
            <div id="uploaded_img_container" class="d-flex flex-wrap gap-3"></div>
            <input type="hidden" name="default_img" id="default_img">
        </div>
    </div>
</form>