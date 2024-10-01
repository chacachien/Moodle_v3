define([], function () {
  window.requirejs.config({
    paths: {
      widgetjs: "http://localhost/moodle4113" + "/theme/boost/js/widget.min",
    },
    shim: {
      widgetjs: { exports: "widgetjs" },
    },
  });
});
