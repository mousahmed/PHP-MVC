<?php require APPROOT . "/views/includes/header.php" ?>
<?php flash('success') ?>

    <div class="d-flex justify-content-between mb-2">
        <div>
            <h3>Posts</h3>

        </div>
        <div >
            <form class="form-inline my-2 my-lg-0" action="/posts/index" method="POST">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search"
                       value="<?= $data['search'] ?>">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div>
            <?php if ($_SESSION['user_admin'] == 1): ?>
                <a href="/posts/create" class="btn btn-info"><i class="fa fa-pencil"></i> Create Post</a>
            <?php endif; ?>
        </div>
    </div>
<?php foreach ($data['posts'] as $post): ?>

    <div class="card my-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <img width="40px" height="40px" style="border-radius: 50%"
                         src="https://via.placeholder.com/150" alt="">
                    <span class="ml-2 font-weight-bold"><?= $post->name ?></span>
                </div>
                <div>
                    <a href="/posts/show/<?= $post->postId ?>" class="btn btn-success btn-sm"><i
                                class="fa fa-eye"></i>
                        View</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="text-center"><span class="h4"><?= $post->title ?></span></div>
            <div class="text-center  p-2 mt-3">
                <small>Created at <?= $post->created_at ?></small>
            </div>
        </div>
    </div>

<?php endforeach; ?>





<?php require APPROOT . "/views/includes/footer.php" ?>