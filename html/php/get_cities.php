<?php include "dbConnection.php";
// get_cities.php
if (isset($_GET['countryID'])) {
    $selectedCountryID = $_GET['countryID'];
    // Fetch cities for the selected country from the database
    $queryCity = "SELECT * FROM cities WHERE CountryID = $selectedCountryID";
    $resultCity = mysqli_query($conn, $queryCity);
    
    if(mysqli_num_rows($resultCity) > 0) {
        while($cityRow = mysqli_fetch_assoc($resultCity)) {
            echo '<option value="' . $cityRow['ID'] . '">' . $cityRow['Name'] . '</option>';
        }
    } else {
        echo '<option value="">No cities found</option>';
    }
}
?>
