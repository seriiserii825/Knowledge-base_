#install webpack
npm install webpack webpack-cli -D
npm install -D babel-loader @babel/core @babel/preset-env 
npm install --save-dev browser-sync-webpack-plugin

#package.json
"build": "webpack",
"start": "webpack --watch"

#scss
npm i css-loader sass-loader node-sass mini-css-extract-plugin -D

#minify css
npm i optimize-css-assets-webpack-plugin -D


#webpack.config.js
const path = require('path');
const miniCss = require('mini-css-extract-plugin');
const minify = require('optimize-css-assets-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
 
module.exports = {
	mode: 'development',
	entry: './src/index.js',
	output: {
		path: path.resolve(__dirname, 'assets'),
		filename: 'scripts.js'
	},
	module: {
		rules: [{
			test:/\.(s*)css$/,
			use: [
				miniCss.loader,
				'css-loader',
				'sass-loader',
			]
		}]
	},
	optimization: {
		minimizer: [
			new minify({})
		],
	},
	plugins: [
		new miniCss({
			filename: '../style.css',
		}),
	]
};

