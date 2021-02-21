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
<!--            <img src="#" alt="logo Jingo">-->
            <nav style="width: 20%; background-color: #181933; min-height: 100vh; color: white;">
                <div style="text-align: center; padding-top: 8%;">
                    <a href="#" class="brand">Jingo</a>
                </div>
                <ul class="nav vertical-nav">
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
<!--                    separation à créer-->
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

</body>
</html>