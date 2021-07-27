<!--div class="nav-front horizontal-nav" style="background-color: #3b3b3b">
    <div class="container-fluid-nm">
        <a class="site-title ml-10" style="color: white" href="#">JINGO</a>
        <ul class="navbar-nav">
            <li>
                <a class="nav-link nav-front-font" style="color: white!important;" href="#">Accueil</a>
            </li>
            <li>
                <a class="nav-link nav-front-font" style="color: white!important;" href="#">Cours</a>
            </li>
            <li>
                <a class="nav-link nav-front-font" style="color: white!important;" href="#">Tarifs</a>
            </li>
            <li>
                <a class="nav-link nav-front-font" style="color: white!important;" href="#">Espace</a>
            </li>
            <button class="dropbtn">Dropdown</button>
            <div class="dropdown-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </ul>

    </div>
</div-->

<?php
foreach ($getNav as $code): ?>
    <?= $code['code'] ?>
<?php endforeach; ?>

<div class="container-front">
    <?php
    foreach ($pagesShow as $rowData): ?>
        <h1> <?= $rowData['title'] ?> </h1>

        <?= $rowData['code'] ?>
    <?php endforeach; ?>
</div>
