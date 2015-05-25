<?php
if(GOOGLEMAPS) {
    /* google map shortcode
        *** Using [googlemap id="somemapid" coordinates="1 ,1" zoom="17" height="500px" infobox="<p>Some Infobox Content</p>"]
        *** if need street view, please add 'streetview="true"';
        *** if you need satellite view in 45 angle add 'tilt="45"';
    */
    function google_map_js($atts) {
        extract(shortcode_atts(array(
            'id'                => 'map_canvas',
            'coordinates'       => '1, 1',
            'zoom'              => 15,
            'height'            => '350px',
            'zoomcontrol'       => 'false',
            'scrollwheel'       => 'false',
            'scalecontrol'      => 'false',
            'disabledefaultui'  => 'false',
            'infobox'           => '',
            'satellite'         => '',
            'tilt'              => '',
            'icon'              => theme().'/images/marker.png',
            'streetview'        => ''
        ), $atts));
        $mapid = str_replace('-','_',$id);
        $map = !$streetview?'<div class="googlemap" id="'.$id.'" '.($height?'style="height:'.$height.'"':'').'></div><script>
    var '.$mapid.';
    function initialize_'.$mapid.'() {
        var myLatlng = new google.maps.LatLng('.$coordinates.');
        var mapOptions = {
            '.($satellite?'mapTypeId: google.maps.MapTypeId.SATELLITE,':'').'
            zoom: '.$zoom.',
            center: myLatlng,
            zoomControl: '.$zoomcontrol.',
            scrollwheel: '.$scrollwheel.',
            scaleControl: '.$scalecontrol.',
            disableDefaultUI: '.$disabledefaultui.'
        };
        var '.$mapid.' = new google.maps.Map(document.getElementById("'.$id.'"), mapOptions);
        '.($tilt?$mapid.'.setTilt(45);':'').'
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: '.$mapid.',
            '.($icon?'icon:"'.$icon.'",':'').'
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
    </script>':do_streetView_map($id, $coordinates, $height, $streetview);
        return $map;
    }
    add_shortcode('googlemap', 'google_map_js');
    function do_streetView_map($id, $pos, $height, $streetview){
        return '<div class="googlemap" id="street_'.$id.'" '.($height?'style="height:'.$height.'"':'').'></div><script>
        function street_init_'.$id.'() {
        var geocoder =  new google.maps.Geocoder();
        geocoder.geocode( { "address": "'.$streetview.'" }, function(results, status) {
            var lookTo = results[0].geometry.location;
            if (status == google.maps.GeocoderStatus.OK) {
                  var panoOptions = {
                    position: lookTo,
                    panControl: false,
                    addressControl: false,
                    linksControl: false,
                    zoomControlOptions: false
                  };
                  var pano = new  google.maps.StreetViewPanorama(document.getElementById("street_'.$id.'"),panoOptions);
                  var service = new google.maps.StreetViewService;
                  service.getPanoramaByLocation(pano.getPosition(), 50, function(panoData) {
                    if (panoData != null) {
                      var panoCenter = panoData.location.latLng;
                      var heading = google.maps.geometry.spherical.computeHeading(panoCenter, lookTo);
                      var pov = pano.getPov();
                      pov.heading = heading;
                      pano.setPov(pov);
                      var marker = new google.maps.Marker({
                        map: pano,
                        position: lookTo
                      });
                    } else {
                      alert("Not Found");
                    }
                  });
            } else {
                alert("Could not find your address");
            }
        });
        }
        google.maps.event.addDomListener(window, "load", street_init_'.$id.');</script>';
    }
} //end GOOGLEMAPS



