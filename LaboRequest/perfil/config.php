<?php
$diretorios = ['uploads', 'uploads/fotos', 'uploads/curriculos'];

foreach ($diretorios as $diretorio) {
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0755, true);
    }
}
?>
