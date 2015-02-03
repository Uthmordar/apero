<?php
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\Behat\Context\Step;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\Mink\Driver\GoutteDriver;

use Illuminate\Foundation\Testing\ApplicationTrait;
/**
 * Defines application features from the specific context.
 */
class LogContext extends MinkContext{
    protected $user;
    protected $data;
    
    use ApplicationTrait;
 
    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct(){
    }
 
    /**
     * @BeforeScenario
     */
    public function setUp(){
        if(!$this->app){
            $this->refreshApplication();
        }
    }
 
    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication(){
        $unitTesting = true;
        $testEnvironment = 'testing';
        return require __DIR__.'/../../bootstrap/start.php';
    }
    
     /**
     * @Given there are following users:
     */
    public function thereAreFollowingUsers(TableNode $table){
        $this->user=$table;
    }

     /**
     * @When I visit :arg1
     */
    public function iVisit($arg1){
        $this->call('GET', $arg1);
    }

    /**
     * @When I submit I press :arg1
     */
    public function iSubmitIPress($arg1){
       $this->pressButton($arg1);
       
    }

    /**
     * @Then I should be redirected on :arg1
     */
    public function iShouldBeRedirectedOn($arg1){
        $this->assertPageAddress($arg1);
    }

    /**
     * @Then I should see link :arg1
     */
    public function iShouldSeeLink($arg1){
        $this->assertPageContainsText($arg1);
    }
}
