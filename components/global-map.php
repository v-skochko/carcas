<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUPkH8XAlVE39QDX5C-NZOqe-gciMfdA4"></script>
<script type="text/javascript">
    (function ($) {
        function new_map($el) {
            var $markers = $el.find('.marker');
            var args = {
                zoom: 16,
                center: new google.maps.LatLng(0, 0),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map($el[0], args);
            map.markers = [];
            $markers.each(function () {
                add_marker($(this), map);
            });
            center_map(map);
            return map;
        }

        function add_marker($marker, map) {
            var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
            // create marker
            //var iconBase = '<?php //echo theme(); ?>///img/pin.png';
            var marker = new google.maps.Marker({
                position: latlng,
                // icon: iconBase,
                map: map
            });
            // add to array
            map.markers.push(marker);
            // if marker contains HTML, add it to an infoWindow
            if ($marker.html()) {
                // create info window
                var infowindow = new google.maps.InfoWindow({
                    content: $marker.html()
                });
                // show info window when marker is clicked
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });
            }
        }


        function center_map(map) {
            // vars
            var bounds = new google.maps.LatLngBounds();
            // loop through all markers and create bounds
            $.each(map.markers, function (i, marker) {
                var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                bounds.extend(latlng);
            });
            // only 1 marker?
            if (map.markers.length == 1) {
                // set center of map
                map.setCenter(bounds.getCenter());
                map.setZoom(16);
            } else {
                // fit to bounds
                map.fitBounds(bounds);
            }
        }

        var map = null;
        $(document).ready(function () {
            $('.acf-map').each(function () {
                map = new_map($(this));
            });
        });
    })(jQuery);
</script>