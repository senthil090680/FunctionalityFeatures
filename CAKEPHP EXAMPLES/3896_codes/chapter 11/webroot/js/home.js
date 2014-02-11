Event.observe(window, 'DOMContentLoaded', function() { 
	 Event.observe('QuestionHomeForm', 'submit', checkQuestionNotEmpty);
}); 

function checkQuestionNotEmpty(event) {
	if($F('QuestionQuestion') == '') {
		Event.stop(event);
		$('js_errors').innerHTML = "Cannot Enter Empty Question";
		$('js_errors').show();
		$('QuestionQuestion').focus();
	}
}