/*
	Advanced Slider
*/
(function($) {
	
	function AdvancedSlider(instance, options) {
		
		// reference to the main DIV that contains the slider
		var slider = $(instance),
			
			// reference to the current object
			self = this,
			
			// index of the current slide
			currentIndex = -1,
			
			// index of the previous slide
			previousIndex = -1,
			
			// array of objects, each object containing data(path, thumbnail, caption etc.) about the slide
			slides = [],
			
			// reference to the DIV element of the current slide
			currentSlideDiv = null,
			
			// reference to the DIV element of the previous slide
			previousSlideDiv = null,
			
			// indicates whether the slider is in the transition phase
			isTransition = false,
			
			// will be used as the timer for the slideshow mode
			slideshowTimer = 0,
			
			// will be used for the timer animation
			timerAnimationTimer = 0,
			
			// indicated whether the slideshow is playing or is paused
			slideshowState = '',
			
			// these properties can be assign to individual slides in the XML file
			slideProps = ['alignType', 'effectType', 'sliceDelay', 'sliceDuration', 'horizontalSlices', 'verticalSlices', 'slicePattern', 'slicePoint', 'slideStartPosition',
						  'slideStartRatio', 'sliceFade', 'captionSize', 'captionPosition', 'captionShowEffectDuration', 'captionHideEffectDuration', 'captionShowEffect', 'captionHideEffect', 
						  'captionLeft', 'captionTop', 'captionWidth', 'captionHeight', 'captionShowSlideDirection', 'captionHideSlideDirection', 'slideshowDelay', 'slideMask', 'linkTarget'];
		
		// contains all the settings for the slider
		this.settings = $.extend({}, $.fn.advancedSlider.defaults, options);
		
		
		// START
		init();
		

		/**
		* Initializes the slider
		*/
		function init() {
			// delete the content of the selected DIV and initialize it
			slider.addClass('advanced-slider')
			 	  .css({width: self.settings.width, height: self.settings.height});
			
			if (self.settings.xmlSource) {
				// delete the previous content of the selected DIV
				slider.empty();
				
				//parse the XML file
				$.ajax({type:'GET', url:self.settings.xmlSource, dataType: $.browser.msie ? 'text' : 'xml', success:function(data) {																													
					var xml;
					
					if ($.browser.msie) {
						xml = new ActiveXObject('Microsoft.XMLDOM');
						xml.async = false;
						xml.loadXML(data);
					} else {
						xml = data;
					}
					
					// find all the <slide> nodes
					$(xml).find('slide').each(function() {
						// will contain data such as path, thumbnail, caption or link
						var slide = {};
						
						// will contain data such as effectType, sliceDelay, sliceDuration etc.
						slide.properties = {};
						
						// reads all the tags that were specified for a slide in the XML file
						for (var i = 0; i < $(this).children().length; i++) {						
							var node = $(this).children()[i];
							slide[node.nodeName] = $(this).find(node.nodeName).text();
						}
						
						// reads all the attributes that were specified for a slide in the XML file
						for (var i = 0; i < slideProps.length; i++) {
							var name = slideProps[i],
								value = $(this).attr(name);
								
							// if a property was not specified in the XML file, take the default value							
							if (value == undefined)
								slide.properties[name] = self.settings[name];
							else
								slide.properties[name] = value;
						}
						
						slides.push(slide);
					});
					
					create();					
				}});
			} else {
				// if an XML file was not specified, read the content of the selected div
				slider.children().each(function(index) {					  
					// will contain data such as path, thumbnail, caption, or link
					var slide = {};
					
					// will contain data such as effectType, sliceDelay, sliceDuration etc.
					slide.properties = {};

					// loops through all the sub-children of child
					for (var i = 0; i < $(this).children().length; i++) {
						var data = $(this).children()[i];
						
						// check whether the current sub-child is an image, a thumbnail, a link, or a paragraph, and copy the data
						if($(data).is('a')) {
							slide['path'] = $(data).find('img').attr('src');
							slide['link'] = $(data).attr('href');
							if ($(data).attr('target'))
								slide.properties.linkTarget = $(data).attr('target');
						} else if($(data).is('img')) {
							if ($(data).hasClass('thumbnail'))
								slide['thumbnail'] = $(data).attr('src');
							else
								slide['path'] = $(data).attr('src');
						} else {
							slide[$(data).attr('class')] = $(data).html();
						}
					}
					
					// reads all the settings that were specified for each slide
					for (var i = 0; i < slideProps.length; i++) {
						var name = slideProps[i],
							value;
						
						if (self.settings.slideProperties)
							if (self.settings.slideProperties[index])
								value = self.settings.slideProperties[index][name];
								
						// if a property was not specified for the slide, take the default value
						if (!slide.properties[name])
							if (value == undefined)
								slide.properties[name] = self.settings[name];
							else
								slide.properties[name] = value;
					}
					
					//console.log(index)
					slides.push(slide);
				});
				
				// delete the current content of the selected div and create the slider
				slider.empty();
				create();
			}
		}
		
		
		/**
		* Creates all the assets, preloads the slides and opens the first slide
		*/
		function create() {
			
			if (self.settings.shuffle)
				slides.sort(function(){return 0.5 - Math.random()});					
						
			if (self.settings.navigationArrows)
				createNavigationArrows();
				
			if (self.settings.navigationButtons)
				createNavigationButtons();
						
			if (self.settings.slideshowControls)
				createSlideshowControls();
				
			if (self.settings.slidesPreloaded) {
				showPreloader();
				
				// contains the number of slides that were preloaded
				var counter = 0,
						
				// the number of slides that need to be preloaded
				// if -1 was specified, all the slides will be preloaded
				n = self.settings.slidesPreloaded == -1 ? slides.length : self.settings.slidesPreloaded;
						
				// load the images
				for (var i = 0; i < n; i++) {						
					$('<img/>').load(function() {
										 counter++;
										 if (counter == n) {
											 hidePreloader();
											 gotoSlide(self.settings.slideStart);
										 }
									 })
								.attr('src', slides[i].path);
				}
			} else {
				gotoSlide(self.settings.slideStart);
			}
		}
		
		
		/**
		* Creates the left and right arrows
		*/
		function createNavigationArrows() {						
			var initialOpacity = self.settings.hideNavigationArrows == true ? 0 : 1,
			
				arrowNavigation = $('<div class="arrow-navigation"></div>').appendTo(slider),
			
				leftArrow = $('<a class="left-arrow"></a>').css('opacity', initialOpacity)
														   .mouseover(function(){$(this).stop().css('opacity', 1)})
														   .click(function(){previousSlide();})
														   .appendTo(arrowNavigation),
			
				rightArrow = $('<a class="right-arrow"></a>').css('opacity', initialOpacity)
														     .mouseover(function(){$(this).stop().css('opacity', 1)})
														     .click(function(){nextSlide();})
														     .appendTo(arrowNavigation);
		}
		
		
		/**
		* Creates the slideshow control (play and pause) buttons
		*/
		function createSlideshowControls() {			
			var slideshowControls = $('<div class="slideshow-controls"></div>').appendTo(slider);
				currentClass = self.settings.slideshow ? 'slideshow-pause': 'slideshow-play';
				
			slideshowControls.addClass(currentClass)
							 .css('opacity', 0)
							 .mouseover(function(){$(this).stop().css('opacity', 1)})
							 .click(function() {
										if ($(this).hasClass('slideshow-pause')) {
											$(this).removeClass('slideshow-pause').addClass('slideshow-play');
											slideshowState = 'pause';
											stopSlideshow();
										} else if ($(this).hasClass('slideshow-play')) {
											//set the slideshow property to true if it was not previously set
											if (!self.settings.slideshow)
												self.settings.slideshow = true;
											
											$(this).removeClass('slideshow-play').addClass('slideshow-pause');											
											slideshowState = 'play';
											startSlideshow();
										}
									});
		}
		
		
		/**
		* Automatically creates the navigation buttons based on how many slides are in the slideshow
		*/
		function createNavigationButtons() {
			var numButtons = slides.length,			
				buttonsNavigation = $('<div class="buttons-navigation"></div>').appendTo(slider);
			
			for (var i = 0; i < numButtons; i++) {
				var button = $('<a rel="' + i + '"></a>').appendTo(buttonsNavigation);
				
				button.bind({mouseover:function() {
								var index = $(this).attr('rel');
								
								if (!$(this).hasClass('select'))
									$(this).addClass('over');						
								
								if (self.settings.showThumbnails)
									showThumbnail(index);
							},
				
							mouseout:function() {
								if (!$(this).hasClass('select'))
									$(this).removeClass('over');
									
								if (self.settings.showThumbnails)
									hideThumbnail();
							},
				
							click:function() {
								if (!isTransition)
									gotoSlide(parseInt($(this).attr('rel')));
							}});
			}
			
			// if true, the buttons will be horizontally positioned in the center
			// if false, the buttons will be posistioned based on the value of the 'left' property specified in the CSS
			if (self.settings.navigationButtonsCenter) {
				var leftPos = (self.settings.width - buttonsNavigation.outerWidth()) / 2;			
				buttonsNavigation.css('left', leftPos);
			}
		}
		
		
		/**
		* Shows the thumbnail for the specified index
		*/
		function showThumbnail(index) {
			// check if a thumbnail image was specified
			if (!slides[index].thumbnail)
				return;
			
			// holds a reference to the navigation button that is rolled over
			var button = slider.find('.buttons-navigation a').eq(index),
			
				// the path to the thumbnail image
				thumbnailPath = slides[index].thumbnail,
				thumbnail = $('<div class="thumbnail"></div>').appendTo(slider.find('.buttons-navigation')),
				
				// calculate the position of the thumbnail image
				leftPos = parseInt(button.position().left) - (parseInt(thumbnail.outerWidth(true)) - parseInt(button.css('width'))) / 2,
				topPos = parseInt(button.position().top) - (parseInt(thumbnail.outerHeight(true)));
			
			thumbnail.css({'left':leftPos, 'top':topPos - self.settings.thumbnailSlide,
						   'opacity':0});
			
			// load the image using the <img> tag and when it's completely assign it as a background to the thumbnail DIV
			$('<img/>').load(function() {
								 thumbnail.css('background-image','url('+ thumbnailPath +')');
							 })
					   .attr('src', thumbnailPath);
									
			thumbnail.animate({'top':topPos, 'opacity':1}, self.settings.thumbnailDuration);
		}
		
		
		/**
		* Hides the visible thumbnail
		*/
		function hideThumbnail() {
			// check if there is a visible thumbnail
			var thumbnail = slider.find('.buttons-navigation .thumbnail');
			if (!thumbnail)
				return;
				
			thumbnail.animate({'top':parseInt(thumbnail.css('top')) - self.settings.thumbnailSlide, 'opacity':0}, self.settings.thumbnailDuration, function(){thumbnail.remove();})
		}		
		
		
		/**
		* Opens the slide with the specified index
		*/
		function gotoSlide(index) {
			// if the slider is already in the transition phase, return 
			if (isTransition)
				return;
			
			// if the slideshow mode is on, stop the slideshow timer
			if (self.settings.slideshow)
				stopSlideshow();
				
			isTransition = true;
			previousIndex = currentIndex;
			currentIndex = index;
			
			// an object that contains all the data for the current slide
			var slideData = slides[currentIndex];
			
			showPreloader();
			
			// first load the image using the <img> tag and when it is completely loaded, start the transition
			$('<img/>').load(function() {	
										 slideData.width = $(this).attr('width');
										 slideData.height = $(this).attr('height');
										 hidePreloader();
										 startTransition();
									})
					   .attr('src', slideData.path);
			
			// select the navigation button that corresponds to the current slide
			if (self.settings.navigationButtons) {
				var buttonsNavigation = slider.find('.buttons-navigation');
				
				buttonsNavigation.find('.select').attr('class', 'out');
				buttonsNavigation.find('a').eq(index).attr('class', 'select');	
			}
			
			
			// fire the 'slideOpen' event
			var eventObject = {type: 'slideOpen', index:currentIndex, data:slides[currentIndex]};
			$.isFunction(self.settings.slideOpen) && self.settings.slideOpen.call(this, eventObject);
		}
		
		
		/**
		* Opens the next slide
		*/
		function nextSlide() {
			if (isTransition)
				return;
				
			var index = (currentIndex == slides.length - 1) ? 0 : (currentIndex + 1);
			gotoSlide(index);
		}
		
		
		/**
		* Opens the previous slide
		*/
		function previousSlide() {
			if (isTransition)
				return;
				
			var index = currentIndex == 0 ? (slides.length - 1) : (currentIndex - 1);
			gotoSlide(index);
		}
		
		
		/**
		* Shows the main preloader
		*/
		function showPreloader() {
			var preloader = $('<div class="preloader"></div>').hide()
										   				      .fadeIn(300)
										   				      .appendTo(slider),
				
				// calculate the preloader's position
				preloaderLeft = ((self.settings.width - parseInt(preloader.css('width'))) * 0.5),
				preloaderTop = ((self.settings.height - parseInt(preloader.css('height'))) * 0.5);
			
			preloader.css({'left':preloaderLeft, 'top':preloaderTop});
		}
		
		
		/**
		* Hides the main preloader
		*/
		function hidePreloader() {
			slider.find('.preloader').remove();
		}
		
		
		/**
		* Starts the transition
		*/
		function startTransition() {
			// get all the data of the new slide
			var slideData = slides[currentIndex];			
			
			// checks if there is currently a slide
			// this will be false only when the first slide is opened
			if (previousIndex != -1) {
				// set the previous slide at a lower z-index postion
				var zIndex = slider.find('.slide').css('z-index');
				previousSlideDiv = slider.find('.slide').css('z-index', zIndex - 1);
				
				var previousWidth = slides[previousIndex].width,
					previousHeight = slides[previousIndex].height,
				
					currentWidth = slideData.width,
					currentHeight = slideData.height;
				
				// if the old slide has a bigger size than the new one, fade out the old slide
				if ((currentWidth < self.settings.width && currentWidth < previousWidth) || (currentHeight < self.settings.height && currentHeight < previousHeight)) {
					previousSlideDiv.fadeOut(300);	
				}
				
				// remove the caption
				if (slides[previousIndex].caption)
					removeCaption();
			}
			
			// create the new slide DIV
			currentSlideDiv = $('<div class="slide"></div>').appendTo(slider);
			
			// show/hide the arrows, the slideshow buttons and the timer animation on hover
			// fire the events
			currentSlideDiv.bind({mouseover:function() {
									if (self.settings.hideNavigationArrows)
										slider.find('.arrow-navigation a').stop().animate({opacity:1}, 500);
									
									if (self.settings.slideshowControls)
										slider.find('.slideshow-controls').stop().animate({opacity:1}, 500);
										
									if (self.settings.timerAnimation && self.settings.hideTimer && !isTransition) {
										var timerCanvas = slider.find('#timer-animation');
										
										if (!$.browser.msie) {
											timerCanvas.stop().animate({'opacity':1}, self.settings.timerFadeDuration);
										} else {
											timerCanvas.css('filter', '');
										}
									}
										
									var eventObject = {type: 'slideMouseOver', index:currentIndex, data:slideData};
									$.isFunction(self.settings.slideMouseOver) && self.settings.slideMouseOver.call(this, eventObject);
								},
								
								mouseout:function() {
									if (self.settings.hideNavigationArrows)
										slider.find('.arrow-navigation a').stop().animate({opacity:0}, 500);
									
									if (self.settings.slideshowControls)
										slider.find('.slideshow-controls').stop().animate({opacity:0}, 500);
										
									if (self.settings.timerAnimation && self.settings.hideTimer && !isTransition) {
										var timerCanvas = slider.find('#timer-animation');
										
										if (!$.browser.msie) {
											timerCanvas.stop().animate({'opacity':0}, self.settings.timerFadeDuration);
										} else {
											timerCanvas.css('opacity', 0);
										}
									}
										
									var eventObject = {type: 'slideMouseOut', index:currentIndex, data:slideData};
									$.isFunction(self.settings.slideMouseOut) && self.settings.slideMouseOut.call(this, eventObject);
								},
			
								click:function() {
									var eventObject = {type: 'slideClick', index:currentIndex, data:slideData};
									$.isFunction(self.settings.slideClick) && self.settings.slideClick.call(this, eventObject);
								}});
			
			// get the properties of the new slide
			var properties = slideData.properties,
			
				alignType = properties.alignType,
				horizontalSlices = parseInt(properties.horizontalSlices),
				verticalSlices = parseInt(properties.verticalSlices),
				slicePattern = properties.slicePattern,
				effectType = properties.effectType,
				slicePoint = properties.slicePoint,
				slideStartPosition = properties.slideStartPosition,
				slideStartRatio = parseFloat(properties.slideStartRatio),
				sliceDuration = parseInt(properties.sliceDuration),
				sliceDelay = parseInt(properties.sliceDelay),
				sliceFade = properties.sliceFade == true ? 0 : 1,
				
				//calculate the width and height of the slices
				sliceWidth = Math.floor(Math.min(slideData.width, self.settings.width) / horizontalSlices),
				sliceHeight = Math.floor(Math.min(slideData.height, self.settings.height) / verticalSlices),
				
				//calcualte the background's offset based on the align type specified
				offsetBgLeft = (slideData.width > self.settings.width) ? getLeftOffset(alignType, slideData.width, self.settings.width) : 0,
				offsetBgTop = (slideData.height > self.settings.height) ? getTopOffset(alignType, slideData.height, self.settings.height) : 0,
				
				//calcualte the position offset based on the align type specified
				offsetPosLeft = (slideData.width < self.settings.width) ? Math.floor((self.settings.width - slideData.width) / 2) : 0,
				offsetPosTop = (slideData.height < self.settings.height) ? Math.floor((self.settings.height - slideData.height) / 2) : 0,
				
				initialSlices = [];
				
			if (properties.slideMask)
				currentSlideDiv.css('overflow', 'hidden');
			
			// create the slices
			for (var i = 0; i < horizontalSlices; i++) {
				for (var j = 0; j < verticalSlices; j++) {
					var slice = $('<div class="slice"></div>').css({'background-image': 'url(' + slideData.path + ')',
																	'background-position': - (i * sliceWidth + offsetBgLeft) + 'px' + ' ' + - (j * sliceHeight + offsetBgTop) + 'px',
																	'background-repeat': 'no-repeat',
																	'left': i * sliceWidth + offsetPosLeft, 'top': j * sliceHeight + offsetPosTop,
																	'width': sliceWidth, 'height': sliceHeight,
																	'opacity': sliceFade})
															   .data({'hPos':i, 'vPos':j})
												  			   .appendTo(currentSlideDiv);
															   
					initialSlices.push(slice);
				}
			}	
			
			
			// if the 'random' value was specified for some of the properties, randomly select a new value for that property
			
			if (effectType == 'random') {
				var effects = ['scale', 'width', 'height', 'slide', 'fade'];
				effectType = getRandom(effects);
			}
			
			if (slicePattern == 'random') {
				var patterns = ['randomPattern', 'topToBottom', 'bottomToTop', 'leftToRight', 'rightToLeft', 'topLeftToBottomRight', 'topRightToBottomLeft', 'bottomLeftToTopRight',
								'bottomRightToTopLeft', 'horizontalMarginToCenter', 'horizontalCenterToMargin', 'marginToCenter', 'verticalCenterToMargin', 'skipOneTopToBottom',
								'skipOneBottomToTop', 'skipOneLeftToRight', 'skipOneRightToLeft', 'skipOneHorizontal', 'skipOneVertical', 'spiralMarginToCenterCW', 
								'spiralMarginToCenterCCW', 'spiralCenterToMarginCW', 'spiralCenterToMarginCCW'];				
				slicePattern = getRandom(patterns);
			}
			
			if (slicePoint == 'random') {
				var points = ['leftTop', 'leftCenter', 'leftBottom', 'centerTop', 'centerCenter', 'centerBottom', 'rightTop', 'rightCenter', 'rightBottom'];				
				slicePoint = getRandom(points);
			}
			
			if (slideStartPosition == 'random') {
				var positions = ['left', 'right', 'top', 'bottom', 'leftTop', 'rightTop', 'leftBottom', 'horizontalAlternative', 'verticalAlternative'];
				slideStartPosition = getRandom(positions);
			}			
			
			// get the slices in a specific order, based on the slicePattern property
			var orderedSlices = getOrderedSlices(initialSlices, slicePattern, horizontalSlices, verticalSlices),			
				n  = orderedSlices.length;
			
			// animate all the slices
			for (var i = 0; i < n; i++) {
				animateSlice(orderedSlices[i], i, n, effectType, slicePoint, slideStartPosition, slideStartRatio, sliceDuration, sliceDelay);
			}		
			
			// fire the 'transitionStart' event
			var eventObject = {type: 'transitionStart', index:currentIndex, data:slideData};
			$.isFunction(self.settings.transitionStart) && self.settings.transitionStart.call(this, eventObject);
		}
		
		
		/**
		* This is called at the end of the transition
		*/
		function endTransition() {
			var slideData = slides[currentIndex],
			
				alignType = slideData.properties.alignType,
				offsetLeft = getLeftOffset(alignType, slideData.width, self.settings.width),
				offsetTop = getTopOffset(alignType, slideData.height, self.settings.height);
			
			isTransition = false;
			
			// remove all the slices
			currentSlideDiv.find('.slice').remove();
			
			// show the image as a background
			currentSlideDiv.css({'background-image': 'url(' + slideData.path + ')',
						  	  	 'background-position': - offsetLeft + 'px' + ' ' + - offsetTop + 'px',
						  	  	 'background-repeat': 'no-repeat'});
			
			
			// if a link was specified for this slide, make the slide clickable
			if(slideData.link) {
				currentSlideDiv.css('cursor', 'pointer');
				
				currentSlideDiv.click(function() {
					window.open(slideData.link, slideData.properties.linkTarget);
				});
			}
			
			// remove the previous slide
			if (previousSlideDiv)
				previousSlideDiv.remove();
			
			// restart the slideshow
			if (self.settings.slideshow && slideshowState != 'pause')
				startSlideshow();
			
			// if a caption was specified for this slide, create it
			if (slideData.caption)
				createCaption();
				
			// fire the 'transitionComplete' event
			var eventObject = {type: 'transitionComplete', index:currentIndex, data:slideData};
			$.isFunction(self.settings.transitionComplete) && self.settings.transitionComplete.call(this, eventObject);
		}
		
		
		/**
		* Returns a random element from an array
		*/
		function getRandom(array) {
			return	array[Math.floor((Math.random() * array.length))];
		}
		
		
		/**
		* Creates the caption
		*/
		function createCaption() {
			// get the specified values for the current caption
			var slideData = slides[currentIndex],
				properties = slideData.properties,
				
				captionPosition = properties.captionPosition,
				captionSize = parseInt(properties.captionSize),
				captionWidth = parseInt(properties.captionWidth),
				captionHeight = parseInt(properties.captionHeight),
				captionLeft = parseInt(properties.captionLeft),
				captionTop = parseInt(properties.captionTop),
				
				captionShowEffect = properties.captionShowEffect,
				captionShowEffectDuration = parseInt(properties.captionShowEffectDuration),
				captionShowSlideDirection = properties.captionShowSlideDirection,
			
				currentWidth = Math.min(slideData.width, self.settings.width),
				currentHeight = Math.min(slideData.height, self.settings.height),
			
				containerWidth = (captionPosition == "custom") ? captionWidth : currentWidth,
				containerHeight = (captionPosition == "custom") ? captionHeight : currentHeight,
				containerLeft = (captionPosition == "custom") ? captionLeft : (self.settings.width - containerWidth) / 2,
				containerTop = (captionPosition == "custom") ? captionTop : (self.settings.height - containerHeight) / 2,			
			
				captionContainer = $('<div class="caption-container"></div>').appendTo(slider),
				captionWrapper = $('<div class="caption-wrapper"></div>').appendTo(captionContainer),
				captionBackground = $('<div class="caption-background"></div>').css('opacity', self.settings.captionBackgroundOpacity)
																			   .appendTo(captionWrapper),
				captionContent = $('<div class="caption-content"></div>').html(slideData.caption)
											 							 .appendTo(captionWrapper),
				
				initialPosition = captionShowEffect == "fade" ? 0 : captionSize,
				endState = {};			
			
			
			switch (captionPosition) {
				case 'left':
					captionContainer.css({'width': captionSize, 'height': containerHeight, 'left': containerLeft, 'top': containerTop});
					if (captionShowSlideDirection == 'auto')
						captionWrapper.css({'width': captionSize, 'height': containerHeight, 'left': -initialPosition, 'top': 0});
					break;
					
				case 'right':
					captionContainer.css({'width': captionSize, 'height': containerHeight, 'right': containerLeft, 'top': containerTop});
					if (captionShowSlideDirection == 'auto')
						captionWrapper.css({'width': captionSize, 'height': containerHeight, 'left': initialPosition, 'top': 0});
					break;
					
				case 'top':
					captionContainer.css({'width':containerWidth, 'height': captionSize, 'left': containerLeft, 'top': containerTop});
					if (captionShowSlideDirection == 'auto')
						captionWrapper.css({'width':containerWidth, 'height': captionSize, 'left': 0, 'top': -initialPosition});
					break;
					
				case 'bottom':
					captionContainer.css({'width': containerWidth, 'height': captionSize, 'left': containerLeft, 'bottom': containerTop});
					if (captionShowSlideDirection == 'auto')
						captionWrapper.css({'width': containerWidth, 'height': captionSize, 'left': 0, 'top': initialPosition});
					break;
					
				case 'custom':
					captionContainer.css({'width': containerWidth, 'height': containerHeight, 'left': containerLeft, 'top': containerTop});
					captionWrapper.css({'width': containerWidth, 'height': containerHeight, 'left': 0, 'top': 0});
					break;
					
				case 'default':
					captionContainer.css({'width': containerWidth, 'height': captionSize, 'left': containerLeft, 'bottom': containerTop});
					if (captionShowSlideDirection == 'auto')
						captionWrapper.css({'width': containerWidth, 'height': captionSize, 'left': 0, 'top': initialPosition});
					break;
			}
					
			if (captionShowEffect == "fade") {
				
				if ($.browser.msie) {
					captionContent.css({'opacity': 0});
					captionContent.animate({'opacity': 1}, captionShowEffectDuration);
					
					captionBackground.css({'opacity': 0});
					captionBackground.animate({'opacity': self.settings.captionBackgroundOpacity}, captionShowEffectDuration);	
				} else {
					captionWrapper.css({'opacity': 0});
					captionWrapper.animate({'opacity': 1}, captionShowEffectDuration);
				}
				
			} else {
				
				if (captionPosition == 'custom')
					captionContainer.css({'width': containerWidth, 'height': containerHeight, 'left': containerLeft, 'top': containerTop});
				
				if (captionShowSlideDirection == 'topToBottom')
					captionWrapper.css({'width':containerWidth, 'height': containerHeight, 'left': 0, 'top': -containerHeight});
				else if (captionShowSlideDirection == 'bottomToTop')
					captionWrapper.css({'width': containerWidth, 'height': containerHeight, 'left': 0, 'top': containerHeight});
				else if (captionShowSlideDirection == 'leftToRight')
					captionWrapper.css({'width': containerWidth, 'height': containerHeight, 'left': -containerWidth, 'top': 0});
				else if (captionShowSlideDirection == 'rightToLeft')
					captionWrapper.css({'width': containerWidth, 'height': containerHeight, 'left': containerWidth, 'top': 0});
						
				captionWrapper.animate({'top':0, 'left':0}, captionShowEffectDuration);
			}
			
			
		}
		
		
		/**
		* Removes the caption
		*/
		function removeCaption() {
			var captionContainer = slider.find('.caption-container'),
				captionWrapper = captionContainer.find('.caption-wrapper'),
				properties = slides[previousIndex].properties,
				
				captionPosition = properties.captionPosition,
				captionHideEffect = properties.captionHideEffect,
				captionHideEffectDuration = parseInt(properties.captionHideEffectDuration),
				captionHideSlideDirection = properties.captionHideSlideDirection;
				
			if (captionHideEffect == "fade") {				
				captionContainer.animate({'opacity': 0}, captionHideEffectDuration, function(){captionContainer.remove();});
				
			} else {
				
				if (captionHideSlideDirection == 'topToBottom')
					captionWrapper.animate({'top': parseInt(captionWrapper.css('height'))}, captionHideEffectDuration, function(){captionContainer.remove();});
				else if (captionHideSlideDirection == 'bottomToTop')
					captionWrapper.animate({'top': - parseInt(captionWrapper.css('height'))}, captionHideEffectDuration, function(){captionContainer.remove();});
				else if (captionHideSlideDirection == 'leftToRight')
					captionWrapper.animate({'left': parseInt(captionWrapper.css('width'))}, captionHideEffectDuration, function(){captionContainer.remove();});
				else if (captionHideSlideDirection == 'rightToLeft')
					captionWrapper.animate({'left': - parseInt(captionWrapper.css('width'))}, captionHideEffectDuration, function(){captionContainer.remove();});
				else if (captionHideSlideDirection == 'auto')
					switch (captionPosition) {
						case 'left':
							captionWrapper.animate({'left': - parseInt(captionWrapper.css('width'))}, captionHideEffectDuration, function(){captionContainer.remove();});
							break;
							
						case 'right':
							captionWrapper.animate({'left': parseInt(captionWrapper.css('width'))}, captionHideEffectDuration, function(){captionContainer.remove();});
							break;
							
						case 'top':
							captionWrapper.animate({'top': - parseInt(captionWrapper.css('height'))}, captionHideEffectDuration, function(){captionContainer.remove();});
							break;
							
						case 'bottom':
							captionWrapper.animate({'top': parseInt(captionWrapper.css('height'))}, captionHideEffectDuration, function(){captionContainer.remove();});
							break;
							
						case 'custom':
							captionWrapper.animate({'top': parseInt(captionWrapper.css('height'))}, captionHideEffectDuration, function(){captionContainer.remove();});
							break;
							
						case 'default':
							captionWrapper.animate({'top': parseInt(captionWrapper.css('height'))}, captionHideEffectDuration, function(){captionContainer.remove();});
							break;
					}
			
			}
			
		}		
		
		
		/**
		* Starts the slideshow
		*/
		function startSlideshow() {
			var delay = slides[currentIndex].properties.slideshowDelay || self.settings.slideshowDelay;
			
			if (self.settings.timerAnimation)
				startTimerAnimation(delay);
			
			slideshowTimer = setTimeout(function() {
				if (self.settings.slideshowDirection == 'next')
					nextSlide();
				else if (self.settings.slideshowDirection == 'previous')
					previousSlide();
			}, delay);
		}
		
		
		/**
		* Stops the slideshow
		*/
		function stopSlideshow() {			
			if (slideshowTimer)
				clearTimeout(slideshowTimer);
				
			if (self.settings.timerAnimation)
				stopTimerAnimation();
		}
		
		
		/**
		* Creates the timer animation
		*/
		function startTimerAnimation(delay) {
			// create a canvas element
			var timerCanvas = document.createElement('canvas'),
			
				// calculate the diagonal of the timer based on the strokes's width and the specified radius
				timerSize = Math.max(self.settings.timerStrokeWidth1, self.settings.timerStrokeWidth2) + self.settings.timerRadius * 2,
				
				// calculate the center of the timer
				timerPosition = timerSize / 2,
				
				// used to transform degrees in radians
				radians = Math.PI / 180,
				
				// the current angle of the animated circle
				angle = 0,
				
				// will be used how much time has passed since the animation started
				initialTime = (new Date()).getTime(),
				currentTime,
				timePassed,
				
				// values for the color and opacity of the timer
				strokeOpacity1 = self.settings.timerStrokeOpacity1,
				strokeOpacity2 = self.settings.timerStrokeOpacity2,
				strokeRed1 = hexToRGB(self.settings.timerStrokeColor1).red,
				strokeGreen1 = hexToRGB(self.settings.timerStrokeColor1).green,					
				strokeBlue1 = hexToRGB(self.settings.timerStrokeColor1).blue,
				strokeRed2 = hexToRGB(self.settings.timerStrokeColor2).red,
				strokeGreen2 = hexToRGB(self.settings.timerStrokeColor2).green,					
				strokeBlue2 = hexToRGB(self.settings.timerStrokeColor2).blue;
				
				
			timerCanvas.width = timerCanvas.height = timerSize;
			
			// add the canvas to the slider
			$(timerCanvas).attr('id', 'timer-animation')
						  .appendTo(slider);
			
			
			if (self.settings.hideTimer) {
				$(timerCanvas).css({'opacity':0});
			} else {
				// fade in the canvas
				if (!$.browser.msie) {
					$(timerCanvas).css({'opacity':0})
								  .stop().animate({'opacity':1}, self.settings.timerFadeDuration);
				}
			}
			
			// IE doesn't support 'canvas', so a 3rd parth library is used: excanvas.js
			if ($.browser.msie)
				timerCanvas = G_vmlCanvasManager.initElement(timerCanvas);
				
			var	ctx = timerCanvas.getContext("2d");			
				
			timerAnimationTimer = setInterval(function() {
				if (angle <= 360) {
					currentTime = (new Date()).getTime();
					timePassed = (currentTime - initialTime);
					
					// calculate the angle on the circle based on how much time has passed
					angle = (timePassed / delay) * 360 + 1;
					if (angle > 360) 
						angle = 360;
					
					// clear the canvas
					timerCanvas.width = timerCanvas.width;
					
					// draw the underlying circle
					ctx.beginPath();
					ctx.lineWidth = self.settings.timerStrokeWidth1;
					ctx.strokeStyle = 'rgba(' + strokeRed1 + ', ' + strokeGreen1 + ', ' + strokeBlue1 + ', ' + strokeOpacity1 + ')';	
					ctx.arc(timerPosition, timerPosition, self.settings.timerRadius, 0, 2 * Math.PI, false);
					ctx.stroke();
					
					// draw the animated circle
					ctx.beginPath();
					ctx.lineWidth = self.settings.timerStrokeWidth2;
					ctx.strokeStyle = 'rgba(' + strokeRed2 + ', ' + strokeGreen2 + ', ' + strokeBlue2 + ', ' + strokeOpacity2 + ')';				
					ctx.arc(timerPosition, timerPosition, self.settings.timerRadius, 0, angle * radians, false);
					ctx.stroke();
				}
			}, 20);
		}
		
		
		/**
		* Stops the timer animation and removes the canvas
		*/
		function stopTimerAnimation() {
			if (timerAnimationTimer)
				clearInterval(timerAnimationTimer);
			
			var timerCanvas = slider.find('#timer-animation');
			
			if (timerCanvas)
			{
				if (!$.browser.msie)
					timerCanvas.stop().animate({'opacity':0}, self.settings.timerFadeDuration, function(){timerCanvas.remove();});
				else
					timerCanvas.remove();
			}
		}
		
		
		/**
		* Returns the left offset of the slide based on the specified align type, and the difference between the slider's specified width and the slide's actual width
		*/
		function getLeftOffset(alignType, fullWidth, setWidth) {
			var left = 0;
			
			if (alignType == 'centerTop' || alignType == 'centerCenter' || alignType == 'centerBottom')
				left = Math.floor((fullWidth - setWidth) / 2);
			else if (alignType == 'rightTop' || alignType == 'rightCenter' || alignType == 'rightBottom')
				left = fullWidth - setWidth;
			
			return left;
		}
		
		
		
		/**
		* Returns the top offset of the slide based on the specified align type, and the difference between the slider's specified height and the slide's actual height
		*/
		function getTopOffset(alignType, fullHeight, setHeight) {
			var top = 0;
			
			if (alignType == 'leftCenter' || alignType == 'centerCenter' || alignType == 'rightCenter')
				top = Math.floor((fullHeight - setHeight) / 2);
			else if (alignType == 'leftBottom' || alignType == 'centerBottom' || alignType == 'rightBottom')
				top = fullHeight - setHeight;
			
			return top;
		}
		
		
		
		/**
		* Animates the individual slice
		*/
		function animateSlice(slice, i, n, effectType, slicePoint, slideStartPosition, slideStartRatio, sliceDuration, sliceDelay) {
			// contains the starting values for the slice's properties
			var startState = new Object(),
			
				// contains the ending values for the slice's properties
				endState = new Object(),
				
				// assign values to the ending properties
				endWidth = parseInt(slice.css('width')),
				endHeight = parseInt(slice.css('height')),				
				endLeft = parseInt(slice.css('left')),
				endTop = parseInt(slice.css('top')),
			
				startLeft, startTop, startWidth = 0, startHeight = 0;
			
			// assign values to the starting left and top position based on the set effect type
			if (effectType == 'scale' || effectType == 'width' || effectType == 'height') {
				switch (slicePoint) {
					case 'centerCenter':
						startTop = endTop + endHeight * 0.5;
						startLeft = endLeft + endWidth * 0.5;
						break;	
						
					case 'rightCenter':
						startTop = endTop + endHeight * 0.5;
						startLeft = endLeft + endWidth;
						break;	
						
					case 'leftCenter':
						startTop = endTop + endHeight * 0.5;
						startLeft = endLeft;
						break;	
						
					case 'centerTop':
						startTop = endTop;
						startLeft = endLeft + endWidth * 0.5;
						break;	
						
					case 'rightTop':
						startTop = endTop;
						startLeft = endLeft + endWidth;
						break;	
						
					case 'leftTop':
						startTop = endTop;
						startLeft = endLeft;
						break;	
						
					case 'centerBottom':
						startTop = endTop + endHeight;
						startLeft = endLeft + endWidth * 0.5;
						break;	
						
					case 'rightBottom':
						startTop = endTop + endHeight;
						startLeft = endLeft + endWidth;
						break;	
						
					case 'leftBottom':
						startTop = endTop + endHeight;
						startLeft = endLeft;
						break;	
						
					default:
						startTop = endTop + endHeight * 0.5;
						startLeft = endLeft + endWidth * 0.5;
				}
			} else if (effectType == 'slide') {
				switch (slideStartPosition) {
					case 'left':
						startTop = endTop;
						startLeft = endLeft - endWidth * slideStartRatio;
						break;	
						
					case 'right':
						startTop = endTop;
						startLeft = endLeft + endWidth * slideStartRatio;
						break;	
						
					case 'top':
						startTop = endTop - endHeight * slideStartRatio;
						startLeft = endLeft;
						break;	
						
					case 'bottom':
						startTop = endTop + endHeight * slideStartRatio;
						startLeft = endLeft;
						break;	
						
					case 'leftTop':
						startTop = endTop - endHeight * slideStartRatio;
						startLeft = endLeft - endWidth * slideStartRatio;
						break;	
						
					case 'rightTop':
						startTop = endTop - endHeight * slideStartRatio;
						startLeft = endLeft + endWidth * slideStartRatio;
						break;	
						
					case 'leftBottom':
						startTop = endTop + endHeight * slideStartRatio;
						startLeft = endLeft - endWidth * slideStartRatio;
						break;	
						
					case 'rightBottom':
						startTop = endTop + endHeight * slideStartRatio;
						startLeft = endLeft + endWidth * slideStartRatio;
						break;	
						
					case 'horizontalAlternative':
						startTop = endTop;
						startLeft = endLeft + endWidth * slideStartRatio * (i % 2 == 0 ? 1 : -1);
						break;	
						
					case 'verticalAlternative':
						startTop = endTop + endHeight * slideStartRatio * (i % 2 == 0 ? 1 : -1);
						startLeft = endLeft;
						break;	
						
					default:
						startTop = endTop;
						startLeft = endLeft - endWidth * slideStartRatio;
				}
			}
			
			
			// assign values to the starting and ending states based on the set effect type
			switch (effectType) {
				case 'fade':
					endState = {'opacity':1};
					break;
					
				case 'scale':
					startState = {'width':startWidth, 'height':startHeight, 'left':startLeft, 'top':startTop};
					endState = {'width':endWidth, 'height':endHeight, 'left':endLeft, 'top':endTop, 'opacity':1};
					break;
					
				case 'width':
					startState = {'width':startWidth, 'left':startLeft};
					endState = {'width':endWidth, 'left':endLeft, 'opacity':1};
					break;
					
				case 'height':
					startState = {'height':startHeight, 'top':startTop};
					endState = {'height':endHeight, 'top':endTop, 'opacity':1};
					break;
					
				case 'slide':
					startState = {'left':startLeft, 'top':startTop};
					endState = {'left':endLeft, 'top':endTop, 'opacity':1};
					break;
					
				default:
					endState = {'opacity':1};					
			}			
			
			// assign the starting state to the slice
			slice.css(startState);
			
			// animate the slice to the ending state
			setTimeout(function(){slice.animate(endState, sliceDuration, function(){ //if the last slice was animated, call the enTransition function
																				 	 if (i == n - 1) 
																					 	endTransition();
																				  })}, i * sliceDelay);
		}
		
		
		/**
		* Returns a new array, with the slices ordered based on the specified pattern
		*/
		function getOrderedSlices(initialArray, pattern, horizontalSlices, verticalSlices) {
			var orderedArray = new Array(),
				i, j, k, l = 0;			
			
			switch(pattern) {
				case 'randomPattern':
					var randomArray = new Array();
										
					while(initialArray.length) {
						l = Math.floor(Math.random() * initialArray.length);
						randomArray.push(initialArray[l]);
						initialArray.splice(l, 1);
					}					
					var n = randomArray.length;					
					for(k = 0; k < n; k++) {
						orderedArray[k] = randomArray[k];
					}					
					break;	
					
				
				case 'topToBottom':
					for(j = 0; j < verticalSlices; j++)
						for(i = 0; i < horizontalSlices; i++) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}					
					break;
					
				
				case 'bottomToTop':
					for (j = verticalSlices - 1; j >= 0; j--)
						for (i = horizontalSlices - 1; i >= 0; i--) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}					
					break;
									
				case 'rightToLeft':
					for (i = horizontalSlices - 1; i >= 0; i--)
						for (j = verticalSlices - 1; j >= 0; j--) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}					
					break;	
				
				case 'leftToRight':
					for (i = 0; i < horizontalSlices; i++)
						for( j = 0; j < verticalSlices; j++) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}					
					break;
				
				case 'topLeftToBottomRight':
					for (k = 0; k < horizontalSlices + verticalSlices - 1; k++) {
						j = 0;
						for (i = k; i >= 0; i--){							
							if (getSliceByPosition(initialArray, i, j) != undefined) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
							}
							j++;
						}
					}					
					break;	
				
				case 'bottomLeftToTopRight':
					l = horizontalSlices > verticalSlices ? horizontalSlices : verticalSlices;
					
					for (k = horizontalSlices - 1; k >= 1 - l; k--) {
						i = 0;
						for (j = k; j <= horizontalSlices - 1; j++) {
							if (getSliceByPosition(initialArray, i, j) != undefined) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
							}
							i++;
						}
					}					
					break;	
				
				case 'topRightToBottomLeft':
					l = horizontalSlices > verticalSlices ? horizontalSlices : verticalSlices;
					
					for (k = horizontalSlices - 1; k >= 1 - l; k--) {
						i = k;
						for (j = 0; j <= verticalSlices - 1; j++) {
							if (getSliceByPosition(initialArray, i, j) != undefined) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
							}
							i++;
						}
					}					
					break;	
				
				case 'bottomRightToTopLeft':
					for (k = verticalSlices + horizontalSlices - 2; k >= 0; k--) {
						j = 0;
						for (i = k; i >= 0; i--) {
							if (getSliceByPosition(initialArray, i, j) != undefined) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
							}
							j++;
						}
					}					
					break;	
			
				case 'horizontalMarginToCenter':
					if (horizontalSlices % 2) {
						for (i = 0; i < Math.floor(horizontalSlices / 2); i++)
							for (j = 0; j < verticalSlices; j++) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - 1 - i, j));
							}
						for (k = 0; k < verticalSlices; k++) {
							orderedArray.push(getSliceByPosition(initialArray, Math.floor(horizontalSlices / 2), k));
						}
					} else {
						for (i = 0; i < Math.floor(horizontalSlices / 2); i++)
							for (j = 0; j < verticalSlices; j++) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - 1 - i, j));
							}
					}					
					break;	
				
				case 'horizontalCenterToMargin':
					if (horizontalSlices % 2) {
						for (k = 0; k < verticalSlices; k++) {
							orderedArray.push(getSliceByPosition(initialArray, Math.floor(horizontalSlices / 2), k));
						}
						for (i = Math.floor(horizontalSlices / 2) - 1; i >= 0; i--)
							for (j = 0; j < verticalSlices; j++) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - 1 - i, j));
							}
					} else {
						for (i = Math.floor(horizontalSlices / 2) - 1; i >= 0; i--)
							for (j = 0; j < verticalSlices; j++) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - 1 - i, j));
							}
					}					
					break;	
				
				case 'verticalMarginToCenter':
					if (verticalSlices % 2) {
						for (j = 0; j < Math.floor(verticalSlices / 2); j++)
							for (i = 0; i < horizontalSlices; i++) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - 1 - j));
							}
						for (k = 0; k < horizontalSlices; k++) {
							orderedArray.push(getSliceByPosition(initialArray, k, Math.floor(verticalSlices / 2)));
						}
					} else {
						for (j = 0; j < Math.floor(verticalSlices / 2); j++)
							for (i = 0; i < horizontalSlices; i++) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - 1 - j));
							}
					}					
					break;	
				
				case 'verticalCenterToMargin':
					if (verticalSlices % 2) {
						for (k = 0; k < horizontalSlices; k++) {
							orderedArray.push(getSliceByPosition(initialArray, k, Math.floor(verticalSlices / 2)));
						}
						for (j = Math.floor(verticalSlices / 2) - 1; j >= 0; j--)
							for(i = 0; i < horizontalSlices; i++) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - 1 - j));
							}
					} else {
						for (j = Math.floor(verticalSlices / 2) - 1; j >= 0; j--)
							for (i = 0; i < horizontalSlices; i++) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - 1 - j));
							}
					}					
					break;
				
				case 'skipOneTopToBottom':
					for (j = 0; j < verticalSlices; j++) {
						for (i = l; i < horizontalSlices; i += 2) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}
						l==0 ? l = 1 : l = 0;
					}
					l = 1;
					for (j = 0; j < verticalSlices; j++) {
						for (i = l; i < horizontalSlices; i += 2) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}
						l == 0 ? l = 1 : l = 0;
					}					
					break;
				
				case 'skipOneBottomToTop':
					for (j = verticalSlices-1; j >= 0; j--) {
						for (i = l; i < horizontalSlices; i += 2) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}
						l == 0 ? l = 1 : l = 0;
					}
					l = 1;
					for (j = verticalSlices - 1; j >= 0; j--) {
						for (i = l; i < horizontalSlices; i += 2) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}
						l == 0 ? l = 1 : l = 0;
					}					
					break;	
				
				case 'skipOneLeftToRight':
					for (i = 0; i < horizontalSlices; i++) {
						for (j = l; j < verticalSlices; j += 2) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}
						l == 0 ? l = 1 : l = 0;
					}
					l = 1;
					for (i = 0; i < horizontalSlices; i++) {
						for (j = l; j < verticalSlices; j += 2) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}
						l == 0 ? l = 1 : l = 0;
					}					
					break;	
				
				case 'skipOneRightToLeft':
					for (i = horizontalSlices - 1; i >= 0; i--) {
						for (j = l; j < verticalSlices; j += 2) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}
						l == 0 ? l = 1 : l = 0;
					}
					l = 1;
					for (i = horizontalSlices - 1; i >= 0; i--) {
						for (j = l; j < verticalSlices; j += 2) {
							orderedArray.push(getSliceByPosition(initialArray, i, j));
						}
						l == 0 ? l = 1 : l = 0;
					}					
					break;	
				
				case 'skipOneVertical':
					if (verticalSlices % 2) {
						for (j = 0; j < verticalSlices; j++) {
							for (i = l; i < horizontalSlices; i += 2) {
								if (j == Math.floor(verticalSlices / 2)) {
									j++;
									for (k = 1 - (horizontalSlices % 2); k < horizontalSlices; k += 2) {
										orderedArray.push(getSliceByPosition(initialArray, k, Math.floor(verticalSlices / 2)));
										if (getSliceByPosition(initialArray, k - 1, Math.floor(verticalSlices / 2)) != undefined) {
											orderedArray.push(getSliceByPosition(initialArray, k - 1, Math.floor(verticalSlices / 2)));
										}
									}
								}
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - j - 1));
							}
							l == 0 ? l = 1 : l = 0;
						}
					} 
					else {
						for (j = 0; j < verticalSlices; j++) {
							for (i = l; i < horizontalSlices; i += 2) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - j - 1));
							}
							l == 0 ? l = 1 : l = 0;
						}
					}					
					break;	
				
				case 'skipOneHorizontal':
					if (horizontalSlices % 2) {
						for (i = 0; i < horizontalSlices; i++) {
							for (j = l; j < verticalSlices; j += 2) {
								if (i == Math.floor(horizontalSlices / 2)) {
									i++;
									for (k = 1 - (verticalSlices % 2); k < verticalSlices; k += 2) {
										orderedArray.push(getSliceByPosition(initialArray, Math.floor(horizontalSlices / 2), k));
										if (getSliceByPosition(initialArray, Math.floor(horizontalSlices / 2), k-1) != undefined) {
											orderedArray.push(getSliceByPosition(initialArray, Math.floor(horizontalSlices / 2), k-1));
										}
									}
								}
								
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - 1 - i, j));
							}
							l == 0 ? l = 1 : l = 0;
						}
					}
					else {
						for (i = 0; i < horizontalSlices; i++) {
							for (j = l; j < verticalSlices; j += 2) {
								orderedArray.push(getSliceByPosition(initialArray, i, j));
								orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - 1 - i, j));
							}
							l == 0 ? l = 1 : l = 0;
						}
					}					
					break;	
				
				case 'spiralMarginToCenterCW':
					var h  = horizontalSlices,
						v = verticalSlices,					
						r, a = 0,				
						m = verticalSlices < horizontalSlices ? verticalSlices : horizontalSlices,
						n = Math.floor(m / 2);
				
					for (r = 0; r < n; r++) {
						for (i = a++; i < h; i++) {
							orderedArray.push(getSliceByPosition(initialArray, i, a - 1));
						}
						h--;
						for (j = a; j < v; j++) {
							orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - a, j));
						}
						v--;
						for (k = h; k >= horizontalSlices - h; k--) {
							orderedArray.push(getSliceByPosition(initialArray, k - 1, v));
						}
						for (l = v - 1; l>=  verticalSlices - v; l--) {
							orderedArray.push(getSliceByPosition(initialArray, a - 1, l));
						}
					}
					if (m % 2) {
						if (m == verticalSlices) {
							for (i = a++; i < h; i++) {
								orderedArray.push(getSliceByPosition(initialArray, i, a - 1));
							}
						}
						if (m == horizontalSlices) {
							for (j = a++; j < v; j++) {
								orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - a, j));
							}
						}
					}					
					break;	
				
				case 'spiralMarginToCenterCCW':
					var h  = horizontalSlices,
						v = verticalSlices,				
						r, a = 0,
						m = verticalSlices < horizontalSlices ? verticalSlices : horizontalSlices,
						n = Math.floor(m / 2);
				
					for (r = 0; r < n; r++) {
						for (j = a++; j < v; j++) {
							orderedArray.push(getSliceByPosition(initialArray, a - 1, j));
						}
						v--;
						for (i = a; i < h; i++) {
							orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - a));
						}
						h--;
						for (k = v; k >= verticalSlices - v; k--) {
							orderedArray.push(getSliceByPosition(initialArray, h, k - 1));
						}
						for (l = h - 1; l >= horizontalSlices - h; l--) {
							orderedArray.push(getSliceByPosition(initialArray, l, a - 1));
						}
					}
					if (m % 2) {
						if (m == verticalSlices) {
							for (i = a++; i < h; i++) {
								orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - a));
							}
						}
						if (m == horizontalSlices) {
							for (j = a++; j < v; j++) {
								orderedArray.push(getSliceByPosition(initialArray, a - 1, j));
							}
						}
					}					
					break;
				
				case 'spiralCenterToMarginCCW':
					var h  = horizontalSlices,
						v = verticalSlices,
						r, a = 0,
						m = verticalSlices < horizontalSlices ? verticalSlices : horizontalSlices,
						n = Math.floor(m / 2);
				
					for (r = 0; r < n; r++) {
						for (i = a++; i < h; i++) {
							orderedArray.push(getSliceByPosition(initialArray, i, a - 1));
						}
						h--;
						for (j = a; j < v; j++) {
							orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - a, j));
						}
						v--;
						for (k = h; k >= horizontalSlices - h; k--) {
							orderedArray.push(getSliceByPosition(initialArray, k - 1, v));
						}
						for (l = v - 1; l>=  verticalSlices - v; l--) {
							orderedArray.push(getSliceByPosition(initialArray, a - 1, l));
						}
					}
					if (m % 2) {
						if (m == verticalSlices) {
							for (i = a++; i < h; i++) {
								orderedArray.push(getSliceByPosition(initialArray, i, a - 1));
							}
						}
						if (m == horizontalSlices) {
							for (j = a++; j < v; j++) {
								orderedArray.push(getSliceByPosition(initialArray, horizontalSlices - a, j));
							}
						}
					}
					
					orderedArray.reverse();					
					break;
				
				case 'spiralCenterToMarginCW':
					var h  = horizontalSlices,
						v = verticalSlices,
						r, a = 0,
						m = verticalSlices < horizontalSlices ? verticalSlices : horizontalSlices,
						n = Math.floor(m / 2);
				
					for (r = 0; r < n; r++) {
						for (j = a++; j < v; j++) {
							orderedArray.push(getSliceByPosition(initialArray, a - 1, j));
						}
						v--;
						for (i = a; i < h; i++) {
							orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - a));
						}
						h--;
						for (k = v; k >= verticalSlices - v; k--) {
							orderedArray.push(getSliceByPosition(initialArray, h, k - 1));
						}
						for (l = h - 1; l >= horizontalSlices - h; l--) {
							orderedArray.push(getSliceByPosition(initialArray, l, a - 1));
						}
					}
					if (m % 2) {
						if (m == verticalSlices) {
							for (i = a++; i < h; i++) {
								orderedArray.push(getSliceByPosition(initialArray, i, verticalSlices - a));
							}
						}
						if (m == horizontalSlices) {
							for (j = a++; j < v; j++) {
								orderedArray.push(getSliceByPosition(initialArray, a - 1, j));
							}
						}
					}
					
					orderedArray.reverse();					
					break;
				
				default:
					var randomArray = new Array();
										
					while(initialArray.length) {
						l = Math.floor(Math.random() * initialArray.length);
						randomArray.push(initialArray[l]);
						initialArray.splice(l, 1);
					}
					
					var n = randomArray.length;
					
					for(k = 0; k < n; k++) {
						orderedArray[k] = randomArray[k];
					}				
			}
			
			return orderedArray;
		}
		
		/**
		* Returns an element from the array, at the specified horizontal and vertical position
		*/
		function getSliceByPosition(array, hPos, vPos) {
			return $.grep(array, function(el){return (el.data('hPos') == hPos && el.data('vPos') == vPos)})[0];
		}
		
		
		/**
		* Converts an hex string to RGB
		*/
		function hexToRGB(value) {
			var red = parseInt(value.substring(1, 3), 16),
				green = parseInt(value.substring(3, 5), 16),
				blue = parseInt(value.substring(5, 7), 16);
				
			return {red:red, green:green, blue:blue};
		}
		
		
		// PUBLIC METHODS
		
		this.nextSlide = nextSlide;
		
		this.previousSlide = previousSlide;
		
		this.gotoSlide = gotoSlide;
		
		this.startSlideshow = function() {
			slider.find('.slideshow-controls').removeClass('slideshow-play').addClass('slideshow-pause');
			slideshowState = 'play';
			startSlideshow();
		}
		
		this.stopSlideshow = function() {
			slider.find('.slideshow-controls').removeClass('slideshow-pause').addClass('slideshow-play');
			slideshowState = 'pause';
			stopSlideshow();
		}
		
		this.getSlideshowState = function() {
			return slideshowState;
		}
		
		this.getCurrentIndex = function() {
			return currentIndex;	
		}
		
		this.getSlideAt = function(index) {
			return slides[index];	
		}
		
		this.isTransition = function() {
			return isTransition;	
		}
	}
	
	
	$.fn.advancedSlider = function(options) {
		var collection = [];
		
		for (var i = 0; i < this.length; i++) {
			if (!this[i].slider) {
				this[i].slider = new AdvancedSlider(this[i], options);
				collection.push(this[i].slider);
			}
		}
		
		// if there are more slider instances, return the array of sliders
		// it there is only one, return just the slide instance
		return collection.length > 1 ? collection : collection[0];
	}
	
	
	// default settings
	$.fn.advancedSlider.defaults =  {
		xmlSource:null,
		width:500,
		height:300,
		alignType:'leftTop',
		slideshow:true,
		slideshowDelay:5000,
		slideshowDirection:'next',
		slideshowControls:true,
		timerAnimation:true,
		timerFadeDuration:500,
		hideTimer:false,
		timerRadius:18,
		timerStrokeColor1:'#000000',
		timerStrokeColor2:'#FFFFFF',
		timerStrokeOpacity1:0.5,
		timerStrokeOpacity2:0.7,
		timerStrokeWidth1:8,
		timerStrokeWidth2:4,
		slideStart:0,
		slidesPreloaded:0,
		shuffle:false,
		effectType:'random',
		sliceDelay:50,
		sliceDuration:1000,
		horizontalSlices:5,
		verticalSlices:3,
		slicePattern:'random',
		slicePoint:'centerCenter',
		slideStartPosition:'left',
		slideStartRatio:1,
		sliceFade:true,
		navigationArrows:true,
		hideNavigationArrows:true,
		navigationButtons:true,
		navigationButtonsCenter:true,
		showThumbnails:true,
		thumbnailSlide:10,
		thumbnailDuration:300,
		captionSize:70,
		captionBackgroundOpacity:0.5,
		captionShowEffect:'slide',
		captionShowEffectDuration:500,
		captionShowSlideDirection:'auto',
		captionHideEffect:'fade',
		captionHideEffectDuration:300,
		captionHideSlideDirection:'auto',
		captionPosition:'bottom',
		captionLeft:50,
		captionTop:50,
		captionWidth:300,
		captionHeight:100,
		slideProperties:null,
		slideMask:false,
		linkTarget:'_blank',
		slideOpen:null,
		slideClick:null,
		slideMouseOver:null,
		slideMouseOut:null,
		transitionStart:null,
		transitionComplete:null		
	};
	
})(jQuery)