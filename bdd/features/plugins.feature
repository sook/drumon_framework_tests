Feature: Check plugins and Hooks
	In order to plugins e hooks
	On a basic application
	I want to be able to view these texts

	Scenario: Test all hooks is called
		Given I am on /
		Then I should see "on_complete"