/*jshint node:true */

module.exports = function( grunt ) {
	'use strict';

	var loader = require( 'load-project-config' ),
		config = require( 'sitecare-plugin-config' );

	loader( grunt, config ).init();
};
