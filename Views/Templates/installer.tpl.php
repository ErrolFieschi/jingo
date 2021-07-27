<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <title>Template de FRONT</title>
    <meta name="description" content="ceci est la description de ma page">
    <link href="/Content/dist/main.css" rel="stylesheet"> <!-- temporary will be removed -->
    <link href="/Content/dist/article.css" rel="stylesheet">
    <script src="/Content/js/jquery-3.5.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d59c1d4dbf.js" crossorigin="anonymous"></script>
</head>
<body>

<header>
</header>


<!-- intégration de la vue -->
<?php include $this->view; ?>


<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script src="/Content/js/lessonNav.js"></script>
</body>
</html>
