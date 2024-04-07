<li id="all" class="mb-2 border rounded-3 p-3 bg-light-subtle border-light shadow-sm position-relative order_status">
    <i class="bi bi-list-ul"></i>
    <span class="ms-4 order_status_category">All Orders</span>
    <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count"><?= $all_count; ?></span>
</li>
<li id="pending" class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative order_status">
    <i class="bi bi-hourglass-split"></i>
    <span class="ms-4 order_status_category">Pending</span>
    <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count"><?= $pending_count; ?></span>
</li>
<li id="process" class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative order_status">
    <i class="bi bi-arrow-clockwise"></i>
    <span class="ms-4 order_status_category">On-process</span>
    <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count"><?= $process_count; ?></span>
</li>
<li id="shipped" class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative order_status">
    <i class="bi bi-truck"></i>
    <span class="ms-4 order_status_category">Shipped</span>
    <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count"><?= $shipped_count; ?></span>
</li>
<li id="delivered" class="mb-2 border rounded-3 p-3 bg-light-subtle shadow-sm position-relative order_status">
    <i class="bi bi-house-check-fill"></i>
    <span class="ms-4 order_status_category">Delivered</span>
    <span class="position-absolute top-0 end-0 bg-info text-dark fw-semibold rounded-pill px-2 count"><?= $delivered_count; ?></span>
</li>