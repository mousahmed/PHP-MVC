<?php require APPROOT . "/views/includes/header.php" ?>
<?php flash('success') ?>
    <div class="d-flex justify-content-between mb-2">
        <div>
            <h3>Comments</h3>
        </div>

    </div>
    <div class="card my-3">
        <div class="card-body">
            <table class="table">
                <thead class="table-dark">
                <tr>

                    <th scope="col">content</th>
                    <th scope="col">Author</th>
                    <th scope="col">Post</th>
                    <th scope="col">Status</th>

                </tr>
                </thead>
                <tbody>

                <?php foreach ($data['comments'] as $comment): ?>
                    <tr>
                        <td><?= $comment->commentContent ?></td>
                        <td><?= $comment->name ?></td>
                        <td><?= $comment->title ?></td>
                        <td>
                            <form action="/comments/approve/<?= $comment->commentId ?>" method="post">
                                <?php if ($comment->status == 0): ?>
                                    <input type="hidden" name="status" value=1>
                                    <button type="submit" class="btn btn-info btn-sm  btn-block ">Approve</button>
                                <?php else: ?>
                                    <input type="hidden" name="status" value=0>
                                    <button type="submit" class="btn btn-danger btn-sm btn-block ">Disapprove</button>
                                <?php endif; ?>

                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>


<?php require APPROOT . "/views/includes/footer.php" ?>