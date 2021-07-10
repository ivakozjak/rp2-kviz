<?php require_once __DIR__ . '/_header.php'; ?>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Is admin</th>
        <th>Score stem</th>
        <th>Score sport</th>
        <th>Score music</th>
        <th>Score film</th>
    </tr>
    <?php
    foreach ($userList as $user) {
        echo '<tr>' .
            '<td>' . $user->username . '</td>' .
            '<td>' . $user->email . '</td>' .
            '<td>' . $user->is_admin . '</td>' .
            '<td>' . $user->score_stem . '</td>' .
            '<td>' . $user->score_sport . '</td>' .
            '<td>' . $user->score_music . '</td>' .
            '<td>' . $user->score_film . '</td>' .
            '</tr>';
    }
    ?>
</table>

<?php require_once __DIR__ . '/_footer.php'; ?>