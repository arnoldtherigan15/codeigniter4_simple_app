<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Codeigniter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/Comic">Comics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Page/about">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('message'); ?>
    </div>
<?php endif ?>