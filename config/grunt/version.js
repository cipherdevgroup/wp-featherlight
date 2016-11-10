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
			prefix: 'VERSION\\s+=\\s+\''
		},
		src: [
			'includes/class-plugin.php'
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
