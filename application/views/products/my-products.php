    <main class="p-4">
        <div class="row gx-4 pb-5">
            <div class="col-md-2 mt-3">
                <p>Categories</p>
                <ul class="p-0 overflow-y-auto pt-1 categories">
                    <li class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative">
                        <i class="bi bi-list-ul"></i>
                        <span class="ms-4">All Products</span>
                        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count">12</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative">
                        <i class="bi bi-list-ul"></i>
                        <span class="ms-4">All Products</span>
                        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count">12</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative">
                        <i class="bi bi-list-ul"></i>
                        <span class="ms-4">All Products</span>
                        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count">12</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative">
                        <i class="bi bi-list-ul"></i>
                        <span class="ms-4">All Products</span>
                        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count">12</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                <table class="w-100">
                    <thead>
                        <tr>
                            <th class="text-light">All Products (105)</th>
                            <td class="text-center text-secondary-emphasis">Product ID #</td>
                            <td class="text-center text-secondary-emphasis">Price</td>
                            <td class="text-center text-secondary-emphasis">Category</td>
                            <td class="text-center text-secondary-emphasis">Stocks</td>
                            <td class="text-center text-secondary-emphasis">Sold</td>
                        </tr>
                    </thead>
                    <tbody class="overflow-y-auto">
<?php
                        for ($i = 0; $i < 10; $i++) {
?>
                        <tr class="bg-light-subtle">
                            <td class="p-3 rounded-start-3">
                                <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="object-fit-fill rounded" alt="product">
                                <span class="ms-3">Carrot</span>
                            </td>
                            <td class="px-3 text-center">6</td>
                            <td class="px-3 text-center">&#36; 25</td>
                            <td class="px-3 text-center">Vegetables</td>
                            <td class="px-3 text-center">100</td>
                            <td class="px-3 text-center">23</td>
                            <td class="rounded-end-3 text-center align-middle">
                                <button type="button" class="btn btn-outline-secondary mx-3">Edit</button>
                                <i class="bi bi-trash-fill mx-3 remove"></i>
                            </td>
                        </tr>
<?php
                        }
?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                        <li class="page-item"><a class="page-link text-light" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="page-item"><a class="page-link text-body-secondary" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-light" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-light" href="#">3</a></li>
                        <li class="page-item"><a class="page-link text-light" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                    </ul>   
                </nav>
            </div>
        </div>
    </main>
    <script src="<?= base_url("assets/js/upload-images.js"); ?>"></script>
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