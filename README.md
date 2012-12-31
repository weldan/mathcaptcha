  Math Captcha CakePHP component 
 
  Weldan Jamili (mweldan@gmail.com)
 
  Usage:
  
  1. Put this file in your application app/Controller/Component dir 
  2. Use it.
 
  Example: 
   
    ```php
    // in controller 
    public $components = array(
        'MathCaptcha'
    );
    public function captchaForm() {
        $question = $this->MathCaptcha->getQuestion();
 
       $this->set('question', $question);
    }
    
   public function captchaProcess() {
       echo "entered answer: ".$this->request->data['captcha_answer']."<br>";
       echo "real answer: ".$this->Session->read('MathCaptcha.Answer')."<br>";
       exit;
   }
 
   // in view form  
 
 
  <fieldset>
  <legend>Answer this question:</legend>
  <form method="post" action="/controllerName/captchaProcess">
  <label><?php echo (isset($question)) ? $question : ''; ?></label>
  <input type="text" name="captcha_answer">
  <input type="submit">
  </form>
  </fieldset>
  ```
  
