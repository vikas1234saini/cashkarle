function validateDOB() {

    var dob = document.forms["ProcessInfo"]["txtDOB"].value;
    var pattern = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
    if (dob == null || dob == "" || !pattern.test(dob))
    {
        errMessage += "Invalid date of birth\n";
        return false;
    }
    else {
        return true
    }
}

function fWhenJoin(val)
{
    if (val == "Immediately")
    {
        $("#divjoinafter").css({'display': 'none'})
        //$("#datepicker-example9").css({'display':'none'})
    }
    if (val == "After")
    {
        $("#divjoinafter").css({'display': 'block'})
        //	$("#datepicker-example9").css({'display':'none'})
        //	$('#datepicker-example8').datepick({  minDate: 0 });

    }


}
function fClickWilling(val)
{
    if (val == "No")
    {
        document.getElementById("divWillingToWork").style.display = "None";
    } else
    {
        document.getElementById("divWillingToWork").style.display = "block";
    }
}
function fEmployerDiv(val)
{
    if (val == "Self Employed") {
        document.getElementById("employerDets1").style.display = "none";
        document.getElementById("employerDets2").style.display = "none";
    } else {
        document.getElementById("employerDets1").style.display = "block";
        document.getElementById("employerDets2").style.display = "block";
    }
}
function idProofCheck(fld1, fld2, chk)
{
    if (chk) {
        //document.getElementById(fld1).disabled=false;
        //document.getElementById(fld2).disabled=false;
    } else {
        //$("#"+fld1+", #"+fld2+"").css({border:'1px solid #adadad', background:'#fff'});
        //document.getElementById(fld1).value="";
        //document.getElementById(fld1).disabled=true;
//	document.getElementById(fld2).value="";
        //document.getElementById(fld2).disabled=true;
    }
}

function removeWExp(id)
{
    var url = "ajaxSubmitExp.asp";
    var parameters = "remove=yes&id=" + encodeURI(id);
    //alert(parameters);
    var xmlHttp = new CreateObject();
    xmlHttp.open("POST", url, true);
    //Send the proper header information along with the request  
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.setRequestHeader("Content-length", parameters.length);
    xmlHttp.setRequestHeader("Connection", "close");
    xmlHttp.onreadystatechange = function () {//Handler function for call back on state change.  
        if (xmlHttp.readyState == 4) {
            document.getElementById("divPrevWorking").innerHTML = xmlHttp.responseText;
            $('.inputdate').datepick();

            // alert(xmlHttp.responseText);
        }
    }
    xmlHttp.send(parameters);
}
function validPreEmp(val)
{
    var count_bug = val;
    $("#pactivity1, #datepicker-example10, #datepicker-example11").css({border: '1px solid #adadad', background: '#fff'});

    if ($("#pactivity1").val() == "")
    {
        $("#pactivity1").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        if (eval(count_bug) == 0) {
            $("#pactivity1").focus();
            count_bug += 1;
        }
    }
    var pemppincode = $("#pemppincode").val();
    if ($("#pemppincode").val() == "")
    {
        /*$("#corpincode").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
         $("#corpincode").focus();
         if(eval(count_bug)==0)			
         count_bug+=1;*/
    } else if (!isInteger(pemppincode))
    {
        $("#pemppincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        $("#pemppincodeErrorDiv").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#pemppincode").focus();
            count_bug += 1;
        }
    } else if (pemppincode.charAt(0) == "0")
    {
        $("#pemppincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        $("#pemppincodeErrorDiv").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#pemppincode").focus();
            count_bug += 1;
        }
    } else if (pemppincode.length != 6)
    {
        $("#pemppincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        $("#pemppincodeErrorDiv").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#pemppincode").focus();
            count_bug += 1;
        }
    }

    /*	if ($("#datepicker-example10").val()=="")
     {	
     $("#datepicker-example10").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
     //$("#datepicker-example10").focus();
     if(eval(count_bug)==0)			
     count_bug+=1;
     }
     if ($("#datepicker-example11").val()=="")
     {	
     $("#datepicker-example11").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
     //$("#datepicker-example11").focus();
     if(eval(count_bug)==0)			
     count_bug+=1;
     }else
     
     {
     var date1=$("#datepicker-example10").val()
     var date2=$("#datepicker-example11").val()
     var d1=date1.split("/");
     var d2=date2.split("/");
     var dt1=(d1[2]+""+d1[1]+""+d1[0])
     var dt2=(d2[2]+""+d2[1]+""+d2[0])
     if (parseInt(dt1) > parseInt(dt2))
     {
     $("#datepicker-example10").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
     $("#datepicker-example11").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
     //$("#datepicker-example11").focus();
     document.getElementById("datePreSpan").style.display="Block";
     if(eval(count_bug)==0)			
     count_bug+=1;
     }else{
     document.getElementById("datePreSpan").style.display="none";
     }
     }*/

    return count_bug;
}
function validPreEmp1()
{
    var count_bug = 0;
    $("#activity1, #datepicker-example4, #datepicker-example4").css({border: '1px solid #adadad', background: '#fff'});

    if ($("#activity1").val() == "")
    {
        $("#activity1").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        $("#activity1").focus();
        if (eval(count_bug) == 0)
            count_bug += 1;
    }
    if ($("#datepicker-example4").val() == "")
    {
        $("#datepicker-example4").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        //$("#datepicker-example10").focus();
        if (eval(count_bug) == 0)
            count_bug += 1;
    }

    if ($("#datepicker-example5").val() == "")
    {
        $("#datepicker-example5").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        //$("#datepicker-example11").focus();
        if (eval(count_bug) == 0)
            count_bug += 1;
    } else {

        var date1 = $("#datepicker-example4").val()
        var date2 = $("#datepicker-example5").val()
        var d1 = date1.split("/");
        var d2 = date2.split("/");
        var dt1 = (d1[2] + "" + d1[1] + "" + d1[0])
        var dt2 = (d2[2] + "" + d2[1] + "" + d2[0])
        if (parseInt(dt1) > parseInt(dt2))
        {
            $("#datepicker-example4").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#datepicker-example5").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            //$("#datepicker-example11").focus();
            document.getElementById("datePreSpan1").style.display = "Block";
            if (eval(count_bug) == 0)
                count_bug += 1;
        } else {
            document.getElementById("datePreSpan1").style.display = "none";
        }
    }

    return count_bug;
}
function fExperience(val)
{
    if (val == "1")
    {
        //document.getElementById("divWorkExp").style.display="block";
        document.getElementById("noYears").disabled = false;
        document.getElementById("noMonths").disabled = false;
    } else
    {
        //document.getElementById("divWorkExp").style.display="none";
        document.getElementById("noYears").disabled = true;
        document.getElementById("noMonths").disabled = true;
        document.getElementById("noYears").value = "";
        document.getElementById("noMonths").value = "";
    }
}
function fChangeCurrWorking(val)
{
    if (val == "Yes")
    {
        document.getElementById("divCurrWorking").style.display = "block";

    } else
    {
        document.getElementById("divCurrWorking").style.display = "none";
    }
}
function fChangeCat(val)
{
//alert(val)
    if (val != "") {
        var url = "ajaxSubCat.asp";
        var parameters = "id=" + encodeURI(val);
//alert(parameters);
        var xmlHttp = new CreateObject();
        xmlHttp.open("POST", url, true);
        //Send the proper header information along with the request  
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", parameters.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.onreadystatechange = function () {//Handler function for call back on state change.  
            if (xmlHttp.readyState == 4) {
                document.getElementById("divSubcategories").innerHTML = xmlHttp.responseText;
                //alert(xmlHttp.responseText);
            }
        }
        xmlHttp.send(parameters);
    } else {
        document.getElementById("divSubcategories").innerHTML = "Please select category.";
    }
}
function fCheckBoxAddress(val)
{
    if (val)
    {
        /*document.getElementById("peraddress").value=document.getElementById("coraddress").value;
         //document.getElementById("percity").value=document.getElementById("corcity").value;
         document.getElementById("perdistrict").value=document.getElementById("cordistrict").value;
         document.getElementById("perstate").value=document.getElementById("corstate").value;
         document.getElementById("perpincode").value=document.getElementById("corpincode").value;*/
    }
}
function fMarital(val)
{
    //alert(val)
    if (val == "Married")
    {
        if (document.getElementById("gender2").checked)
        {
            document.getElementById("spanSpouse").style.display = "block";
        }
        else
        {
            document.getElementById("spousename").value = "";
            document.getElementById("spanSpouse").style.display = "none";
        }
    }
}
function fClickCat(val, val1, sta)
{	//alert(val)
//	alert(val1)
//	alert(sta)
    //document.getElementById("catName"+val).checked=true
    if (sta) {
        for (j = 1; j <= val1; j++)
        {
            document.getElementById("subcatname" + val + "_" + j).checked = true;
        }
    } else {
        for (j = 1; j <= val1; j++)
        {
            document.getElementById("subcatname" + val + "_" + j).checked = false;
        }
    }
}
function fRemovePSkill(id)
{

    var url = "ajaxSubmitSkill.asp";
    var parameters = "remove=yes&id=" + encodeURI(id);
    //alert(parameters);
    var xmlHttp = new CreateObject();
    xmlHttp.open("POST", url, true);
    //Send the proper header information along with the request  
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.setRequestHeader("Content-length", parameters.length);
    xmlHttp.setRequestHeader("Connection", "close");
    xmlHttp.onreadystatechange = function () {//Handler function for call back on state change.  
        if (xmlHttp.readyState == 4) {
            document.getElementById("divSkillsDetails").innerHTML = xmlHttp.responseText;
            // alert(xmlHttp.responseText);
        }
    }
    xmlHttp.send(parameters);

}
function FAddPrevEmployement()
{
    if (validPreEmp('0') == 0)
    {
        var pactivity1 = document.getElementById("pactivity1").value;
        //var pactivity2=document.getElementById("pactivity2").value;
        //var pactivity3=document.getElementById("pactivity3").value;
        var dateFrom = document.getElementById("datepicker-example10").value;
        var dateTo = document.getElementById("datepicker-example11").value;
        var pnature = "";
        if (document.getElementById("pnatureSelf").checked) {
            pnature = "Self Employed"
        }
        if (document.getElementById("pnatureCont").checked) {
            pnature = "Contractual"
        }
        if (document.getElementById("pnatureSelf2").checked) {
            pnature = "Employed"
        }
        var pempname = document.getElementById("pempname").value;
        var pempaddress = document.getElementById("pempaddress").value;
        var pempcity = document.getElementById("pempcity").value;
        var pempdistrict = document.getElementById("pempdistrict").value;
        var pempstate = document.getElementById("pempstate").value;
        var pemppincode = document.getElementById("pemppincode").value;
        var url = "ajaxSubmitExp.asp";
        var parameters = "pactivity1=" + encodeURI(pactivity1) + "&dateFrom=" + encodeURI(dateFrom) + "&dateTo=" + encodeURI(dateTo) + "&pnature=" + encodeURI(pnature) + "&pempname=" + encodeURI(pempname) + "&pempaddress=" + encodeURI(pempaddress) + "&pempcity=" + encodeURI(pempcity) + "&pempdistrict=" + encodeURI(pempdistrict) + "&pempstate=" + encodeURI(pempstate) + "&pemppincode=" + encodeURI(pemppincode);
        //alert(parameters);
        var xmlHttp = new CreateObject();
        xmlHttp.open("POST", url, true);
        //Send the proper header information along with the request  
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", parameters.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.onreadystatechange = function () {//Handler function for call back on state change.  
            if (xmlHttp.readyState == 4) {
                document.getElementById("divPrevWorking").innerHTML = xmlHttp.responseText;
                $('.inputdate').datepick();

                // alert(xmlHttp.responseText);
            }
        }
        xmlHttp.send(parameters);

    }
}
function FModPrevEmployement(id)
{
    if (validPreEmp('0') == 0)
    {
        var pactivity1 = document.getElementById("pactivity1").value;
        //var pactivity2=document.getElementById("pactivity2").value;
        //var pactivity3=document.getElementById("pactivity3").value;
        var dateFrom = document.getElementById("datepicker-example10").value;
        var dateTo = document.getElementById("datepicker-example11").value;
        var pnature = "";
        if (document.getElementById("pnatureSelf").checked) {
            pnature = "Self Employed"
        }
        if (document.getElementById("pnatureCont").checked) {
            pnature = "Contractual"
        }
        if (document.getElementById("pnatureSelf2").checked) {
            pnature = "Employed"
        }
        var pempname = document.getElementById("pempname").value;
        var pempaddress = document.getElementById("pempaddress").value;
        var pempcity = document.getElementById("pempcity").value;
        var pempdistrict = document.getElementById("pempdistrict").value;
        var pempstate = document.getElementById("pempstate").value;
        var pemppincode = document.getElementById("pemppincode").value;
        var url = "ajaxSubmitExp.asp";
        var parameters = "id=" + encodeURI(id) + "&edit=yes&pactivity1=" + encodeURI(pactivity1) + "&dateFrom=" + encodeURI(dateFrom) + "&dateTo=" + encodeURI(dateTo) + "&pnature=" + encodeURI(pnature) + "&pempname=" + encodeURI(pempname) + "&pempaddress=" + encodeURI(pempaddress) + "&pempcity=" + encodeURI(pempcity) + "&pempdistrict=" + encodeURI(pempdistrict) + "&pempstate=" + encodeURI(pempstate) + "&pemppincode=" + encodeURI(pemppincode);
        //alert(parameters);
        var xmlHttp = new CreateObject();
        xmlHttp.open("POST", url, true);
        //Send the proper header information along with the request  
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", parameters.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.onreadystatechange = function () {//Handler function for call back on state change.  
            if (xmlHttp.readyState == 4) {
                document.getElementById("divPrevWorking").innerHTML = xmlHttp.responseText;
                $('.inputdate').datepick();

                // alert(xmlHttp.responseText);
            }
        }
        xmlHttp.send(parameters);

    }
}
function EditWExp(id)
{
    var url = "ajaxEditWork.asp";
    var parameters = "id=" + encodeURI(id) + "&modify=yes";
    //alert(parameters);
    var xmlHttp = new CreateObject();
    xmlHttp.open("POST", url, true);
    //Send the proper header information along with the request  
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.setRequestHeader("Content-length", parameters.length);
    xmlHttp.setRequestHeader("Connection", "close");
    xmlHttp.onreadystatechange = function () {//Handler function for call back on state change.  
        if (xmlHttp.readyState == 4) {
            document.getElementById("divPrevWorking").innerHTML = xmlHttp.responseText;
            $('.inputdate').datepick();
            // alert(xmlHttp.responseText);
        }
    }
    xmlHttp.send(parameters);
}
function fAddProfessional()
{
    if (validProf('0') == 0)
    {
        //  start func body
        var industry = document.getElementById("industry").value;
        var skills = document.getElementById("skills").value;
        var degree = document.getElementById("degree").value;
        //var degree1=document.getElementById("degree1").value;
        var institute = document.getElementById("institute").value;
        var skillyear = document.getElementById("skillyear").value;
        var ncc = "";
        if (document.getElementById("ncc").checked) {
            ncc = "NCC"
        }
        if (document.getElementById("nss").checked) {
            ncc = "NSS"
        }
        if (document.getElementById("sg").checked) {
            ncc = "Scouts and Guides"
        }
        var url = "ajaxSubmitSkill.asp";
        var parameters = "industry=" + encodeURI(industry) + "&skills=" + encodeURI(skills) + "&degree=" + encodeURI(degree) + "&institute=" + encodeURI(institute) + "&skillyear=" + encodeURI(skillyear) + "&ncc=" + encodeURI(ncc);
        //alert(parameters);
        var xmlHttp = new CreateObject();
        xmlHttp.open("POST", url, true);
        //Send the proper header information along with the request  
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", parameters.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.onreadystatechange = function () {//Handler function for call back on state change.  
            if (xmlHttp.readyState == 4) {
                document.getElementById("divSkillsDetails").innerHTML = xmlHttp.responseText;
                // alert(xmlHttp.responseText);
            }
        }
        xmlHttp.send(parameters);
        // end func body
    }

}
function fEditProfessional(id)
{

    if (validProf('0') == 0)
    {
        //  start func body
        //var subcat=SkillSubcatCheckedValues();
        var industry = document.getElementById("industry").value;
        var skills = document.getElementById("skills").value;
        var degree = document.getElementById("degree").value;
        var institute = document.getElementById("institute").value;
        var skillyear = document.getElementById("skillyear").value;
        var ncc = "";
        if (document.getElementById("ncc").checked) {
            ncc = "NCC"
        }
        if (document.getElementById("nss").checked) {
            ncc = "NSS"
        }
        if (document.getElementById("sg").checked) {
            ncc = "Scouts and Guides"
        }
        var url = "ajaxSubmitSkill.asp";
        var parameters = "id=" + encodeURI(id) + "&edit=yes&industry=" + encodeURI(industry) + "&skills=" + encodeURI(skills) + "&degree=" + encodeURI(degree) + "&institute=" + encodeURI(institute) + "&skillyear=" + encodeURI(skillyear) + "&ncc=" + encodeURI(ncc);
        //alert(parameters);
        var xmlHttp = new CreateObject();
        xmlHttp.open("POST", url, true);
        //Send the proper header information along with the request  
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.setRequestHeader("Content-length", parameters.length);
        xmlHttp.setRequestHeader("Connection", "close");
        xmlHttp.onreadystatechange = function () {//Handler function for call back on state change.  
            if (xmlHttp.readyState == 4) {
                document.getElementById("divSkillsDetails").innerHTML = xmlHttp.responseText;
                // alert(xmlHttp.responseText);
            }
        }
        xmlHttp.send(parameters);
        // end func body
    }

}
function EditPSkill(id)
{
    var url = "ajaxEditSkill.asp";
    var parameters = "id=" + encodeURI(id) + "&modify=yes";
    //alert(parameters);
    var xmlHttp = new CreateObject();
    xmlHttp.open("POST", url, true);
    //Send the proper header information along with the request  
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.setRequestHeader("Content-length", parameters.length);
    xmlHttp.setRequestHeader("Connection", "close");
    xmlHttp.onreadystatechange = function () {//Handler function for call back on state change.  
        if (xmlHttp.readyState == 4) {
            document.getElementById("divSkillsDetails").innerHTML = xmlHttp.responseText;
            // alert(xmlHttp.responseText);
        }
    }
    xmlHttp.send(parameters);
    // end func body
}
function validProf(val)
{
    var count_bug = val;

    var pdate = $("#dateofbirth").val().split('-');
    var dd = parseInt(pdate[0]);
    var mm = parseInt(pdate[1]);
    var yy = parseInt(pdate[2]);
    $("#degree").css({border: '1px solid #adadad', background: '#fff'});
    if ($("#degree").val() == "")
    {
        $("#degree").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        if (eval(count_bug) == 0) {
            $("#degree").focus();
            count_bug += 1;
        }
    }
    else {
        $("#degree").css({border: '1px solid #adadad', background: '#fff'});
    }
    var skillyear = $("#skillyear").val();
    if ($("#skillyear").val() == "")
    {
        $("#skillyear").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        if (eval(count_bug) == 0) {
            $("#skillyear").focus();
            count_bug += 1;
        }
    } else if (!isInteger(skillyear))
    {
        $("#skillyear").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        $("#spanSkillYear").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#skillyear").focus();
            count_bug += 1;
        }
    } else if (skillyear.charAt(0) == "0")
    {
        $("#skillyear").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        $("#spanSkillYear").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#skillyear").focus();
            count_bug += 1;
        }
    } else if (skillyear.length != 4)
    {
        $("#skillyear").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        $("#spanSkillYear").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#skillyear").focus();
            count_bug += 1;
        }
    } else if (parseInt(skillyear) < 1940 || parseInt(skillyear) > 2020)
    {
        $("#skillyear").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        $("#spanSkillYear").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#skillyear").focus();
            count_bug += 1;
        }
    }
    else if (parseInt(skillyear) <= parseInt(yy))
    {
        $("#skillyear").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        $("#spanSkillYear").html('Year cannot be less than Year of Birth');
        $("#spanSkillYear").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#skillyear").focus();
            count_bug += 1;
        }
    }
    else {
        $("#skillyear").css({border: '1px solid #adadad', background: '#fff'});
        $("#spanSkillYear").css({'display': 'none'});
    }
    //alert($("#txtchkSkillEntryStrFlag").val());
    if (parseInt($("#txtchkSkillEntryStrFlag").val()) == 1)
    {
        $("#trade").css({border: '1px solid #adadad', background: '#fff'});
        if ($.trim($("#trade").val()) == "")
        {
            $("#trade").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

            if (eval(count_bug) == 0) {
                $("#trade").focus();
                count_bug += 1;
            }
        }
        $("#skills").css({border: '1px solid #adadad', background: '#fff'});
        if ($.trim($("#skills").val()) == "")
        {
            $("#skills").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            if (eval(count_bug) == 0) {
                $("#skills").focus();
                count_bug += 1;
            }
        }
    }
    return count_bug;
}
function SkillSubcatCheckedValues()
{
    var j = 0;
    var str = "";
    var lent = document.getElementById("txtchkLength").value;
    var xl = 0;
    if (lent > 0)
    {
        for (j = 0; j < lent; j++)
        {
            xl = j + 1;
            if (document.getElementById("chkSubCat" + xl).checked) {
                str = str + document.getElementById("chkSubCat" + xl).value + ",";
            }
        }
        str = str.substring(0, str.length - 1)
    }
    return str;

}
function fMobileChange(val)
{
    var MobVal = $("#mobile").val();
    $("#mobile").css({border: '1px solid #adadad', background: '#fff'});
    var flgMob = false;
    if ($("#mobile").val() == "") {
        flgMob = true;
    } else if (!isInteger(MobVal)) {
        flgMob = true;
    } else if (MobVal.charAt(0) == "0") {
        flgMob = true;
    } else if (MobVal.length != 10) {
        flgMob = true;
    } else {

    }
    if (flgMob == true)
    {
        $("#mobile").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        $("#mobileErrorDiv").html(msg);
        $("#mobile").focus();
    }
}

function populateState(val)
{
    $("#corpincode").css({border: '1px solid #adadad', background: '#fff'});
    var corpincode = $("#corpincode").val();
    if ($("#corpincode").val() == "")
    {
        $("#corpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else if (!isInteger(corpincode))
    {
        $("#corpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else if (corpincode.charAt(0) == "0")
    {
        $("#corpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else if (corpincode.length != 6)
    {
        $("#corpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else
    {
        $("#corpincode").css({border: '1px solid #adadad', background: '#fff'});

        var tmpStr = "actionType=getPinCodeData&PinCode=" + corpincode;
        $.ajax({url: "../ajaxActionCode.php", data: tmpStr, type: "POST",
            success: function (data) {
                data = data.split('|:|');
                //$('#currentCity').val(data[0]);
                $('#cordistrict').val(data[1]);
                $('#corstate').val(data[2]);
            }
        });

    }
}
function perPopulateState_bakup(val)
{
    $("#perpincode").css({border: '1px solid #adadad', background: '#fff'});
    var perpincode = $("#perpincode").val();
    if ($("#perpincode").val() == "")
    {
        $("#perpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else if (!isInteger(perpincode))
    {
        $("#perpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else if (perpincode.charAt(0) == "0")
    {
        $("#perpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else if (perpincode.length != 6)
    {
        $("#perpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else
    {
        $("#perpincode").css({border: '1px solid #adadad', background: '#fff'});
        var tmpStr = "actionType=getPinCodeData&PinCode=" + perpincode;
        $.ajax({url: "../ajaxActionCode.php", data: tmpStr, type: "POST",
            success: function (data) {
                data = data.split('|:|');

                //$('#currentCity').val(data[0]);
                $('#perdistrict').val(data[1]);
                $('#perstate').val(data[2]);

            }
        });
    }
}
function fRadioAddress(val)
{
    if (val == "No") {
        document.getElementById("divTablePermanent").style.display = "block";
    }
    if (val == "Yes") {
        document.getElementById("divTablePermanent").style.display = "none";
    }
}
function BlurOutRedPin(id)
{
    var count_bug = 0;
    $("#formNoErrorDiv").hide();
    $("#perPicodeErrorDiv").hide();
    $("#" + id).css({border: '1px solid #adadad', background: '#fff'});
    var data = $("#" + id).val();
    if ($.trim(data) == "") {
        count_bug++;
        $("#" + id).css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else if (!isInteger(data)) {
        count_bug++;
        $("#" + id).css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    } else if (data.length != 6) {
        count_bug++;

    }
    if (count_bug > 0) {
        if (id == 'formnumber') {
            $("#" + id).css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#formNoErrorDiv").show();
        } else if (id == 'perpincode') {
            $("#" + id).css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#perPicodeErrorDiv").show();
        }
    }
    if (id == 'skillyear') {
        var flgskillyear = false;
        $("#spanSkillYear").hide();
        var pdate = $("#dateofbirth").val().split('-');
        var yy = parseInt(pdate[2]);
        var msg = '';
        if (parseInt(data) <= parseInt(yy)) {
            flgskillyear = true;
            msg = 'Year cannot be less than Year of Birth';
        }
        if (parseInt(data) < 1940) {
            flgskillyear = true;
            msg = 'Year cannot be less than 1940';
        }
        if (parseInt(data) > 2021) {
            flgskillyear = true;
            msg = 'Year cannot exceed 2021.';
        }
        if (flgskillyear == true) {
            $("#spanSkillYear").html(msg);
            $("#skillyear").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#spanSkillYear").show();
            $("#skillyear").focus();
        }
    }
}

function BlurOutRed(id)
{
    if ($("#" + id).val() != "") {
        $("#" + id).css({border: '1px solid #adadad', background: '#fff'});
    } else {
        $("#" + id).css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
    }
}

function BlurOutRedDob()
{
    var count_bug = 0;
    $("#dateofbirth").css({border: '1px solid #adadad', background: '#fff'});
    re = /^\d{1,2}\-\d{1,2}\-\d{4}$/;
    if ($("#dateofbirth").val() == "")
    {
        $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        if (eval(count_bug) == 0) {
            $("#dateofbirth").focus();
            count_bug += 1;
        }
    }
    else if (!$("#dateofbirth").val().match(re))
    {
        $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        document.getElementById("dobErrorDiv").style.display = "block";
        if (eval(count_bug) == 0) {
            $("#dateofbirth").focus();
            count_bug += 1;
        }
    } else
    {
        var pdate = $("#dateofbirth").val().split('-');
        var dd = parseInt(pdate[0]);
        var mm = parseInt(pdate[1]);
        var yy = parseInt(pdate[2]);

        var today = new Date();
        var d1 = today.getDate();
        var m1 = today.getMonth() + 1; //January is 0!
        var y1 = today.getFullYear() - 18;
        var y2 = today.getFullYear() - 65;

        if (dd.toString().length < 2) {
            dd = "0" + dd.toString();
        }
        if (mm.toString().length < 2) {
            mm = "0" + mm.toString();
        }
        if (d1.toString().length < 2) {
            d1 = "0" + d1.toString();
        }
        if (m1.toString().length < 2) {
            m1 = "0" + m1.toString();
        }

        var cur = y1 + "" + m1 + "" + d1;
        var ent = yy + "" + mm + "" + dd;
        var morecur = y2 + "" + m1 + "" + d1;
        if (parseInt(cur) < parseInt(ent))
        {
            $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#dobErrorDiv1").show();
            if (eval(count_bug) == 0) {
                $("#dateofbirth").focus();
                count_bug += 1;
            }
        } else {
            $("#dobErrorDiv1").hide();
        }

        if (parseInt(morecur) > parseInt(ent))
        {
            $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#dobErrorDiv2").show();
            if (eval(count_bug) == 0) {
                $("#dateofbirth").focus();
                count_bug += 1;
            }
        } else {
            $("#dobErrorDiv2").hide();
        }

        var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if (parseInt(mm) > 12)
        {
            $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            document.getElementById("dobErrorDiv").style.display = "block";
            if (eval(count_bug) == 0) {
                $("#dateofbirth").focus();
                count_bug += 1;
            }
        }
        else if (mm == 1 || mm > 2)
        {
            if (dd > ListofDays[mm - 1])
            {
                $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                document.getElementById("dobErrorDiv").style.display = "block";
                if (eval(count_bug) == 0) {
                    $("#dateofbirth").focus();
                    count_bug += 1;
                }
            } else {
                $("#dateofbirth").css({border: '1px solid #adadad', background: '#fff'});
                document.getElementById("dobErrorDiv").style.display = "none";

            }
        }
        else if (mm == 2)
        {
            var lyear = false;
            if ((!(yy % 4) && yy % 100) || !(yy % 400))
            {
                lyear = true;
            }
            if ((lyear == false) && (dd >= 29))
            {
                $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                document.getElementById("dobErrorDiv").style.display = "block";
                if (eval(count_bug) == 0) {
                    $("#dateofbirth").focus();
                    count_bug += 1;
                }
            }
            else if ((lyear == true) && (dd > 29))
            {
                $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                document.getElementById("dobErrorDiv").style.display = "block";
                if (eval(count_bug) == 0) {
                    $("#dateofbirth").focus();
                    count_bug += 1;
                }
            }
            else {
                // alert("here1")
                $("#dateofbirth").css({border: '1px solid #adadad', background: '#fff'});
                document.getElementById("dobErrorDiv").style.display = "none";
            }
        }
        else
        {
            // alert("here2")
            $("#dateofbirth").css({border: '1px solid #adadad', background: '#fff'});
            document.getElementById("dobErrorDiv").style.display = "none";
        }
    }
    if (eval(count_bug) > 0) {
        return false;
    } else {
        return true;
    }
}

function validate()
{
    $("#formNoErrorDiv").css({'display': 'none'});
    $("#picodeErrorDiv").css({'display': 'none'});
    $("#perPicodeErrorDiv").css({'display': 'none'});
    $("#mobileErrorDiv").css({'display': 'none'});
    $("#mobileRef1ErrorDiv").css({'display': 'none'});
    $("#mobileRef2ErrorDiv").css({'display': 'none'});

    $("#formnumber,#firstname, #email, #dateofbirth,#joinafter, #landline,  #mobile, #fathername, #earntype, #income,  #datepicker-example8,  #coraddress ,#corcity, #cordistrict, #corstate, #corpincode,#perpincode, #noYears, #noMonths, #chkTerms, #refPhone1, #refPhone2").css({border: '1px solid #adadad', background: '#fff'});
    var count_bug = 0;

    var AppNoVal = $.trim($("#formnumber").val());
    /*	if ($("#formnumber").val().replace(/^\s+|\s+$/gm,'')=="")
     {	
     $("#formnumber").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
     $("#formNoErrorDiv").css({'display':'block'});		
     count_bug+=1;
     $("#mobile").focus();
     }*/
    if (AppNoVal != '')
    {
        var flgAppNoVal = false;
        if (!isInteger(AppNoVal)) {
            flgAppNoVal = true;
        } else if (AppNoVal.length != 6) {
            flgAppNoVal = true;
        }
        if (flgAppNoVal == true) {
            $("#formnumber").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#formnumber").focus();
            $("#formNoErrorDiv").css({'display': 'block'});
            count_bug += 1;
        }
    }


    if ($("#firstname").val().replace(/^\s+|\s+$/gm, '') == "")
    {
        $("#firstname").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        if (eval(count_bug) == 0) {
            $("#firstname").focus();
            count_bug += 1;
        }
    }

    var emailid = $.trim($("#email").val());
    if (emailid != "")
    {
        if (!echeck(emailid))
        {
            $("#email").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            if (eval(count_bug) == 0) {
                $("#email").focus();
                count_bug += 1;
            }
        }
    }

    var flgMobVal = false;
    var MobVal = $.trim($("#mobile").val());
    if (MobVal.replace(/^\s+|\s+$/gm, '') == "")
    {
        flgMobVal = true;
    }
    else if (!isInteger(MobVal))
    {
        flgMobVal = true;
    }
    else if (MobVal.charAt(0) == "0")
    {
        flgMobVal = true;
    }
    else if (MobVal.length != 10)
    {
        flgMobVal = true;
    }

    if (flgMobVal == true) {
        $("#mobile").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        if (eval(count_bug) == 0) {
            $("#mobile").focus();
            $("#mobileErrorDiv").css({'display': 'block'});
            count_bug += 1;
        }
    }

    var landline = $.trim($("#landline").val());
    if (landline != "")
    {
        var flgLandline = false;
        if (!isInteger(landline)) {
            flgLandline = true;
        } else if (landline.length < 6) {
            flgLandline = true;
        }
        if (flgLandline == true) {
            $("#landline").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            if (eval(count_bug) == 0) {
                $("#landline").focus();
                $("#landlineErrorDiv").css({'display': 'block'});
                count_bug += 1;
            }
        }
    }


    if ($.trim($("#dateofbirth").val()) != "")
    {
        re = /^\d{1,2}\-\d{1,2}\-\d{4}$/;

        if ($("#dateofbirth").val().replace(/^\s+|\s+$/gm, '') == "")
        {
            $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

            if (eval(count_bug) == 0) {
                $("#dateofbirth").focus();
                count_bug += 1;
            }
        }
        else if (!$("#dateofbirth").val().match(re))
        {
            $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            document.getElementById("dobErrorDiv").style.display = "block";

            if (eval(count_bug) == 0) {
                $("#dateofbirth").focus();
                count_bug += 1;
            }
        } else
        {

            var pdate = $("#dateofbirth").val().split('-');
            var dd = parseInt(pdate[0]);
            var mm = parseInt(pdate[1]);
            var yy = parseInt(pdate[2]);

            //**
            var today = new Date();
            var d1 = today.getDate();
            var m1 = today.getMonth() + 1; //January is 0!
            var y1 = today.getFullYear() - 18;
            var y2 = today.getFullYear() - 65;

            if (dd.toString().length < 2) {
                dd = "0" + dd.toString();
            }
            if (mm.toString().length < 2) {
                mm = "0" + mm.toString();
            }
            if (d1.toString().length < 2) {
                d1 = "0" + d1.toString();
            }
            if (m1.toString().length < 2) {
                m1 = "0" + m1.toString();
            }


            var cur = y1 + "" + m1 + "" + d1;
            var ent = yy + "" + mm + "" + dd;
            var morecur = y2 + "" + m1 + "" + d1;
            // alert(morecur+'-'+ent)
            if (parseInt(cur) < parseInt(ent))
            {
                $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                document.getElementById("dobErrorDiv1").style.display = "block";
                if (eval(count_bug) == 0) {
                    $("#dateofbirth").focus();
                    count_bug += 1;
                }
            } else {
                document.getElementById("dobErrorDiv1").style.display = "none";
            }

            /* if(parseInt(morecur) > parseInt(ent))
             {			 
             $("#dateofbirth").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
             document.getElementById("dobErrorDiv2").style.display="block";
             if(eval(count_bug)==0)
             {		
             $("#dateofbirth").focus();	
             count_bug+=1;
             }
             }else{ document.getElementById("dobErrorDiv2").style.display="none";}*/

            //*********
            var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
            if (parseInt(mm) > 12)
            {
                $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                document.getElementById("dobErrorDiv").style.display = "block";

                if (eval(count_bug) == 0) {
                    $("#dateofbirth").focus();
                    count_bug += 1;
                }
            }
            else if (mm == 1 || mm > 2)
            {
                if (dd > ListofDays[mm - 1])
                {
                    $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                    document.getElementById("dobErrorDiv").style.display = "block";

                    if (eval(count_bug) == 0) {
                        $("#dateofbirth").focus();
                        count_bug += 1;
                    }
                }
            }
            else if (mm == 2)
            {

                var lyear = false;
                if ((!(yy % 4) && yy % 100) || !(yy % 400))
                {
                    lyear = true;
                }
                if ((lyear == false) && (dd >= 29))
                {
                    $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                    document.getElementById("dobErrorDiv").style.display = "block";
                    if (eval(count_bug) == 0) {
                        $("#dateofbirth").focus();
                        count_bug += 1;
                    }
                }
                else if ((lyear == true) && (dd > 29))
                {
                    $("#dateofbirth").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                    document.getElementById("dobErrorDiv").style.display = "block";
                    if (eval(count_bug) == 0) {
                        $("#dateofbirth").focus();
                        count_bug += 1;
                    }
                }
                else {
                    //  alert("here1")
                    $("#dateofbirth").css({border: '1px solid #adadad', background: '#fff'});
                    document.getElementById("dobErrorDiv").style.display = "none";
                }
            }
            else
            {
                // alert("here2")
                $("#dateofbirth").css({border: '1px solid #adadad', background: '#fff'});
                document.getElementById("dobErrorDiv").style.display = "none";
            }

        }
    }

    var corpincode = $("#corpincode").val();
    if (corpincode.replace(/^\s+|\s+$/gm, '') == "")
    {
        $("#corpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        if (eval(count_bug) == 0) {
            $("#corpincode").focus();
            count_bug += 1;
        }
    } else if (!isInteger(corpincode))
    {
        $("#corpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        $("#picodeErrorDiv").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#corpincode").focus();
            count_bug += 1;
        }
    } else if (corpincode.charAt(0) == "0")
    {
        $("#corpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        $("#picodeErrorDiv").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#corpincode").focus();
            count_bug += 1;
        }
    } else if (corpincode.length != 6)
    {
        $("#corpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

        $("#picodeErrorDiv").css({'display': 'block'});
        if (eval(count_bug) == 0) {
            $("#corpincode").focus();
            count_bug += 1;
        }
    }
    if ($("#corstate").val() == "")
    {
        $("#corstate").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        if (eval(count_bug) == 0) {
            $("#corstate").focus();
            count_bug += 1;
        }
    }
    if ($("#cordistrict").val().replace(/^\s+|\s+$/gm, '') == "")
    {
        $("#cordistrict").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        if (eval(count_bug) == 0) {
            $("#cordistrict").focus();
            count_bug += 1;
        }
    }

// *******************


//**************************	
    // *******************
    var perpincode = $("#perpincode").val();
    if (perpincode != "") {
        var flgperpincode = false;
        if ($("#perpincode").val().replace(/^\s+|\s+$/gm, '') == "") {
            flgperpincode = true;
        } else if (!isInteger(perpincode)) {
            flgperpincode = true;
        } else if (perpincode.charAt(0) == "0") {
            flgperpincode = true;
        } else if (perpincode.length != 6) {
            flgperpincode = true;
        }
        if (flgperpincode == true) {
            $("#perpincode").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#perPicodeErrorDiv").css({'display': 'block'});
            if (eval(count_bug) == 0) {
                $("#perpincode").focus();
                count_bug += 1;
            }
        }
    }
//**************************
    if (document.getElementById("txtchkSkillEntry").value == 0) {
        if (validProf(count_bug) > 0)
        {
            if (eval(count_bug) == 0)
                count_bug += 1;
        }
    }

    if (document.getElementById("experience1").checked) {
        if (!isInteger($("#noYears").val()))
        {
            $("#noYears").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            if (eval(count_bug) == 0) {
                $("#noYears").focus();
                count_bug += 1;
            }
        }
        if (!isInteger($("#noMonths").val()))
        {
            $("#noMonths").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            if (eval(count_bug) == 0) {
                $("#noMonths").focus();
                count_bug += 1;
            }
        } else if (parseInt($("#noMonths").val()) > 11)
        {
            $("#noMonths").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            if (eval(count_bug) == 0) {
                $("#noMonths").focus();
                count_bug += 1;
            }
        } else
        {
            $("#noMonths").css({border: '1px solid #000', background: '#fff'});
        }

    }



    if ($("#income").val().replace(/^\s+|\s+$/gm, '') == "")
    {
        /*$("#income").css({border:'1px solid #ff0000', background:'#ffdbdb', color:'#222'});
         $("#income").focus();
         if(eval(count_bug)==0)			
         count_bug+=1;*/
    } else if (!isInteger($("#income").val()))
    {
        $("#income").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        if (eval(count_bug) == 0) {
            $("#income").focus();
            count_bug += 1;
        }
    }
    if (parseInt($("#txtchkSkillEntryStrFlag").val()) == 1)
    {
        if ($("#salary").val().replace(/^\s+|\s+$/gm, '') == "")
        {
            $("#salary").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            if (eval(count_bug) == 0) {
                $("#salary").focus();
                count_bug += 1;
            }
        } else if (!isInteger($("#salary").val()))
        {
            $("#salary").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            if (eval(count_bug) == 0) {
                $("#salary").focus();
                count_bug += 1;
            }
        }

        if ($("#wherewilling").val() == "")
        {
            $("#wherewilling").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

            if (eval(count_bug) == 0) {
                $("#wherewilling").focus();
                count_bug += 1;
            }
        }
    }
    if (document.getElementById("whenjoin2").checked)
    {
        if ($("#joinafter").val().replace(/^\s+|\s+$/gm, '') == "")
        {
            $("#joinafter").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});

            if (eval(count_bug) == 0) {
                $("#joinafter").focus();
                count_bug += 1;
            }
        }

        else if (!$("#joinafter").val().match(re))
        {
            $("#joinafter").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            document.getElementById("joinafterErrorDiv").style.display = "block";

            if (eval(count_bug) == 0) {
                $("#joinafter").focus();
                count_bug += 1;
            }
        } else
        {
            var today = new Date();
            var d1 = today.getDate();
            var m1 = today.getMonth() + 1; //January is 0!

            var y1 = today.getFullYear();

            var pdate = $("#joinafter").val().split('/');
            var dd = parseInt(pdate[0]);
            var mm = parseInt(pdate[1]);
            var yy = parseInt(pdate[2]);
            //alert(d1.toString().length);
            if (dd.toString().length < 2) {
                dd = "0" + dd.toString();
            }
            if (mm.toString().length < 2) {
                mm = "0" + mm.toString();
            }
            if (d1.toString().length < 2) {
                d1 = "0" + d1.toString();
            }
            if (m1.toString().length < 2) {
                m1 = "0" + m1.toString();
            }


            var cur = y1 + "" + m1 + "" + d1;
            var ent = yy + "" + mm + "" + dd;
            if (parseInt(cur) > parseInt(ent))
            {
                // alert("hi")
                $("#joinafter").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                document.getElementById("joinafterErrorDiv").style.display = "block";
                if (eval(count_bug) == 0) {
                    $("#joinafter").focus();
                    count_bug += 1;
                }
            } else {
                document.getElementById("joinafterErrorDiv").style.display = "none";
            }

            var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
            if (mm == 1 || mm > 2)
            {
                if (dd > ListofDays[mm - 1])
                {
                    $("#joinafter").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                    document.getElementById("joinafterErrorDiv").style.display = "block";

                    if (eval(count_bug) == 0) {
                        $("#joinafter").focus();
                        count_bug += 1;
                    }
                }
            }
            else if (mm == 2)
            {
                var lyear = false;
                if ((!(yy % 4) && yy % 100) || !(yy % 400))
                {
                    lyear = true;
                }
                if ((lyear == false) && (dd >= 29))
                {
                    $("#joinafter").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                    document.getElementById("joinafterErrorDiv").style.display = "block";
                    if (eval(count_bug) == 0) {
                        $("#joinafter").focus();
                        count_bug += 1;
                    }
                }
                else if ((lyear == true) && (dd > 29))
                {
                    $("#joinafter").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
                    document.getElementById("joinafterErrorDiv").style.display = "block";
                    if (eval(count_bug) == 0) {
                        $("#joinafter").focus();
                        count_bug += 1;
                    }
                }
                else {
                    $("#joinafter").css({border: '1px solid #adadad', background: '#fff'});
                    document.getElementById("joinafterErrorDiv").style.display = "none";
                }
            }
            else
            {
                $("#joinafter").css({border: '1px solid #adadad', background: '#fff'});
                document.getElementById("joinafterErrorDiv").style.display = "none";
            }
        }



    }

    if (fCheckIdProof() == "")
    {
        document.getElementById("SpanIdProof").style.display = "block";
        if (eval(count_bug) == 0)
            count_bug += 1;
    } else {
        document.getElementById("SpanIdProof").style.display = "none";
    }


    if (count_bug > 0){
        return false;
    }else{
        return true;
    }
}

function fCLickLearn(val)
{
    if (val) {
        document.getElementById("divLrnOth").style.display = "block";
    }
    else {
        document.getElementById("divLrnOth").style.display = "none";
        document.getElementById("txtLearnOther").value = "";

    }
}
function ValueKeyPress(fld1, val, fld2)
{
    /*if(document.getElementById("ispermanent").checked)
     {
     //document.getElementById(fld2).value=document.getElementById(fld1).value;
     }*/
}
function fChangeDegree(val)
{
    if (val == "Other") {
        document.getElementById("divDegreeOther").style.display = "Block";
    }
    else {
        document.getElementById("divDegreeOther").style.display = "none";
    }
}
function fChangedCoreState(val)
{
    if (document.getElementById("ispermanent").checked)
    {
        document.getElementById("perstate").value = val;
    }

}
function checkBoxFields(fld1, fileFld, flnName)
{
    $("#" + fld1 + ", #" + fileFld + "").css({border: '1px solid #adadad', background: '#fff'});

    if ($("#" + fld1).val() == "")
    {
        $("#" + fld1).css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        return 1;
    }
    else if ($("#" + fileFld).val() == "")
    {
        $("#" + fileFld).css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        return 1;
    }
    else
        return 0;

}
function fCheckIdProof()
{
    var j = 0;
    var str = "";
    var lent = document.regForm.idproof.length;
    if (lent != undefined)
    {
        for (j = 0; j < document.regForm.idproof.length; j++)
        {
            if (document.regForm.idproof[j].checked) {
                str = str + document.regForm.idproof[j].value + ",";

            }
        }
        str = str.substring(0, str.length - 1)
    }
    else
    {
        str = document.regForm.idproof.value;
    }
    //alert(str);
    return str;

}
var digits = "0123456789";
function isInteger(s)
{
    var i;
    for (i = 0; i < s.length; i++)
    {
        var c = s.charAt(i);
        if (digits.indexOf(c) < 0)
        {
            return false
            exit();
        }
    }
    return true;
}

function echeck(str) {
    var atpos = str.indexOf("@");
    var dotpos = str.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= str.length) {
        return false;
    }
    return true;
}

function CreateObject()
{
    http_request = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_request = new XMLHttpRequest();
        if (http_request.overrideMimeType) {
            http_request.overrideMimeType('text/html');
        }
    } else if (window.ActiveXObject) { // IE
        try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
            }
        }
    }
    if (!http_request) {
        alert('Cannot create XMLHTTP instance');
        return false;
    }
    return http_request;
}

function validateLandLine(chk)
{
    var count_bug = 0;
    var landline = $.trim(chk);
    $("#landline").css({border: '1px solid #adadad', background: '#fff'});
    $("#landlineErrorDiv").hide();
    if (landline != "")
    {
        if (!isInteger(landline))
            count_bug += 1;
        else if (landline.length < 6)
            count_bug += 1;

        if (eval(count_bug) > 0) {
            $("#landline").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#landline").focus();
            $("#landlineErrorDiv").css({'display': 'block'});
        }
    }
}

function fnsameAsAddress(chk)
{
    if (chk) {
        $('#perpincode').val($('#corpincode').val());
        $('#perstate').val($('#corstate').val());
        $('#perdistrict').val($('#cordistrict').val());
        $('#peraddress').val($('#coraddress').val());
    } else {
        $('#perpincode, #perstate, #perdistrict, #peraddress').val('');
    }
}

function validateEmail() {
    var emailid = $.trim($("#email").val());
    $("#email").css({border: '1px solid #adadad', background: '#fff'});
    if (emailid != "")
    {
        if (!echeck(emailid))
        {
            $("#email").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            $("#email").focus();
        }
    }
}

function saveToDraft()
{
    $("#formNoErrorDiv").css({'display': 'none'});
    $("#picodeErrorDiv").css({'display': 'none'});
    $("#perPicodeErrorDiv").css({'display': 'none'});
    $("#mobileErrorDiv").css({'display': 'none'});
    $("#mobileRef1ErrorDiv").css({'display': 'none'});
    $("#mobileRef2ErrorDiv").css({'display': 'none'});

    $("#formnumber,#firstname, #email, #dateofbirth,#joinafter, #landline,  #mobile, #fathername, #earntype, #income,  #datepicker-example8,  #coraddress ,#corcity, #cordistrict, #corstate, #corpincode,#perpincode, #noYears, #noMonths, #chkTerms, #refPhone1, #refPhone2").css({border: '1px solid #adadad', background: '#fff'});

    var count_bug = 0;
    if ($.trim($("#firstname").val()) == "")
    {
        $("#firstname").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        if (eval(count_bug) == 0) {
            $("#firstname").focus();
            count_bug += 1;
        }
    }

    var emailid = $.trim($("#email").val());
    if (emailid != "")
    {
        if (!echeck(emailid)) {
            $("#email").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
            if (eval(count_bug) == 0) {
                $("#email").focus();
                count_bug += 1;
            }
        }
    }

    var flgMobVal = false;
    var MobVal = $.trim($("#mobile").val());
    if (MobVal.replace(/^\s+|\s+$/gm, '') == "")
        flgMobVal = true;
    else if (!isInteger(MobVal))
        flgMobVal = true;
    else if (MobVal.charAt(0) == "0")
        flgMobVal = true;
    else if (MobVal.length != 10)
        flgMobVal = true;

    if (flgMobVal == true) {
        $("#mobile").css({border: '1px solid #ff0000', background: '#ffdbdb', color: '#222'});
        if (eval(count_bug) == 0) {
            $("#mobile").focus();
            $("#mobileErrorDiv").css({'display': 'block'});
            count_bug += 1;
        }
    }
    var dob = $.trim($("#dateofbirth").val());
    if (dob != "") {
        if (!BlurOutRedDob()) {
            count_bug += 1;
        }
    }

    if (eval(count_bug) == 0) {
        document.regForm.submit();
    }
}



 