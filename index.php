 <!DOCTYPE html>
<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
  <link rel="stylesheet" href="style.css" type=text/css>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
   integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
   <script src="script.js"></script>
   <script type="text/javascript" src="adapter.js"></script>
   <script src="instascan.min.js"></script>
  <script>
  $(document).ready(function(){
    $("#qr").click(function(){
        qrScanner();
        $("#myModal").modal();
        
    });
});
</script>
</head>

<body onload="myfunc()">
  <div class="container-fluid">
      <div class="row">
  <div class="col-8">
    <div class="jumbatron jumbotron-fluid">
      <h1>Garbage Manager</h1>
      <p id="promo"></p>
    </div> 
  </div>
  <div class="col-4">
     <div class="button-container">
       <ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="tooltip" title="Get closest bin"><button onclick="getLoc()"><img src="binloc.png"/></button></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="tooltip" title="Redeem offers"><button id="qr"><img src="qr.png"/></button></a>
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Scan QR Code</h4>
          <button type="button" onclick="closeScanner(false, null)" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          
            <video id="preview" class="embed-responsive-item" width=90% height=90%></video>
          
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeScanner(false, null)">Close</button>
        </div>

      </div>
    </div>
  </div>
      <div class="modal" id="promomodal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Promocode</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <p id="promop" class="jumbotron-fluid">
            <span></span>
          </p>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  </li>
  
</ul> 
    
    
  </div>
  </div>
</div>
  <div class="row">
    <div class="col">
  <div id="mapid"></div>
  </div>
  </div>
 </div>
</body>
</html> 
