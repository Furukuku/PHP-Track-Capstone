    <header class="position-fixed top-0 start-0 end-0 border p-3 ps-5 bg-white d-flex justify-content-between shadow-sm z-1">
        <h2 class="ms-5 text-secondary">Hello Again</h2>
        <div>
            <a href="<?= site_url("sign-up"); ?>" class="btn btn-bluegreen">Sign up</a>
            <a href="<?= site_url("login"); ?>" class="btn btn-bluegreen">Login</a>
        </div>
    </header>
    <aside class="position-fixed start-0 top-0 bottom-0 border bg-white px-3 py-2 shadow-sm z-1">
        <a href="<?= site_url("products"); ?>"><i class="bi bi-shop-window fs-1"></i></a>
    </aside>
    <div class="ps-5 pe-4 pt-5 mt-5 ms-5">
        <div class="row">
            <form action="" method="get" class="col-md-4 mb-3">
                <input type="search" class="form-control" placeholder="Search products">
            </form>
            <div class="col-md-2 mb-3">
                <a href="<?= site_url("cart"); ?>" class="btn btn-bluegreen"><i class="bi bi-cart-fill"></i> Cart(0)</a>
            </div>
        </div>
    </div>
