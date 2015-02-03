@core

Feature: Create apero

 Background:
    Given there are following users:
        | name       | email              | password   | enabled |
        | Alexandre  | alexandre@mail.com | Alexandre  |   yes   |

Scenario: Calculate total price
    Given I am on "/create_apero"
    When I fill "title" with "test_title"
    When I fill "date" with "2015-10-10"
    When I fill "content" with "test_content"
    When I submit press "submit"
    Then I should be redirected on "/apero"
    Then I should message "success"
    And I should see title "test_title" 
