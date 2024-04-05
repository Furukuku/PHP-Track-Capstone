<script>
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
    
    if ($error) {
?>
    Toast.fire({
        icon: 'error',
        titleText: '<?= $error; ?>',
        color: '#fff',
        background: '#cf3434',
    });
<?php
    }
?>
</script>