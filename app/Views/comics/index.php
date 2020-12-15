<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-5">
    <a href="/Comic/create" class="btn btn-primary mb-4">Add New Comic</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cover</th>
                <th scope="col">Title</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comics as $data) : ?>
                <tr>
                    <th scope="row"><?= $data["id"]; ?></th>
                    <td>
                        <img src="/img/<?= $data["cover"]; ?>" alt="thumbnail" class="img-thumbnail thumbnail">
                    </td>
                    <td><?= $data["title"]; ?></td>
                    <td>
                        <a href="/comic/<?= $data['slug']; ?>" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>