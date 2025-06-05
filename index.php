<?php

require_once("require/database_connection.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Curd App</title>
</head>

<body>

    <p id="msg" style="color:blue; " align="center" ></p>

    <div id="get_form" align="center">

    </div>
    <br>
    <div id="search-div" align="center" >
        <fieldset>
            <legend>search here!...</legend>
            <input type="text" name="search" id="search" style="width: 500px;">
            <button onclick="search()">Search</button>
            <button onclick="show_users()">show all</button>
        </fieldset>
    </div>
    <br>

    <div id="show_users" align="center">

    </div>

    <script>
        function get_form() {
            var ajax_request = null;

            if (window.XMLHttpRequest) {
                ajax_request = new XMLHttpRequest;
            } else {
                ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
            }

            ajax_request.onreadystatechange = function() {
                if (ajax_request.readyState == 4 && ajax_request.status == 200) {
                    document.getElementById("get_form").innerHTML = ajax_request.responseText;
                }
            }
            ajax_request.open("GET", "process.php?action=get_form");
            ajax_request.send();
        }
        get_form();

        function show_users() {
            var ajax_request = null;

            if (window.XMLHttpRequest) {
                ajax_request = new XMLHttpRequest;
            } else {
                ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
            }

            ajax_request.onreadystatechange = function() {
                if (ajax_request.readyState == 4 && ajax_request.status == 200) {
                    document.getElementById("show_users").innerHTML = ajax_request.responseText;
                    document.getElementById("search").value = "";
                    cancel();
                }
            }

            ajax_request.open("POST", "process.php");
            ajax_request.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            ajax_request.send("action=show_data");
        }
        show_users();

        function search() {
            var ajax_request = null;
            var search = document.getElementById("search").value;
            

            if (window.XMLHttpRequest) {
                ajax_request = new XMLHttpRequest;
            } else {
                ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
            }

            ajax_request.onreadystatechange = function() {
                if (ajax_request.readyState == 4 && ajax_request.status == 200) {
                    document.getElementById("show_users").innerHTML = ajax_request.responseText;
                    
                }
            }

            
            ajax_request.open("POST", "process.php");
            ajax_request.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            ajax_request.send("action=show_data&search=" + search);
        }

        function cancel() {
            document.getElementById("first_name").value = ""
            document.getElementById("middle_name").value = ""
            document.getElementById("last_name").value = ""
            document.getElementById("email").value = ""
            document.getElementById("phone_number").value = ""
            document.getElementById("search").value = "";
            

        }

        function add_user() {
            var first_name = document.getElementById("first_name").value;
            var middle_name = document.getElementById("middle_name").value;
            var last_name = document.getElementById("last_name").value;
            var email = document.getElementById("email").value;
            var phone_number = document.getElementById("phone_number").value;

            var ajax_request = null;
            if (window.XMLHttpRequest) {
                ajax_request = new XMLHttpRequest;
            } else {
                ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
            }

            ajax_request.onreadystatechange = function() {
                if (ajax_request.readyState == 4 && ajax_request.status == 200) {
                    document.getElementById("msg").innerHTML = ajax_request.responseText;
                    show_users();
                }
            }

            ajax_request.open("POST", "process.php");
            ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            ajax_request.send("action=add_user" + "&first_name=" + first_name + "&middle_name=" + middle_name + "&last_name=" + last_name + "&email=" + email + "&phone_number=" + phone_number);
        }

        function delete_user(user_id) {

            var ajax_request = null;
            if (window.XMLHttpRequest) {
                ajax_request = new XMLHttpRequest;
            } else {
                ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
            }

            ajax_request.onreadystatechange = function() {
                if (ajax_request.readyState == 4 && ajax_request.status == 200) {
                    document.getElementById("msg").innerHTML = ajax_request.responseText;
                    show_users();
                }
            }

            ajax_request.open("POST", "process.php");
            ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            ajax_request.send("action=delete_user&user_id="+user_id);
        }

        function edit_user(user_id){
            var ajax_request = null;

            if (window.XMLHttpRequest) {
                ajax_request = new XMLHttpRequest;
            } else {
                ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
            }

            ajax_request.onreadystatechange = function() {
                if (ajax_request.readyState == 4 && ajax_request.status == 200) {
                    document.getElementById("get_form").innerHTML = ajax_request.responseText;
                }
            }
            ajax_request.open("GET", "process.php?action=edit_user&user_id="+user_id);
            ajax_request.send();
        }

        function update_user(user_id){
            var first_name = document.getElementById("first_name").value;
            var middle_name = document.getElementById("middle_name").value;
            var last_name = document.getElementById("last_name").value;
            var email = document.getElementById("email").value;
            var phone_number = document.getElementById("phone_number").value;

            var ajax_request = null;

            if (window.XMLHttpRequest) {
                ajax_request = new XMLHttpRequest;
            } else {
                ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
            }

            ajax_request.onreadystatechange = function() {
                if (ajax_request.readyState == 4 && ajax_request.status == 200) {
                    document.getElementById("msg").innerHTML = ajax_request.responseText;
                    show_users();
                    get_form();
                    
                }
            }

            ajax_request.open("POST","process.php");
            ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax_request.send("action=update_user" + "&first_name=" + first_name + "&middle_name=" + middle_name + "&last_name=" + last_name + "&email=" + email + "&phone_number=" + phone_number+"&user_id="+user_id);
        }

        
    </script>
</body>

</html>