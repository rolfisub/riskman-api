/**
 * Landing page main controller
 *
 * @package   Nova
 * @author    Rolf Bansbach
 * @copyright Copyright 2017 Trxadegroup, Inc.
 */

define('admins',[
    'admin',
    'header',
    'footer',
    'mainpanel',
    'api'
], function(admin){
    admin.cp.register('admins',[
        '$scope', 
        '$sce',
        'api',
    function ($scope, $sce, api) {
        
        $scope.data = [
            {
                user_name: '',
                datetime:'',
                email:'',
                first_name:'',
                last_name:''
            }
        ];
        
        var init = function() {
            var r = api.read('/admins');
            r.then(function(response){
                $scope.data = response.data.admins_data;
                console.log(response);
            },function(response){
                console.log(response);
            });
        };
        
        init();
        
    }]);
});
