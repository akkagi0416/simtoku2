var gulp = require('gulp');
var sass = require('gulp-sass');
// var sass = require('gulp-ruby-sass');
var autoprefixer = require("gulp-autoprefixer");
var plumber = require('gulp-plumber');

gulp.task('sass', function(){
  gulp.src('sass/*.scss')
    .pipe(plumber())
    .pipe(sass({style: 'expanded'}))
    .pipe(autoprefixer())
    .pipe(gulp.dest('./'));
});

// gulp.task('sass', function(){
//   return sass('sass/*.scss', { style: 'expanded' })
//           .pipe(autoprefixer())
//           .pipe(gulp.dest('./'));
// });

gulp.task('default', function(){
  gulp.watch('sass/*.scss', ['sass']);
});
