    <header class="position-fixed top-0 end-0 p-3 d-flex bg-dark-subtle justify-content-between shadow-sm z-1">
        <h2 class="text-white">Hello Again</h2>
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
        <a href="<?= site_url("products"); ?>" class="link-underline link-underline-opacity-0"><i class="bi bi-shop-window fs-1 text-white me-3"></i><span class="fs-3 text-light">V88</span></a>
        <ul class="navbar-nav mt-4">
            <li class="nav-item fs-5">
                <a href="<?= site_url("orders"); ?>" class="nav-link"><i class="bi bi-bag-check-fill me-2"></i>Orders</a>
            </li>
            <li class="nav-item fs-5">
                <a href="<?= site_url("my-products"); ?>" class="nav-link"><i class="bi bi-house-door-fill me-2"></i>Products</a>
            </li>
        </ul>
    </nav>
    <div class="px-4 pt-5 mt-5 search_container">
        <div class="row">
            <form action="" method="get" class="col-md-4 mb-3">
                <input type="search" class="form-control" placeholder="Search products">
            </form>
            <div class="col-md-2 mb-3">
                <button type="button" class="btn btn-bluegreen" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-plus-circle me-2"></i>Add product</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <form action="" method="post" class="p-2">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="email" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" class="form-select">
                                <option value="Sample">Sample</option>
                                <option value="Sample">Sample</option>
                                <option value="Sample">Sample</option>
                                <option value="Sample">Sample</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" value="1" min="0.01" id="price">
                        </div>
                        <div class="col-md-3">
                            <label for="inventory" class="form-label">Inventory</label>
                            <input type="number" class="form-control" value="1" min="1" id="inventory">
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4">
                            <label for="images" id="drag_area" class="form-label text-secondary">
                                <div id="upload_imgs" class="bg-light p-2 shadow d-flex align-items-center justify-content-center rounded">
                                    <div class="d-flex flex-column align-items-center justify-content-center rounded">
                                        <i class="bi bi-cloud-upload fs-3"></i>
                                        Upload Images (5 Max)
                                    </div>
                                </div>
                            </label>
                            <input type="file" accept="image/*" name="images" id="images" multiple hidden>
                        </div>
                        <div class="col-lg-8">
                            <p>Choose default image to be displayed</p>
                            <div id="uploaded_img_container" class="d-flex flex-wrap gap-3">
                                <!-- <label for="image1">
                                    <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="rounded border border-3 border-info" alt="product">
                                </label>
                                <label for="image2">
                                    <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="rounded" alt="product">
                                </label>
                                <label for="image3">
                                    <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="rounded" alt="product">
                                </label>
                                <label for="image4">
                                    <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="rounded" alt="product">
                                </label>
                                <label for="image5">
                                    <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="rounded" alt="product">
                                </label> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-5 me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-bluegreen px-5">Save</button>
            </div>
            </div>
        </div>
    </div>
    