Feature: Befere and After action hooks
	In order to check controller hooks
	On a basic application
	I want to see application working

	Scenario: Test before actions
		Given I am on "/before_after/simple"
		Then I should see "Welcome Admin"
		
	Scenario: Test before only actions
		Given I am on "/before_after/test_only"
		Then I should see "Post 2"
		
	Scenario: Test before except actions calling
		Given I am on "/before_after/simple"
		Then I should see "Post 1"
		
	Scenario: Test before except actions no calling
		Given I am on "/before_after/test_only"
		Then I should see "Post 2"