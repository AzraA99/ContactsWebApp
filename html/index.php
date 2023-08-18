<?php
    include "php/dbConnection.php";
    include "php/update.php";
    include "php/delete.php";
    include "php/submit.php";
    include "php/get_cities.php";
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Contact form</title>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleFormButton = document.getElementById('toggleFormButton');
        const formSection = document.getElementById('formSection');

        toggleFormButton.addEventListener('click', function() {
            formSection.classList.toggle('hidden');
        });
    });
</script>

<style>
    /* Button styles */
    #toggleFormButton {
        margin: 20px;
        margin-left: 45%;
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }
</style>
   
</head>
<body>
<button id="toggleFormButton">Toggle Form</button>
<div id="formSection" class="formbold-main-wrapper hidden">
    <div class="formbold-form-wrapper">
        <form name="contactForm" onsubmit="return fullFormValidation()" action="" method="POST">
            <div class="formbold-main-wrapper">
            <div class="formbold-form-wrapper">
                <form name="contactForm" onsubmit="return fullFormValidation()" action="" method="POST">
                    <div class="formbold-mb-5">
                        <label for="firstname" class="formbold-form-label" maxlength="50"> First Name </label>
                        <input
                            type="text"
                            name="firstname"
                            id="firstname"
                            placeholder="First Name"
                            class="formbold-form-input"
                        /> <h3 id="info-text1"></h3>
                    </div>
                    <div class="formbold-mb-5">
                        <label for="lastname" class="formbold-form-label" maxlength="50"> Last Name </label>
                        <input
                            type="text"
                            name="lastname"
                            id="lastname"
                            placeholder="Last Name"
                            class="formbold-form-input"
                        /> <h3 id="info-text2"></h3>
                    </div>
                    <div class="formbold-mb-5">
                        <label for="phone" class="formbold-form-label" maxlength="50"> Phone Number </label>
                        <input
                            type="number"
                            name="phone"
                            id="phone"
                            placeholder="Enter your phone number"
                            class="formbold-form-input"
                        /> <h3 id="info-text3"></h3>
                    </div>
    <div class="formbold-mb-5">
                    <label for="gender" class="formbold-form-label"> Gender </label>
                    <select class="formbold-form-input" id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    </select>
                </div> 
                <div class="formbold-mb-5">
                    <label for="email" class="formbold-form-label"> Email Address </label>
                    <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter your email"
                    class="formbold-form-input"
                    /> 
                </div>

                <div class="formbold-mb-5">
                    <label for="countries" id="country" name="countries" class="formbold-form-label">Country:</label>
                    <select class="formbold-form-input" id="countries" name="countries" onchange="saveSelectedCountry(this); populateCityDropdown()">
                        <option value="">Select a country</option>
                        <?php
                            // Fetch countries from the database
                            $query_country = "SELECT * FROM countries";
                            $result_country = mysqli_query($conn, $query_country);

                            while ($row_country = mysqli_fetch_assoc($result_country)) {
                                echo '<option value="' . $row_country['ID'] . '|' . $row_country['Name'] . '">' . $row_country['Name'] . '</option>';
                            }
                        ?>
                    </select>
                    
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
                </div>
                <div class="formbold-mb-5">
                    <label for="city" id="city" class="formbold-form-label">City</label>
                    <select class="formbold-form-input" id="cityDropdown" name="city">
                        <option value="">Select a city</option>
                    </select>

                </div>
                <div class="flex flex-wrap formbold--mx-3"> 
                <div class="w-full sm:w-half formbold-px-3">
                    <div class="formbold-mb-5 w-full">
                    <label for="date" class="formbold-form-label"> Date of birth </label>
                    <input
                        type="date"
                        name="u_date"
                        id="u_date"
                        class="formbold-form-input"
                    /> 
                    </div>
                </div>
                <div class="w-full sm:w-half formbold-px-3">
                    <div class="formbold-mb-5">
                    <label for="time" class="formbold-form-label"> Age </label>
                    <input
                        type="number"
                        name="age"
                        id="age"
                        class="formbold-form-input"
                    /> 
                    </div>
                </div>
                </div>
                
                <div>
                <input type="submit" class="formbold-btn" name="submit" value="Submit">
                </div> <h3 id="info-text"></h3>
            </form>
            </div>
        </div>
        </form>
    </div>
</div>

<div id="tableContainer">
<?php
$query = "SELECT u.*, c.Name AS country_name, ct.Name AS city_name
          FROM users u
          LEFT JOIN countries c ON u.country = c.ID
          LEFT JOIN cities ct ON u.city = ct.ID";
$res = mysqli_query($conn, $query);

if (!$res) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($res) > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Last name</th><th>Phone</th><th>Gender</th><th>Email</th><th>Country</th><th>City</th><th>Date</th><th>Age</th><th>Edit</th><th>Delete</th></tr>";

    while ($row = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['country_name'] . "</td>";
        echo "<td>" . $row['city_name'] . "</td>"; // Display city name
        echo "<td>" . $row['u_date'] . "</td>";
        echo "<td>" . $row['age'] . "</td>";
        echo "<td><a href='?edit=" . $row['ID'] . "'>Edit</a></td>";
        echo "<td><a href='?delete=" . $row['ID'] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}
?>

</div>

    <script src="js/validation.js"></script>
    
</body>
</html>
