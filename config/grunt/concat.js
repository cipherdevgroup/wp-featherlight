// https://github.com/gruntjs/grunt-contrib-concat
module.exports = {
	js: {
		src: [
			'<%= paths.jsVend %>jquery.detect_swipe.js',
			'<%= paths.jsVend %>featherlight.js',
			'<%= paths.jsVend %>featherlight.gallery.js',
			'<%= paths.jsSrc %>wpFeatherlight.js'
		],
		dest: '<%= paths.jsDist %><%= pkg.nameCamelLow %>.pkgd.js'
	},
	adminjs: {
		src: [
			'<%= paths.jsSrc %>admin/**/*.js',
			'!<%= paths.jsSrc %>**/*.min.js'
		],
		dest: '<%= paths.jsDist %><%= pkg.nameCamelLow %>Admin.pkgd.js'
	}
};
