var windowOnloadAdd = function(event){
 if(window.onload){
  window.onload = window.onload + event;
 } else {
  window.onload = event;
 };
};

windowOnloadAdd(function() {
 var Trs=document.getElementsByClassName('iedit author-self type-post status-publish format-standard hentry');
 var n=Trs.length;
console.log(n);
	for(i=0;i<n;i++){
		var Tr=Trs.item(i);
		var pID=Tr.id;
		pID=pID.replace("post-", "");
console.log(pID);		
		var Author=Tr.getElementsByClassName('author').item(0);
		var ahtml=Author.innerHTML;
console.log(ahtml);
  Author.innerHTML=ahtml+'<br /><div class="plus" id="plus'+pID+'"></div><div class="minus" id="minus'+pID+'"></div>';
		plusminus(pID, i);
	} //for i
});

function plusminus(vid, i){
setTimeout(function(){	
 var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "/ajax/admin.php?vid="+vid, true);
 xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
 xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var response = this.responseText; 
//console.log(response);				
    var vid=response.replace(/^\s*(\d+)\:(\d+)\:(\d+)\s*$/, "$1");
    var plus=response.replace(/^\s*(\d+)\:(\d+)\:(\d+)\s*$/, "$2");
    var minus=response.replace(/^\s*(\d+)\:(\d+)\:(\d+)\s*$/, "$3");
//console.log('vid='+vid+',plus='+plus+',minus='+minus);				
    var plusDiv=document.getElementById('plus'+vid);
				plusDiv.innerHTML=plus;
    var minusDiv=document.getElementById('minus'+vid);
				minusDiv.innerHTML=minus;
  }
 };
 xhttp.send();
 }, i*500);
}