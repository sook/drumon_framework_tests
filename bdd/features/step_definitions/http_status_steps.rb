# new
Given /^(?:|I )open (.+)$/ do |page_name|
	begin
		visit path_to(page_name)
	rescue Mechanize::ResponseCodeError => exception
		@response_code = exception.response_code.to_s
	end
end


Given /^Response status should be (.+)$/ do |status|
	assert_equal status, @response_code
end