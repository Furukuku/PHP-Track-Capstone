<thead>
    <tr>
        <th class="text-light"><?= $category_label; ?></th>
        <td class="text-center text-secondary-emphasis">Product ID #</td>
        <td class="text-center text-secondary-emphasis">Price</td>
        <td class="text-center text-secondary-emphasis">Category</td>
        <td class="text-center text-secondary-emphasis">Stocks</td>
        <td class="text-center text-secondary-emphasis">Sold</td>
    </tr>
</thead>
<tbody class="overflow-y-auto">
<?php
    if (!empty($products)) {
        foreach ($products as $product) {
?>
    <tr class="bg-light-subtle">
        <td class="p-3 rounded-start-3">
            <img src="<?= base_url("uploads/products/{$product["display_img"]}"); ?>" class="object-fit-fill rounded" alt="product">
            <span class="ms-3"><?= $product["name"]; ?></span>
        </td>
        <td class="px-3 text-center product_id"><?= $product["id"]; ?></td>
        <td class="px-3 text-center">&#36; <?= $product["formatted_price"]; ?></td>
        <td class="px-3 text-center"><?= $product["category_name"]; ?></td>
        <td class="px-3 text-center"><?= $product["inventory"]; ?></td>
        <td class="px-3 text-center"><?= $product["sold"]; ?></td>
        <td class="rounded-end-3 text-center align-middle">
            <button type="button" class="btn btn-outline-light mx-3 edit_product_btn" data-bs-toggle="modal" data-bs-target="#edit_product_modal">Edit</button>
            <i class="bi bi-trash-fill mx-3 remove" data-bs-toggle="modal" data-bs-target="#delete_product_modal"></i>
        </td>
    </tr>
<?php
        }
    } else {
?>
    <td class="text-center mt-5 fs-4" colspan="5">No products</td>
<?php
    }
?>
</tbody>