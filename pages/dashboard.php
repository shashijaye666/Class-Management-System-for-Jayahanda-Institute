<?php 
include('../library/config.php');

// if(isset($_POST["request"])){
//     $func = $_POST["request"];
//     $func($_POST);
// }

loadimage();

function loadimage() {
    // Assuming $level is obtained safely from $_GET["level"]
    $level = isset($_GET["level"]) ? intval($_GET["level"]) : 1; // Example default level

    // Load the image
    $img = imagecreatefromjpeg("../dist/img/classroom.jpg");

    // Check if image creation was successful
    if (!$img) {
        die('Error: Unable to load image');
    }

    // Resize the image (example: resize to 800x600)
    $resizedImg = imagescale($img, 1500, 650); // Resize to width 800 and height 600

    // Check if resizing was successful
    if (!$resizedImg) {
        die('Error: Unable to resize image');
    }

    // Define colors
    $red = imagecolorallocate($resizedImg, 255, 0, 0);    // Red
    $green = imagecolorallocate($resizedImg, 0, 150, 2); // Green
    $black = imagecolorallocate($resizedImg, 0, 0, 0);   // Black

    // Set content type header
    header('Content-type: image/jpeg');
    
    // Output the resized image
    imagejpeg($resizedImg);

    // Free up memory
    imagedestroy($resizedImg);
}






// function loadimage(){

//     $level = $_GET["level"];
    
//     $ps = new parkingslot();
//     $solts = $ps->getSlotByArea($level);
//     $img = imagecreatefromjpeg("../dist/img/B".$level.".jpg"); // or imagecreatefrompng, etc.


//     $red = imagecolorallocate($img,  255, 0, 0); //red
//     $green = imagecolorallocate($img,  0, 150, 2); //green
//     $black = imagecolorallocate($img,  0, 0, 0); //black

//     // $points = array(247,780,262,765,294,798,276,815);
//     // imagefilledpolygon($img, $points, 4, $green);

    
//     foreach ($solts as $slot) {
        
//         //$str_arr = explode (",", $slot->cords); 
//         $points = array_map('intval', explode(',', $slot->cords));

//         //echo $slot->occupied;

//         if($slot->occupied == 1)
//             imagefilledpolygon($img, $points, 4, $red);//fill
//         else
//             imagefilledpolygon($img, $points, 4, $green);//fill
            
//         imagepolygon($img, $points, 4, $black);//border
        
//     }
//     // $point1 = array(372,583,451,530,465,548,386,602);
//     // $point2 = array(784,842,804,850,761,935,739,922);

//     // imagefilledpolygon($img, $point1, 4, $red);
//     // imagefilledpolygon($img, $point2, 4, $green);

//    header('Content-type: image/jpeg;');
  
    
//    imagejpeg($img); // or imagepng(), etc.
// }

?>