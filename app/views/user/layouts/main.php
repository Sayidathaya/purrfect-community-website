<?php
$viewFile = BASE_PATH . '/app/views/' . $view . '.php';
require BASE_PATH . '/app/views/user/layouts/header.php';
require $viewFile;
require BASE_PATH . '/app/views/user/layouts/footer.php';
