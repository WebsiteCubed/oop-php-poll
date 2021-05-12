<?php

class Poll
{
    private $question;
    private $tableName = 'option_items';
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getOptions()
    {
        $query = "SELECT * FROM $this->tableName";

        $statement = $this->connection->prepare($query);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function submitVote()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['option_item']) && empty($_POST['option_item'])) {
                die('Please choose an option before submitting.');
            }
            $requestData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array_map('trim', $requestData);

            $query = "UPDATE $this->tableName SET count=count + 1 WHERE option_item=:option_item";

            $statement = $this->connection->prepare($query);

            $statement->bindValue(':option_item', $data['option_item'], PDO::PARAM_STR);

            if ($statement->execute()) {
                session_start();
                $_SESSION['flash'] = 'Your vote has been counted!';
                session_write_close();

                header('Location: results.php');

                exit();
            } else {
                die('Sorry, your vote could not be processed at this time.');
            }
        }
    }
}
