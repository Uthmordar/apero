@core

Feature: Create apero

Scenario: Calculate total price
    Given I am on "login"
    When I fill in the following:
        | name | Alexandre |
        | password | Alexandre |
    When I submit I press "Log in"
    Then I should be redirected on "/apero/create"
    And I should see link "Log out"
    Given I am on "/apero/create"
    When I fill "title" with "test_title"
    When I fill "date" with "2015-10-10"
    When I fill "content" with "test_content"
    When I submit press "Submit"
    Then I should be redirected on "/apero"
    Then I should message "success"
    And I should see title "test_title" 
