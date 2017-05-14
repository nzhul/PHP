define(['requestModule'], function (requestModule) {
    var PhotosPersister = (function () {

        function PhotosPersister(rootUrl) {
            this.rootUrl = rootUrl;
        }

        PhotosPersister.prototype = {
            getAllPhotos: function (success, error, beforeSend) {
                var url = this.rootUrl + '?photos';
                requestModule.getJSON(url, success, error, '', beforeSend);
            },
            getAllPhotosFilter: function (filterId, success, error, beforeSend) {
                var url = this.rootUrl + '?photos=1&filter='+filterId;
                requestModule.getJSON(url, success, error, '', beforeSend);
            },
            getAllCategories: function (success, error, beforeSend) {
                var url = this.rootUrl + '?categories';
                requestModule.getJSON(url, success, error, '', beforeSend);
            }
        };

        return PhotosPersister
    }());
    return PhotosPersister
});