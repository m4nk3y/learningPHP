<?php
if (!isset($_GET['file']) || empty($_GET['file'])) {
    echo "Không tìm thấy tệp quiz.";
    exit;
}

$filename = '../quizfile/' . $_GET['file'];
if (!file_exists($filename)) {
    echo "Tệp quiz không tồn tại.";
    exit;
}

$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$current_question = [];
$all_questions = [];

foreach ($questions as $line) {
    if (strpos($line, "ANSWER:") !== false) {
        $current_question[] = $line;
        $all_questions[] = $current_question;
        $current_question = [];
    } else {
        $current_question[] = $line;
    }
}

if (!empty($current_question)) {
    $all_questions[] = $current_question;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answers = [];
    foreach ($questions as $line) {
        if (strpos($line, "ANSWER:") !== false) {
            $answers[] = trim(substr($line, strpos($line, ":") + 1));
        }
    }

    $score = 0;
    foreach ($_POST as $key => $userAnswer) {
        $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
        if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
            $score++;
        }
    }

    echo "<div class='alert alert-success text-center'>";
    echo "Bạn trả lời đúng <strong>$score</strong>/" . count($answers) . " câu.";
    echo "</div>";
    echo "<a href='" . $_SERVER['PHP_SELF'] . "?file=" . $_GET['file'] . "' class='btn btn-primary'>Làm lại</a>";
    exit;
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Bài trắc nghiệm</h1>
    <form method="post">
        <?php foreach ($all_questions as $index => $question): ?>
            <div class="card mb-4">
                <div class="card-header"><strong><?php echo $question[0]; ?></strong></div>
                <div class="card-body">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <?php $answer = substr($question[$i], 0, 1); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question<?php echo $index + 1; ?>" value="<?php echo $answer; ?>" id="question<?php echo $index + 1 . $answer; ?>">
                            <label class="form-check-label" for="question<?php echo $index + 1 . $answer; ?>">
                                <?php echo $question[$i]; ?>
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
        
        <div style="display: flex; justify-content:center; margin-bottom: 20px;">
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </div>        
    </form>
</div>
