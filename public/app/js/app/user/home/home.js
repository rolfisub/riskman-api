/**
 * Landing page main controller
 *
 * @package   RiskMan Admin
 * @author    Rolf Bansbach
 * @copyright Copyright 2017 Trxadegroup, Inc.
 */

define('home',[
    'admin',
    'header',
    'footer',
    'mainpanel',
    'api'
], function(admin){
    admin.cp.register('home',[
        '$scope', 
        '$sce', 
        'api',
        'spinnerService',
        '$timeout',
    function ($scope, $sce, api, spinnerService,$timeout) {
        
        $scope.config = {
            last24Loading:true,
            monthlyLoading:true
        };
        var init = function(){
            $timeout(function(){
                spinnerService.hide('last24Spinner');
            }, 2000);
            
            $timeout(function(){
                spinnerService.hide('monthlySpinner');
            }, 1000);
        };
        init();
    }]);
});
