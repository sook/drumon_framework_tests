Feature: Check Status pages
	In order to verify http status codes 
	On a basic application
	I want to see all status found

	Scenario: Invalid URI to 404
		Given I am on "/not_found_page"
		Then the response status code should be 404
	
	Scenario: Status 404 from controller with render_erro
		Given I am on "/render-erro-page"
		Then the response status code should be 404
		
		
	Scenario: Status 403 from controller
		Given I am on "/status-403-page"
		Then the response status code should be 403