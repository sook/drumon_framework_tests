Feature: Check Status pages
	In order to verify http status codes 
	On a basic application
	I want to see all status found

	Scenario: Invalid URI to 404
		Given I open invalid page
		Then Response status should be 404
	
	Scenario: Status 404 from controller with render_erro
		Given I open render erro page
		Then Response status should be 404
		
	Scenario: Status 403 from controller
		Given I open status 403 page
		Then Response status should be 403