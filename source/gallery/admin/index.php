<?php
$gallerypage = $_SERVER["HTTP_REFERER"];
header("Location: ../../{$gallerypage}?p=initadmin");
?>