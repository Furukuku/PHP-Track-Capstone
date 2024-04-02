    <main class="container py-5 px-4 users">
        <div class="row justify-content-center h-100 align-items-center">
            <form action="<?= site_url("user/login"); ?>" method="post" class="col-lg-5 border rounded shadow-sm p-4 pb-5 bg-white">
                <div class="d-flex flex-wrap gap-4 justify-content-between align-items-center mb-3">
                    <p class="fs-4 mb-0">Login to order</p>
                    <a href="<?= site_url("sign-up"); ?>" class="text-info">New member? Register here.</a>
                </div>
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="name@example.com">
<?= isset($errors["email"]) ? $errors["email"] : ""; ?>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
<?= isset($errors["password"]) ? $errors["password"] : ""; ?>
<?= $invalid; ?>
                </div>
                <input type="submit" value="Login" class="btn btn-bluegreen w-100">
            </form>
        </div>
    </main>