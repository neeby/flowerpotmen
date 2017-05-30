<HTML>
    <title>
        Property Management System Name That I Can't Think Of
    </title>

    <?php
        //Required Declarations

        define("db_Name", "FlowerPotMen");
        define("db_User", "root");
        define("db_Password", "password");
        define("db_Host", "localhost");
    
        //Connecting to db
        $db = mysqli_connect(db_Host, db_User, db_Password, db_Host)
        or die("There was an error when connecting to the MySQL server.");
    
        //Functions
        function messageBox(message_Input){
            echo("<script>alertBox(message_Input)</script>");
        }
    
    ?>

    

    <head>

        //Popup Scripting
        <script>
        function alertBox(messageBox_Input){
            alert(messageBox_Input);
        }
        </script>

    </head>

    <body>
        <h1>Property Management System</h1>
        <?php
            //Pulling details from previous page.

            $user_ID = $_POST["userName"];
            $user_Pass = $_POST["password"];

            //Do the queue on the db
            $db_Query = "SELECT * FROM Users WHERE userName = '{$user_ID}'";
            mysqli_query($db, $db_Query) 
            or die("There was an erorr querying database.");

            $result = mysqli_query($db, $db_Query);
            $row = mysqli_fetch_array($result);

            if ($row['userName'] == $user_ID) {
                echo ("Username " . $user_ID . " found <br>");
                if ($row['password'] == $user_Pass) {
                    echo ("password correct");
                    
                } else {
                    echo ("password not correct");
                }
            } else {
                echo ("Username " . $user_ID . " not found <br>");
            }

            //Close le DB
            mysqli_close($db);

        ?>
    </body>



</HTML>
