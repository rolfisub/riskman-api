/**
 * Main angular module for trxade
 *
 * @package   Nova
 * @author    Rolf Bansbach
 * @copyright Copyright 2017 Trxadegroup, Inc.
 */

/*
 * insert angular dependency using RequireJs
 */

define('admin',[
    'angularAMD',
    'ngRoute', 
    'ui.bootstrap', 
    'click.outside',
], function(angularAMD){
    //Angular Code Start
    /*
     * Create main site angular application and inject angular dependencies
     */
    var admin = angular.module('admin',[
        //angular dependencies
        'ngRoute',
        'ui.bootstrap',
        'angular-click-outside',
    ]);

    /**
    * Set routes and main config for admin app
    * $routeProvider, $locationProvider are created by ngRoute
    * $controllerProvider, $compileProvider and $provide are globals to be able to instantiate code 
    *   after angular has done its bootstrap
    */
    admin.config(function ($routeProvider, $locationProvider, $controllerProvider, $compileProvider, $provide, $filterProvider) { 
        $routeProvider
            .otherwise({
                redirectTo: '/Admin/404'
        });
        //csrf
        $locationProvider.html5Mode({enabled: true, requireBase: false});
        
        /**
         * Global providers are used to register lazy loaded components in angular after bootstrap in to admin module
         */
        //controller provider 
        admin.cp = $controllerProvider;
        
        //directive provider
        admin.dp = $compileProvider;
        
        //service and factory provider
        admin.sp = $provide;
        
        //filter provider
        admin.fp = $filterProvider;
    });
    
    /**
     * Wrapper to create User routes
     * @param {type} controllerName
     * @returns {undefined}
     */
    admin.addUserRoute = function(controllerName){
        admin.addRoute('user', controllerName, controllerName);
    }
    
    /**
     * Wrapper to create admin routes
     * @param {type} controllerName
     * @returns {undefined}
     */
    admin.addAdminRoute = function(controllerName){
        admin.addRoute('admin', 'admin/' + controllerName, controllerName);
    }
    /**
     * @desc Creates a new route and loads required scripts on demand for that route
     * @param {string} baseFolder
     * @param {string} controllerName
     * @param {string} fileName
     * @returns {null}
     */
    admin.addRoute = function(baseFolder, controllerName, fileName){
        var myroute = '/Admin/';
        var mytemplate = '/app/js/app/' + baseFolder + '/' + fileName + '/' + fileName +'.html';
        if (baseFolder !== 'user') {
            myroute = myroute + baseFolder + '/' + fileName;
        } else {
            myroute = myroute + controllerName;
        }
        admin.config(function ($routeProvider) {
            $routeProvider
                .when(
                    myroute,
                    angularAMD.route({
                        templateUrl: mytemplate,
                        controller: controllerName
                    })
                );    
        }); 
    }
    
    
   /**
     * Create new routes here 
     */
    //landing page, routes to /market/home
    admin.addUserRoute('home');
    //top ndc page
    //admin.addUserRoute('topndc');
    
    //hello page, routes to /market/hello
    //admin.addUserRoute('hello');
    //hello page, routes to /market/hello2
    //admin.addUserRoute('hello2');
    //404 page, routes to /market/404
    //admin.addUserRoute('404');
    //hello page, routes to /market/admin/hello
    //admin.addAdminRoute('hello');
    //other routes
    
    


    return admin;
    //Angular Code End

});


