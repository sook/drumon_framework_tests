Feature: Check System routes
	In order to check all routes
	On a basic application
	I want to be able to access this pages

	Scenario: Show home page
		Given I am on home page
		Then I should see "Bem Vindo"
	
	Scenario: Visit about page
		Given I am on about page
		Then I should see "about_test"