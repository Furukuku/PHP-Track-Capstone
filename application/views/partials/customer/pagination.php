<?php
if ($total_pages > 1) {
?>
<ul class="pagination justify-content-end">
<?php
    for ($link = 1; $link <= $total_pages; $link++) {
        if ($current_page == $link) {
?>
    <li class="page-item"><p class="page-link bg-light-subtle text-body-secondary"><?= $link; ?></p></li>
<?php
        } else {
?>
    <li class="page-item"><a class="page-link bg-white text-info" href="<?= site_url("products/paginate/{$link}"); ?>"><?= $link; ?></a></li>
<?php
        }
    }
?>
</ul>
<?php
}
?>