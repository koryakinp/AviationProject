<!DOCTYPE html >
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Aviation Head Office</title>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
  function load() {
    var pointer = new google.maps.LatLng(43.728544, -79.607913);
    var p = {
      zoom: 15,
      center: pointer
    };
    var map = new google.maps.Map(
        document.getElementById("map"),
        p);
 
    var m = new google.maps.Marker({
        position: pointer,
        map: map,
        title:"Project Office"
    });  
 
    var displayContent = '<strong>Project Office</strong>';
    var info = new google.maps.InfoWindow({
        content: displayContent
    });
 
    google.maps.event.addListener(m, 'click', function() {
      info.open(map,m);
    });
 
  }
 
</script>
</head>
<body onload="load()">
    <div id="map"></div>
</body>
</html>

