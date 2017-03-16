/**
 * Landing page main controller
 *
 * @package   Nova
 * @author    Rolf Bansbach
 * @copyright Copyright 2017 Trxadegroup, Inc.
 */

define('home',[
    'admin',
    'header',
    'footer',
    'mainpanel'
], function(admin){
    admin.cp.register('home',[
        '$scope', 
        '$sce', 
    function ($scope, $sce) {
        
        $scope.msg = 'test controller';
    }]);
});
