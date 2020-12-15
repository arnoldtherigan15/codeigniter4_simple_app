<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col mt-5">
            <div class="card" style="width: 18rem;">
                <img src="/img/<?= $comic['cover']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $comic['title']; ?></h5>
                    <p class="card-text">Author : <?= $comic['author']; ?></p>
                    <p class="card-text">Publisher : <?= $comic['publisher']; ?></p>
                    <div class="d-flex justify-content-between mb-4">
                        <a href="/comic/edit/<?= $comic['slug']; ?>" class="btn btn-warning" style="width: 90px;">Edit</a>
                        <form action="/comic/<?= $comic['id']; ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" style="width: 90px;" onclick="return confirm('this cannot be revert, are you sure?')">Delete</button>
                        </form>
                    </div>
                    <a href="/comic" class="mt-4">Back to home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>