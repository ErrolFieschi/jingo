<div class="container-front">
    <section>
        <ul class="p-0" id="columns">
            <?php foreach ($data as $rowData): ?>
                <li style="list-style: none;" id="Element_<?= $rowData['id'] ?>" data-article-id="<?= $rowData['id'] ?>" draggable="true" class="column">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="card flex-row flex-nowrap card--shadow justify-content-between">
                                <div class="card-header">
                                    <img src="/Content/Images/category.png" alt="title image" style="object-fit: cover;height: 100px !important;">
                                </div>
                                <div class="card-block">
                                    <h4 class="card-title"><?= $rowData['title'] ?></h4>
                                </div>

                                <div class="card-button-validate">
                                    <div class="card-icon">
                                        <i class="fas fa-arrow-circle-right" style="color: #3b3b3b;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</div>
</div>


