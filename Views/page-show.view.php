<div class="container-front">
    <?php
    foreach ($pagesShow as $rowData): ?>
        <h1> <?= $rowData['title'] ?> </h1>

    <?= $rowData['code'] ?>
    <?php endforeach; ?>
</div>
