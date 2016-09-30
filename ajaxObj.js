var ajaxObj = function(respHandler) {
	var xhr	= new XMLHttpRequest();

	this.receive = function() {
		if (xhr.readyState == 4) {
			if (xhr.status == 200) {
				var resp = JSON.parse(xhr.responseText);
				respHandler(resp);
			} else {
				alert(xhr.status);
			}
		}
	};

	this.send = function(method, url, payload) {
		xhr.onreadystatechange	= this.receive;
		xhr.open(method, url, true);
		xhr.send(payload);
	}
};

