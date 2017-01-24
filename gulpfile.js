var gulp    = require('gulp');
var concat  = require('gulp-concat');
var clean   = require('gulp-clean');
var uglify  = require('gulp-uglify');
var sass    = require('gulp-sass');
//var compass = require('gulp-compass');

//paths is an object containing all paths of the assets
var paths = {
    vendorJs: [
        './web/vendors/components/jquery/dist/jquery.min.js',
        './web/vendors/components/bootstrap/dist/js/bootstrap.min.js',
        './web/vendors/components/afterglow/dist/afterglow.min.js',
        './web/vendors/components/jquery-ui/jquery-ui.min.js'
    ],
    vendorCss: [
        'web/vendors/components/bootstrap/dist/css/bootstrap.min.css'
    ],
    fonts: [
        'web/vendors/components/bootstrap/dist/fonts/**/*'
    ],
    js: [
        'web/dev/js/*.js'
    ],
    sass: [
        'web/dev/sass/*.sass',
        'web/dev/sass/**/*.sass'
    ],
    img: [
        'web/dev/sass/media/img/*'
    ],
    dist: {
        js: './web/assets/js',
        css: './web/assets/css',
        fonts: './web/assets/fonts',
        assets: './web/assets',
        img: './web/assets/media/img'
    }

    //compass: 'web/dev/config.rb'
};

//the "default" tasks runs all the tasks, allowing to only run "gulp" command.
gulp.task('default', ['vendors', 'src'], function(){

});

//the "vendor-js" task minify all the vendors' js files and concatenate them in /web/assets/js/vendor.js
gulp.task('vendor-js', function(){
    return gulp.src(paths.vendorJs)
        .pipe(uglify())
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(paths.dist.js))
});

//the "vendor-css" task minify all the vendors' css files and concatenate them in /web/assets/css/vendor.css
gulp.task('vendor-css', function(){
    return gulp.src(paths.vendorCss)
        .pipe(concat('vendor.css'))
        .pipe(gulp.dest(paths.dist.css))
});

//the "fonts" task only copy fonts to the /web/assets/fonts directory
gulp.task('fonts', function(){
    return gulp.src(paths.fonts)
        .pipe(gulp.dest(paths.dist.fonts))
});

//the "vendors" task regroup all vendors tasks
gulp.task('vendors', ['vendor-js', 'vendor-css', 'fonts'], function(){

});

//the "js" task minify the js files and concatenate them in /web/assets/js/app.js
gulp.task('js', function(){
    return gulp.src(paths.js)
        .pipe(uglify())
        .pipe(concat('app.js'))
        .pipe(gulp.dest(paths.dist.js))
});

//the css task allows compass action to be considered before sass action
/*gulp.task('css', function() {
    gulp.src(paths.sass)
        .pipe(compass({
            config_file: paths.compass
        }))
        .pipe(concat('app.css'))
        .pipe(gulp.dest('paths.dist.css'));
});*/

//the "sass" task create a uniq, minified css file with all the compiled sass files and concatenate them in /web/assets/css/app.css
gulp.task('sass', function(){
    return gulp.src(paths.sass)
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(concat('app.css'))
        .pipe(gulp.dest(paths.dist.css))
});

//the "images" task optimize images

gulp.task('images', function(){
    return gulp.src(paths.img)
        .pipe(gulp.dest(paths.dist.img))
});

//the "src" task regroup all the sources (made by us) tasks
gulp.task('src', ['js', 'sass', 'images'], function(){

});

//the "watch" file automatically runs other tasks on change on "watched" files
gulp.task('watch', function(){
    gulp.watch([paths.sass], ['sass'])
});

//the "clean" task delete the /web/assets directory
gulp.task('clean', function(){
    return gulp.src([paths.dist.assets], {read: false}).pipe(clean());
});
