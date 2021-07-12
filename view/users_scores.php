<?php require_once __DIR__ . '/_header.php'; ?>
<h2>Rezultati kvizova</h2>
<table>
    <tr>
        <?php
        $i = 1;
        foreach ($allscores as $score) {
            if ($score != NULL) {
                $q = 'kviz' . $i;
                echo '<th>' .  $q . '</th>';
                $i++;
            }
        }
        ?>
    </tr>
    <?php
    echo '<tr>';
    foreach ($allscores as $score) {
        if ($score != NULL)   echo '<td>' . $score . '</td>';
    }

    echo '</tr>';
    ?>

</table>

<?php require_once __DIR__ . '/_footer.php'; ?>