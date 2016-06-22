module.exports = function (grunt) {
    var sources = [
        "lib/Client/_namespaces.js",
        "lib/Client/_helpers.js",
        "lib/Client/context.js",
        "lib/Client/render.js",
        "lib/Client/functions/**.js",
        "lib/Client/filters/**.js"
    ];

    grunt.initConfig({
        pkg: grunt.file.readJSON("package.json"),

        jshint: {
            files: sources
        },

        concat: {
            sources: {
                options: {
                    stripBanners: true,
                    banner: '(function(){\n',
                    footer: '\n})();',
                    separator: '\n\n'
                },

                files: {
                    'dist/zwig.js': sources
                }
            },

            header: {
                files: {
                    'dist/zwig.js': [
                        'lib/Client/_header.js',
                        'dist/zwig.js'
                    ]
                }
            }
        },

        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> v<%= pkg.version %> - (c) <%= pkg.author %> - <%= pkg.license %> license */\n',
                report: 'gzip'
            },
            dist: {
                files: {
                    'dist/zwig.min.js': 'dist/zwig.js'
                }
            }
        },

        watch: {
            files: sources,
            tasks: ["default"]
        }
    });


    grunt.loadNpmTasks("grunt-contrib-jshint");
    grunt.loadNpmTasks("grunt-contrib-concat");
    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-watch");

    grunt.registerTask("default", ["jshint", "concat", "uglify"]);
};
