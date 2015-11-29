var gulp = require('gulp'),
    less = require('gulp-less'),
		minifyCSS = require('gulp-minify-css'),
		sourcemaps = require('gulp-sourcemaps');

gulp.task('less', function () {
	gulp.src('./less/**/*.less')
		.pipe(sourcemaps.init())
		.pipe(less())
		.pipe(minifyCSS())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./css'));
});

gulp.task('watch', function() {
	gulp.watch('less/*.less', ['less']);
});

gulp.task('default', ['less', 'watch']);

