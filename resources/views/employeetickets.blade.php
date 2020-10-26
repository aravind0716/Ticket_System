
<!DOCTYPE html>
<html>
<head><title>Employee Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<div class="topnav">
    <a href="employee">Home</a>
    <a class='active' href="tickets">New Ticket</a>
    <form action="/emplogout" method="post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type="submit" value="logout">
    </form>
</div>
<form action="empshow" method="post">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <button type="submit" value="submit">show all tickets</button>
</form>
</body>
</html>




