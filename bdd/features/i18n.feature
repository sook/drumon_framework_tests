Feature: Check internacionalization system
	In order to check i18n system
	On a basic application
	I want to see these texts translated

	Scenario: Hello World
		Given I am on "/translate"
		Then I should see "Olá Mundo"
				
	Scenario: Hello Boy
		Given I am on "/translate"
		Then I should see "Olá Garoto"