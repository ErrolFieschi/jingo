<div class="container-front">
    <section class="mt-10">
        <?php
        foreach ($data as $rowData): ?>
            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="card flex-row flex-nowrap card--shadow justify-content-between">
                        <a href="/courses/<?= $rowData['url'] ?>">
                            <div class="card-header">
                                <img src="/Content/Images/formation.png" alt="title image" style="object-fit: cover;">
                            </div>
                        </a>
                        <div class="card-block">
                            <a href="/courses/<?= $rowData['url'] ?>">
                                <h4 class="card-title"><?= $rowData['title'] ?></h4>
                            </a>
                            <p class="card-text mb-10"><?= $rowData['description'] ?></p>

                            <a href="#" style="color: #c56f43;"><?= $rowData['name'] ?></a>
                        </div>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
    </section>
</div>