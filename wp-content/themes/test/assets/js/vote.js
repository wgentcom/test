var windowOnloadAdd = function(event){
 if(window.onload){
  window.onload = window.onload + event;
 } else {
  window.onload = event;
 };
};

windowOnloadAdd(function() {
 var Votes=document.getElementsByClassName('vote');
	var n=Votes.length;
	for(i=0;i<n;i++){
		var Vote=Votes.item(i);
  var Buttons=Vote.getElementsByClassName('button');
  var m=Buttons.length;
	 for(j=0;j<m;j++){
 		var Button=Buttons.item(j);
   var buttonClass=Button.className;
   Button.addEventListener('click', function(){
				var vid=this.getAttribute("rel");
				var vote=( this.className.indexOf("plus") >0 ) ? 1 : -1;
     doVote(vid, vote);
   });
			var vid=Button.getAttribute("rel");
			doVote(vid, 0);
		} //for j
	} //for i
});

function doVote(vid, vote){
 var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "/ajax/vote.php?vid="+vid+"&vote="+vote, true);
 xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
 xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var response = this.responseText; 
//console.log(response);				
    var val=response.replace(/^\s*(\d+)\:/, "");
    var vid=response.replace(/\:\-?(\d+)\s*$/, "");
//console.log('val'+vid);
//console.log(val);
     var valDiv=document.getElementById('val'+vid);
					valDiv.innerHTML=val;
  }
 };
 xhttp.send();
}