@log

Feature: Sign in to the website
    In order to access the administrative interface
    As a visitor
    I need to be able to log in to the website

    Scenario: Log in with username and password
        Given I am on "login"
        When I fill in the following:
            | name | Alexandre |
            | password | Alexandre |
        When I submit I press "Log in"
        Then I should be redirected on "/create_apero"
        And I should see link "Log out"

    Scenario: Log in with bad credentials
        Given I am on "login"
        When I fill in the following:
            | name | bar@foo.com |
            | password | bar     |
        And I press "Log in"
        Then I should be on "/login"
        And I should see "Pas de correspondance username/password"