<?php require APPROOT . "/views/includes/header.php" ?>
<?php flash('success') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <span class="ml-2 font-weight-bold"><?= $data['user']->name ?></span>
            </div>
            <?php if ($_SESSION['user_admin'] == 1): ?>
                <div>

                    <a href="/posts/edit/<?= $data['post']->id ?>" class="btn btn-info btn-sm"><i
                                class="fa fa-pencil"></i> Edit</a>

                    <form class="float-right ml-2" action="/posts/delete/<?= $data['post']->id ?>" method="post">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card-body">
        <div class="text-center"><span class="h4"><?= $data['post']->title ?></span></div>

        <hr>

        <?= $data['post']->content ?>

    </div>
</div>


<?php foreach ($data['comments'] as $comment): ?>
    <?php if ($comment->status == 1): ?>

        <div class="card my-3">
            <div class="card-header text-white bg-success">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="ml-2 font-weight-bold"><?= $comment->name ?></span>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <?= $comment->commentContent ?>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<div class="card mt-4">
    <div class="card-header">
        Add a comment
    </div>
    <div class="card-body">
        <form action="/comments/create" method="post">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="post_id" value="<?= $data['post']->id ?>">
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control <?php echo (!empty($data['content_err'])) ? 'is-invalid' : '' ?>"
                          name="content" id="content"></textarea>
                <span class="invalid-feedback"><?= $data['content_err'] ?></span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success">Reply</button>
            </div>
        </form>

    </div>
</div>
<?php require APPROOT . "/views/includes/footer.php" ?>
