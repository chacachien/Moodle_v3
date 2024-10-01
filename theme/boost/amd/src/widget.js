define(["jquery", "theme_boost/widgetjs"], function ($, widgetjs) {
  return {
    init: function (data) {
      console.log("data", data["userId"]);
      console.log("widgetjs1", widgetjs);
      widgetjs.default({
        userId: data["userId"],
        courseId: data["courseId"],
        // assistant:3, friend:1, document:2
      });
    },
  };
});
