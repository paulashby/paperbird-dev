const path = require('path');

// css extraction and minification
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin")

// clean out build dir in-between builds
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = [
  {
    entry: {
      'main': [
        './src/templates/js/main.js',
        './src/templates/scss/main.scss'
      ]
    },
    output: {
      path: path.resolve(__dirname, "dist"),
      filename: "site/templates/js/[name].min.[fullhash].js"
    },
    devtool: "source-map",
    module: {
      rules: [
        // js babelization
        {
          test: /\.(js|jsx)$/,
          exclude: /node_modules/,
          loader: 'babel-loader'
        },
        // sass compilation
        {
          test: /\.(sass|scss)$/,
          use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
        },
        // loader for webfonts (only required if loading custom fonts)
        {
          test: /\.(woff|woff2|eot|ttf|otf)$/,
          type: 'asset/resource',
          generator: {
            filename: 'site/templates/fonts/[name][ext]',
          }
        },
        // loader for images and icons (only required if css references image files)
        {
          test: /\.(png|jpg|gif|svg)$/,
          type: 'asset/resource',
          generator: {
            filename: 'site/templates/img/[name][ext]',
          }
        },
      ]
    },
    plugins: [
      // clear out build directories on each build
      new CleanWebpackPlugin({
        cleanOnceBeforeBuildPatterns: [
          'site/templates/js/*',
          'site/templates/css/*',
          'site/templates/components/*',
        ]
      }),
      new CopyWebpackPlugin({
        patterns: [{
          from: path.resolve(__dirname, "src"),
          to: path.resolve(__dirname, "dist/site"),
          globOptions: {
            ignore: [".*", "**/js/**", "**/scss/**", "**/components/*/script.js", "**/fonts/**"],
          },
        }]
      }),
      // css extraction into dedicated file
      new MiniCssExtractPlugin({
        filename: "site/templates/css/[name].min.[fullhash].css",
      }),
      new BrowserSyncPlugin({
        host: "localhost",
        port: 3000,
        proxy: "localhost:8888",
        files: ["dist/*"]
      })
    ],
    optimization: {
      // minification - only performed when mode = production
      minimizer: [
        // js minification - special syntax enabling webpack 5 default terser-webpack-plugin 
        `...`,
        // css minification
        new CssMinimizerPlugin(),
      ],
    },
  }
];
