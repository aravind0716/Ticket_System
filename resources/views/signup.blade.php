<!DOCTYPE html>
<html>
<head><title>Ticketing System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        background: #f6f5f7;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
        margin: -20px 0 50px;
    }

    .inline {
        padding: 10px;
        display: inline-flex;
        float: left;
        clear: none;
    }

    label {
        float: left;
        clear: none;
        display: flex;
        padding: 0 17px 0 0;
    }

    input[type=radio],
    input.radio {
        float: left;
        clear: none;
        margin: 3px 14px 0 0;
    }

    h1 {
        font-weight: bold;
        margin: 0;
    }

    h2 {
        text-align: center;
    }

    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 12px;
    }

    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    form {
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 50px;
        height: 100%;
        text-align: center;
    }

    input {
        background-color: #eee;
        border: none;
        padding: 12px 15px;
        margin: 8px 4px;
        width: 100%;
    }
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }
    .tab button:hover {
        background-color: #ddd;
    }

    .tab button.active {
        background-color: #ccc;
    }

    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 200px;
        width: 50%;
        z-index: 5;
    }
</style>
</head>
<body>
    <div class="form-container sign-in-container">
        <form action="/create" method="post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <h1>Sign Up</h1>
            <input type="text" id="cname" name="cname" placeholder="Your Name"/>
            <input type="text" id="mail" name="mail" placeholder="Email ID" />
            <input type="password" id="password" name="password" placeholder="Password" />
            @if (count($errors) > 0)
                <div class = "alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="submit" id="sign_up"/>
        </form>
    </div>
</body>
</html>

