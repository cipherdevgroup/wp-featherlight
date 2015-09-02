// https://github.com/sindresorhus/grunt-sass
module.exports = {
	options: {
		sourceMap: false,
		lineNumbers: false,
		outputStyle: 'expanded'
	},
	plugin: {
		files: {
			'<%= paths.tmp %>wp-featherlight.css': '<%= paths.cssSrc %>wp-featherlight.scss'
		}
	}
};
