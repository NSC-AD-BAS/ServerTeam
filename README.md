# ServerTeam

This is the Server Team Repo.  If you're not on the server team, please create a new repo in the org!  kthxbye!  :)

#PRISM PHP Design:

#login_system.php

Functions:	
	- validate_login(username, password)
		Ensure's the person is logged out ant no session is active
		Takes in username and password as POST parameters, and validates them by
		querying the databate looking for users with those stored credentials.
		Redirects to START if invalid credentials, calls start_session() otherwise
	- start_session(user_ID)
		Starts session and stores the passed User_ID as a session variable.
		Queries the database to see what kind of user this is, and then stores the 
		user type as a session variable as well. calls the correct
		populate_page.php function depending on the type of user.
	- is_logged_in()
		returns whether or not the session is active by checking if the USER_ID session
		variable is set.
	- end_session()
		destroys this user's session and redirects to the login page

#populate_page.php

note: these methods will call login_system.php's is_logged_in method to check if session is active

Functions:
	- print_internship_list()
		if user is logged in, and session is active, query the database for all internships,
		print the ListView div to the page body with the resulting elements from that query.
		else, do nothing
	- search_internship_list()
		if user is logged in, and session is active, and 's' GET parameter is set,
		save the GET parameter for plain text search, query the database for all
		internships containing one or more elements containing the saved GET
		parameter, print the ListView div to the page body with the resulting
		elements from that query.
		else, do nothing
	- print_org_list()
		if user is logged in, and session is active, query the database for all organizations,
		print the ListView div to the page body with the resulting elements from that query.
		else, do nothing
	- search_org_list()
		if user is logged in, and session is active, and 's' GET parameter is set,
		save the GET parameter for plain text search, query the database for all
		organizations containing the saved GET parameter, print the ListView div
		to the page body with the resulting elements from that query.
		else, do nothing
	- print_student_list()
		todo: make sure this user has the right access level to see this
		if user is logged in, and session is active, query the database for all students,
		print the ListView div to the page body with the resulting elements from that query.
		else, do nothing
	- search_student_list()
		todo: make sure this user has the right access level to see this
		if user is logged in, and session is active, and 's' GET parameter is set,
		save the GET parameter for plain text search, query the database for all
		students STARTING WITH the saved GET parameter, print the ListView div
		to the page body with the resulting elements from that query.
		else, do nothing
	- print_faculty_list()
		todo: make sure this user has the right access level to see this
		if user is logged in, and session is active, query the database for all students,
		print the ListView div to the page body with the resulting elements from that query.
		else, do nothing
	- search_faculty_list()
		todo: make sure this user has the right access level to see this
		if user is logged in, and session is active, and 's' GET parameter is set,
		save the GET parameter for plain text search, query the database for all
		students STARTING WITH the saved GET parameter, print the ListView div
		to the page body with the resulting elements from that query.
		else, do nothing

	- print_internship_detail()
		todo: make sure this user has the right access level to see this
		todo: make sure this function can find the internship_ID GET parameter
		todo: make sure to add event handlers for "edit" button in client-side Javascript

		if user is logged in, and session is active, print the DetailView div to the page
		body with elements returned from referencing the database view that was created
		to handle the internship detail view.
		If this user is of type ADMIN or FACULTY, also print "edit" button
		else, do nothing

	- print_student_detail()
		todo: make sure this user has the right access level to see this
		todo: make sure this function can find the student_ID GET parameter
		todo: make sure to add event handlers for "edit" button in client-side Javascript

		if user is logged in, and session is active, print the DetailView div to the page
		body with elements returned from referencing the database view that was created
		to handle the student detail view.
		If this student Id matches the Student ID GET parameter, print "edit" button
		If this user is of type ADMIN or FACULTY, also print "edit" button
		else, do nothing

	- print_org_detail()
		todo: make sure this user has the right access level to see this
		todo: make sure this function can find the organization_ID GET parameter
		todo: make sure to add event handlers for "edit" button in client-side Javascript

		if user is logged in, and session is active, print the DetailView div to the page
		body with elements returned from referencing the database view that was created
		to handle the student detail view.
		If this user is of type ADMIN or FACULTY, also print "edit" button
		else, do nothing

	- print_faculty_detail()
		todo: make sure this user has the right access level to see this
		todo: make sure this function can find the faculty_ID GET parameter
		todo: make sure to add event handlers for "edit" button in client-side Javascript

		if user is logged in, and session is active, and this user is of type ADMIN or FACULTY, print the DetailView div to the page body with elements returned from referencing the database view "" that was created to handle the faculty detail view, and the "edit" button.
		else, do nothing

#edit_fields.php
