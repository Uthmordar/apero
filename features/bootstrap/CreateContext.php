<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class CreateContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
    
        /**
     * @Given there are following users:
     */
    public function thereAreFollowingUsers(TableNode $table)
    {
        
    }
    
     /**
     * @Given I am on :arg1
     */
    public function iAmOn($arg1)
    {
        
    }

    /**
     * @When I fill :arg1 with :arg2
     */
    public function iFillWith($arg1, $arg2)
    {
        
    }

    /**
     * @When I submit press :arg1
     */
    public function iSubmitPress($arg1)
    {
        
    }

    /**
     * @Then I should be redirected on :arg1
     */
    public function iShouldBeRedirectedOn($arg1)
    {
       
    }

    /**
     * @Then I should message :arg1
     */
    public function iShouldMessage($arg1)
    {
        
    }

    /**
     * @Then I should see title :arg1
     */
    public function iShouldSeeTitle($arg1)
    {
        
    }
}
