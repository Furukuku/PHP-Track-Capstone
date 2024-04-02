    <main class="container py-5 px-4 users">
        <div class="row justify-content-center h-100 align-items-center">
            <form action="<?= site_url("user/create"); ?>" method="post" class="col-lg-5 border rounded shadow-sm p-4 pb-5 bg-white">
                <div class="d-flex flex-wrap gap-4 justify-content-between align-items-center mb-3">
                    <p class="fs-4 mb-0">Sign up to order</p>
                    <a href="<?= site_url("login"); ?>" class="text-info">Already a member? Login here.</a>
                </div>
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" name="first_name" value="<?= isset($values["first_name"]) ? $values["first_name"] : ""; ?>" class="form-control" id="fname">
<?= isset($errors["fname"]) ? $errors["fname"] : ""; ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="<?= isset($values["last_name"]) ? $values["last_name"] : ""; ?>" class="form-control" id="lname">
<?= isset($errors["lname"]) ? $errors["lname"] : ""; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" value="<?= isset($values["email"]) ? $values["email"] : ""; ?>" class="form-control" id="email" placeholder="name@example.com">
<?= isset($errors["email"]) ? $errors["email"] : ""; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
<?= isset($errors["password"]) ? $errors["password"] : ""; ?>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="paconfirm_passwordssword">
<?= isset($errors["confirm_password"]) ? $errors["confirm_password"] : ""; ?>
                </div>
                <input type="submit" value="Sign up" class="btn btn-bluegreen w-100">
            </form>
        </div>
    </main>