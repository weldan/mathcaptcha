<?php
/**
 * Math Captcha CakePHP component 
 *
 * Weldan Jamili (mweldan@gmail.com)
 *
 * Usage:
 * 
 * 1. Put this file in your application app/Controller/Component dir 
 * 2. Use it.
 *
 * Example:
 *   //in controller  
 *   public $components = array(
 *       'MathCaptcha'
 *   );
 *   public function captchaForm() {
 *       $question = $this->MathCaptcha->getQuestion();
 *
 *      $this->set('question', $question);
 *   }
 *   
 *  public function captchaProcess() {
 *      echo "entered answer: ".$this->request->data['captcha_answer']."<br>";
 *      echo "real answer: ".$this->Session->read('MathCaptcha.Answer')."<br>";
 *      exit;
 *  }
 *
 *  //in view form  
 *
 *
 * <fieldset>
 * <legend>Answer this question:</legend>
 * <form method="post" action="/controllerName/captchaProcess">
 * <label><?php echo (isset($question)) ? $question : ''; ?></label>
 * <input type="text" name="captcha_answer">
 * <input type="submit">
 * </form>
 * </fieldset>
 * 
 */
App::uses('Component', 'Controller');

class MathCaptchaComponent extends Component {

    public $components = array(
        'Session'
    );

    // Set operation types
    protected $operations = array('/', '*', '+', '-');
    
    // Set number limit 
    protected $number_limit = 10;
    
    /**
     * Print current captcha question
     */
    public function getQuestion() {
       // Set question and answer 
       $this->_setQuestion();
       // Return value
       return $this->Session->read('MathCaptcha.Question'); 
    }
    
    /**
     * Get value of current captcha answer
     */
    public function getAnswer() {
        // Return value
        return $this->Session->read('MathCaptcha.Answer');    
    }
    
    /**
     * Set question
     */
    protected function _setQuestion() {
        // Set first number
        $first_number = $this->_getRandomNumber();
        // Set second number
        $second_number = $this->_getRandomNumber();
        // Set operation type 
        $operation = $this->_getOperation();
        // Set Question
        $question = $first_number.$operation.$second_number;
        $this->Session->write('MathCaptcha.Question', $question);
        // Set answer 
        $answer = eval('return '.$question.';');
        $this->Session->write('MathCaptcha.Answer', $answer);        
    }
    
    /**
     * Get random number
     */
    protected function _getRandomNumber() {
        // Set number to calculate
        $number = rand(1, $this->number_limit);        
        // Return value 
        return $number;
    }

    /**
     * Get math operation type
     */
    protected function _getOperation() {
        // Get random operation type      
        $type = array_rand($this->operations, 1);
        // Return value
        return $this->operations[$type];
    }     
    
}
?>
