Feature: Check namespace system
	In order to check namespace system
	On a basic application
	I want to see application working

	Scenario: Simple namespace
		Given I am on simple namespace page
		Then I should see "namespace"
	
	Scenario: Complex namespace
		Given I am on complex namespace page
		Then I should see "complex namespace"