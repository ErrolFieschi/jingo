<style>
    [draggable] {
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        -khtml-user-drag: element;
        -webkit-user-drag: element;
    }

    #columns {
        list-style-type: none;
    }

    .column {
        cursor: move;
    }

    .column.over {
        border-top: 10px solid #279eaf;
    }

</style>
<div class="container-back-wrap">
    <section>
        <div class="banner banner--text banner--header" style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>List de chapitre</h4>
                <p class="my-0">L’endroit pour créer, modifier ou supprimer des chapitres</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row">


        </div>
    </section>
    <section>
        <div class="row col-sm-12">
            <div class="mb-4">
                <a class="btn" href="training"><i class="fas fa-angle-double-left"></i> RETOUR</a>
            </div>
            <div class="mb-4" id="modal-btn" style="margin-left: 10px;">
                <a class="btn" href="javascript:void(0);"><i class="fas fa-plus"></i> Ajouter un chapitre</a>
            </div>
            <div class="mb-4" style="margin-left: 10px;">
                <span class="btn no-click"><i class="fas fa-street-view" style="font-size: 15px; padding-right: 10px;"></i> <?= mb_strtoupper($title); ?></span>
            </div>
        </div>
        <ul style="padding: 0;" id="columns">
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
                        <div class="card-button">
                            <div class="card-icon">
                                <form method="post" id="<?=$rowData['id']?>" action="/part/delete">
                                    <input type="hidden" name="id" value="<?= $rowData['id'] ?>">
                                    <input type="hidden" name="uri" value="<?= '/' . $uri ?>">
                                    <a href="javascript:(0)" onclick="document.getElementById(<?=$rowData['id']?>).submit()">
                                        <img src="/Content/svg/trash.svg" alt="edit button">
                                    </a>
                                </form>
                            </div>
                        </div>

                        <div class="card-button-validate" onclick="window.location='<?= $uri . '/' . $rowData['url'] ?>';">
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
<!--        <a class="btn" href="training"><i class="fas fa-angle-double-left"></i> Retour aux formations</a>-->
        <input class="btn"  type='button' value="Sauvegarder l'ordre" onclick='saveOrder(<?= $trainingId ?>);'/>
    </section>
</div>
<div class="modal fade show" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-modal="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" id="modal-content">
            <?php App\Core\FormBuilder::render($form,'form_input_wrapper') ?>
            <?php if (isset($errors)):
                foreach ($errors as $error):?>
                    <li style="color:red"><?= $error; ?></li>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</div>
</div>


