(function() {

var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
$('#addtof').ajaxForm({
		beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    complete: function(xhr) {
     bar.width("100%");
    percent.html("100%");
    status.html(xhr.responseText);
	
	document.location.href="http://ttubaye.com/upload.php";
    }
}); 

})();