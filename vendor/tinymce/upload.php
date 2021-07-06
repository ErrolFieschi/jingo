<?php
$accepted_origins = array("http://localhost", "http://jingo.ovh", "https://jingo.ovh/");
$imageFolder = "images/";
reset($_FILES);

$temp = current($_FILES);
if (is_uploaded_file($temp['tmp_name'])) {
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Same-origin requests won't set an origin. If the origin is set, it must be valid.
        if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        } else {
            header("HTTP/1.1 403 Origin Denied");
            return;
        }
    }

    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.1 400 Invalid file name.");
        return;
    }

    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png", "jpeg", "svg"))) {
        header("HTTP/1.1 400 Invalid extension.");
        return;
    }

    $fileName = 'import-' . date('Y-m-d-H-i-s') . '.' . pathinfo($temp['name'], PATHINFO_EXTENSION);
    $filetowrite = $imageFolder . $fileName;
    move_uploaded_file($temp['tmp_name'], $filetowrite);

    echo json_encode(array('location' => '/vendor/tinymce/' . $filetowrite));
} else {
    header("HTTP/1.1 500 Server Error");
}