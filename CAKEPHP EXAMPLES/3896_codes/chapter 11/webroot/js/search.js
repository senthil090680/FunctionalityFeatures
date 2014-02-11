Event.observe(window, 'DOMContentLoaded', function() { 
	 Event.observe('showOthersQuestion', 'click', showUserSearchForm);
}); 

function showUserSearchForm(event) {
	$('user_search_form').show();
}