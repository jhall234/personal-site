$(document).ready(function(){
	
	var subject_selected = false;
	var check_answer_clicked = false;
	var which_subject = "";
	var answer_to_submit = 0; /*-1 = False, 0 = N/A , 1 = True*/ 
	var questions_answered = 0;
	$("form").hide();
	$("#game_over").hide();
	$("#game_over_text").hide();
		
	$("button.question_number").hover(function(){
		if (!subject_selected) {
			$(this).css("background-color", "white");
			$(this).css("color", "#998a6c");
			$("#question").text("Click to see question");
			$("#question_box").css("background-color", "white");
		}
		else {	/*If we have seleceted a subject*/		
			if(("#" + $(this).attr("id"))!= which_subject){ 
			/*If what we hovered on is not the subject clicked, change background*/ 
				$(this).css("background-color", "white");
				$(this).css("color", "#998a6c");
			}
		}
	},	
	function(){ /*when we mose the mouse away*/
		if (!subject_selected) {
			$(this).css("background-color", "#998a6c");
			$(this).css("color", "white");
			$("#question").text("");	
			$("#question_box").css("background-color", "#b7b7b7");
		}
		else{ /*If we have selected a subject*/
			if(("#" + $(this).attr("id"))!= which_subject){
			/*If what we hovered on is not the subject clicked, change background*/ 
				$(this).css("background-color", "#998a6c");
				$(this).css("color", "white");
			}
		}
	});
	
	
	$("#math").click(function(){
		if (!subject_selected){ /*If we havent selected a subject*/
			$("form").show();
			subject_selected = true;
			which_subject = "#math";
			$("#question").text("The derivative of ln(x) is e^(x) ");
			$("#question_box").css("background-color", "#b7b7b7");
			$(this).css("background-color", "#c4c4c4");
		}
		else {			
			if($(this).attr("id")!= which_subject){
				alert("You must answer the current question");
			}
		}		
	});
	
	$("#science").click(function(){
		if (!subject_selected){
			$("form").show();
			subject_selected = true;
			which_subject = "#science";
			$("#question").text("The mitochondria is the powerhouse of the cell");
			$("#question_box").css("background-color", "#b7b7b7");
			$(this).css("background-color", "#c4c4c4");
		}
		else {			
			if($(this).attr("id")!= which_subject){
				alert("You must answer the current question");
			}
		}
	});
	
	$("#history").click(function(){
		if (!subject_selected){
			$("form").show();
			subject_selected = true;
			which_subject = "#history";
			$("#question").text("WWII started in 1928");
			$("#question_box").css("background-color", "#b7b7b7");
			$(this).css("background-color", "#c4c4c4");
		}
		else {			
			if($(this).attr("id")!= which_subject){
				alert("You must answer the current question");
			}
		}
	});
	
	$("#english").click(function(){
		if (!subject_selected){
			$("form").show();
			subject_selected = true;
			which_subject = "#english";
			$("#question").text("In 'Romeo and Juliet' Romeo killed himself with poison");
			$("#question_box").css("background-color", "#b7b7b7");
			$(this).css("background-color", "#c4c4c4");
		}
		else {			
			if($(this).attr("id")!= which_subject){
				alert("You must answer the current question");
			}
		}
	});
	
	$("#true").click(function(){
		answer_to_submit = 1;
		$("#no_answer").text("");		
	});
	
	$("#false").click(function(){
		answer_to_submit = -1;
		$("#no_answer").text("");
	});
		
	$("#check_answer").click(function(){
		if (answer_to_submit == 0){
			if (subject_selected){
				$("#no_answer").text("Please select an answer");
			}
		}
		else{
			if (answer_to_submit == 1){
				switch (which_subject) {
					case "#math":
						$("#answer_list").append("<li>:-( Math</li>");
						break;
					
					case "#science":
						$("#answer_list").append("<li>:-) Science</li>");
						break;
					
					case "#history":
						$("#answer_list").append("<li>:-( History</li>");
						break;
					
					case "#english":
						$("#answer_list").append("<li>:-) English</li>");			
				}
			}
			if (answer_to_submit == -1){
				switch (which_subject) {
					case "#math":
						$("#answer_list").append("<li>:-) Math</li>");
						break;
					
					case "#science":
						$("#answer_list").append("<li>:-( Science</li>");
						break;
					
					case "#history":
						$("#answer_list").append("<li>:-) History</li>");
						break;
					
					case "#english":
						$("#answer_list").append("<li>:-( English</li>");
				}
			}
			
			/*hide that question's button, hide the radio buttons, empty question box, reset answer_to_submit=0, which_subject=""*/
			document.getElementById(true).checked = false;
			document.getElementById(false).checked = false;
			$("form").hide();
			$(which_subject).hide();
			subject_selected = false;
			check_answer_clicked = false;
			which_subject = "";
			answer_to_submit = 0;
			questions_answered = questions_answered + 1;
			if (questions_answered  == 4) {
				$("#game_over").show();
				$("#game_over_text").show();
			}
	
		}
	});
	$("#game_over").dblclick(function(){
        $("#game_over").fadeOut();        
    });
	
	
});