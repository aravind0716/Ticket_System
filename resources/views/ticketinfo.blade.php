
<!DOCTYPE html>
<html>
<head><title>Customer Home Page</title>
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
    <a href="customer">Home</a>
    <a href="newticket">New Ticket</a>
    <a class='active' href="ticketinfo">Ticket Info</a>
    <form action="/">
        <input type="submit" value="logout">
    </form>
</div>
<form action="showt" method="post">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <button type="submit" value="submit">show all tickets</button>
</form>
</body>
</html>



