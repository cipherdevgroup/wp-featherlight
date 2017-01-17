// https://github.com/gruntjs/grunt-contrib-copy
module.exports = {
	css: {
		files: []
	},
	js: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: '<%= paths.jsSrc %>',
				src: [
					'wpFeatherlight.js'
				],
				dest: '<%= paths.jsDist %>'
			}
		]
	},
	fonts: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: '<%= paths.fontsSrc %>',
				src: [
					'**/*'
				],
				dest: '<%= paths.fontsDist %>',
				filter: 'isFile'
			}
		]
	},
	languages: {
		files: [
			{
				expand: true,
				cwd: '<%= paths.assets %><%= paths.languages %>',
				src: [ '*.po' ],
				dest: '<%= paths.plugin %><%= paths.languages %>',
				filter: 'isFile'
			}
		]
	},
	bowercss: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: '<%= paths.bower %>',
				src: [],
				dest: '<%= paths.cssVend %>'
			}
		]
	},
	bowerjs: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: '<%= paths.bower %>',
				src: [
					'featherlight/src/featherlight.js',
					'featherlight/src/featherlight.gallery.js',
					'jquery-detect-swipe/jquery.detect_swipe.js'
				],
				dest: '<%= paths.jsVend %>'
			}
		]
	},
	bowerfonts: {
		files: []
	},
	rename: {
		files: [
			{
				expand: true,
				dot: true,
				cwd: '',
				dest: '',
				src: [
					'wp-featherlight.php'
				],
				rename: function( dest, src ) {
					return dest + src.replace( 'wp-featherlight', '<%= pkg.nameDashed %>' );
				}
			},
			{
				expand: true,
				dot: true,
				cwd: '<%= paths.jsSrc %>',
				dest: '<%= paths.jsSrc %>',
				src: [
					'**/*.js'
				],
				rename: function( dest, src ) {
					return dest + src.replace( 'wpFeatherlight', '<%= pkg.nameCamelLow %>' );
				}
			},
			{
				expand: true,
				dot: true,
				cwd: '<%= paths.cssSrc %>',
				dest: '<%= paths.cssSrc %>',
				src: [
					'**/*.scss'
				],
				rename: function( dest, src ) {
					return dest + src.replace( 'wp-featherlight', '<%= pkg.nameDashed %>' );
				}
			}
		]
	},
	release: {
		files: [
			{
				expand: true,
				src: [
					'**',
					'.*',
					'!.git/**',
					'!.sass-cache/**',
					'!.jscsrc',
					'!.jshintrc',
					'!config/**',
					'!release/**',
					'!css/src/**',
					'!languages/src/**',
					'!bower_components/**',
					'!node_modules/**',
					'!tmp/**',
					'!*.json',
					'!*.sublime*',
					'!.DS_Store',
					'!.gitattributes',
					'!.gitignore',
					'!composer.lock',
					'!gruntfile.js',
					'!package.json'
				],
				dest: '<%= paths.release %><%= pkg.version %>'
			}
		]
	}
};
