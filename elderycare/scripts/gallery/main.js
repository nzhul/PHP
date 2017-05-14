(function () {
    require.config({
        urlArgs: "bust=" + (new Date()).getTime(), //TODO: Remove this row
        paths: {
            'requestModule' : 'requestModule',
            'jquery': '../libs/jquery-2.1.1.min',
            'Handlebars' : '../libs/handlebars-v1.3.0',
            'modal': 'modal-plugin/modal',
            'cryptojs': '../libs/cryptojs',
            'mainPersister' : 'persisters/mainPersister',
            'mainController' : 'controllers/mainController',
            'userPersister' : 'persisters/userPersister',
            'photosPersister' : 'persisters/photosPersister'
        }
    });

    require(['requestModule', 'mainController'], function (requestModule, MainController) {

        var rootUrl = '../../rest-server/server.php';

        var controller = new MainController(rootUrl);
        controller.loadGallery('#gallery-container');
    })
}());