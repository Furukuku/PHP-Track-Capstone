    <header class="position-fixed top-0 end-0 p-3 d-flex bg-dark-subtle justify-content-between shadow-sm z-1">
        <h2 class="text-white">KMShop</h2>
        <div class="d-flex align-items-center gap-3">
            <a href="<?= site_url("products"); ?>" class="btn btn-outline-info">Switch to Shop View</a>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= $user["first_name"]; ?></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= site_url("user/logout"); ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </header>
    <nav class="position-fixed start-0 top-0 bottom-0 px-4 py-2 z-1 bg-dark-subtle sidebar">
        <a href="<?= site_url("products"); ?>" class="link-underline link-underline-opacity-0"><i class="bi bi-shop-window fs-1 text-white me-3"></i><span class="fs-3 text-light">KM</span></a>
        <ul class="navbar-nav mt-4">
            <li class="nav-item fs-5">
                <a href="<?= site_url("my-products"); ?>" class="nav-link"><i class="bi bi-house-door-fill me-2"></i>Products</a>
            </li>
            <li class="nav-item fs-5">
                <a href="<?= site_url("orders"); ?>" class="nav-link"><i class="bi bi-bag-check-fill me-2"></i>Orders</a>
            </li>
        </ul>
    </nav>
    <div class="px-4 pt-5 mt-5 search_container">
        <div class="row">
            <form action="#" method="get" id="admin_form_search" class="col-md-4 mb-3">
                <input type="search" name="keyword" id="admin_search" class="form-control" placeholder="Search products">
            </form>
<?php
            if (current_url() === "/my-products" || current_url() === "/my-products/admin-filter") {
?>
            <div class="col-md-2 mb-3">
                <button type="button" id="show_add_modal_btn" class="btn btn-bluegreen" data-bs-toggle="modal" data-bs-target="#add_product_modal"><i class="bi bi-plus-circle me-2"></i>Add product</button>
            </div>
<?php
            }
?>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="add_product_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add_product_modal_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_product_modal_label">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div id="add_product" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-5 me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" id="add_product_btn" class="btn btn-bluegreen px-5">Add</button>
            </div>
            </div>
        </div>
    </div>
