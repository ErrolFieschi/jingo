
            <div class="container-back-wrap">
                <section>
                    <div class="banner banner--text banner--header" style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
                        <div class="bg">
                            <h4>Créateur de leçon</h4>
                            <p class="my-0">L’endroit pour créer de nouvelle leçon</p>
                        </div>
                    </div>
                </section>

                <section>
                    <?php if(isset($_GET['success']) && $_GET['success'] == 'ok') echo '<b style="color: #1fad1f;">Insertion réussi</b>'; ?>
                    <div class="row mb-4" style="background-color: white;">
                        <div class="col-sm-12">
                                <?php App\Core\FormBuilder::render($form, 'form_input_wrapper') ?>
                            <?php if (isset($errors)):
                                foreach ($errors as $error):?>
                                    <li style="color:red"><?= $error; ?></li>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </section>
            </div>


