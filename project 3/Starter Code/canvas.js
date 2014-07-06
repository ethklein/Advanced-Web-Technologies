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


// Handle radio buttons and apply corresponding image filters
//added sinCity functionality and pinhole functionality
function handleClick(myRadio)
{
    // keep this
    ResetCanvas();
    
	switch(myRadio.value)
	{
		case "greyscale":
			Caman("#preview", function() {
				this.greyscale();
				this.render();
			});
			break;
		case "lomo":
			Caman("#preview", function() {
				this.lomo();
				this.render();
			});
			break;
		case "pinhole":
			// add code here
            Caman("#preview", function() {
                this.pinhole();
                this.render();
            });
			break;
		case "sinCity":
			// add code here 
            Caman("#preview", function() {
                this.sinCity();
                this.render();
            });
			break;
		default:
			break;
	}
}

// This must be called everytime before applying a filter
function ResetCanvas()
{
    // Use the identity matrix while clearing the canvas
    preview.getContext('2d').setTransform(1, 0, 0, 1, 0, 0);
    preview.getContext('2d').clearRect(0, 0, preview.width, preview.height);
    preview.getContext('2d').drawImage(canvas,0,0);
    Caman("#preview", function(){
        this.revert();
        this.revert();
    });
    
}

//new function that changes the color of the text and titles on the postcard
//asigns the color to a variable named color, which is later assigned to the parent.innerHTML color
function changeColor(myRadio) {
  
      
  
      switch(myRadio.value){
    
        case "red":
          color = "red";
          
          break;
        case "blue":
          color = "blue";
          
          break;
        case "green":
          color = "green";
          
          break;
        case "purple":
          color = "purple";
          
          break;
        default:
          break;
  
    }
  
  
}



// This function will process the form
function submit()
{
    

    // Read values from form
    var title = document.getElementById("title").value;
    var text = document.getElementById("text").value;
    
    // Save filtered image in a variable
    var filteredImage = preview;
 
    
    // Manipulate DOM:
    // 1. Clean up (remove) old stuff
    var parent = form.parentElement;
    while (form.firstChild) {
        form.removeChild(form.firstChild);
    }
    
    
    //2. Posting image and text/title to the page
    parent.innerHTML = '<h2>' + title + '</h2><p>' + text + '</p>';
    //changes the color of the text. -> took very long to finally get this working!
    parent.style.color = color;
    parent.appendChild(filteredImage);
    
}

