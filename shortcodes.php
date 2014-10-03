<?php

// Google map shortcode
// echo do_shortcode('[googlemap coordinates="51.381158, 30.116569" id="aes" height="310px" zoom="13"] ');
function google_map_js($atts) {
    extract(shortcode_atts(array(
        'id'           => 'map_canvas',
        'coordinates'  => '1, 1',
        'zoom'         => 15,
        'height'       => '',
        'zoomControl'  => 'false',
        'scrollwheel'  => 'false',
        'scaleControl' => 'false',
        'disableDefaultUI' => 'false'
    ), $atts));
    $mapid = str_replace('-','_',$id);
    $map = '<div id="'.$id.'" '.($height?'style="height:'.$height.'"':'').'></div>
    <script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=en"></script>
    <script>var '.$mapid.';
        function initialize_'.$mapid.'() {
            var myLatlng = new google.maps.LatLng('.$coordinates.');
            var mapOptions = {
            zoom: '.$zoom.',
            center: myLatlng,
            zoomControl: '.$zoomControl.',
            scrollwheel: '.$scrollwheel.',
            scaleControl: '.$scaleControl.',
            disableDefaultUI: '.$disableDefaultUI.'
        };
        var '.$mapid.' = new google.maps.Map(document.getElementById("'.$id.'"), mapOptions),
        marker = new google.maps.Marker({
            position: myLatlng,
            map: '.$mapid.',
            animation: google.maps.Animation.DROP
        });
        google.maps.event.addListener('.$mapid.', "center_changed", function() {
                window.setTimeout(function() {
                    '.$mapid.'.panTo(marker.getPosition());
                }, 15000);
            });
        };
        google.maps.event.addDomListener(window, "load", initialize_'.$mapid.');
    </script>';
    return $map;
}
add_shortcode('googlemap', 'google_map_js');




