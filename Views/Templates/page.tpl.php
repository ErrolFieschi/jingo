<!DOCTYPE html>
<html lang="FR">
<head>
    <?php if (!empty($pagesShow)):
        foreach ($pagesShow as $rowData): ?>
            <meta charset="UTF-8">
            <title><?= $rowData['title']; ?></title>
            <meta name="description" content="ceci est la description de ma page">
            <meta name="keywords" content=" <?= $rowData['meta']; ?>">
        <?php endforeach;
    else: ?>
        <meta charset="UTF-8">
            <title>Nav editor</title>
    <meta name="description" content="ceci est la description de ma page">
    <?php endif;
    ?>
    <link href="/Content/dist/main.css" rel="stylesheet">
    <script src="/vendor/tinymce/tinymce.min.js"></script>
    <script src="/vendor/tinymce/uploadFile.js"></script>
    <script src="/node_modules/chart.js/dist/Chart.js"></script>
    <script src="/Content/js/jquery-3.5.1.min.js"></script>
    <script src="/Content/js/nav.js"></script>
    <script src="/Content/js/generator.js"></script>
    <script src="/Content/js/nav-generator.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/d59c1d4dbf.js" crossorigin="anonymous"></script>
</head>
<body>

<header>
</header>

<!-- intégration de la vue -->
<?php include $this->view; ?>

</body>
</html>
