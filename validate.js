function validatepass(form){
		var x= form.password.value;
		if(1){}
}
function validatemail(form){
		var x = form.email.value;
		var pos = x.indexOf("@");
		if (!(pos>=7 && pos<=9)) {alert("Invalid email,Enter your iitk mail only");return false;}
		else {var name=x.slice(pos);}
		trim(name);
		if (name!="iitk.ac.in"){
			alert("Invalid email,Enter your iitk mail only");return false;
		}
}
function trim(s){ 
  return ( s || '' ).replace( /^\s+|\s+$/g, '' ); 
}
function say_sorry(){
		alert("Service unavailable today,contact Sumedh(sumedh@) or Milind(milind@).");
		return false;
}
function validateimage(form){
	var x = form.name.value;
	if ( x==""){
	alert("No photo selected for upload!");
	return false;
	}
}
