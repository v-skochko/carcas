<?php

// Google map shortcode
// echo do_shortcode('[gmap coordinates="xx.xxxxxx, -yy.yyyyyy"]');
function cgmap($atts) {
     extract(shortcode_atts(array(
     "coordinates" => '1, 2'
     ), $atts));
     return '<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=en"></script>
    <script>
        var map;
        function initialize() {
            var myLatlng = new google.maps.LatLng('.$coordinates.');
            var mapOptions = {
                zoom: 18,
                center: myLatlng,
                zoomControl: false,
                scaleControl: false,
                scrollwheel: false,
            };
            var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                animation: google.maps.Animation.DROP
            });
            google.maps.event.addListener(map, "center_changed", function() {
                window.setTimeout(function() {
                  map.panTo(marker.getPosition());
                }, 15000);
            });
        };
        google.maps.event.addDomListener(window, "load", initialize);
    </script><div id="map_canvas"></div>';
}
add_shortcode('gmap', 'cgmap');


