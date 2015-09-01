function puttext(){
  document.getElementById('warning').innerHTML="Your password is piece of very sensitive information. Please keep it secure, never share it with others.";
 }
 function removetext(){
  document.getElementById('warning').innerHTML="";
 }

 function validateformreg()
 {
  var x = document.forms.reg.user.value;
   	if ((x==null) || (x=="") || (x.length<6)){
		alert("Invalid email.");
		return false;}
  var pos = x.indexOf("@")+1;
  var dom = x.substring(pos);
  if (pos<6 || pos>15) {alert("Invalid email,please use your IITK mail.");return false;}
  if (dom !== "iitk.ac.in"){
	alert("Invalid email,this isn't an IITK mail id.");
	return false;
  }
  var x = document.forms.reg.pass.value;
   if ((x==null)|| (x=="")){
		alert("Password cannot be left empty");
		return false;}
	if (x.length<6){
	 alert("Please enter a password that is strong and atleast 6 characters long.");
	 return false;
	}
	var y=document.forms.reg.pass2.value;
	if (x!==y){
	alert("The entered passwords do not match.");
	return false;
	}
  var x = document.forms.reg.date.value;
	{
		if (x<0 || x>31) {alert("Invalid birthdate, are you an alien?\nSorry, aliens aren't allowed.");return false;}
	}
  var x = document.forms.reg.month.value;
	{
		if (x<0 || x>12) {alert("Invalid birthmonth, are you an alien?\nSorry, aliens aren't allowed.");return false;}
	}
 }
