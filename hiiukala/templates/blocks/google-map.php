<?php
    /* ***************************************************************************** */
    /* GOOGLE MAP BLOCK
    /* ***************************************************************************** */
    /* ACF: Block - Google Map
    /* Requires: -
    /* Notes: -
    /* ***************************************************************************** */
?>

<?php
    // Get block attributes
    $attributes = theme_get_block_attributes([
        'wrapper_classes'       => ''
    ], $args);


    // Get block field data
    $fields = get_field('block_google_map');


    // Default output data
    $data = [
        'nav_anchor'            => $fields['nav_anchor'],
        'api_key'               => $fields['api_key'],
        'start_pos_lat'         => $fields['start_pos_lat'],
        'start_pos_lng'         => $fields['start_pos_lng']
    ];


    // Process data
    if (empty($data['start_pos_lat'])) {
        $data['start_pos_lat'] = 59.4032344;
    }
    if (empty($data['start_pos_lng'])) {
        $data['start_pos_lng'] = 24.7489328;
    }
?>


<section class="map<?php echo $attributes['wrapper_classes']; ?>">
    <?php theme_get_nav_anchor($data['nav_anchor']); ?>

    <div id="map">&nbsp;</div>

    <script>
        function initMap() {
            var options = {
                zoom: 14,
                center: { 
                    lat: <?php echo $data['start_pos_lat']; ?>,
                    lng: <?php echo $data['start_pos_lng']; ?>
                } 
            }
            var map = new google.maps.Map(document.querySelector('#map'), options);
            var marker = new google.maps.Marker({
                position: {
                    lat: <?php echo $data['start_pos_lat']; ?>,
                    lng: <?php echo $data['start_pos_lng']; ?>
                },
                map: map,
                draggable: true
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $data['api_key']; ?>&callback=initMap"></script>
</section>