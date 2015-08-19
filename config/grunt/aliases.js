module.exports = function() {
	'use strict';
	var tasks = {
		'build:dependencies:fonts': [
			'clean:fonts',
			'shell:bower',
			'copy:bowerfonts'
		],
		'build:dependencies:css': [
			'clean:css',
			'shell:bower',
			'copy:bowercss'
		],
		'build:dependencies:js': [
			'clean:js',
			'shell:bower',
			'copy:bowerjs'
		],
		'build:fonts': [
			'build:dependencies:fonts',
			'newer:copy:fonts'
		],
		'build:css': [
			'build:dependencies:css',
			'newer:sass',
			'newer:usebanner',
			'newer:postcss',
			'newer:wpcss',
			'newer:rtlcss',
			'newer:cssmin',
			'newer:replace:style',
			'newer:copy:css'
		],
		'build:images': [
			'newer:imagemin:images',
			'newer:copy:images'
		],
		'build:js': [
			'build:dependencies:js',
			'newer:concat:js',
			'newer:uglify'
		]
	};

	return tasks;
};
