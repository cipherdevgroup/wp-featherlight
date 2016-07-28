// https://github.com/kswedberg/grunt-version
module.exports = {
	options: {
		pkg: {
			version: '<%= package.version %>'
		}
	},
	project: {
		src: [
			'package.json',
			'bower.json'
		]
	},
	phpConstant: {
		options: {
			prefix: 'WP_FEATHERLIGHT_VERSION\'\,\\s+\''
		},
		src: [
			'wp-featherlight.php'
		]
	},
	style: {
		options: {
			prefix: '\\s+\\*\\s+Version:\\s+'
		},
		src: [
			'wp-featherlight.php',
			'<%= paths.cssSrc %>wp-featherlight.scss'
		]
	}
};
