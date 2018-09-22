$(function() {
    $(".attraction .delete-btn").on("click", function(e) {
    	e.preventDefault();

        if (confirm("Are you sure you want to delete this item?")) {
            var id = $(this).parent().parent().attr("id");

    	    App.deleteAttraction(id, function(responseText) {
    		    if (responseText.indexOf("sucessfully") !== -1) {
                   $("#attraction" + id).fadeOut("slow").replaceWith(" ");
    		    }
                App.alert(responseText);
    	    });
        }
    });

    $(".attraction .publish-btn").on("click" , function(e) {
        e.preventDefault();

        if (confirm("Do you want to preceed with this action?")) {
            var id = $(this).parent().parent().attr("id");

            App.togglePublishing(id, function(responseText) {
                App.alert(responseText);
                var title = (responseText.indexOf("published") !== -1) ? "Upublish" : "Publish";
                $("#attraction"+id+ " .links li:last a img").attr("title", title);
            });
        }
    });
});


var App = {};

App.alert = function(msg) {
	alert(msg);
};

App.deleteAttraction = function(id, callback) {
	var url = "deleteAttraction=yes&id=" + id;
	$.post("ajax/ajax.delete.php", url, function(responseText) {
		if (callback != null) {
			callback(responseText);
		}
	});
};

App.togglePublishing = function(id, callback) {
    var url = "togglePublishing=yes&id=" + id;
	$.post("ajax/ajax.update.php", url, function(responseText) {
		if (callback != null) {
			callback(responseText);
		}
	});
}
