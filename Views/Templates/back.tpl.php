<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <meta name="description" content="ceci est la description de ma page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    <link href="/Content/dist/main.css" rel="stylesheet">
    <link href="/Content/dist/page-generator.css" rel="stylesheet">
    <script src="/Content/js/jquery-3.5.1.min.js"></script>
    <script src="/node_modules/chart.js/dist/Chart.js"></script>
    <script defer src="/Content/js/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
</head>
<body>
<div class="container-back">
    <nav class="nav vertical-nav">
        <div class="nav-brand">
            <a href="#">JINGO</a>
        </div>
        <ul>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                <img src="/Content/svg/board.svg" alt="icon">
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/stats">
                <img src="/Content/svg/stats.svg" alt="icon">
                    <span>Statistiques</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pages">
                <img src="/Content/svg/page.svg" alt="icon">
                    <span>Pages</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/training">
                <img src="/Content/svg/formation.svg" alt="icon">
                    <span>Formations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/lesson">
                <img src="/Content/svg/lecon.svg" alt="icon">
                    <span>Leçons</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">
                <img src="/Content/svg/article.svg" alt="icon">
                    <span>Articles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/admin-user">
                <img src="/Content/svg/user.svg" alt="icon">
                    <span>Utilisateurs</span>
                </a>
            </li>
            <hr class="nav-separator">
            <li class="nav-item">
                <a class="nav-link " href="/settings">
                <img src="/Content/svg/setting.svg" alt="icon">
                    <span>Paramètres</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/logout">
                <img src="/Content/svg/logout.svg" alt="icon">
                    <span>Déconnexion</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php include $this->view; ?>
</div>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script src="/vendor/tinymce/tinymce.min.js"></script>
<script src="/vendor/tinymce/uploadFile.js"></script>
<script src="/Content/js/nav.js"></script>
<script src="/Content/js/global.js"></script>
<script type="text/javascript" src="https://kit.fontawesome.com/19c1e7b3bd.js" crossorigin="anonymous"></script>
<script src="/Content/js/modal.js"></script>
<script src="/Content/js/sortList.js"></script>
</body>
</html>
