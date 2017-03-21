<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>Simple markers </title>
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="styles.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
    crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>

  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
    
    #map {
      height: 50%;
      float: right;
      width: calc(70% - 10px);
    }
    
    .nav {
      float: left;
      width: 30%;
      margin-left: 10px;
    }

    .table{
      margin-left: 15px;
    }
  </style>
</head>

<body>

  <div class="row" style="height: 100%;">
    <div class="nav">
      <ul class="list-group" id="list">
      </ul>
    </div>
    <div id="map"></div>
    <table id="myTable" class="table table-condensed">
      <thead>
        <tr>
          <th>Jour</th>
          <th>Matin</th>
          <th>Aprèm</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>


  <script>
    var arrayMarker = [];
    var navActive;
    var list = JSON.parse(<?php echo json_encode($_SESSION['list'])?>);

    function initMap() {

      var myLatLng = {
        lat: parseFloat(list.PUDO_ITEMS.PUDO_ITEM[0].LATITUDE.replace(",", ".")),
        lng: parseFloat(list.PUDO_ITEMS.PUDO_ITEM[0].LONGITUDE.replace(",", "."))
      };

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: myLatLng
      });

      console.log(list);
      for (let i = 0; i < list.PUDO_ITEMS.PUDO_ITEM.length; i++) {
        var myLatLng = {
          lat: parseFloat(list.PUDO_ITEMS.PUDO_ITEM[i].LATITUDE.replace(",", ".")),
          lng: parseFloat(list.PUDO_ITEMS.PUDO_ITEM[i].LONGITUDE.replace(",", "."))
        };

        var infowindow = new google.maps.InfoWindow({
          content: list.PUDO_ITEMS.PUDO_ITEM[i].ADDRESS1 + " " + list.PUDO_ITEMS.PUDO_ITEM[i].CITY
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: list.PUDO_ITEMS.PUDO_ITEM[i].NAME,
          html: list.PUDO_ITEMS.PUDO_ITEM[i].ADDRESS1 + " " + list.PUDO_ITEMS.PUDO_ITEM[i].CITY
        });

        marker.addListener('click', function () {
          var navAc = document.getElementById(i);
          if (navActive) {
            navActive.classList.remove("active");
          }
          navActive = navAc;
          navAc.classList.add('active');
          infowindow.setContent(this.html);
          infowindow.open(map, this);
          map.setZoom(13);
          map.setCenter(this);
          showTable(i);
        });
        arrayMarker.push(marker);
        var node = document.createElement("LI");
        var textnode = document.createTextNode(list.PUDO_ITEMS.PUDO_ITEM[i].NAME);
        node.appendChild(textnode);
        node.classList.add('list-group-item');
        node.setAttribute("id", i);
        var element = document.getElementById("list").appendChild(node);
        element.addEventListener('click', function () {
          if (navActive) {
            navActive.classList.remove("active");
          }
          navActive = this;
          this.classList.add('active');
          infowindow.setContent(arrayMarker[i].html);
          infowindow.open(map, arrayMarker[i]);
          map.setZoom(13);
          map.setCenter(arrayMarker[i].position);
          showTable(i);
        });
      }
    }

    function showTable(id) {
      var table = document.getElementById("myTable");
      
      $("#myTable").find("tbody").remove();
      var body = table.createTBody();
      
      var dayPrec = null;
      var row = body.insertRow(-1);
      var countCell = 0;
      for (let elt of list.PUDO_ITEMS.PUDO_ITEM[id].OPENING_HOURS_ITEMS.OPENING_HOURS_ITEM) {
        if(dayPrec === null || dayPrec !== elt.DAY_ID){
          dayPrec = elt.DAY_ID;
          row = body.insertRow(-1);
          countCell = 0;
          row.insertCell(countCell).innerHTML = day_id_to_sting(elt.DAY_ID);
          countCell++;
        }
        var cell1 = row.insertCell(countCell).innerHTML = elt.START_TM + " à " + elt.END_TM;
        countCell++;
      }
    }

    function day_id_to_sting (day_id){
      var day;
      if(day_id==="1"){
        day = "Lundi";
      } else if (day_id==="2"){
        day = "Mardi";
      } else if (day_id==="3"){
        day = "Mercredi";
      } else if (day_id==="4"){
        day = "Jeudi";
      } else if (day_id==="5"){
        day = "Vendredi";
      } else if (day_id==="6"){
        day = "Samedi";
      } else if (day_id==="7"){
        day = "Dimanche";
      }
      return day;
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2X2ltzIi6ccdRoRfW-fWNcdcqTFypxOc&signed_in=true&callback=initMap"></script>
</body>

</html>