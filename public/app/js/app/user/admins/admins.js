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
    'mainpanel'
], function(admin){
    admin.cp.register('admins',[
        '$scope', 
        '$sce', 
    function ($scope, $sce) {
        
        $scope.msg = 'test admins controller';
    }]);
});
