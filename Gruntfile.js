module.exports = function(grunt) {
  grunt.initConfig({
    //pkg : grunt.file.readJSON('package.json'),

    // uglify configuration
    uglify: {
      target : {
        src : ['public/assets/js/aperos.index.js'],
        dest : 'public/assets/js/dist/aperos.index.min.js'
      },
      options: {}
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.registerTask('default', ['uglify']);
};