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
    <a class="active" href="/employee">Home</a>
    <a href="tickets">Tickets</a>
    <form action="/emplogout" method="post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type="submit" value="logout">
    </form>
</div>

<div style="padding-left:16px">
    <h2>Welcome</h2>
    <p>Please complete the pending tickets asap</p>
</div>

</body>
</html>


