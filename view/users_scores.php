<?php require_once __DIR__ . '/_header.php'; ?>
<h2>Rezultati kvizova</h2>
<table>
    <tr>
        <th>Stem</th>
        <th>Sport</th>
        <th>Music</th>
        <th>Film</th>
    </tr>
    <?php
    echo '<tr>' .
        '<td>' . $allscores->score_stem . '</td>' .
        '<td>' . $allscores->score_sport . '</td>' .
        '<td>' . $allscores->score_music . '</td>' .
        '<td>' . $allscores->score_film . '</td>' .
        '</tr>';
    ?>
</table>

<?php require_once __DIR__ . '/_footer.php'; ?>