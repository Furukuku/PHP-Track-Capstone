    <main class="p-4">
        <div class="row gx-4 pb-5">
            <div class="col-md-2 mt-3">
                <p>Categories</p>
                <ul class="p-0 overflow-y-auto pt-1 categories"></ul>
            </div>
            <div class="col-md-10">
                <table class="w-100"></table>
                <nav id="pagination_container" aria-label="Page navigation"></nav>
            </div>
        </div>
    </main>
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_product_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit_product_modal_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit_product_modal_label">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div id="edit_product" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-5 me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" id="save_product_btn" class="btn btn-bluegreen px-5">Save</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_product_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delete_product_modal_Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete_product_modal_Label">Remove Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="delete_product" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="delete_product_btn" class="btn btn-outline-danger">Remove</a>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url("assets/js/admin/categories-filter.js"); ?>"></script>
    <script src="<?= base_url("assets/js/admin/add-product.js"); ?>"></script>
    <script src="<?= base_url("assets/js/admin/edit-product.js"); ?>"></script>
    <script src="<?= base_url("assets/js/admin/delete-product.js"); ?>"></script>
    <script src="<?= base_url("assets/js/admin/pagination.js"); ?>"></script>