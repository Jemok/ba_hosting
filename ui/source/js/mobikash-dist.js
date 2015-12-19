//The build will inline common dependencies into this file.

//For any third party dependencies, like jQuery, place them in the lib folder.

//Configure loading modules from the lib directory,
//except for 'app' ones, which are in a sibling
//directory.
requirejs.config({
    baseUrl: 'http://patternlab.mobikash.local/js/lib',
    paths: {
        app: 'http://patternlab.mobikash.local/js/global'
    }
});

// Load the main app module to start the app
requirejs(['jquery.min', 'bootstrap']);