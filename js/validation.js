function regvalidation()
{
	//name validation
var name=document.getElementById("name").value;
var msg=document.getElementById("msg");
var pn=/^[A-Z a-z]{2,30}$/;
		if(!pn.test(name))
        {
        msg.innerHTML="* Please Enter Valid Name.";
		document.getElementById('name').style.border='2px solid red';
		document.getElementById('name').focus();
		return false;
        }
	  else
	  {
		msg.innerHTML="";
		 document.getElementById('name').style.border='2px solid green';
	  }
	  //adhar validation
	  var adhar=document.getElementById("adhar").value;
	  var num=/^[1-9]{12,12}$/
	  if(!num.test(adhar))
        {
        msg.innerHTML="* Please Enter valid adharnumber.";
		document.getElementById('adhar').style.border='2px solid red';
		document.getElementById('adhar').focus();
		return false;
        }
	  else
	  {
		msg.innerHTML="";
		document.getElementById('adhar').style.border='2px solid green';
	  }
	   //pincode validation
	  var pin=document.getElementById("pin").value;
	  var code=/^[1-9]{6,6}$/
	  if(!code.test(pin))
        {
        msg.innerHTML="* Please Enter valid adharnumber.";
		document.getElementById('pin').style.border='2px solid red';
		document.getElementById('pin').focus();
		return false;
        }
	  else
	  {
		msg.innerHTML="";
		document.getElementById('pin').style.border='2px solid green';
	  }
//mobile validation
      var mob=/^[0-9]{10}$/;
      var contact=document.getElementById("contact").value;
	    if(!mob.test(contact))
		{
	      msg.innerHTML=" * Please Enter Valid Mobile Number.";
		 document.getElementById('contact').style.border='2px solid red';
		 document.getElementById('contact').focus();
		 return false;
		}
		else
		{
	     var first=mname.charCodeAt(0);//ASCII
	     if(first==55 || first==56 || first==57)
		 {
		   msg.innerHTML="vaid indian mobile no";
		   document.getElementById('contact').style.border='2px solid green';
		 }
		 else
		 {
			msg.innerHTML=" * Mobile Number is not Indian Number";
			document.getElementById('contact').focus();
           return false;			
		 }
	   }
	 //email validation and password validation
	  var email=document.getElementById("email").value;

       var pemail=/^[a-zA-Z0-9.-_]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$/;
	  if(!pemail.test(email))
        {
        msg.innerHTML="* Please Enter Valid Email is Required.";
		 msg.style.color="red";
		 document.getElementById('email').style.border='2px solid red';
		 return false;
        }
	  else
	  {
		 msg.innerHTML="";
		 document.getElementById('email').style.border='2px solid green';
	   }
	    //alert("ok");
		//passwor validation
		var pass=document.getElementById("password").value;
		var p=/^[a-zA-Z 1-9]{8,10}$/
		if(!p.test(pass))
		{
		msg.innerHTML="incorrect password";
		msg.style.color="red";
		document.getElementById("password").style.border="2px solid red";
		return false;
		}
		else
	  {
		 msg.innerHTML="";
		pass.style.border='2px solid green';
	   }
	 //close password and email  validation 
	  
   
}