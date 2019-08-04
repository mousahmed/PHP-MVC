<?php require APPROOT . "/views/includes/header.php" ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header"><h4>Create an account</h4></div>
            <div class="card-body bg-light ">
                <form action="/users/register" method="post">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name"
                               class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $data['name'] ?>" required>
                        <span class="invalid-feedback"><?= $data['name_err'] ?></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email"
                               class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $data['email'] ?>" required>
                        <span class="invalid-feedback"><?= $data['email_err'] ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password"
                               class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $data['password'] ?>" required>
                        <span class="invalid-feedback"><?= $data['password_err'] ?></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Passowrd</label>
                        <input id="confirm_password" type="password" name="confirm_password"
                               class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '' ?>"
                               value="<?php echo $data['confirm_password'] ?>" required>
                        <span class="invalid-feedback"><?= $data['confirm_password_err'] ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block">Register</button>
                        </div>
                        <div class="col">
                            <a href="/users/login" class="btn btn-light btn-block">Have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . "/views/includes/footer.php" ?>
