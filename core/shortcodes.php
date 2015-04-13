<?php

/* google map shortcode
    *** Useing [googlemap id="somemapid" coordinates="1 ,1" zoom="17" height="500px" infobox="<p>Some Infobox Content</p>"]
*/
function google_map_js($atts) {
    extract(shortcode_atts(array(
        'id'           => 'map_canvas',
        'coordinates'  => '1, 1',
        'zoom'         => 15,
        'height'       => '350px',
        'zoomControl'  => 'false',
        'scrollwheel'  => 'false',
        'scaleControl' => 'false',
        'disableDefaultUI' => 'false',
        'infobox' => ''
    ), $atts));
    $mapid = str_replace('-','_',$id);
    $map = '<div class="googlemap" id="'.$id.'" '.($height?'style="height:'.$height.'"':'').'></div><script>var '.$mapid.';
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
'.($infobox?'marker.info = new google.maps.InfoWindow({content: "'.$infobox.'"});google.maps.event.addListener(marker, "click", function() {marker.info.open('.$mapid.', marker);});':'').'
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



