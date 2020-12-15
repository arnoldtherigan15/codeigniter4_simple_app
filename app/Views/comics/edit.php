<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8 mt-5">
            <h2>Edit Comic Data</h2>
            <form action="/comic/update/<?= $comic['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $comic['slug']; ?>">
                <input type="hidden" name="coverOld" value="<?= $comic['cover']; ?>">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= $validation->hasError('title') ? 'is-invalid' : ''; ?>" name="title" id="title" value="<?= old('title') ? old('title') : $comic['title']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('title'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="author" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="author" id="author" value="<?= old('author') ? old('author') : $comic['author']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="publisher" id="publisher" value="<?= old('publisher') ? old('publisher') : $comic['publisher']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $comic['cover']; ?>" alt="cover" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= $validation->hasError('cover') ? 'is-invalid' : ''; ?>" id="cover" name="cover" onchange="preview()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('cover'); ?>
                            </div>
                            <label class="custom-file-label" for="cover"><?= $comic['cover']; ?></label>
                        </div>
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>