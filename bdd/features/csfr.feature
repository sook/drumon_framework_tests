Feature: Check CSFR protection system
	In order to check CSFR protection
	On a basic application
	I want to see 401 unauthorized or 200 Ok

	Scenario: Valid CSFR Token
		Given I am on /csfr
		When I fill in "comment" with "Hello World"
		And I press "submit"
		Then I should see "Hello World"
	
	Scenario: Invalid CSFR Token
		Given I am on /csfr-invalid
		When I fill in "comment" with "Hello World"
		And I press "submit"
		Then the response status code should be 401
		And I should not see "Hello World"