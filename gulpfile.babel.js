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
    .pipe(dest(`${Settings.themeLocation}/css/`));
};

// Browser Syc

const server = browserSync.create();
export const serve = (done) => {
  server.init({
    proxy: "localhost:10023",
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
    `${Settings.themeLocation}/assets/sass/**/*.scss`,
    series(styles, reload)
  );
  watch(`${Settings.themeLocation}/**/*.php`, reload);
};

const dev = series(styles, serve, watchForChange);
const build = series(styles);

export default dev;
