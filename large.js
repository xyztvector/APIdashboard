var post1ajax;
var get1ajax;
var put1ajax;
var delete1ajax;

function onloadFn() {
	post1ajax	= new ajaxObj(post1handler);
	get1ajax	= new ajaxObj(get1handler);
	put1ajax	= new ajaxObj(put1handler);
	delete1ajax	= new ajaxObj(delete1handler);
}

function respCommon(resp) {
	document.getElementById("sessionNum").value	= resp.session;
	document.getElementById("srcIP").value		= resp.srcIP;
	document.getElementById("method").value		= resp.method;
	document.getElementById("count").value		= resp.count;
	document.getElementById("testTypeResp").value	= resp.testTypeResp;
	document.getElementById("reqHeaders").value	= resp.reqHeaders;
	document.getElementById("respHeaders").value	= resp.respHeaders;
}

function post1handler(resp) {
	document.getElementById("postResp1").value = resp.resp1;
	document.getElementById("postResp2").value = resp.resp2;
	respCommon(resp);
}

function get1handler(resp) {
	document.getElementById("getResp1").value = resp.resp1;
	document.getElementById("getResp2").value = resp.resp2;
	respCommon(resp);
}

function put1handler(resp) {
	document.getElementById("putResp1").value = resp.resp1;
	document.getElementById("putResp2").value = resp.resp2;
	respCommon(resp);
}

function delete1handler(resp) {
	document.getElementById("deleteResp1").value = resp.resp1;
	document.getElementById("deleteResp2").value = resp.resp2;
	respCommon(resp);
}

//---

function param1() {
	return document.querySelector('input[name = "classTestType"]:checked').value;
}

function postFn() {
	var p1 = param1();
	var post1 = document.getElementById("postReq1").value;
	var post2 = document.getElementById("postReq2").value;
	var payload = JSON.stringify({"post1":post1,"post2":post2});
	post1ajax.send("POST", "largetarget.php?p1="+p1, payload);
}

function getFn() {
	var p1 = param1();
	var get1 = document.getElementById("getReq1").value;
	var get2 = document.getElementById("getReq2").value;
	var payload = JSON.stringify({"get1":get1,"get2":get2});
	get1ajax.send("GET", "largetarget.php?p1="+p1, payload);
}

function putFn() {
	var p1 = param1();
	var put1 = document.getElementById("putReq1").value;
	var put2 = document.getElementById("putReq2").value;
	var payload = JSON.stringify({"put1":put1,"put2":put2});
	put1ajax.send("PUT", "largetarget.php?p1="+p1, payload);
}

function deleteFn() {
	var p1 = param1();
	var delete1 = document.getElementById("deleteReq1").value;
	var delete2 = document.getElementById("deleteReq2").value;
	var payload = JSON.stringify({"delete1":delete1,"delete2":delete2});
	delete1ajax.send("DELETE", "largetarget.php?p1="+p1, payload);
}


