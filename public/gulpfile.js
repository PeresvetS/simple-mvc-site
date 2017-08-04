var gulp = require("gulp"),
  scss = require("gulp-scss"),
  csso = require("gulp-csso"),
  notify = require("gulp-notify"),
  uglifyJs = require("gulp-uglifyjs"),
  connectPHP = require("gulp-connect-php"),
  autoprefixer = require("gulp-autoprefixer"),
  browserSync = require("browser-sync");


var config = {
    raw: "./raw",
    assets: "./assets"
};

var errorHandler = {
    errorHandler: notify.onError({
        title: "Error in plugin <%= error.plugin %>",
        message: "Error: <%= error.message %>"
    })
};


// assets
gulp.task('sass', function() {
    gulp
      .src(config.raw + "/sass/**/*.scss")
      .pipe(scss())
      .pipe(autoprefixer())
      .pipe(gulp.dest(config.assets + "/css"))
      .pipe(csso({ comment: false }))
      .pipe(gulp.dest(config.assets + "/css"))
      .pipe(browserSync.reload({ stream: true }));
});

gulp.task('js', function() {
    gulp
      .src(config.raw + "/js/**/*.js")
      .pipe(uglifyJs())
      .pipe(gulp.dest(config.assets + "/js"))
      .pipe(browserSync.reload({ stream: true }));
});



gulp.task('watch', function() {
    gulp.watch(config.raw + "/sass/**/*.scss", ["sass"]);
    gulp.watch(config.raw + "/js/**/*.js", ["js"]);
 });



// gulp.task("server", function() {
//   connect.server({}, function() {
//     browserSync({
//       proxy: "127.0.0.1:8000"
//     });
//   });
// });

// run 

gulp.task("default", ["sass", "js", "watch"]);
