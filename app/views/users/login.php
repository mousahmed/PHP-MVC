<?php require APPROOT . "/views/includes/header.php" ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <?php flash('success') ?>
        <div class="card">
            <div class="card-header"><h4>Sign In</h4></div>
            <div class="card-body bg-light ">
                <form action="/users/login" method="post">


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

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <div class="col">
                            <a href="/users/register" class="btn btn-light btn-block">New User? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . "/views/includes/footer.php" ?>
