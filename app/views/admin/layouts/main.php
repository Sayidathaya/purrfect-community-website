<?php
$viewFile = BASE_PATH . '/app/views/' . $view . '.php';
require BASE_PATH . '/app/views/admin/layouts/header.php';
require $viewFile;
require BASE_PATH . '/app/views/admin/layouts/footer.php';
