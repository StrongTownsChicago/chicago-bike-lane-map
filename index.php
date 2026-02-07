<?php
  require("vendor/autoload.php");

  // Pack bike path data into PHP variable
  $paths = json_decode(file_get_contents("./data/paths.json"), true); // The "true" puts it in array mode

  $pathstyle = json_decode(file_get_contents("./data/style.json"), true);

  // Simplified geojson file pulled from https://github.com/datamade/chi-councilmatic/blob/main/data/final/chicago_shapes.geojson
  // Then enriched with aldermanic data from here https://data.cityofchicago.org/resource/c6ie-9e6c.json (ward-data.json)
  $wards = json_decode(file_get_contents("./data/wards.geojson"), true);

  // Pack config data into PHP variable (WARNING: DO NOT INSERT INTO JAVASCRIPT, there is sensitive information in here that must not appear on client's device)
  $config = require("settings.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chicago Protected Bicycle Lanes</title>
  
    <!-- Bootstrap stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
    <!--Leaflet stylesheet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  
    <!--Leaflet script -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Force in some padding for the top of the map page - otherwise the navbar covers up the zoom buttons and the key. -->
    <!-- <style>
      body {
        padding-top: 55px;
      }
      @media (max-width: 979px) {
        body {
          padding-top: 0px;
        }
      }
    </style> -->
  </head>
  <body>

    <!-- The navbar is in its own isolated file, to make sure every page has the same navbar. -->
    <?php echo file_get_contents("./chunks/navbar"); ?>

    <!-- Pack data structure back into JSON for map script -->
    <script>
      const bicycle_paths = <?php echo json_encode($paths); ?>;
    </script>

    <!-- Insert path style parameters into JSON editable object -->
    <script>
      let layer_map = <?php echo json_encode($pathstyle); ?>;
    </script>

    <!-- Insert map parameters from config into JSON constants. We don't want to pass the whole config since it contains sensitive information, so we pick and choose which values we pass. -->
    <script>
      const config = {
        "debug_logNames": <?php echo json_encode($config["debug_logNames"]); ?>,
        "debug_showOutlines": <?php echo json_encode($config["debug_showOutlines"]); ?>,
        "debug_showPoints": <?php echo json_encode($config["debug_showPoints"]); ?>,
        "show_location": <?php echo json_encode($config["show_location"]) ?>,
        "zoom_location": <?php echo json_encode($config["zoom_location"]) ?>,
        "in_progress": <?php echo json_encode($config["in_progress"]) ?>
      };
    </script>

    <script>
      const chicago_wards = <?php echo json_encode($wards); ?>;
    </script>

    <div id="map" style="width: 100vw; height: 91vh; padding-top: 55px;"> <!-- CHange to 600px/400px if desired -->
      <script type="text/javascript" src="map.js"></script>
    </div>
  </body>
</html>
