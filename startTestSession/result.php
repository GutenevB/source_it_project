<!DOCTYPE html>
<html>
<head>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../res/css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../res/css/style.css" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type="text/javascript" src="../res/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../res/js/materialize.min.js"></script>
</head>
<body class="deep-orange lighten-5">

<nav>
    <div class="nav-wrapper red lighten-1">
        <a href="#" class="brand-logo right">Online-test</a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="index.php">На главную</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <?php
    include_once("../defines.php");
    require_once BASE_DIR . "/dao/ImplQuestionDao.php";
    require_once BASE_DIR . "/dao/ImplAnswerDao.php";

    session_start();

    $questionDao = new QuestionDaoImpl();
    $answerDao = new AnswerDaoImpl();

    $result = 0; // Переменная для суммы ответов
    $count = 0;

    $answersCorrect = $answerDao->getAllAnswers();
    $countQuestions = count($questionDao->getAllQuestions());//колличество вопросов
    $countTrueAnswer = count($answerDao->getAllAnswers());//колличество правильных ответов

//    print_r($_SESSION['answers']);

    if (isset($_SESSION['answers'])) {
        foreach ($_SESSION['answers'] as $valArray) {
            foreach ($valArray as $valTrueAnswer) {
                if ($valTrueAnswer == 1) {
                    $result++;
                }
            }
        }
    }
    unset($_SESSION['answers']);
    setcookie(session_name('answers'), '');
    ?>
    <table>
        <tr>
            <td>
                <h3 class=' cyan-text text-darken-3 '>Ваш результат: <?php echo $result ?> из <?php echo $countTrueAnswer ?>  </h3>
            </td>
        </tr>
    </table>
    <a href="index.php">Пройти тест ещё раз</a>

</div>
</body>
</html>