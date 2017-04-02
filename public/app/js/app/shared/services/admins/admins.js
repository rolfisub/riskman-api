/**
 * Admins rest interface
 *
 * @package   RiskMan
 * @author    Rolf
 * 
 */

define('admins/service',['admin'], function(admin){
    /**
     * API service wrapper to make Ajax calls for Trxade
     */
    admin.sp.factory('adminsSrv', ['api', function (api) {
        
        var admins = {
        };
        
        //private functions
        admins.getAdminsList = function()
        {   
            return api.read('/admins');
        }
        
        
        admins.errorCallBack = function(response) {
            api.errorCallback(response);
        };
        
        return admins;

    }]);
});

