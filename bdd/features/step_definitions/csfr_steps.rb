# new
Then /^I press "([^"]*)" and should see status "([^"]*)"$/ do |buttom, status|
	begin
		click_button(buttom)
	rescue 	Mechanize::ResponseCodeError => exception
		assert_equal '401', exception.response_code
	end
end