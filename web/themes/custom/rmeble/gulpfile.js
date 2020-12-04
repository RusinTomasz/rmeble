/*global -$ */
"use strict";

var gulp = require("gulp");
var $ = require("gulp-load-plugins")();
var sass = require("gulp-sass");
var sourcemaps = require("gulp-sourcemaps");
var runSequence = require("run-sequence");
var requireDir = require("require-dir")("./gulp_tasks");
var $ = require("gulp-load-plugins")();
var config = require("./gulpconfig.js");
// Error notifications
var reportError = function (error) {
  $.notify({
    title: "Gulp Task Error",
    message: "Check the console.",
  }).write(error);
  console.log(error.toString());
  this.emit("end");
};

var config = {
  sassPath: "./sass",
  bowerDir: "./bower_components/",
};

// Sass processing
gulp.task("sass", function () {
  return (
    gulp
      .src("./scss/**/*.scss")
      // .pipe($.sourcemaps.init())
      // Convert sass into css
      .pipe(
        $.sass({
          // outputStyle: "nested", // libsass doesn't support expanded yet
          outputStyle: "compressed", // libsass doesn't support expanded yet
          precision: 10,
          includePaths: [
            config.bowerDir + "/normalize-scss/sass",
            config.bowerDir + "/breakpoint-sass/stylesheets",
            config.sassPath,
          ],
        })
      )
      // Show errors
      .on("error", reportError)
      // Autoprefix properties
      .pipe(
        $.autoprefixer({
          browsers: ["last 2 versions"],
        })
      )
      // Write sourcemaps
      // .pipe($.sourcemaps.write())
      // Save css
      .pipe(gulp.dest("./css"))
  );
});

// process JS files and return the stream.
gulp.task("js", function () {
  return gulp.src("./js/*.js").pipe(gulp.dest("./js"));
});

// Beautify JS
gulp.task("beautify", function () {
  gulp
    .src("./js/*.js")
    .pipe($.beautify({ indentSize: 2 }))
    .pipe(gulp.dest("./js"))
    .pipe(
      $.notify({
        title: "JS Beautified",
        message: "JS files in the theme have been beautified.",
        onLast: true,
      })
    );
});

// Compress JS
gulp.task("compress", function () {
  return gulp
    .src("./js/*.js")
    .pipe($.sourcemaps.init())
    .pipe($.uglify())
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest("./js"))
    .pipe(
      $.notify({
        title: "JS Minified",
        message: "JS files in the theme have been minified.",
        onLast: true,
      })
    );
});

gulp.task("watch", function () {
  gulp.watch("./scss/**/*.scss", ["sass"]);
  gulp.watch("./js/*.js", ["js"]);
});

// Default task to be run with `gulp`
gulp.task("default", ["sass", "js", "critical"]);
