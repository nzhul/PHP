define(['userPersister', 'photosPersister'], function (UserPersister, PhotosPersister) {
    var MainPersister = (function () {

        function MainPersister(rootUrl) {
            this.rootUrl = rootUrl;
            this.user = new UserPersister(this.rootUrl);
            this.photos = new PhotosPersister(this.rootUrl);
        }

        MainPersister.prototype = {
            isUserLoggedIn: function () {
                var isLoggedIn = this.user.username !== null && this.user.sessionKey !== null;
                return isLoggedIn; // This returns true if nickname and sessionKey are defined!
            }
        };

        return MainPersister
    }());
    return MainPersister
});