<thead>
    <tr>
        <th class="text-light"><?= $category_label; ?></th>
        <td class="text-center text-secondary-emphasis">Order ID #</td>
        <td class="text-center text-secondary-emphasis">Order Date</td>
        <td class="text-center text-secondary-emphasis">Receiver</td>
        <td class="text-center text-secondary-emphasis">Total Amount</td>
        <td class="text-center text-secondary-emphasis">Status</td>
    </tr>
</thead>
<tbody class="overflow-y-auto">
<?php
    if (!empty($orders)) {
        foreach ($orders as $order) {
?>
    <tr class="bg-light-subtle">
        <td class="p-3 rounded-start-3">
            <img src="<?= base_url("uploads/products/{$order["display_img"]}"); ?>" class="object-fit-fill rounded" alt="product">
            <span class="ms-3"><?= $order["quantity"]; ?> Items</span>
        </td>
        <td class="px-3 text-center"><?= $order["id"]; ?></td>
        <td class="px-3 text-center"><?= $order["order_date"]; ?></td>
        <td class="px-3 text-center">
            <p class="mb-0"><?= $order["customer_name"]; ?></p>
            <p class="text-body-secondary address"><?= $order["address_1"]; ?></p>
        </td>
        <td class="px-3 text-center">&#36; <?= $order["amount"]; ?></td>
        <td class="rounded-end-3 pe-3">
            <form action="<?= site_url("order/update"); ?>" method="post" class="update_status_form">
                <input type="hidden" name="id" value="<?= $order["id"]; ?>">
                <select name="status" class="form-control text-body-secondary select_status">
                    <option value="Pending" <?= $order["status"] === "Pending" ? "selected" : ""; ?>>Pending</option>
                    <option value="On-process" <?= $order["status"] === "On-process" ? "selected" : ""; ?>>On-process</option>
                    <option value="Shipped" <?= $order["status"] === "Shipped" ? "selected" : ""; ?>>Shipped</option>
                    <option value="Delivered" <?= $order["status"] === "Delivered" ? "selected" : ""; ?>>Delivered</option>
                </select>
            </form>
        </td>
    </tr>
<?php
        }
    } else {
?>
        <td class="text-center mt-5 fs-4" colspan="6">No Orders</td>
<?php
    }
?>
</tbody>
