<?php
//This function generate radio buttons on the third form; alternate methods prior via HTML
function create_radio($value, $name) {

// create_gallon_radio() function.
echo '<input type="radio" name="' . $name .'" value="' . $value . '"';

	// Check for stickiness:
	if (isset($_POST[$name]) && ($_POST[$name] == $value)) {
		echo ' checked="checked"';
	}

	// Complete the element:
	echo "> $value ";

} // End of function.

// Calculates and returns cost
function calc($miles, $mpg, $ppg){
   $gallons = $miles / $mpg;
   $dollars = $gallons * $ppg;
   return number_format($dollars, 2);
}

$page_title = 'My Calculator';
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (isset($_POST['distance'], $_POST['gallon_price'], $_POST['efficiency']) &&
          is_numeric($_POST['gallon_price']) && is_numeric($_POST['efficiency'])){

          $hours = $_POST['distance']/65;

          // function that does the same as above
          $cost = calc( $_POST['distance'],  $_POST['efficiency'], $_POST['gallon_price']);

            echo '<div class="page-header"><h1>Calculator</h1></div>
            <p>Total cost of driving ' . $_POST['distance'] . ' miles averaging, ' . $_POST['efficiency'] . " mpg, and paying " . $_POST['gallon_price'] .
            ' is $' . $cost . ' driving 65 mph should take you ' . number_format($hours, 2) . ' hours.';
          }

          else{ // Inavlid submitted values
              echo '<div class="page-header"><h1>Error!</h1></div>
                      <p class="text-danger">Please enter a valid distance, price per gallong, and fuel efficiency.</p>';
          }
}
?>

<!-- First form, doesn't submits back to itself -->
<div class="page-header"><h1>Trip Cost Calculator (Clears out)</h1></div>
<form action="" method="post">
	<p>Distance (in miles): <input type="number" name="distance"></p>
      <p>Avg. Price Per Gallon:
          <input type="radio" name="gallon_price" value="3.00">$3.00</input>
          <input type="radio" name="gallon_price" value="3.50">$3.50</input>
          <input type="radio" name="gallon_price" value="4.00">$4.00</input>
      </p>

  <p>Fuel Efficiency: <select name="efficiency">
      <option value="10">Terrible</option>
      <option value="20">Decent</option>
      <option value="30">Very Good</option>
      <option value="50">Outstanding</option>
    </select>
  </p>
  	<p><input class="btn btn-secondary" type="submit" name="submit" value="Calculate"></p>
</form>

<!-- Third form, submits back to itself -->
<div class="page-header"><h1>Sticky Trip Cost Calculator</h1></div>
<form action="calculator.php" method="post">
	<p>Distance (in miles): <input type="number" name="distance" value="<?php if (isset($_POST['distance'])) echo $_POST['distance']; ?>"></p>
	<p>Avg. Price Per Gallon:
      <?php
        create_radio('3.00', 'gallon_price');
        create_radio('3.50', 'gallon_price');
        create_radio('4.00', 'gallon_price');
      ?>
	</p>

	<p>Fuel Efficiency: <select name="efficiency">
      <option value="10"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency'] == '10')) echo ' selected="selected"'; ?>>Terrible</option>
      <option value="20"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency'] == '20')) echo ' selected="selected"'; ?>>Decent</option>
      <option value="30"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency'] == '30')) echo ' selected="selected"'; ?>>Very Good</option>
      <option value="50"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency'] == '50')) echo ' selected="selected"'; ?>>Outstanding</option>
    </select></p>
	<p><input class="btn btn-secondary" type="submit" name="submit" value="Calculate"></p>
</form>

<?php include('includes/footer.html');?>