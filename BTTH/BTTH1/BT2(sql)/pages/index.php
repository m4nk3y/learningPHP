<?php
$questions = [];
$results = null;

require '../includes/conn.php';

$correct_answers = [];
$sql = "SELECT stt, dap_an FROM trac_nghiem";
$stmt = $conn->prepare($sql);
$stmt->execute(); 

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $correct_answers[$row['stt']] = trim($row['dap_an']); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['quiz_file'])) {
    $file = $_FILES['quiz_file']['tmp_name'];

    if (file_exists($file)) {
        $content = file($file);
        $question = null;

        foreach ($content as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            if (strpos($line, 'ANSWER:') === 0) {
                $question['answer'] = substr($line, 7); 
                $questions[] = $question;
                $question = null;
            } elseif (strpos($line, 'A.') === 0 || strpos($line, 'B.') === 0 || strpos($line, 'C.') === 0 || strpos($line, 'D.') === 0) {
                $question['options'][] = $line;
            } else {
                $question['question'] = $line;
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_quiz'])) {
    $questions = json_decode($_POST['questions'], true);
    $score = 0;
    $results = [];

    foreach ($questions as $index => $q) {
        $selected = $_POST["question_$index"] ?? []; 
        $selected_answers = array_map('trim', $selected);

        $question_stt = $index + 1;

        $correct_answer_from_sql = $correct_answers[$question_stt] ?? null;

        $correct_answer_from_sql = trim($correct_answer_from_sql);

        $is_correct = in_array($correct_answer_from_sql, $selected_answers);

        $results[] = [
            'question' => $q['question'],
            'is_correct' => $is_correct,
            'correct_answer' => $correct_answer_from_sql,
            'selected' => implode(',', $selected_answers),
        ];

        if ($is_correct) {
            $score++;
        }
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Bài Thi Trắc Nghiệm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<body>
    <header>
        <?php include '../includes/header.php' ?>
    </header>
    <main>
        <div class="container mt-4">
            <h1 class="text-center">Bài Thi Trắc Nghiệm</h1>

            <?php if (empty($questions) && $results === null): ?>
                <form action="" method="POST" enctype="multipart/form-data" class="mb-4">
                    <div class="mb-3">
                        <label for="quiz_file" class="form-label">Chọn tệp câu hỏi (.txt):</label>
                        <input type="file" name="quiz_file" id="quiz_file" class="form-control" accept=".txt" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Tải lên</button>
                </form>
            <?php endif; ?>

            <?php if (!empty($questions) && $results === null): ?>
                <form action="" method="POST">
                    <input type="hidden" name="questions" value='<?= json_encode($questions) ?>'>
                    <?php foreach ($questions as $index => $q): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Câu <?= $index + 1 ?>: <?= $q['question'] ?></h5>
                                <div class="options">
                                    <?php foreach ($q['options'] as $option): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="question_<?= $index ?>[]" value="<?= $option ?>" id="q<?= $index ?>_<?= $option ?>">
                                            <label class="form-check-label" for="q<?= $index ?>_<?= $option ?>">
                                                <?= $option ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" name="submit_quiz" class="btn btn-success">Nộp bài</button>
                </form>
            <?php endif; ?>

            <?php if ($results !== null): ?>
                <h3>Kết Quả:</h3>
                <p>Bạn đã trả lời đúng <?= $score ?>/<?= count($results) ?> câu.</p>

                <div class="accordion" id="resultAccordion">
                    <?php foreach ($results as $index => $result): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $index ?>">
                                <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $index ?>">
                                    Câu <?= $index + 1 ?>: <?= $result['is_correct'] ? 'Đúng' : 'Sai' ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $index ?>" data-bs-parent="#resultAccordion">
                                <div class="accordion-body">
                                    <p><strong>Câu hỏi:</strong> <?= $result['question'] ?></p>
                                    <p><strong>Đáp án đúng:</strong> <?= $result['correct_answer'] ?></p>
                                    <p><strong>Đáp án của bạn:</strong> <?= $result['selected'] ?? 'Không chọn' ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="" class="btn btn-primary mt-3">Làm lại</a>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include '../includes/footer.php' ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
