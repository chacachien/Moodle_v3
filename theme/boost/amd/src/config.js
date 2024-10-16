define([], function () {
  window.requirejs.config({
    paths: {
      widgetjs: M.cfg.wwwroot + "/theme/boost/js/widget.min",
    },
    shim: {
      widgetjs: { exports: "widgetjs" },
    },
  });
});
