<div class="container-back-wrap">
    <script>
    </script>
    <section>
        <div class="banner banner--text banner--header"
             style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>Gestion des utilisateurs</h4>
                <p class="my-0">Bienvenue sur l'administration utilisateur</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row mb-12 ">
            <?php if (isset($_GET['id'])) { ?>
                <div class="row col-sm-7 popup-form">
                    <?php App\Core\FormBuilder::render($formUser, "popup_form_builder flex flex-col col-md-6"); ?>
                    <a href="/admin-user">
                        <i class="far fa-times-circle unshow"></i>
                    </a>
                    <?php
                    if (isset($errors)):
                        foreach ($errors as $error):?>
                            <li style="color:red"><?= $error; ?></li>
                        <?php endforeach;
                    endif; ?>
                </div>
                <script>
                    $(".popup-form").show();
                </script>
            <?php } ?>
        </div>
    </section>
    <section style="overflow: auto;">
        <table class="tab" class="display testerExemple" style="width:100%;">
            <thead>
            <tr>
                <th>#</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <!--th scope="col">Mot de passe</th-->
                <th>Pays</th>
                <th>Role</th>
                <!-- <th>Status</th> -->
                <th>Supprimer</th>
                <th>Date de création</th>
                <th>Date de mise à jour</th>
                <th>Edit</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $rowData): ?>

                <tr>
                    <th scope="row"><?= $rowData['id'] ?></th>
                    <td><?= $rowData['firstname'] ?></td>
                    <td><?= $rowData['lastname'] ?></td>
                    <td><?= $rowData['email'] ?></td>
                    <td><?= $rowData['birthday'] ?></td>
                    <td><?= $rowData['country'] ?></td>
                    <td><?= $rolesUser[$rowData['role']] ?></td>
                    <td><?= $rowData['isDeleted'] == 1 ? 'Oui' : 'Non' ?></td>
                    <td><?= $rowData['createdAt'] ?></td>
                    <td><?= $rowData['updatedAt'] ?></td>
                    <?php if ($rowData['role'] !== 1 || $rowData['id'] == $_SESSION['id']) { ?>
                        <td>
                            <div class="card-icon show">
                                <a href="/admin-user?id=<?= $rowData['id'] ?>">
                                    <img src="/Content/svg/edit.svg" alt="edit img" style="cursor: pointer">
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="card-icon"><a href="/admin-user/delete?id=<?= $rowData['id'] ?>"> <img
                                            src="/Content/svg/trash.svg"
                                            alt="Trash button" style="cursor: pointer"></a>
                            </div>
                        </td>
                    <?php } else { ?>
                        <td></td>
                        <td></td>
                    <?php } ?>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
