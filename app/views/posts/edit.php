<?php require APPROOT . "/views/includes/header.php" ?>


<a href="/posts" class="btn btn-light mb-2"><i class="fa fa-backward"></i> Back</a>

<div class="card">
    <div class="card-header"><h4>Edit Post</h4></div>
    <div class="card-body bg-light">
        <form action="/posts/edit/<?=$data['id'] ?>" method="post">
            <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"] ?>">
            <div class="form-group">
                <label for="name">Title</label>
                <input id="title" type="text" name="title"
                       class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : '' ?>"
                       value="<?php echo $data['title'] ?>" required>
                <span class="invalid-feedback"><?= $data['title_err'] ?></span>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content"  rows="5"
                          class="form-control <?php echo (!empty($data['content_err'])) ? 'is-invalid' : '' ?>"
                          required> <?php echo $data['content'] ?></textarea>
                <span class="invalid-feedback"><?= $data['content_err'] ?></span>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success btn-block">Edit Post</button>
                </div>

            </div>
        </form>
    </div>
</div>


<?php require APPROOT . "/views/includes/footer.php" ?>
