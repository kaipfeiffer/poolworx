import { fileURLToPath, URL } from "node:url";

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
const { cp } = require("fs/promises");
const { unlinkSync, readdirSync, statSync } = require("fs");
const path = require("path");

const rmpreviousbuild = function (dir) {
  var files = readdirSync(dir);
  for (var i = 0; i < files.length; i++) {
    var filename = path.join(dir, files[i]);
    var stat = statSync(filename);

    if (filename == "." || filename == ".." || !stat.isDirectory()) {
      // remove fiilename
      unlinkSync(filename);
    }
  }
};
// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    {
      name: "postbuild-commands", // the name of your custom plugin. Could be anything.
      closeBundle: async () => {
        await cp(
          "./dist/index.html",
          "./plugin/templates/single-kpm-counter.php"
        );
        // remove files from previous builds
        await rmpreviousbuild("./plugin/public/dist");
        await cp(
          "./dist/wp-content/plugins/kpm-counter/public/dist",
          "./plugin/public/dist",
          { recursive: true }
        );
      },
    },
    vue(),
  ],
  // base: '/wp-content/plugins/kpm-counter/js-src/counter-app/dist/',
  base: "/",
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", import.meta.url)),
    },
  },
  build: {
    // outDir: '../../../../../',
    // outDir: '../../templates/',
    // publicPath: '/kpm-counter/',
    assetsDir: "wp-content/plugins/kpm-counter/public/dist/",
    // rollupOptions: {
    //   input: [
    //     './page-kpm-counter-index.php',
    //     // 'src/main.js',
    //     // 'src/style.scss',
    //     // 'src/assets/*'
    //   ],
    //   // output: {
    //   //   // chunkFileNames: 'js/[name].js',
    //   //   // entryFileNames: 'js/[name].js',
    //   //   dir: '../../../../../',
    //   //   // assetFileNames: '../../public/dist/[name]-[hash][extname]',
    //   // },
    // },
  },
});
