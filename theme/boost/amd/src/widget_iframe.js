// define(['jquery'], function($) {
//   return {
//     init: function(config) {
//       // Create iframe container
//       const iframeContainer = $('<div>').attr('id', 'widget-iframe-container');
//       $('body').append(iframeContainer);
//
//       // Create and configure iframe
//       const iframe = $('<iframe>')
//         .attr({
//           'id': 'widget-iframe',
//           'src': `${config.wwwroot}/theme/boost/widget.php`,
//           'style': 'width: 100%; height: 500px; border: none;'
//         });
//
//       iframeContainer.append(iframe);
//
//       // Send configuration to iframe once loaded
//       iframe.on('load', function() {
//         iframe[0].contentWindow.postMessage({
//           type: 'WIDGET_CONFIG',
//           data: {
//             userId: config.userId,
//             courseId: config.courseId
//           }
//         }, '*');
//       });
//     }
//   };
// });
define(['jquery'], function($) {
  return {
    init: function(config) {
      // Create iframe container with fixed positioning
      const iframeContainer = $('<div>').attr({
        'id': 'widget-iframe-container',
        'style': `
                    position: fixed;
                    right: 20px;
                    bottom: 20px;
                    z-index: 1000;
                    width: 400px;
                    height: 600px;
                    background: transparent !important;
                `
      });

      // Create and configure iframe
      const iframe = $('<iframe>').attr({
        'id': 'widget-iframe',
        'src': `${config.wwwroot}/theme/boost/widget.php`,
        'style': `
                    width: 100%;
                    height: 100%;
                    border: none;
                    background: transparent;
                    overflow: hidden;
                `
      });

      iframeContainer.append(iframe);
      $('body').append(iframeContainer);

      iframe.on('load', function() {
        iframe[0].contentWindow.postMessage({
          type: 'WIDGET_CONFIG',
          data: {
            userId: config.userId,
            courseId: config.courseId
          }
        }, '*');
      });
    }
  };
});
