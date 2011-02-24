
Then /^URL should be "(.+)"$/ do |url|
	assert_equal url, current_url
end