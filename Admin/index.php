<?php
if (!headers_sent()) {
    header("Location: admin.php");
    exit;
}