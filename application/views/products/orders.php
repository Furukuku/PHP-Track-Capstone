    <main class="p-4">
        <div class="row gx-4 pb-5">
            <div class="col-md-2 mt-3">
                <p>Status</p>
                <ul class="p-0 overflow-y-auto pt-1 order_categories"></ul>
            </div>
            <div class="col-md-10">
                <table class="w-100 order_table"></table>
                <nav id="pagination_container" aria-label="Page navigation"></nav>
            </div>
        </div>
    </main>
    <script src="<?= base_url("assets/js/admin/order-status-categories.js"); ?>"></script>
    <script src="<?= base_url("assets/js/admin/order-search.js"); ?>"></script>
    <script src="<?= base_url("assets/js/admin/order-paginate.js"); ?>"></script>