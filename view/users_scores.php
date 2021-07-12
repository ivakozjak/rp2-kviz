<?php require_once __DIR__ . '/_header.php'; ?>
<h2>Rezultati kvizova</h2>
<table>
    <tr>
        <?php
        for ($i = 1; $i < 16; $i++) {
            $q = 'kviz' . $i;
            echo '<th>' .  $q . '</th>';
        }
        ?>
    </tr>
    <?php
    echo '<tr>';
    for ($i = 1; $i < 16; $i++) {
        $kviz = 'kviz' . (string)$i;
        echo '<td>' . $allscores->$kviz . '</td>';
    }

    echo '</tr>';
    ?>

</table>

<?php require_once __DIR__ . '/_footer.php'; ?>