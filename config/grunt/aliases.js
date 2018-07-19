module.exports = function() {
	'use strict';
	var tasks = {
		'build:dependencies:fonts': [
			'clean:fonts',
			'copy:fonts'
		],
		'build:dependencies:css': [
			'clean:css',
			'copy:css'
		],
		'build:dependencies:js': [
			'clean:js',
			'copy:js'
		],
		'build:fonts': [
			'build:dependencies:fonts'
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
			'newer:copy:js',
			'newer:concat:js',
			'newer:concat:adminjs',
			'newer:uglify'
		]
	};

	return tasks;
};
