// https://github.com/outaTiME/grunt-replace
module.exports = {
	// Useful when forking this project into a new project
	packagename: {
		options: {
			patterns: [
				{
					match: /WP Featherlight/g,
					replacement: '<%= pkg.nameSpaced %>'
				},
				{
					match: /wp featherlight/g,
					replacement: '<%= pkg.nameSpacedLow %>'
				},
				{
					match: /wp-featherlight/g,
					replacement: '<%= pkg.nameDashed %>'
				},
				{
					match: /wp_featherlight/g,
					replacement: '<%= pkg.nameUscore %>'
				},
				{
					match: /WP_Featherlight/g,
					replacement: '<%= pkg.nameUscoreCam %>'
				},
				{
					match: /WPFeatherlight/g,
					replacement: '<%= pkg.nameCamel %>'
				},
				{
					match: /wpFeatherlight/g,
					replacement: '<%= pkg.nameCamelLow %>'
				}
			]
		},
		files: [
			{
				expand: true,
				src: [
					'**',
					'.*',
					'!<%= paths.bower %>**/*',
					'!**/*.{png,ico,jpg,gif}',
					'!node_modules/**',
					'!bower_components/**',
					'!.sass-cache/**',
					'!dist/**',
					'!logs/**',
					'!tmp/**',
					'!*.sublime*',
					'!.idea/**',
					'!.DS_Store'
				]
			}
		]
	}
};
