    <main class="p-4">
        <div class="row gx-4 pb-5">
            <div class="col-md-2 mt-3">
                <p>Status</p>
                <ul class="p-0 overflow-y-auto pt-1 categories">
                    <li class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative">
                        <i class="bi bi-list-ul"></i>
                        <span class="ms-4">All Orders</span>
                        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count">12</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative">
                        <i class="bi bi-hourglass-split"></i>
                        <span class="ms-4">Pending</span>
                        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count">12</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative">
                        <i class="bi bi-arrow-clockwise"></i>
                        <span class="ms-4">On-process</span>
                        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count">12</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative">
                        <i class="bi bi-truck"></i>
                        <span class="ms-4">Shipped</span>
                        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count">12</span>
                    </li>
                    <li class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative">
                        <i class="bi bi-house-check-fill"></i>
                        <span class="ms-4">Delivered</span>
                        <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count">12</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                <table class="w-100">
                    <thead>
                        <tr>
                            <th class="text-light">All Orders (105)</th>
                            <td class="text-center text-secondary-emphasis">Order ID #</td>
                            <td class="text-center text-secondary-emphasis">Order Date</td>
                            <td class="text-center text-secondary-emphasis">Receiver</td>
                            <td class="text-center text-secondary-emphasis">Total Amount</td>
                            <td class="text-center text-secondary-emphasis">Status</td>
                        </tr>
                    </thead>
                    <tbody class="overflow-y-auto">
<?php
                        for ($i = 0; $i < 10; $i++) {
?>
                        <tr class="bg-light-subtle">
                            <td class="p-3 rounded-start-3">
                                <img src="https://i.ebayimg.com/images/g/Y8AAAOSwD3NjmB5K/s-l1200.webp" class="object-fit-fill rounded" alt="product">
                                <span class="ms-3">10 Items</span>
                            </td>
                            <td class="px-3 text-center">6</td>
                            <td class="px-3 text-center">02-23-2024</td>
                            <td class="px-3 text-center">
                                <p class="mb-0">Michael Choi</p>
                                <p class="text-body-secondary address">123 Dojo Way, Bellevue, WA, 98005</p>
                            </td>
                            <td class="px-3 text-center">&#36; 25</td>
                            <td class="rounded-end-3 pe-3">
                                <form action="" method="post">
                                    <select class="form-control text-body-secondary">
                                        <option value="Pending">Pending</option>
                                        <option value="On-process">On-process</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </form>
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