
function validate()
{
	
	$("#firstname, #lastname, #mobile, #cordistrict, #skills").css({border:'1px solid #adadad', background:'#fff'});
	var count_bug=0;
	if ($("#firstname").val().replace(/^\s+|\s+$/gm,'')=="")
	{	
		$("#firstname").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
		$("#firstname").focus();
		if(eval(count_bug)==0)			
		count_bug+=1;
	}
	
	
	var MobVal=$("#mobile").val();
	if ($("#mobile").val().replace(/^\s+|\s+$/gm,'')=="")
	{	
		$("#mobile").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
		$("#mobile").focus();
		if(eval(count_bug)==0)			
		count_bug+=1;
	}else if(!isInteger(MobVal))
	{
		$("#mobile").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
		$("#mobile").focus();
		if(eval(count_bug)==0)			
		count_bug+=1;
	}else if(MobVal.charAt(0)=="0")
	{
		$("#mobile").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
		$("#mobile").focus();
		if(eval(count_bug)==0)			
		count_bug+=1;
	}else if(MobVal.length != 10)
	{
		$("#mobile").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
		$("#mobile").focus();
		if(eval(count_bug)==0)			
		count_bug+=1;
	}
	if ($("#cordistrict").val().replace(/^\s+|\s+$/gm,'')=="")
	{	
		$("#cordistrict").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
		$("#cordistrict").focus();
		if(eval(count_bug)==0)			
		count_bug+=1;
	}
/*	if ($("#skills").val().replace(/^\s+|\s+$/gm,'')=="")
	{	
		$("#skills").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
		$("#skills").focus();
		if(eval(count_bug)==0)			
		count_bug+=1;
	}*/
	if(count_bug > 0)
		return false;
	else return true;
//**********validations for Billing address end **************//
	}
function echeck(str) {
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

 		 return true					
	}
var digits = "0123456789";
function isInteger(s)
{   var i;

    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
       if(digits.indexOf(c)<0)
	   {
	   return false
	   exit();
	   }
    }
    return true;
}
