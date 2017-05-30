<!--
File name: functions.php
Date created: 20/04/2017
Purpose of file:
    > Create a master file of referenceable functions.
-->
<head>
    <link rel='stylesheet'  type='text/css' href='stylesheet.css'>
</head>
<?PHP
    function loginDB(){
        /*
        > Define required things
        > Connect to DB
        > ???
        > Profit
        */

        global $db;

        define('DB_NAME', 'FlowerPotMen');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'password');
        define('DB_HOST', 'localhost');

        $db = mysqli_connect(DB_HOST ,DB_USER ,DB_PASSWORD ,DB_NAME)
        or die('Error connecting to MySQL server.');

        $_SESSION['db'] = $db;

    }

    function checkDB($debug){
        global $db;

        $query = "SELECT * FROM users";
        if(mysqli_query($db, $query) or die('checkDB returned Error querying database.')){
            if($debug == '1'){
                echo "Database connection successful. Testing with: '" . $query . "'";
            }
            return true;
        }
    }

    function verifyUser($user, $pass){
        /*
        > Destory previous session through Logout()
            > The reason we do this is to fix the bug where if you log in as an admin, and then manually
                navigate to index.php and sign in as a normal user, you would be signed in as an admin
                because those $_SESSION supervariables still exist in the system for the admin account.
        > Check for active connection to DB
        > Verify UserName
        > Verify PassWord
        > Return UAC level to be run through defineUAC()
        */

        

        global $db;

        $query = "SELECT * FROM users WHERE userName = '{$user}'";
        mysqli_query($db, $query) or die('Error querying database.');

        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);

        if ($row['userName'] == $user) {
            /* Username valid. Check for password. */
            if ($row['password'] == $pass) {
                /* Password valid. Posting SESSION and Getting UAC level. */
                
                $_SESSION['POST_User'] = $_POST['userName'];
                $_SESSION['POST_Pass'] = $_POST['passWord'];

                $UAC = $row['Staff'];
                defineUAC($UAC);
            } else {
                /* Handle invalid password. */
                header("Location: index.php?error=invalidPassword");
                exit();
            }
        } else {
            /* Handle invalid username. */
            header("Location: index.php?error=invalidUsername");
            exit();       
        }

        mysqli_close($db);
    }

    function defineUAC($UAC_User){
        switch ($UAC_User){
            case "1":
                $_SESSION['UAC_Level'] = "User";
                break;
            case '2':
                $_SESSION['UAC_Level'] = 'Staff';
                break;
            case '3':
                $_SESSION['UAC_Level'] = 'Admin';
                break;
            case '4':
                $_SESSION['UAC_Level'] = 'Owner';
                break;
            default:
                $_SESSION['UAC_Level'] = 'Visitor';
                break;
        }
    }

    function hyper($input){
        /*
            This function takes an input and converts it into a hyperlink/GET request.
            Mainly used for the Main Header Table and Left Sidebar on most pages, the point 
            of having this function is to ensure the code below doesn't become stupidly 
            long and retains readbility.
        */

        switch($input){
            case "Home":
                return "<a href='home.php'>Home</a>";
                break;
            case "Properties":
                return "<a href='properties.php'>Properties</a>";
                break;
            case "Users":
                return "<a href='users.php'>Users</a>";
                break;
            case "Staff":
                return "<a href='staff.php'>Staff</a>";
                break;
            case "Admins":
                return "<a href='admins.php'>Admins</a>";
                break;
            case "Logout":
                return "Welcome " . $_SESSION['POST_User'] . " (" . $_SESSION['UAC_Level'] . ")<br><a href='index.php?logout=true'>Logout</a>";
                break;
            case "New User":
                return "<a href=users.php?action=New><input style='leftSidebar' type='button' value='New User'></a>";
                break;
            case "View Users":
                return '<a href=users.php?action=View><input style="leftSidebar" type="button" value="View Users"></a>';
                break;
            case "Edit Users":
                return '<a href=users.php?action=Edit><input style="leftSidebar" type="button" value="Edit Users"</a>';
                break;
            case "Delete Users":
                return '<a href=users.php?action=Delete><input style="leftSidebar" type="button" value="Delete Users"</a>';
                break;
            default:
                return "<a href='home.php'>Error</a>";
        }
    }

    function Logout(){
        session_unset();
        session_destroy();
    }

    function writeMenu($UAC_Level){
        global $UAC_Level;

        $OwnerMenuList = array(hyper("Home"), hyper("Properties"), hyper("Users"), hyper("Staff"), hyper("Admins"), hyper("Logout"));
        $AdminMenuList = array(hyper("Home"), hyper("Properties"), hyper("Users"), hyper("Staff"), hyper("Logout"));
        $StaffMenuList = array(hyper("Home"), hyper("Properties"), hyper("Users"), hyper("Logout"));
        $UserMenuList = array(hyper("Home"), hyper("Properties"), hyper("Logout"));
        $VisitorMenuList = array(hyper("Home"), hyper("Properties"), hyper("Logout"));
        
        /* 
            Here we pray that the session stuff is working as it should. 
            There should probably be a check in here somewhere. TODO probs.
        */
        
        echo "<div class='MainHeaderTable'>";
        echo "<table>";
        echo "<tr>";

        switch ($_SESSION['UAC_Level']){
            case "Owner":
                for($x = 0; $x < count($OwnerMenuList); $x++){
                    echo "<th>" . $OwnerMenuList[$x] . "</th>";
                }
                break;
            case "Admin":
                for($x = 0; $x < count($AdminMenuList); $x++){
                    echo "<th>" . $AdminMenuList[$x] . "</th>";
                }
                break;
            case "Staff":
                for($x = 0; $x < count($StaffMenuList); $x++){
                    echo "<th>" . $StaffMenuList[$x] . "</th>";
                }
                break;
            case "User":
                for($x = 0; $x < count($UserMenuList); $x++){
                    echo "<th>" . $UserMenuList[$x] . "</th>";
                }
                break;
            default:
                for($x = 0; $x < count($VisitorMenuList); $x++){
                    echo "<th>" . $VisitorMenuList[$x] . "</th>";
                }
                break;
        }

        echo "</tr>";
        echo "</table>";
        echo "</div>";
    }

    function POSTtoSESSION($user, $pass){
        /*
            This just takes the POST username and passwords and converts
            them to SESSION variables, this allows us to refer back to
            them from other pages. Dunno why it's in functions.php when
            it's only reference by home.php, but it seems to work here
            so I'm not game enough to move it.
        */  
        $_SESSION['POST_User'] = $_POST[$user];
        $_SESSION['POST_Pass'] = $_POST[$pass];
    }

    function returnShortPropertyList($searchParam, $searchValue){
        /*
            > Connect to DB
            > Search Table
            > Probably store values in array
            > Cycle array and produce a list.
            > This is gonna take a while. 
        */

        loginDB();

        global $db;
        global $SearchResults;

        switch($searchParam){
            case "Suburb":
                //$query = "SELECT * FROM properties WHERE suburb = '{$searchValue}'";
				$query = "SELECT * FROM properties WHERE suburb LIKE '%{$searchValue}%'";
                break;
            case "Post":
                $query = "SELECT * FROM properties WHERE postcode = '{$searchValue}'";
                break;
            case "Bed":
                $query = "SELECT * FROM properties WHERE bed = '{$searchValue}'";
                break;
            case "Bath":
                $query = "SELECT * FROM properties WHERE bath = '{$searchValue}'";
                break;
            case "Car":
                $query = "SELECT * FROM properties WHERE car = '{$searchValue}'";
                break;
            case "minWeeklyRent"://--added
                $query = "SELECT * FROM properties WHERE weeklyRent >= '{$searchValue}'";
                break;
            case "maxWeeklyRent"://--added
                $query = "SELECT * FROM properties WHERE weeklyRent <= '{$searchValue}'";
                break;
            case "*":
                $query = "SELECT * FROM properties";
                break;
            default:
                /* 
                    The only way that this default clause could be triggered is that if 
                    the user manually changes the searchParam GET value. In this case
                    we'll return them to properties.php with an error message.
                */
                header("Location: properties.php?error=invalidSearchParam");
                exit();
        }
        
        mysqli_query($db, $query) or die('Error querying database.');

        $queryResult = mysqli_query($db, $query);

        $ResultCount = 0;
        $SearchResults = array (
                    array("uniqueCode"),
                    array("address"),
                    array("suburb"),
                    array("postcode"),
                    array("bed"),
                    array("bath"),
                    array("car"),
                    array("description"),
                    array("image")
        );

        $xyz = 0;
        while ($row = $queryResult->fetch_assoc()) {
            
            $SearchResults[$xyz][0] = $row['uniqueCode'];
            $SearchResults[$xyz][1] = $row['address'];
            $SearchResults[$xyz][2] = $row['suburb'];
            $SearchResults[$xyz][3] = $row['postcode'];
            $SearchResults[$xyz][4] = $row['bed'];
            $SearchResults[$xyz][5] = $row['bath'];
            $SearchResults[$xyz][6] = $row['car'];
            $SearchResults[$xyz][7] = $row['description'];
            $SearchResults[$xyz][8] = $row['image'];
			//---added
			$SearchResults[$xyz][9] = $row['weeklyRent'];
//--
            $ResultCount++;
            $xyz++;
        }

        if(empty($queryResult)){
            echo "<br><br>Sorry, there were no results that matched your search.<br>Please try again with different search parameters.";
        } else {
            if (!$_GET['searchParam'] == "*"){
                echo "<div class='NumSearchResults'>Returned " . $ResultCount . " result(s) for " . $_GET['searchValue'] . " ordered by: " . $_GET['searchParam'] . ".</div><br><br>";
            } else {
                echo "<div class='NumSearchResults'>Showing all properties.</div><br><br>";
            }
            /*
                The below code basically generates a table for each search result that comes back.
                Personally I hate the way this code looks, and I don't like how everything isn't
                tabulated or anything. It looks like shit frankly but for the moment there's
                no other way I can think to do this.

                So programatically what is actually happening is this:
                    > We have one variable, TableToPrint, and it's getting cycled through, with
                    little pieces of the table HTML being added on, and in between the PHP variables
                    are being printed out. At the end this TableToPrint is added onto another variable,
                    TablesToPrint. 
                    > When TablesToPrint is finished, then it is printed and that will be our search results.
            */

            $TableToPrint = "";
            $TablesToPrint = "";

            for($i = 0; $i < $xyz; $i++){
                $TableToPrint = "";
                $TableToPrint = $TableToPrint . "<table class='SmallPropertyListing'><tr><th colspan='3' >Unique Property Code: ";

                $TableToPrint = $TableToPrint . $SearchResults[$i][0];
                $TableToPrint = $TableToPrint . "<tr><th colspan='3'>Address: ";
                $TableToPrint = $TableToPrint . $SearchResults[$i][1];
                $TableToPrint = $TableToPrint . "</th></tr><tr><td colspan='2'><b>Suburb:</b> ";
                $TableToPrint = $TableToPrint . $SearchResults[$i][2];
                $TableToPrint = $TableToPrint . "</td><td><b>Post Code:</b> ";
                $TableToPrint = $TableToPrint . $SearchResults[$i][3];
                $TableToPrint = $TableToPrint . "</td></tr><tr><td><b>Beds:</b> ";
                $TableToPrint = $TableToPrint . $SearchResults[$i][4];
                $TableToPrint = $TableToPrint . "</td><td><b>Baths:</b> ";
                $TableToPrint = $TableToPrint . $SearchResults[$i][5];
                $TableToPrint = $TableToPrint . "</td><td><b>Cars:</b> ";
                $TableToPrint = $TableToPrint . $SearchResults[$i][6];
                $TableToPrint = $TableToPrint . "</td></tr><tr><td colspan='2' rowspan='4'><b>Description:</b><br>";
                $TableToPrint = $TableToPrint . $SearchResults[$i][7];
				
				
//--added
                $TableToPrint = $TableToPrint . "</td><td><b>Weekly Rent:</b> ";
                $TableToPrint = $TableToPrint . $SearchResults[$i][9];

//--

                /* Handling the photo here. */
                $ImageAddress = $SearchResults[$i][8];
                if ($ImageAddress == ""){
                    $TableToPrint = $TableToPrint . "</td><td rowspan='3'><b>Photo missing.</b><br><img src='images/pingu.jpg' class='SolidBorder'>"; 
                } else {
                    $TableToPrint = $TableToPrint . "</td><td rowspan='3'><b>Photo:</b><br><img src=images/" . $SearchResults[$i][8] . " class='SolidBorder'>";
                }
                
                $TableToPrint = $TableToPrint . "</td></tr><tr></tr><tr></tr><tr><td><a href=propertylisting.php?id=" . $SearchResults[$i][0] . ">More Information</a>";
                $TableToPrint = $TableToPrint . "</td></tr></table><br><br>";

                $TablesToPrint = $TablesToPrint . $TableToPrint;
            }
            echo $TablesToPrint;
        }
        mysqli_close($db);
        }//end returnShortPropertyList



    function writeLeftSidebar($input){
        switch(strtolower($input)){
            case 'users':
                $MenuToPrint = array("New User", "View Users", "Edit Users", "Delete Users");
                break;
            case 'properties':
                $MenuToPrint = array("New Property", "View Properties", "Edit Properties", "Delete Properties");
            default:
                /* Probably should think of something to put here. */
        }

        /* Echoing the table, based on the above switch case." */
        echo "<table class='leftSidebar'><th><b>Navigation Menu</b></th><br>";

        for($i = 0; $i < count($MenuToPrint); $i++){
            echo "<tr><td>" . hyper($MenuToPrint[$i]) . "</td></tr><br>";
        }
        echo "</table>";
    }

    function returnUACName($input){
            switch ($input){
                case '1':
                    return "User";
                    break;
                case '2':
                    return "Staff";
                    break;
                case '3':
                    return 'Admin';
                    break;
                case '4':
                    return 'Owner';
                    break;
                default:
                    return "Vistor";
            }
        }

    function writeUserList($options){

        /*
            Function = writes a user list
            $options - View/Edit
                Viewing users just shows the tables
                Edit includes a check box for the user to select and edit in another page.
        */

        $query = "SELECT * FROM users";
        $queryResult = mysqli_query($_SESSION['db'], $query) or die('Error querying database.');

        switch ($options){
            case 'View':
                echo "<div class='usersTable'><table><th>User Name</th><th>Password</th><th>User Access Level</th>";

                while ($row = $queryResult->fetch_assoc()) {
                    echo "<tr><td>" . $row['userName'] . "</td><td>" . $row['password'] . "</td><td>" . returnUACName($row['Staff']) . "</td></tr>";
                }
                break;
            case 'Edit':                
                echo "<form action='users.php' method='POST'>";
                echo "<div class='usersTable'><table><th>User to Edit</th><th>User Name</th><th>Password</th><th>User Access Level</th>";

                while ($row = $queryResult->fetch_assoc()) {
                    $Output = "<tr><td><input type='radio' name='userToEdit' value='" . $row['userName'] . "'></td>";
                    $Output = $Output . "<td>" . $row['userName'] . "</td><td>" . $row['password'] . "</td><td>" . returnUACName($row['Staff']) . "</td></tr>";
                    
                    echo $Output;
                }
                echo "</table>";
                echo "<br><input type='submit' value='Edit Selected User'></form>";
                break;
            case 'Delete':
                echo "<form action='users.php' method='POST'>";
                echo "<div class='usersTable'><table><th>User to Delete</th><th>User Name</th><th>Password</th><th>User Access Level</th>";

                while ($row = $queryResult->fetch_assoc()) {
                    $Output = "<tr><td><input type='checkbox' name='userToDelete' value='" . $row['userName'] . "'></td>";
                    $Output = $Output . "<td>" . $row['userName'] . "</td><td>" . $row['password'] . "</td><td>" . returnUACName($row['Staff']) . "</td></tr>";
                    
                    echo $Output;
                }
                echo "</table>";
                echo "<br><input type='submit' value='Delete Selected User'></form></div>";
                break;
            default:
                /* Probably should think of something to put here. */
        }
    }

    function echoMap($AddressOriginal){
        global $LatLng;

        /*
            The first block of code takes the address in the form:
                106 Blah Blah Road, Fairyland
            and turns it into co-ordinates that gMaps can read.
            The second block then echos the Javascript script to 
            show the map object.
        */

        $Address = urlencode($AddressOriginal);
        $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
        $xml = simplexml_load_file($request_url) or die("url not loading");
        $status = $xml->status;
        if ($status=="OK") {
            $Lat = $xml->result->geometry->location->lat;
            $Lon = $xml->result->geometry->location->lng;
            $LatLng = "$Lat,$Lon";
            echo <<<EOL
<div id="map" style="width:500px;height:500px;margin:auto;"></div>

<script>
function myMap() {
  var mapCanvas = document.getElementById("map");
  var myCenter = new google.maps.LatLng(
EOL;

        echo $LatLng;
    
        echo <<<EOL
);
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas,mapOptions);
  var marker = new google.maps.Marker({position: myCenter});
  marker.setMap(map);
}

  var infowindow = new google.maps.InfoWindow({
    content: "
EOL;
    
        echo $AddressOriginal;

        echo <<<EOL
"
  });
  infowindow.open(map,marker);
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ9Cvf5punc60HM2DoyPlI69E1fnPqIgc&callback=myMap"></script>
EOL;

        } else {
            echo "There was an error with the map. It is possible Google Maps can't find the address.";
        }


        
        }
?>