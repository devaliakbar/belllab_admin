<?php
$conn = mysqli_connect("localhost", "root", "", "belllab_admin");
if (!$conn) {
    mysqli_error();
    die();
}
