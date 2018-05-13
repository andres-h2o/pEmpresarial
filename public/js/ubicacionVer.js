var marker;
var coords = {};

initMap = function (){
    navigator.geolocation.getCurrentPosition(
        function (position){
            coords =  {
                lng: position.coords.longitude,
                lat: position.coords.latitude
            };
            setMapa(coords);
        },function(error){console.log(error);});
}

function setMapa (coords){
    var map = new google.maps.Map(document.getElementById('map'),
        {
            zoom: 10,
            center:new google.maps.LatLng(coords.lat,coords.lng),

        });

    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords.lat,coords.lng),

    });
    marker.addListener('click', toggleBounce);

    marker.addListener( 'dragend', function (event)
    {
        document.getElementById("inLat").value = this.getPosition().lat();
        document.getElementById("inLon").value = this.getPosition().lng();
    });
}

//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
function toggleBounce() {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

function comenzar(){
    var miBoton = document.getElementById("btnUbicacion");
    miBoton.addEventListener("click", obtenerU, false);
}

function obtenerU(){
    navigator.geolocation.getCurrentPosition(findme);
}

function findme(findM){


    coords =  {
        lng: document.getElementById("y").innerHTML ,
        lat: document.getElementById("x").innerHTML
    };
    setMapa(coords);
}

window.addEventListener("load",comenzar, false);