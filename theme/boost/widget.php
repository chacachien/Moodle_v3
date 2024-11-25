<?php
  require_once('../../config.php');
header('X-Frame-Options: SAMEORIGIN');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Widget Container</title>
  <style>
    /* Reset CSS to avoid Moodle styles interference */
    html, body {
      margin: 0;
      padding: 0;
      background: transparent;
      font-family: Arial, sans-serif;
      height: 100%;
      overflow: hidden;
    }
    #widget-root {
      height: 100%;
      background: transparent;
    }
    /* Add your widget-specific styles here */
  </style>
</head>
<body style="background: transparent !important;">
<div id="widget-root"></div>
<script>
  // Create a function to initialize the widget
  function initializeWidget(config) {
    if (window.ChatbotWidget && window.ChatbotWidget.default) {
      window.ChatbotWidget.default(config);
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
          courseId: event.data.data.courseId
        });
      }
    });
  };
  document.body.appendChild(script);
</script>
</body>
</html>
