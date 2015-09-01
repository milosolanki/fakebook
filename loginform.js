function validateform(formn)
 {
   var x=document.forms.login.user.value;
   if ((x==null) || (x=="") || (x.length<6)){
		alert("Invalid username");
		return false;}
   var x= document.forms.login.pass.value;
   if ((x==null) || (x.length<6)){
		alert("Did you forget? Password had atleast 6 characters.");
		return false;}
 }
