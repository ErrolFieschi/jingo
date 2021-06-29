<div class="container-back-wrap">
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
            <div class="row col-sm-7 popup-form">
            </div>
        </div>
    </section>
    <section>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <!--th scope="col">Mot de passe</th-->
                <th scope="col">Pays</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
                <th scope="col">Supprimer</th>
                <th scope="col">Date de création</th>
                <th scope="col">Date de mise à jour</th>
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
            <?php
            foreach ($data as $rowData): ?>
                <tbody>
                <?php if ($rowData['isDeleted'] == 1) {
                    ?>
                    <tr style="background-color: red;">

                        <th scope="row"><?= $rowData['id'] ?></th>
                        <td><?= $rowData['firstname'] ?></td>
                        <td><?= $rowData['lastname'] ?></td>
                        <td><?= $rowData['email'] ?></td>
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
                <?php } else { ?>
                    <tr>
                        <th scope="row"><?= $rowData['id'] ?></th>
                        <td><?= $rowData['firstname'] ?></td>
                        <td><?= $rowData['lastname'] ?></td>
                        <td><?= $rowData['email'] ?></td>
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
                <?php } ?>
                </tbody>
            <?php endforeach; ?>
        </table>
    </section>
</div>

