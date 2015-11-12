<?php
include_once "../../_autoload.php";
require_once BASE_DIR . "onlinetest/model/Answer.php";
require_once BASE_DIR . "onlinetest/connectionManager/DB_connection.php";
require_once BASE_DIR . "onlinetest/dao/AnswersDao.php";

/**
 * @author Maria Ostashevskaya
 */
class AnswerDaoImpl implements AnswersDao
{
    public function getAnswer($id)  //получить ответ
    {

        $sql = "SELECT `answer` FROM `answer` WHERE `id` = '$id'";

        $query_result = mysqli_query(DB_connection::db_connect(), $sql);

        $answer = null;
        while ($row = mysqli_fetch_array($query_result)) {
            $id = $row[0];
            $text = $row[1];
            $answer = new Answer($id, $text);
        }

        return $answer;
    }

    public function getAllAnswers()  //получить список ответов
    {
        $sql = "SELECT `id`, `answer`, `trueAnswer` FROM `answer` WHERE `trueAnswer`='1'";

        $query_result = mysqli_query(DB_connection::db_connect(), $sql);

        $answers = array();
        while ($row = mysqli_fetch_assoc($query_result)) {
            $answers[] = new Answer($row['id'], $row['answer'], $row['trueAnswer']);
        }

        return $answers;
    }

    public function getAnswersByQuestionsIds($questionsIds)
    {
        $query = "SELECT
                a.id
            FROM `answer` a
              INNER JOIN question_answer qa ON (qa.answer_id = a.id)
              INNER JOIN question q ON (q.id = qa.question_id)
            WHERE a.trueAnswer = '1'
            AND q.id IN (" . implode(',', $questionsIds) . ")";

        $query_result = mysqli_query(DB_connection::db_connect(), $query);

        $answers = array();
        while ($row = mysqli_fetch_assoc($query_result)) {
            $answers[] = $row['id'];
        }

        return $answers;

    }

    public function saveAnswer($answer, $trueAnswer) //сохранить ответ
    {

        $sql = "INSERT INTO `answer` (`answer`,`trueAnswer`) VALUES ('$answer','$trueAnswer')";
        $query = mysqli_query(DB_connection::db_connect(), $sql);
        if ($query) {
            return " ответ сохранён! ";
        } else {
            return "ошибка при сохранении  ответа! ";
        }

    }

    public function updateAnswer($id, $answer)  //обновить ответ
    {
        $sql = "UPDATE `answer` SET `answer`.`answer`= '$answer' WHERE `answer`.`id` IN('$id')";

        $query = mysqli_query(DB_connection::db_connect(), $sql);

        if ($query) {
            return "вопрос обновлён! ";
        } else {
            return "ошибка при обновлении вопроса! ";
        }
    }

    public function getAnswerId($answer)
    {
        $sql = "SELECT `id` FROM `answer` WHERE `answer`='$answer'";

        $id = null;
        $query_result = mysqli_query(DB_connection::db_connect(), $sql);

        while ($row = mysqli_fetch_array($query_result)) {
            $id = $row[0];
        }

        return $id;
    }

    public function getTrueAnswer($id)
    {
        $sql = "SELECT `trueAnswer` FROM `answer` WHERE `id`='$id'";

        $trueAnswer = null;
        $query_result = mysqli_query(DB_connection::db_connect(), $sql);

        while ($row = mysqli_fetch_array($query_result)) {
            $trueAnswer = $row[0];
        }

        return $trueAnswer;

    }

    public function deleteAnswer($id)// удалить ответ
    {
        $sql = "DELETE FROM  `answer` WHERE `id`='$id'";

        $query = mysqli_query(DB_connection::db_connect(), $sql);

        if ($query) {
            return "ответ № $id удалён! ";
        } else {
            return "ошибка при удалении ответа! ";
        }
    }
}
