<?php
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Illuminate\Foundation\Testing\ApplicationTrait;
/**
 * Defines application features from the specific context.
 */
class CreateContext extends MinkContext implements SnippetAcceptingContext{
    use ApplicationTrait;
 
    public function __construct(){
    }
 
    /**
    * @BeforeScenario
    */
    public function setUp(){
        if(!$this->app){
            $this->refreshApplication();
        }
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }
 
    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication(){
        $unitTesting = true;
        $testEnvironment = 'testing';
        return require __DIR__.'/../../../../bootstrap/start.php';
    }

    /**
     * @When I submit I press :arg1
     */
    public function iSubmitIPress($arg1){
       $this->pressButton($arg1); 
    }

    /**
     * @Then I should see link :arg1
     */
    public function iShouldSeeLink($arg1){
        $this->assertPageContainsText($arg1);
    }
    /**
     * @Given I am logged in
     */
    public function iAmLoggedIn(){
        //Auth::attempt(['name'=>'Alexandre', 'password'=>'Alexandre'], false);
    }
    
     /**
     * @Given I test page :arg1
     */
    public function iTestPage($arg1){
        $this->assertPageAddress($arg1);
    }
    
    /**
     * @When I fill :arg1 with :arg2
     */
    public function iFillWith($arg1, $arg2){
        $this->fillField($arg1, $arg2);
    }

    /**
     * @When I submit press :arg1
     */
    public function iSubmitPress($arg1){
        $this->pressButton($arg1);
    }

    /**
     * @Then I should be redirected on :arg1
     */
    public function iShouldBeRedirectedOn($arg1){
       $this->assertPageAddress($arg1);
    }

    /**
     * @Then I should message :arg1
     */
    public function iShouldMessage($arg1){
        $this->assertPageContainsText($arg1);
    }

    /**
     * @Then I should see title :arg1
     */
    public function iShouldSeeTitle($arg1){
        $this->assertPageContainsText($arg1);
    }
    
    /**
     * @Given I should see :arg1
     */
    public function iShouldSee($arg1){
         $this->assertPageContainsText($arg1);
    }
    
    /**
     * @Given I delete the last Apero
     */
    public function iDeleteTheLastApero(){
        //Apero::truncate();
    }
}
