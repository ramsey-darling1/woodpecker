var gulp = require('gulp');
var sass = require('gulp-sass');
var coffee = require('gulp-coffee');

gulp.task('coffee', function() {
      gulp.src('./coffee/*.coffee')
       .pipe(coffee({bare: true}).on('error', console.log))
       .pipe(gulp.dest('./js/'));
});
gulp.task('sass', function () {
    gulp.src('./scss/*.scss')
      .pipe(sass())
      .pipe(gulp.dest('./css'));
});
