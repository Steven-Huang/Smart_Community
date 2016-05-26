<?php

$src=$_GET['src'];
if (file_exists($src)) {
    unlink($src);
}