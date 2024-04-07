    <header class="position-fixed top-0 start-0 end-0 border p-3 ps-5 bg-white d-flex justify-content-between align-items-center shadow-sm z-2">
        <h2 class="ms-5 text-secondary">Village88</h2>
<?php
        if ($user["is_admin"] == 1) {
?>
        <div>
            <a href="<?= site_url("sign-up"); ?>" class="btn btn-bluegreen">Sign up</a>
            <a href="<?= site_url("login"); ?>" class="btn btn-bluegreen">Login</a>
        </div>
<?php
        } else {
?>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= $user["first_name"]; ?></a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= site_url("user/logout"); ?>">Logout</a></li>
            </ul>
        </div>
<?php
        }
?>
    </header>
    <aside class="position-fixed start-0 top-0 bottom-0 border bg-white px-3 py-2 shadow-sm z-2">
        <a href="<?= site_url("products"); ?>"><i class="bi bi-shop-window fs-1"></i></a>
    </aside>
    <div class="ps-5 pe-4 pt-5 mt-5 ms-5">
        <div class="row">
            <form action="" method="get" id="customer_form_search" class="col-md-4 mb-3">
                <input type="search" name="keyword" id="customer_search" class="form-control" placeholder="Search products">
            </form>
            <div class="col-md-2 mb-3">
                <a href="<?= site_url("cart"); ?>" class="btn btn-bluegreen"><i class="bi bi-cart-fill"></i> Cart(<span id="cart_count"><?= $cart_count; ?></span>)</a>
            </div>
        </div>
    </div>
