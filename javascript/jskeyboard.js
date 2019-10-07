const canvas = document.getElementById("myCanvas");
const context = canvas.getContext("2d");
var img = new Image();

const scale = 0.2;
const x_img_pixels = 471*scale;
const y_img_pixels = 347*scale;

var x_pos = 0;
var y_pos = 0;

img.onload = function() {context.drawImage(img, x_pos, y_pos, x_img_pixels, y_img_pixels);}

img.src = "../images/nicholas_cage.jpg";

window.addEventListener("keydown", dealWithKeyboard);

function dealWithKeyboard(event) {
	switch(event.keyCode) {
		case 37:
            // left key pressed
			if (x_pos >= 5){
				x_pos -= 5;
			}
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.drawImage(img, x_pos, y_pos, x_img_pixels, y_img_pixels);
            break;
        case 38:
            // up key pressed
			if (y_pos >= 5){
				y_pos -= 5;
			}
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.drawImage(img, x_pos, y_pos, x_img_pixels, y_img_pixels);
            break;
        case 39:
            // right key pressed
			if (x_pos <= canvas.width-x_img_pixels-5){
				x_pos += 5;
			}
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.drawImage(img, x_pos, y_pos, x_img_pixels, y_img_pixels);
            break;
        case 40:
            // down key pressed
			if (y_pos <= canvas.width-y_img_pixels-5){
				y_pos += 5;
			}
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.drawImage(img, x_pos, y_pos, x_img_pixels, y_img_pixels);
            break; 
	}
}

	
	