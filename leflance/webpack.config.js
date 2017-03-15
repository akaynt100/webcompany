var path = require('path');
var webpack = require('webpack');
var NpmInstallPlugin = require('npm-install-webpack-plugin');
var WriteFilePlugin = require('write-file-webpack-plugin');

module.exports = {
    devtool: 'cheap-module-eval-source-map',
    devServer: {
        outputPath: path.join(__dirname, './dist')
    },
    entry: [
        'webpack-hot-middleware/client',
        'babel-polyfill',
        './src/index'
    ],
    output: {
        path: __dirname + '/build/assets/js/react-app',
        filename: 'bundle.js',
        publicPath: '/static/'
    },
    plugins: [
        new webpack.optimize.OccurenceOrderPlugin(),
        new WriteFilePlugin(),
        new webpack.HotModuleReplacementPlugin(),
        new NpmInstallPlugin()
    ],
    module: {
        preLoaders: [
            {
                test: /\.js$/,
                loaders: ['eslint'],
                include: [
                    path.resolve(__dirname, "src")
                ]
            }
        ],
        loaders: [
            {
                loaders: ['react-hot', 'babel-loader'],
                include: [
                    path.resolve(__dirname, "src")
                ],
                test: /\.js$/,
                plugins: ['transform-runtime']
            }
        ]
    }
};
