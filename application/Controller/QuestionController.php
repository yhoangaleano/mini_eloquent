<?php

namespace Mini\Controller;

use Mini\Model\Question;
use Mini\Model\Log;

use Mini\Core\Controller;
use Mini\Libs\Helper;
use Mini\Libs\UtilResponse;

use \Exception;
use \PDOException;

class QuestionController extends Controller
{

    public $utilResponse = null;

    public function __construct()
    {
        $this->utilResponse = new UtilResponse();
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $question = Question::create(['question'=>  "Have you ever met your doppelganger?",'user_id'=>1]);
        $this->utilResponse->setResponse(true, 'Good Job!!', $question);
        echo json_encode($this->utilResponse);
        return;
    }

    /**
     * PAGE: exampleone
     * This method handles what happens when you move to http://yourproject/home/exampleone
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function all()
    {
        $questions = Question::all();
        $this->utilResponse->setResponse(true, 'Good Job!!', $questions);
        echo json_encode($this->utilResponse);
        return;
    }

    /**
     * PAGE: exampletwo
     * This method handles what happens when you move to http://yourproject/home/exampletwo
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function find($id)
    {
        $question = null;

        try {

            $question = Question::findOrFail($id);
            $this->utilResponse->setResponse(true, 'Good Job!!', $question);
            echo json_encode($this->utilResponse);
            return;

        } catch (Exception $e) {
            
            $logModel = new Log();
            $result = $logModel->addLog('No existe la pregunta con el ID '. $id, 'Question', $e->getCode(), $e->getMessage());
            $this->utilResponse->setResponse(false, 'Exception: No existe la pregunta con el ID '. $id, $result);
            echo json_encode($this->utilResponse);
            return;
        }
    }
}
