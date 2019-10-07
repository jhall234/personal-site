const canvas = document.getElementById("myCanvas");
const context = canvas.getContext("2d");
canvas.addEventListener("mousedown", getPosition);
drawHappy();
document.getElementById("canvasButton").onclick = function () {switchSmiley();}


function getPosition(event) {
	var x = event.x;
	var y = event.y;
		
	x -= canvas.offsetLeft;
	y -= canvas.offsetTop;
		
	if (inCircle(x, y, 200, 200, 150)){

		switchSmiley();
	}
	return;
}

function drawHappy() {
	context.clearRect(0, 0, canvas.width, canvas.height);
	context.beginPath();
	context.arc(200, 200, 150, 0, 2*Math.PI); //circle head
	context.lineWidth = 6;
	context.strokeStyle = "black";
	context.fillStyle = "yellow";
	context.fill();

	context.beginPath();
	context.arc(200, 200, 150, 0, 2*Math.PI); //circle head
	context.lineWidth = 6;
	context.strokeStyle = "black";
	context.stroke();

	context.beginPath();
	context.arc(150, 150, 30, 0, 2*Math.PI); //left eye
	context.fillStyle = "black";
	context.fill();

	context.beginPath();
	context.arc(250, 150, 30, 0, 2*Math.PI); //right eye
	context.fillStyle = "black";
	context.fill();

	context.beginPath();
	context.arc(200, 250, 60, 0, Math.PI); //smile
	context.stroke();
	return;
}

function drawSad() {
	context.clearRect(0, 0, canvas.width, canvas.height);
	context.beginPath();
	context.arc(200, 200, 150, 0, 2*Math.PI); //circle head
	context.lineWidth = 6;
	context.strokeStyle = "black";
	context.fillStyle = "yellow";
	context.fill();

	context.beginPath();
	context.arc(200, 200, 150, 0, 2*Math.PI); //circle head
	context.lineWidth = 6;
	context.strokeStyle = "black";
	context.stroke();

	context.beginPath();
	context.arc(150, 150, 30, 0, 2*Math.PI); //left eye
	context.fillStyle = "black";
	context.fill();

	context.beginPath();
	context.arc(250, 150, 30, 0, 2*Math.PI); //right eye
	context.fillStyle = "black";
	context.fill();

	context.beginPath();
	context.arc(200, 300, 60, 0, Math.PI, true); //frown
	context.stroke();
	return;
}

function inCircle(x, y, cx, cy, r) { //returns true if on/inside circle
	var dx = x-cx
	var dy = y-cy
	return (dx*dx)+(dy*dy) <= r*r
}

function switchSmiley() {
	var buttonText = document.getElementById("canvasButton");

	if (buttonText.innerHTML === "Make me Happy") {
		drawHappy();
		buttonText.innerHTML = "Make me Sad";
	}
	else{
		drawSad();
		buttonText.innerHTML = "Make me Happy";
	}
	return;
}