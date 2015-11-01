String.prototype.repeat = function(times) {
   return (new Array(times + 1)).join(this);
};

var currentExercise = 0;

var showExercise = function showExercise(exercise) {

	var append = "<div class=\"term1\"><img src=\"upload/" + exercise.path + "\" /><h3>" + exercise.english_word + "</h3></div>";
	$("#term1").html(append.repeat(exercise.term1));

	$("#term2").html("<h1>X " + exercise.term2 + "</h1>");

}

var checkAnswer = function checkAnswer() {
	var answer = $('#answerNumber').val();
	if(answer == (data[currentExercise].term1 * data[currentExercise].term2)) {
		alert("Antwoord correct!");
		if(currentExercise == (data.length -1)) {
			alert("Gefeliciteerd, u heeft alle opgaven behaald!");
			$("#term1").html("<h1>Gefeliciteerd!</h1>");
		} else {
			currentExercise += 1;
			$('#answerNumber').val("");
			showExercise(data[currentExercise]);
		}
	} else {
		alert("Helaas, antwoord is fout!");
		$('#answerNumber').val("");
	}
}

showExercise(data[currentExercise]);