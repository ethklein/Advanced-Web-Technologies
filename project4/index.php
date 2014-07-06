<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Weight Converter</title>

    <!-- Bootstrap Core CSS -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Custom Theme CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">
                    <i class="fa fa-play-circle"></i>  <span class="light">Fortini - Klein - Grant</span>: Weight Converter
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <section class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Weight Converter</h1>
                      <div class="page-scroll">
                            <a href=".form-group" class="btn btn-circle">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="col-md-5 col-md-offset-3">
             <form class="form-horizontal" action="index.php" method="POST">
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="text" id="weight" name="weight" class="weight" required autofocus>
                </div>

                <div class="form-group"> 
                    <div class="checkbox-inline">  
                        <label for="ounces">Ounces to Grams</label>
                        <input type="radio" name="conversion" id="ounces" value="ounces">
                     </div>

                     <div class="checkbox-inline"> 
                        <label for="grams">Grams to Ounces</label>
                        <input type="radio" name="conversion" id="grams" value="grams">
                     </div><br>
                    <div class="checkbox-inline"> 
                        <label for="ouncesP">Ounces to Pounds</label>
                        <input type="radio" name="conversion" id="ouncesP" value="ouncesP">
                    </div>
                    <div class="checkbox-inline">
                        <label for="pounds">Pounds to Ounces</label>
                        <input type="radio" name="conversion" id="pounds" value="pounds">
                    </div><br>
                    <div class="checkbox-inline"> 
                        <label for="ouncesMg">Ounces to Mg</label>
                        <input type="radio" name="conversion" id="ouncesMg" value="ouncesMg">
                    </div>
                    <div class="checkbox-inline">
                        <label for="Mg">Mg to Ounces</label>
                        <input type="radio" name="conversion" id="Mg" value="Mg">
                    </div>
                 </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        
<?php
function sanitizeString($str)
{
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return $str;
}
//conversion from ounces to grams
function toGrams($ounces)
{
    return $ounces/(.035274); 
}
//conversion from grams to ounces
function toOunces($grams)
{
    return $grams * (.035274); 
}

function toPounds($ounces){
  return $ounces * .0625;
}

function lbsToOunces($pounds){
  return $pounds/.0625;
}

function toMg($ounces){
  return $ounces*28349.5;
}

function mgToOunces($mg){
  return $mg/28349.5;
}

if(isset($_POST['weight']))
{
    // sanitize temperature
    $weight = sanitizeString($_POST['weight']);
    
    $output = "Error!";
    if (is_Numeric($weight)){
    // creates the string to display the successful conversion of ounces to grams or grams to ounces
        if(isset($_POST['conversion']) && $_POST['conversion'] === 'grams')
        {
            $output = $weight . " g == " . toOunces($weight) . " Oz";
        }
        else if(isset($_POST['conversion']) && $_POST['conversion'] === 'ounces')
        {
            $output = $weight . " Oz == " . toGrams($weight) . " g";       
        }
        else if(isset($_POST['conversion']) && $_POST['conversion'] === 'ouncesP')
        {
            $output = $weight  ." Oz == " . toPounds($weight) . " lbs";
        } 
        else if(isset($_POST['conversion']) && $_POST['conversion'] === 'pounds')
        {
            $output = $weight . " lbs == " . lbsToOunces($weight) . " Oz";
        }
        else if(isset($_POST['conversion']) && $_POST['conversion'] === 'ouncesMg')
        {
            $output = $weight . " Oz == " . toMg($weight) . " Mg";
        }
        else if(isset($_POST['conversion']) && $_POST['conversion'] === 'Mg')
        {
            $output = $weight . " Mg == " . mgToOunces($weight) . " Oz";
        }
    }
    // print temperature
    echo $output . "<br>" . "<br>" . "<br>";
}
?>   
        </div>
    </div>

    

    <!-- Core JavaScript Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
