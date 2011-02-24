module NavigationHelpers
	def path_to(page_name)
		
		case page_name
		
		
		when /a page/
			'/'
			
		# routes
		when /home page/
			'/'

		when /about page/
			'/about'
			
		when /google page/
			'/google'
			
		when /danillos page/
			'/danillos'
			
		# CSFR
		when /protected form page/
			'/csfr'
				
		when /simple form page/
			'/csfr-invalid'	
			
		# namespace
		when /simple namespace page/	
			'/simple-namespace'
			
		when /complex namespace page/	
			'/complex-namespace'
		
		# http status
		when /invalid page/	
			'/oops'
		
		when /render erro page/
			'/render-erro-page'
			
		when /status 403 page/
			'/status-403-page'
		
		else
			raise "Can't find mapping from \"#{page_name}\" to a path.\n" +
				"Now, go and add a mapping in #{__FILE__}"
		end
	end
end

World(NavigationHelpers)
