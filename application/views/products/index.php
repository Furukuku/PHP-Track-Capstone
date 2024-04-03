    <main class="ps-5 pe-4 ms-5 products">   
        <div class="row gx-4 pb-5">
            <div class="col-md-2">
                <p>Categories</p>
                <ul class="p-0 overflow-y-auto border-top pt-1 categories">
                    <li class="mb-2 border rounded-3 bg-white shadow-sm">
                        <a href="<?= site_url("products"); ?>" class="d-block text-dark link-underline link-underline-opacity-0 p-3">
                            <i class="bi bi-list-ul"></i>
                            <span class="ms-4">All Products</span>
                        </a>
                    </li>
<?php
                    foreach ($categories as $category) {
?>
                    <li class="mb-2 border rounded-3 bg-white shadow-sm">
                        <form action="<?= site_url("products/filter"); ?>" method="get" class="p-3 form_categories">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
                            <input type="hidden" name="category" value="<?= $category["id"]; ?>">
                            <i class="bi bi-gift-fill"></i>
                            <span class="ms-4"><?= $category["name"]; ?></span>
                        </form>
                    </li>
<?php
                    }
?>
                </ul>
            </div>
            <div class="col-md-10">
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
                                    <p>&#36; 25</p>
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
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                    </ul>   
                </nav>
            </div>
        </div>
    </main>
    <script src="<?= base_url("assets/js/categories-filter.js"); ?>"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            allowEscapeKey: true,
        });

<?php
        if ($success) {
?>
        Toast.fire({
            icon: 'success',
            titleText: '<?= $success; ?>',
            color: '#fff',
            background: '#2fa354',
        });
<?php
        }
?>
    </script>