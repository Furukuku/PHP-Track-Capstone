    <main class="ps-5 pe-4 ms-5 products">   
        <div class="row gx-4 pb-5">
            <div class="col-md-2">
                <p>Categories</p>
                <ul class="p-0 overflow-y-auto border-top pt-1 categories">
                    <li class="mb-2 border rounded-3 p-3 bg-white shadow-sm">
                        <i class="bi bi-gift-fill"></i>
                        <span class="ms-4">All Products</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-white shadow-sm">
                        <i class="bi bi-gift-fill"></i>
                        <span class="ms-4">All Products</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-white shadow-sm">
                        <i class="bi bi-gift-fill"></i>
                        <span class="ms-4">All Products</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-white shadow-sm">
                        <i class="bi bi-gift-fill"></i>
                        <span class="ms-4">All Products</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                <p>All Products (105)</p>
                <div class="overflow-y-auto border-top mb-4 products_container">
<?php
                    for ($i = 0; $i < 20; $i++) {
?>
                    <article class="border rounded bg-white shadow-sm d-inline-block mx-1 my-1 product_cards">
                        <a href="<?= site_url("products/1"); ?>">
                            <div class="border-bottom img_container">
                                <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="h-100 w-100 object-fit-cover rounded-top" alt="product">
                            </div>
                            <div class="row px-3 py-2 align-items-center">
                                <div class="col-9">
                                    <p class="text-truncate">Carrots</p>
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