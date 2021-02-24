<!DOCTYPE html>
<html lang="FR">
<head>
	<meta charset="UTF-8">
	<title>Template de BACK</title>
	<meta name="description" content="ceci est la description de ma page">
    <link href="/Content/dist/main.css" rel="stylesheet">

</head>
<body>
	<header>
            <nav class="nav vertical-nav">
                <div class="nav-brand">
                    <a href="#">JINGO</a>
                </div>
                <ul>
                    <li class="nav-item">
                        <img src="/Content/svg/board.svg" alt="icon">
                        <a class="nav-link" href="#">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <img src="/Content/svg/page.svg" alt="icon">
                        <a class="nav-link" href="#">Pages</a>
                    </li>
                    <li class="nav-item">
                        <img src="/Content/svg/formation.svg" alt="icon">
                        <a class="nav-link" href="#">Formations</a>
                    </li>
                    <li class="nav-item">
                        <img src="/Content/svg/lecon.svg" alt="icon">
                        <a class="nav-link " href="#">Leçons</a>
                    </li>
                    <li class="nav-item">
                        <img src="/Content/svg/article.svg" alt="icon">
                        <a class="nav-link " href="#">Articles</a>
                    </li>
                    <li class="nav-item">
                        <img src="/Content/svg/user.svg" alt="icon">
                        <a class="nav-link " href="#">Utilisateurs</a>
                    </li>
                    <hr class="nav-separator">
                    <li class="nav-item">
                        <img src="/Content/svg/setting.svg" alt="icon">
                        <a class="nav-link " href="#">Paramètres</a>
                    </li>
                    <li class="nav-item">
                        <img src="/Content/svg/logout.svg" alt="icon">
                        <a class="nav-link " href="#">Déconnexion</a>
                    </li>
                </ul>
            </nav>
	</header>

    <?php include $this->view; ?>

    <script type="text/javascript" src="https://kit.fontawesome.com/19c1e7b3bd.js" crossorigin="anonymous"></script>
</body>
</html>
