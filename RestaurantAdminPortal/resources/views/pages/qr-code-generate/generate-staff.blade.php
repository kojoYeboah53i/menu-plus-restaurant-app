<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Staff QR Code</title>
    <style>

    </style>
</head>
<body>
    <div class="container mt-3 pt-3">
        <div class="row justify-content-center">
            <div class="col-2">
                <div class="row justify-content-center">
                    <img src="data:image/png;base64,{{ base64_encode(@file_get_contents(url($restaurant->logo)))}}" style="width: 150px; height: 100px;"/>
                </div>
            </div>
        </div><br><br>
        <div class="row justify-content-center mb-2">
            <div class="col-5">
                <div class="row justify-content-center">
                    <h5>QR Code for {{$restaurant->name}} Staffs</h5>
                </div>
            </div>
        </div><br>
        <div class="row justify-content-center mb-2">
            <div class="col-5">
                <div class="row justify-content-center">
                    <h4>Scan Below QR Code to Open Portal</h4>
                </div>
            </div>
        </div><br><br>
        <div class="row justify-content-center mb-1">
            <div class="col-3">
                <div class="row justify-content-center">
                    <img src="data:image/png;base64,{!! base64_encode($image) !!}" class="img img-fluid" style="width:200px; height:200px;"/>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="row justify-content-center">
                    <h5>Powered By <strong>MENUPLUS</strong></h5>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

