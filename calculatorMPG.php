<?php

function calc($miles, $mpg, $ppg){
    $gallons = $miles /$mpg;
    $dollars = $gallons * $ppg;
    return number_format($dollars, 2);
}

$page_title = 'Calculator MPG';
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['distance'], $_POST['gallon_price']
    , $_POST['efficiency'], $_POST['speed']) && is_numeric($_POST['gallon_price']) && is_numeric($_POST['efficiency']) 
    && is_numeric($_POST['distance']) && is_numeric($_POST['speed'])){

        $speed = $_POST['speed'];
        $hours = $_POST['distance']/$speed;
        
        $cost = calc($_POST['distance'], $_POST['efficiency'], $_POST['gallon_price']);

        echo '<div class="page-header"><h1>Calculator</h1></div>
        <p>Total cost of driving ' . $_POST['distance'] . ' miles averaging, ' . $_POST['efficiency'] . " mpg, and paying " . $_POST['gallon_price'] .
        ' per gallon is $' . $cost . ' driving ' . $speed . ' mph should take you ' . number_format($hours, 2) . ' hours.';
    }
    else{ // Invalid entry message
        echo '<div class="page-header"><h1>Error!</h1></div>
        <p class="text-danger">Please enter a valid distance, price per gallon, and fuel efficiency.</p>';
    }
}
?>

<!-- First form, doesn't submits back to itself -->
<div class="page-header"><h1>Trip Cost Calculator (Clears out)</h1></div>
<form class="row g-3" action="" method="post">
    <div class="col-md-6">
        <label class="form-label">Distance (in miles): </label> 
        <input class="form-control" type="number" name="distance" step="0.01">
    </div><p></p>
    <div class="col-md-6">
        <label class="form-label">Avg. Price Per Gallon: </label> 
        <input class="form-control" type="number" name="gallon_price" step="0.01">
    </div><p></p>
    <div class="col-md-6">
        <label class="form-label">Avg. Speed (MPH): </label> 
        <input class="form-control" type="number" name="speed" step="0.01">
    </div><p></p>
    <div class="col-md-6">
        <label class="form-label">Fuel Efficiency: </label> 
        <input class="form-control" type="number" name="efficiency" step="0.01">
    </div>
        <p><input class="btn btn-secondary" type="submit" name="submit" value="Calculate"></p>
</form>

<!-- Second form, submits back to itself -->
<div class="page-header"><h1>Sticky Trip Cost Calculator</h1></div>
<form class="row g-3" action="calculatorMPG.php" method="post">
    <div class="col-md-6">
        <label class="form-label">Distance (in miles): </label> 
        <input class="form-control" type="number" name="distance" value="<?php if (isset($_POST['distance'])) echo $_POST['distance']; ?>" step="0.01">
    </div><p></p>
    <div class="col-md-6">
        <label class="form-label">Avg. Price Per Gallon: </label> 
        <input class="form-control" type="number" name="gallon_price" value="<?php if (isset($_POST['gallon_price'])) echo $_POST['gallon_price']; ?>" step="0.01">
    </div><p></p>
    <div class="col-md-6">
        <label class="form-label">Avg. Speed (MPH): </label> 
        <input class="form-control" type="number" name="speed" value="<?php if (isset($_POST['speed'])) echo $_POST['speed']; ?>" step="0.01">
    </div><p></p>
    <div class="col-md-6">
        <label class="form-label">Fuel Efficiency: </label> 
        <input class="form-control" type="number" name="efficiency" value="<?php if (isset($_POST['efficiency'])) echo $_POST['efficiency']; ?>" step="0.01">
    </div>
        <p><input class="btn btn-secondary" type="submit" name="submit" value="Calculate"></p>
</form>

<?php include('includes/footer.html'); ?>
