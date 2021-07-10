<?php require_once __DIR__ . '/_header.php'; ?>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>
    <?php
    foreach ($userList as $user) {
        echo '<tr>' .
            '<td>' . $user->username . '</td>' .
            '<td>' . $user->email . '</td>' .
            '</tr>';
    }
    ?>
</table>

<?php require_once __DIR__ . '/_footer.php'; ?>