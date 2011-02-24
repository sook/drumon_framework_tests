Feature: Check CSFR protection system
	In order to check CSFR protection
	On a basic application
	I want to see 401 unauthorized or 200 Ok

	Scenario: Valid CSFR Token
		Given I am on protected form page
		When I fill in "comment" with "Hello World"
		And I press "submit"
		Then I should see "Hello World"
	
	Scenario: Invalid CSFR Token
		Given I am on simple form page
		When I fill in "comment" with "Hello World"
		Then I press "submit" and should see status "401"
		Then I should not see "Hello World"