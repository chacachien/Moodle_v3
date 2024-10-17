define(["jquery", "theme_boost/widgetjs"], function ($, widgetjs) {
  return {
    init: function (data) {
      widgetjs.default({
        userId: data["userId"],
        courseId: data["courseId"],
      });
    },
  };
});
