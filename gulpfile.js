const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');

const paths = {
  scss: {
    src: 'public/assets/build/scss/**/*.scss', 
    dest: 'public/assets/dist/css/**/*.css' 
  }
};

gulp.task('sass', function() {
  return gulp.src(paths.scss.src)
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest(paths.scss.dest));
});

gulp.task('minify-css', () => {
  return gulp.src(`${paths.scss.dest}/**/*.css`)
    .pipe(cleanCSS({ compatibility: 'ie8' }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(paths.scss.dest));
});

gulp.task('watch', function() {
  gulp.watch(paths.scss.src, gulp.series('sass', 'minify-css'));
});

gulp.task('default', gulp.series('sass', 'minify-css', 'watch'));
