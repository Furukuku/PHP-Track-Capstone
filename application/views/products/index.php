    <main class="ps-5 pe-4 ms-5 products">   
        <div class="row gx-4 pb-5">
            <div class="col-md-2">
                <p>Categories</p>
                <ul class="p-0 overflow-y-auto border-top pt-1 position-relative categories"></ul>
            </div>
            <div class="col-md-10">
                <div id="product_container"></div>
                <nav id="pagination_container" aria-label="Page navigation"> </nav>
            </div>
        </div>
    </main>
    <script src="<?= base_url("assets/js/customer/categories-filter.js"); ?>"></script>
    <script src="<?= base_url("assets/js/customer/search.js"); ?>"></script>
    <script src="<?= base_url("assets/js/customer/pagination.js"); ?>"></script>
    <script src="<?= base_url("assets/js/toast.js"); ?>"></script>
    <?= $toast; ?>