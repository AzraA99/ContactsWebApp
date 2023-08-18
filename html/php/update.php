
<script>
                    var selectedCountryID; // Initialize the variable to store the selected ID

                        function saveSelectedCountry(selectElement) {
                             var selectedValue = selectElement.value; // Store the selected value (ID and Name)
                             
                             var parts = selectedValue.split('|');    // Split the value by '|'
                             console.log('Selected value: ', parts);
    
                            selectedCountryID = parts[0]; // Extract the ID part
                            console.log('Selected country ID:', selectedCountryID); // Output to console (optional)
                        }

                        function populateCityDropdown() {
                            $.ajax({
                                url: 'php/get_cities.php', // PHP script to fetch cities based on selectedCountryID
                                type: 'GET',
                                data: { countryID: selectedCountryID },
                                success: function(data) {
                                    $('#cityDropdown').html(data); // Update the city dropdown options
                                }
                            });
                        }
                    </script>

<?php
include "dbConnection.php";

// Handle editing
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $sql_select = "SELECT * FROM users WHERE ID = $edit_id";
    $res_select = mysqli_query($conn, $sql_select);
    $row_select = mysqli_fetch_assoc($res_select);

    // Assign selected user data to variables
    $firstname = $row_select['firstname'];
    $lastname = $row_select['lastname'];
    $phone = $row_select['phone'];
    $gender = $row_select['gender'];
    $email = $row_select['email'];
    $country = $row_select['country'];
    $city = $row_select['city'];
    $u_date = $row_select['u_date'];
    $age = $row_select['age'];

    // Echo HTML form with populated values
    echo '
        <form method="post" action="php/update.php">
            <input type="hidden" name="edit_id" value="' . $edit_id . '">
            <input type="text" id="firstname" name="firstname" value="' . $firstname . '">
            <input type="text" id="lastname" name="lastname" value="' . $lastname . '">
            <input type="text" id="phone" name="phone" value="' . $phone . '">
            <select id="gender" name="gender">
                <option value="male"' . ($gender === 'male' ? ' selected' : '') . '>Male</option>
                <option value="female"' . ($gender === 'female' ? ' selected' : '') . '>Female</option>
            </select><br><br>
            <input type="email" id="email" name="email" value="' . $email . '">
            <select id="countries" name="countries" onchange="saveSelectedCountry(this); populateCityDropdown()">
              <option value="">Select a country</option>';
              // Fetch countries from the database
              
              $query_country = "SELECT * FROM countries";
              $result_country = mysqli_query($conn, $query_country);

              while ($row_country = mysqli_fetch_assoc($result_country)) {
                  echo '<option value="' . $row_country['ID'] . '|' . $row_country['Name'] . '">' . $row_country['Name'] . '</option>';
              }


  echo '
            </select>            
            <select class="formbold-form-input" id="cityDropdown" name="city">
              <option value="">Select a city</option>
              ';              
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
              
      echo'
            </select>            
          <input type="date" id="u_date" name="u_date" value="' . $u_date . '">
            <input type="number" id="age" name="age" value="' . $age . '">
            <button type="submit" name="ok">OK</button>
            <button type="button" onclick="location.href=\'index.php\'">Cancel</button>
        </form>
        
    ';
}

if (isset($_POST['ok'])) {
    $edit_id = $_POST['edit_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $country = $_POST['countries'];
    $city = $_POST['city'];
    $u_date = $_POST['u_date'];
    $age = $_POST['age'];
    list($selectedCountryID, $selectedCountryName) = explode('|', $_POST["countries"]);

    // Update query
    $sql_update = "UPDATE users 
                   SET firstname='$firstname', lastname='$lastname', phone='$phone', gender='$gender', 
                       email='$email', country='$selectedCountryID', city='$city', u_date='$u_date', age='$age'
                   WHERE ID='$edit_id'";

    if (mysqli_query($conn, $sql_update)) {
        // Redirect back to the form page after successful update
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }
}
?>
