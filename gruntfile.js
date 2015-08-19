/*jshint node:true */

module.exports = function( grunt ) {
	'use strict';
	var config = require( 'sitecare-plugin-config' );
	require( 'sitecare-grunt-config-loader' )( grunt, config ).init({
		pkg: grunt.file.readJSON( 'package.json' )
	});
};
