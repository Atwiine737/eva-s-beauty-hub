<?php
header('Content-Type: text/html; charset=utf-8');
echo '<h2>File Check</h2>';
echo '<h3>Root files (.jpeg):</h3><ul>';
$files = glob('*.jpeg');
foreach ($files as $f) {
    echo '<li>' . $f . ' (' . filesize($f) . ' bytes) - <img src="' . $f . '" width="100"></li>';
}
echo '</ul>';
echo '<h3>images/ files (.jpeg):</h3><ul>';
$files = glob('images/*.jpeg');
foreach ($files as $f) {
    echo '<li>' . $f . ' (' . filesize($f) . ' bytes) - <img src="' . $f . '" width="100"></li>';
}
echo '</ul>';
echo '<h3>images/ files (.jpg):</h3><ul>';
$files = glob('images/*.jpg');
foreach ($files as $f) {
    echo '<li>' . $f . ' (' . filesize($f) . ' bytes) - <img src="' . $f . '" width="100"></li>';
}
echo '</ul>';
?>
