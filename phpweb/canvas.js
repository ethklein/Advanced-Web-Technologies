// Upload button should have the id imageLoader!
var imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);
var canvas = document.getElementById('original');
var preview = document.getElementById('preview');
var context = canvas.getContext('2d');
var color;
function handleImage(e) {
	var reader = new FileReader();
	reader.onload = function(event) {
		var image = new Image();
		image.onload = function() {
            console.log(image.width + 'x' + image.height);
			
			var w = image.width;
			var h = image.height;
			var scalar = 1.0;
			
            //new image resizer using the scaleSize function
            var arrayValues = scaleSize(350,350, w, h);
            w = arrayValues[0];
            h = arrayValues[1];
            
            
            
			canvas.width = w;
			canvas.height = h;
			context.drawImage(image, 0, 0, h, w);

			preview.width = canvas.width;
			preview.height = canvas.height;
			preview.getContext('2d').drawImage(canvas, 0, 0);
		}
		image.src = event.target.result;
	}
	reader.readAsDataURL(e.target.files[0]);
}
//new images resizer - max width and height are 350
function scaleSize(maxW, maxH, currW, currH){

              var ratio = currH / currW;

              if(currW >= maxW && ratio <= 1){
                currW = maxW;
                currH = currW * ratio;
              } else if(currH >= maxH){
                currH = maxH;
                currW = currH / ratio;
              }

              return [currW, currH];
            }

