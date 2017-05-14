define(['jquery', 'mainPersister', 'modal', 'Handlebars'], function ($, MainPersister, modal) {
    var MainController = (function () {

        function MainController(rootUrl) {
            this.persister = new MainPersister(rootUrl);
            this.photosData = [];
            this.categoriesData = [];
        }

        MainController.prototype = {
            loadGallery: function (selector) {
                var selfController = this;

                // Render Categories Template
                selfController.persister.photos.getAllCategories(function(data){
                    selfController.categoriesData = data.data;
                    var catSource;
                    var catTemplate;
                    var catPath = '../templates/categories-row-template.html';
                    $.ajax({
                        url: catPath,
                        success: function(data){
                            catSource = data;
                            catTemplate = Handlebars.compile(catSource);
                            $('#categories-row').html(catTemplate(selfController.categoriesData));
                        }
                    });
                }, function(){
                    console.warn("Error fetching the categories from the server");
                });

                // Render the actual gallery
                this.persister.photos.getAllPhotos(function(data){
                    renderPhotos(selector, data);
                }, function(){
                    console.log("Error fetching the data from the server");
                }, function(){
                    $(selector).html('<div id="gallery-loader"><img src="img/gallery/ajax-loader.gif" alt="Loading Gallery ..."/></div>');
                });

                this.attachUIEventHandlers(selector);
            },
            updatePhotos: function (options) {

            },
            attachUIEventHandlers: function (selector) {
                var wrapper = $(selector);
                var self = this;
                wrapper.on('click', '.gallery-image-description', function () {

                    var descriptionBox = $(this);
                    var theTitle = descriptionBox.find('.gallery-image-title').html();
                    var theDescription = descriptionBox.find('.actual-description').html();

                    var thumbnail =  $(this).prev();
                    var imageFileName = thumbnail.attr('data-filename');
                    var img = $("<img />").attr('src', 'img/gallery/'+imageFileName)
                        .load(function() {
                            if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                                alert('broken image!');
                            } else {
                                var finalContent = $('<div/>');
                                finalContent.append(img);
                                finalContent.append('<h4>' + theTitle + '</h4>');
                                finalContent.append('<p>' + theDescription + '</p>');
                                modal.open({content: finalContent});
                            }
                        });
                });

                wrapper.on('mouseenter', '.gallery-thumbnail', function () {
                    $(this).next().fadeIn();
                });

                wrapper.on('mouseleave', '.gallery-image-description', function () {
                    $(this).fadeOut();
                });

                $('#categories-row').on('click', '.filter-btn', function () {
                    var filterBtn = $(this);
                    var filterId = filterBtn.attr('data-id');
                    self.persister.photos.getAllPhotosFilter(filterId ,function(data){
                        renderPhotos(selector, data);
                    }, function(){
                        console.log("Error fetching the data from the server");
                    }, function(){
                        $(selector).html('<div id="gallery-loader"><img src="img/gallery/ajax-loader.gif" alt="Loading Gallery ..."/></div>');
                    });
                });

            }
        };

        // Helpers
        function renderPhotos(selector, photosData) {
            var allPhotos = photosData.data;
            var source;
            var template;
            var path = '../templates/gallery-template.html';
            $.ajax({
                url: path,
                //cache: true,
                success: function (data) {
                    source = data;
                    template = Handlebars.compile(source);
                    $(selector).html(template(allPhotos));
                }
            });
        }


        function hideAllLayers(UICollection) {
            for (var i = 0; i < UICollection.length; i++) {
                UICollection[i].style.display = 'none';
            }
        }

        function removeChildNodes(parentNode) {
            while (parentNode.firstChild) {
                parentNode.removeChild(parentNode.firstChild);
            }
        }

        return MainController
    }());
    return MainController
});