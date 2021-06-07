<div class="container-back-wrap">
    <section>
        <div class="banner banner--text banner--header" style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>Ma liste de leçon</h4>
                <p class="my-0">L’endroit pour créer, modifier ou supprimer des leçons</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_courses.svg" alt="register">
                </div>
                <p>Ajouter une leçon</p>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_lesson.svg" alt="lesson">
                </div>
                <p>Leçon favoris</p>
            </div>

            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_page.svg" alt="import page">
                </div>
                <p>Dernière leçon modifiée</p>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/import_file.svg" alt="files">
                </div>
                <p>Leçon à la une</p>
            </div>
        </div>
    </section>
    <section>
        <?php foreach ($data as $rowData): ?>
        <div class="row mb-4">
            <div class="col-sm-12">
                <div class="card flex-row flex-wrap card--shadow justify-content-between">
                    <div class="card-header">
                        <img src="/Content/Images/formation.png" alt="title image" style="object-fit: cover;">
                    </div>
                    <div class="card-block">
                        <h4 class="card-title"><?= $rowData['title'] ?></h4>
                        <p class="card-text mb-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet...
                        </p>
                        <a href="#" style="color: #c56f43;">Développement </a>
                    </div>
                    <div class="card-button">
                        <div class="card-icon">
                            <a href="#"><img src="/Content/svg/edit.svg" alt="edit button"></a>
                        </div>
                        <div class="card-icon">
                            <a href="#"><img src="/Content/svg/setting-bis.svg" alt="setting button"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
</div>

