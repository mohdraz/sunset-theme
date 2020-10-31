import { src, dest, watch, series, parallel } from "gulp";
import yargs from "yargs";
import sass from "gulp-sass";
import cleanCss from "gulp-clean-css";
import gulpif from "gulp-if";
import postcss from "gulp-postcss";
import sourcemaps from "gulp-sourcemaps";
import autoprefixer from "autoprefixer";
import gulpIf from "gulp-if";
import imagemin from "gulp-imagemin";
import del from "del";
import webpack from "webpack-stream";
import named from "vinyl-named";
import $ from "jquery";
import browserSync from "browser-sync";

import * as Settings from "./settings";
const PRODUCTION = yargs.argv.prod;

export const styles = () => {
  return src(`${Settings.themeLocation}/sass/style.scss`)
    .pipe(gulpIf(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on("error", sass.logError))
    .pipe(gulpIf(PRODUCTION, postcss([autoprefixer])))
    .pipe(gulpIf(PRODUCTION, cleanCss({ compatibiity: "ie8" })))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest(`${Settings.themeLocation}/`));
};

// JS
export const js_scripts = (callback) => {
  webpack(require("./webpack.config.js"), function (err, stats) {
    if (err) {
      console.log(err.toString());
    }

    console.log(stats.toString());
    callback();
  });
};

// gulp.task("scripts", function (callback) {
//   webpack(require("./webpack.config.js"), function (err, stats) {
//     if (err) {
//       console.log(err.toString());
//     }

//     console.log(stats.toString());
//     callback();
//   });
// });

// export const scripts = () => {
//   return src(["src/js/bundle.js", "src/js/admin.js"])
//     .pipe(named())
//     .pipe(
//       webpack({
//         module: {
//           rules: [
//             {
//               test: /\.js$/,
//               use: {
//                 loader: "babel-loader",
//                 options: {
//                   presets: ["@babel/preset-env"],
//                 },
//               },
//             },
//           ],
//         },
//         mode: PRODUCTION ? "production" : "development",
//         devtool: !PRODUCTION ? "inline-source-map" : false,
//         output: {
//           filename: "[name].js",
//         },
//         externals: {
//           jquery: "jQuery",
//         },
//       })
//     )
//     .pipe(dest("dist/js"));
// };

// end of JS

// admin style
export const styles2 = () => {
  return src(`${Settings.themeLocation}/sass/css/*.scss`)
    .pipe(gulpIf(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on("error", sass.logError))
    .pipe(gulpIf(PRODUCTION, postcss([autoprefixer])))
    .pipe(gulpIf(PRODUCTION, cleanCss({ compatibiity: "ie8" })))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest(`${Settings.themeLocation}/css/`));
};

// Browser Syc

const server = browserSync.create();
export const serve = (done) => {
  server.init({
    proxy: "http://localhost:10023",
  });
  done();
};

export const reload = (done) => {
  server.reload();
  done();
};

// end of Browser Syc

export const watchForChange = () => {
  watch(
    `${Settings.themeLocation}/sass/**/*.scss`,
    series(styles, styles2, reload)
  );
  watch(`${Settings.themeLocation}/**/*.php`, reload);
  watch(`${Settings.themeLocation}/**/*.css`, reload);
  watch(`${Settings.themeLocation}/**/*.js`, reload);
};

const dev = series(styles, serve, watchForChange);
const build = series(styles);

export default dev;
