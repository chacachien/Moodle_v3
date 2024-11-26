<?php
require_once('../../config.php');
header('X-Frame-Options: SAMEORIGIN');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Widget Container</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            background: transparent;
            height: 600px;
            overflow: hidden;
        }
        #widget-root {
            height: 100%;
            background: transparent;
                        position: relative;

        }
    </style>
</head>
<body>
    <div id="widget-root"></div>
    <script>
          function initializeWidget(config) {
            if (window.ChatbotWidget && window.ChatbotWidget.default) {
              window.ChatbotWidget.default(config);
              console.log("hehehe");
            } else {
              console.error('Widget not properly loaded');
            }
          }

          // Load widget script dynamically
          const script = document.createElement('script');
          script.src = '<?php echo $CFG->wwwroot; ?>/theme/boost/js/widget.min.js';
          script.onload = function() {
            // Once script is loaded, set up message listener
            window.addEventListener('message', function(event) {
              // Verify origin if needed
              if (event.data.type === 'WIDGET_CONFIG') {
                initializeWidget({
                  userId: event.data.data.userId,
                  courseId: event.data.data.courseId,
                  embedded: false
                });
              }
            });
          };
          document.body.appendChild(script);
    </script>
</body>
</html>