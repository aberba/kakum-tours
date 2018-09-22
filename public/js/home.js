$(function() {
    $(".fscSlider").fscSlider({
        slideWidth: 800,
        slideHeight: 400,
        slideInterval: 6000,
        tootipTopOffset: 20,
        tootipLeftOffset: 20,
        tooltipBackgroundColor: "rgba(0, 0, 0, 0.8)",
        tooltipTextColor: "#ffffff",
        arrowsTopOffset: 170
    });

/*    $(".thumbs-section > div:nth-child(1) img, .thumbs-section > div:nth-child(1) p a").on("click", function(e) {
    	e.preventDefault();

    	App.queryPackages(function(data) {

    		var goBackLink = $("<a />", {"html":"&laquo; Back to Homepage", "href":"#"}).on("click", function(e) {
		        e.preventDefault();
		        App.showHomepage();
		    });

            var packagesContainer = $("<div />", {"class":"templates-container packages-container clearfix"}).append( goBackLink );

            packagesContainer.append( $("<h2 />", {"text":"Tour Packages Available"}) );
            packagesContainer.append( $("<p />", {"html":"You can also contact us to arrange a special tour package. <br /><br />"}) );


            for (var i in data) {
            	var pack  = $("<div />", {"class":"package"}).data("query", data[i]).bind("click", function() {
            		e.preventDefault();
            		App.showSelectedPackage( $(this).data("query") );
            	});

            	var title = $("<h3 />", {"text":data[i].package_name});
            	var fig  = $("<figure />").append( $("<img />", {"src":"uploads/photos/" + data[i].photo_filename, "alt":data[i].package_name + " photo."}) );
            	var des  = $("<p />", {"html":data[i].description.substring(0, 120) + " ..."});
            	var link = $("<a />", {"text":"Read More ...", "href":"#"});
            	pack.append(title).append(fig).append(des).append(link);
            	packagesContainer.append(pack);
            }

            App.hideHomepage();
            $(".templates-section").append(packagesContainer);
    	});
    });


    $(".thumbs-section > div:nth-child(2) img, .thumbs-section > div:nth-child(2) p a").on("click", function(e) {
    	e.preventDefault();

    	App.queryAttractions(function(data) {

    	});
    });


    $(".thumbs-section > div:nth-child(3) img, .thumbs-section > div:nth-child(3) p a").on("click", function(e) {
    	e.preventDefault();

    	var goBackLink = $("<a />", {"html":"&laquo; Back to Homepage", "href":"#"}).on("click", function(e) {
	        e.preventDefault();
	        App.showHomepage();
	    });


    	App.queryGallery(function(data) {
            var galleryContainer = $("<div />", {"class":"templates-container gallery-container clearfix"}).append( goBackLink );
            var galleryGroupsContainer = $("<div />", {"class":"gallery-groups-container clearfix"});

            galleryContainer.append( $("<h2 />", {"text":"Our Gallery"}) );
            galleryContainer.append( $("<p />", {"html":"This gallery contains photos, videos and other graphics of our activities. <br /><br />"}) );

            var galleryNav = $("<div />", {"class":"gallery-nav"}).
            append( $("<ul />").
                    append( $("<li />").append( $("<a />", {"text":"PHOTOS", "href":"#"}) ) ).
                    append( $("<li />").append( $("<a />", {"text":"VIDEOS", "href":"#"})) ).
                    append( $("<li />").append( $("<a />", {"text":"DOCUMENTS", "href":"#"}) ) )
            );

            var photosContainer = $("<div />", {"class":"gallery-group clearfix videos-container"});
            var videosContainer = $("<div />", {"class":"gallery-group clearfix photos-container"});
            var docsContainer   = $("<div />", {"class":"gallery-group clearfix docs-container"});
            var score           = 0; // a marker that there is at least an item in the gallery

            if (data.photos.length > 1)  {
            	score ++;

            	for (var i in data.photos) {
                    var figure = $("<figure />", {"class":"thumb photo", "id":data.photos[i].photo_id});
                    figure.append( $("<img />", {"src":"uploads/photos/" + data.photos[i].photo_filename, "alt":data.photos[i].caption}) );
                    figure.append( $("<figcaption />", {"text":data.photos[i].caption}) );
                    photosContainer.append(figure);
                }
            } else {
            	photosContainer.append( $("<p />", {"text":"Sorry, there are no photos in our gallery."}) );
            }

            if (data.videos.length > 1)  {
            	score ++;

            	for (var i in data.videos) {
                    var figure = $("<figure />", {"class":"thumb video", "id":data.videos[i].video_id});
                    figure.append( $("<img />", {"src":"uploads/photos/" + data.videos[i].poster_filename, "alt":data.videos[i].caption}) );
                    figure.append( $("<figcaption />", {"text":data.videos[i].caption}) );
                    videosContainer.append(figure);
                }
            } else {
            	videosContainer.append( $("<p />", {"text":"Sorry, there are no videos in our gallery."}) );
            }

            if (data.docs.length > 1)  {
            	score ++;

            	for (var i in data.docs) {
                    var figure = $("<figure />", {"class":"thumb doc", "id":data.docs[i].doc_id});
                    figure.append( $("<img />", {"src":"uploads/photos/" + data.docs[i].poster_filename, "alt":data.docs[i].caption}) );
                    figure.append( $("<figcaption />", {"text":data.docs[i].caption}) );
                    docsContainer.append(figure);
                }
            } else {
            	docsContainer.append( $("<p />", {"text":"Sorry, there are no documents in our gallery."}) );
            }

            // use score to confirm there is data in the gallery
            if (score <= 0) {
            	App.alert("Sorry, no content has been uploaded into our gallery.");
            	return false;
            }

            galleryGroupsContainer.append( photosContainer ).append( videosContainer ).append( docsContainer );
            galleryContainer.append( galleryNav ).append( galleryGroupsContainer )

            App.hideHomepage();
            $(".templates-section").append(galleryContainer);
    	});
    });
    //$(".thumbs-section > div:nth-child(2)").click();


    $(".thumbs-section > div:nth-child(4) img, .thumbs-section > div:nth-child(4) p a").on("click", function(e) {
    	e.preventDefault();

    	App.queryTourUpdates(function(data) {

    	});
    });
*/
});
