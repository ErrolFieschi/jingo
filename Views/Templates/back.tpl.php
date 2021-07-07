<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <meta name="description" content="ceci est la description de ma page">
    <link href="/Content/dist/main.css" rel="stylesheet">
    <script src="/vendor/tinymce/tinymce.min.js"></script>
    <script src="/vendor/tinymce/uploadFile.js"></script>
    <script src="/node_modules/chart.js/dist/Chart.js"></script>
    <script src="/Content/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
    <script src="/Content/js/nav.js"></script>
    <script src="/Content/js/global.js"></script>
    <script defer src="/Content/js/chart.js"></script>
    <script src="https://cdn.tiny.cloud/1/freuyvh2imwvcgh8t7h0vd36xd3iessaj34fcjuiypccegr3/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d59c1d4dbf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>

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
                <a class="nav-link " href="#">
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
<script>

    $(document).ready(function(){
        $('#modal-btn').on('click', function(){
            $('#modal').css('display' , '');
            $('#modal').css('display' , 'block');
            $('#modal').css('padding-right' , '16px');
        });

        $('.modal-content').find('.close').on('click',function(){
            $('#modal').css('display' , 'none');
        });

        // $(document).on('click',function(e){
        //     if(!(($(e.target).closest("#modal-content").length > 0 ) || ($(e.target).closest("#modal-btn").length > 0))){
        //         $('#modal').css('display' , 'none');
        //     }
        // });
    });
</script>
    <script type="text/javascript" src="https://kit.fontawesome.com/19c1e7b3bd.js" crossorigin="anonymous"></script>
</body>
</html>
