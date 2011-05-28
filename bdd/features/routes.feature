Feature: Check System routes
	In order to check all routes
	On a basic application
	I want to be able to access this pages

	Scenario: Show home page
		Given I am on /
		Then I should see "Bem Vindo"
	
	Scenario: Visit about page
		Given I am on about
		Then I should see "about_test"
	
	@javascript
	Scenario: Test redirect router
		Given I go to /danillos
		Then the url should be match "http://www.danillocesar.com.br/"
		
	Scenario: Test get variables from request
		Given I am on /variables/var_1?query=var_2
		Then I should see "var_1"
		And I should see "var_2"