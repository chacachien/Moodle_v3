// define(["jquery", "theme_boost/widgetjs"], function ($, widgetjs) {
//   return {
//     init: function (data) {
//       widgetjs.default({
//         userId: data["userId"],
//         courseId: data["courseId"],
//       });
//     },
//   };
// });
define(['jquery'], function($) {
  return {
    init: function(config) {
      // Listen for messages from iframe
      window.addEventListener('message', function(event) {
        if (event.data.type === 'widgetEvent') {
          // Handle message from widget
          console.log(event.data);
        }
      });

      // Send message to iframe if needed
      const iframe = document.getElementById('widget-iframe');
      iframe.contentWindow.postMessage({
        type: 'parentEvent',
        data: 'some data'
      }, '*');
    }
  };
});