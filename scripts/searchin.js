function showCustomer(str) {
var xhttp;
if (str == "") {
document.getElementById("content").innerHTML = "";
return;
}
xhttp = new XMLHttpRequest();
xhttp.addEventListener("load", function() {
if (xhttp.status === 200) {
document.getElementById("content").innerHTML = this.responseText;
}
});
xhttp.addEventListener("error", function() {
alert("Niestety nie udało się nawiązać połączenia");
});
xhttp.open("GET", "php/getRecipein.php?q="+str, true);
xhttp.send();
}