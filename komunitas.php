<?php
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
header('Location: ' . ($base === '' ? '' : $base) . '/komunitas', true, 301);
exit;
