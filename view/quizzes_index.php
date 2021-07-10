<?php require_once __DIR__ . '/_header.php';

foreach ($quizList as $quiz) {
    $name = strtolower($quiz->name); //tako je spremljeno u mapi app
    $path = dirname($_SERVER['PHP_SELF']);
    echo '<img src="' . $path . '/app/' . $name . '.jpg" width="240" height="80" class="image_quiz">' .
        '<p>' . $quiz->name . '</p>';
}

require_once __DIR__ . '/_footer.php';
