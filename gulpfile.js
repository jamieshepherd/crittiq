process.env.DISABLE_NOTIFIER = true;

var gulp   = require('gulp');
var elixir = require('laravel-elixir');
var babel  = require("gulp-babel");
var concat = require("gulp-concat");

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.task('smash', 'resources/assets/js/**');
    mix.sass('app.scss');
    mix.scriptsIn('resources/assets/js/vendor', 'public/js/vendor.js');
    mix.version([
        'css/app.css',
        'js/vendor.js',
        'js/app.js'
    ]);
});

gulp.task('smash', function() {
    return gulp.src('resources/assets/js/app/**/*')
            .pipe(babel())
            .pipe(concat("app.js"))
            .pipe(gulp.dest('public/js'));
});
