/**
 * Main configuration file Requirejs and Angular manual bootstrap call
 *
 * @package   RiskMan
 * @author    Rolf Bansbach
 * 
 */

require.config({
    //set up base url for js scripts
    baseUrl:'../../app/js',
    
    
    //library paths
    paths: {
        
        //3rd party libs:
        'angular': 'lib/angular/angular.min',
        'ngRoute': 'lib/angular/angular-route.min',
        'angularAMD': 'lib/angularAMD/angularAMD.min',
        'angular-animate': 'lib/angular/angular-animate.min',
        'angular-touch': 'lib/angular/angular-touch.min',
        'ui.bootstrap': 'lib/bootstrap-3.3.7-dist/js/ui-bootstrap-tpls.min',
        'click.outside': 'lib/angular-click-outside/angular.click.outside',
        'string': 'lib/ng-string/ng-string.min',
        
        //main application module
        'admin': 'app/admin',
        
        //services:
        'api':'app/shared/services/api/api.service',
        
        //user controllers
        'home': 'app/user/home/home',
        
        //shared controllers
        '404': 'app/user/404/404',
        
        //shared directives
        'header': 'app/shared/directives/header/header',
        'footer': 'app/shared/directives/footer/footer',
        'mainpanel': 'app/shared/directives/mainpanel/mainpanel',
        'navbar': 'app/shared/directives/navbar/navbar',
        'sidebar': 'app/shared/directives/sidebar/sidebar',
        
        //admin controllers
        //'admin/hello': 'app/admin/hello/hello',
        
        //admin directives
        
        
    },
    
    //wrapper for compatibility and lib dependencies
    shim: {
        'angular':{
            exports:'angular',
        },
        'ngRoute':{
            deps:['angular'],
        },
        'angularAMD':{
            deps:['angular'],
        },
        'ui.bootstrap':{
            deps:[
                'angular', 
                'angular-animate',
                'angular-touch'
            ]
        },
        'angular-touch':{
            deps:['angular'],
        },
        'angular-animate':{
            deps:['angular'],
        },
        'click.outside': {
            deps:['angular'],
        },
        'string':{
            deps:['angular']
        }
        
    },
    
});

//angular bootstrap
require(['angularAMD', 'admin'], function (angularAMD, admin) {
    //on document ready
    angular.element(document).ready(function () {
        // initialisation code defined within admin.js
        angular.bootstrap(document, ['admin']);
        //angularAMD.bootstrap(admin);
    });
});


