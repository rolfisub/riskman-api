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
    'admins/service'
], function(admin){
    admin.cp.register('admins',[
        '$scope', 
        '$sce',
        'adminsSrv',
    function ($scope, $sce, adminsSrv) {
        
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
            var r = adminsSrv.getAdminsList()
            r.then(function(response){
                $scope.data = response.data.admins_data;
            },adminsSrv.errorCallBack);
        };
        
        init();
        
    }]);
});
