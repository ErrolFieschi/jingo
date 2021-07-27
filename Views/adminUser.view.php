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
        <table id="tab" class="display" style="width:100%">
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
                <th>Status</th>
                <th>Supprimer</th>
                <th>Date de création</th>
                <th>Date de mise à jour</th>
                <th>Edit</th>
                <th>Supprimer</th>
                <!--th>
                    <div class="card-icon"><img src="/Content/svg/edit.svg"
                                                alt="edit img" style="cursor: pointer"></div>
                </th>
                <th>
                    <div class="card-icon"><img src="/Content/svg/trash.svg"
                                                alt="Trash button" style="cursor: pointer"></div>
                </th-->
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $rowData): ?>

                <?php if ($rowData['isDeleted'] == 1):
                    ?>
                    <tr style="background-color: red;">

                        <th scope="row"><?= $rowData['id'] ?></th>
                        <td><?= $rowData['firstname'] ?></td>
                        <td><?= $rowData['lastname'] ?></td>
                        <td><?= $rowData['email'] ?></td>
                        <td><?= $rowData['birthday'] ?></td>
                        <!--td><?php //echo $rowData['pwd'] ?></td-->
                        <td><?= $rowData['country'] ?></td>
                        <td><?= $rowData['role'] ?></td>
                        <td><?= $rowData['status'] ?></td>
                        <td><?= $rowData['isDeleted'] ?></td>
                        <td><?= $rowData['createdAt'] ?></td>
                        <td><?= $rowData['updatedAt'] ?></td>
                        <td>
                            <div class="card-icon"><a href=""><img src="/Content/svg/edit.svg"
                                                                   alt="edit img" style="cursor: pointer"></a></div>
                        </td>
                        <td>
                            <div class="card-icon"><a href=""> <img src="/Content/svg/trash.svg"
                                                                    alt="Trash button" style="cursor: pointer"></a>
                            </div>
                        </td>
                    </tr>
                <?php  else: ?>
                    <tr>
                        <th scope="row"><?= $rowData['id'] ?></th>
                        <td><?= $rowData['firstname'] ?></td>
                        <td><?= $rowData['lastname'] ?></td>
                        <td><?= $rowData['email'] ?></td>
                        <td><?= $rowData['birthday'] ?></td>
                        <!--td><?php //echo $rowData['pwd'] ?></td-->
                        <td><?= $rowData['country'] ?></td>
                        <td><?= $rowData['role'] ?></td>
                        <td><?= $rowData['status'] ?></td>
                        <td><?= $rowData['isDeleted'] ?></td>
                        <td><?= $rowData['createdAt'] ?></td>
                        <td><?= $rowData['updatedAt'] ?></td>
                        <td>
<!--                            <a href="/admin-user?id=--><?//= $rowData['id'] ?><!--">-->
                            <div class="card-icon show"><img src="/Content/svg/edit.svg"
                                                                   alt="edit img" style="cursor: pointer"></a></div>
                        </td>
                        <td>
                            <div class="card-icon"><a href="/admin-user/delete?id=<?= $rowData['id'] ?>"> <img
                                            src="/Content/svg/trash.svg"
                                            alt="Trash button" style="cursor: pointer"></a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <section>
        <div class="row mb-12 ">
            <div class="row col-sm-7 popup-form">
                <?php App\Core\FormBuilder::render($formUpdateUser, "popup_form_builder col-md-6");
                ?>
                <i class="far fa-times-circle unshow"></i>
                <?php
                if (isset($errors)):
                    foreach ($errors as $error):?>
                        <li style="color:red"><?= $error; ?></li>
                    <?php endforeach;
                endif; ?>

            </div>
        </div>
    </section>
</div>

