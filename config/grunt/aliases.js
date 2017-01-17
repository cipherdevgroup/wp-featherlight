module.exports = function() {
	'use strict';
	var tasks = {
		'build:dependencies:fonts': [
			'clean:fonts',
			'copy:bowerfonts'
		],
		'build:dependencies:css': [
			'clean:css',
			'copy:bowercss'
		],
		'build:dependencies:js': [
			'clean:js',
			'copy:bowerjs'
		],
		'build:fonts': [
			'build:dependencies:fonts',
			'newer:copy:fonts'
		],
		'build:css': [
			'build:dependencies:css',
			'newer:sass',
			'newer:postcss',
			'newer:rtlcss',
			'newer:cssmin',
			'newer:copy:css'
		],
		'build:images': [
			'newer:imagemin:images'
		],
		'build:js': [
			'build:dependencies:js',
			'newer:concat:js',
			'newer:concat:adminjs',
			'newer:uglify'
		]
	};

	return tasks;
};
