/*
 * Agent form validations
 */
 
/*
	 * show error on form field
	 */
	function hideErrorField(id){
		$('#'+ id).removeClass('hasError');
        $('#'+ id + 'ErrorDiv').hide();
	}
	
	/*
	 * hide error on form field
	 */
	function showErrorField(id, msg){
		$('#'+ id).addClass('hasError');
		//if(msg){
			$('#'+ id + 'ErrorDiv').html(msg);
		//}
        $('#'+ id + 'ErrorDiv').show();
	}
	
	function checkIfMobileNumberExists(elem){
		var tmpStr = "checkmobile=1&mobileno=" + elem.val();
		var isValid = false;
		$.ajax({
			url:"http://54.169.119.208/checkMobileNumber.php", 
			data: tmpStr, 
			type: "POST",
			success: function(data){
			 //alert(data);
			 if(data == 'SUCCESS'){
				 hideErrorField(elem.attr('id'));
				 isValid = true;
			 }else{
				console.log('show', elem.attr('id'));
				showErrorField(elem.attr('id'), 'Mobile number already exists.');
				isValid = false;
			 }
			 //return isValid;
			}
		});
		//console.log('ajax Server 2',isValid);
		//return isValid;
	}
	
	
	/*
	 * must be integer
	 * length 6
	 * can not be 000000..
	 * can be null
	 */
	function validateApplicationNumber(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		if(elemValue.length){
			if(!/^[0-9]{6}$/.test(elemValue)){
				isValid = false;
				showErrorField(elemId, 'Please enter 6 digit number only.');
			}else if(/^0{6}$/.test(elemValue)){
				isValid = false;
				showErrorField(elemId, 'Repeated 0s are not allowed.');
			}else{
				isValid = true;
				hideErrorField(elemId);
			}
		}else{
			isValid = true;
			hideErrorField(elemId);
		}
		return isValid;
	}
	function validateFirstName(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		if(!elemValue.length){
			showErrorField(elemId, 'This is a required field.');
			isValid = false;
		}else{
			hideErrorField(elemId);
			isValid = true;
		}
		return isValid;
	}
	
	function validateEmailAddress(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		if (elemValue.length && !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(elemValue)){  
		  isValid = false;
		  showErrorField(elemId, 'Please enter a valid email address.');
		}else{
		  isValid = true;  
		  hideErrorField(elemId);
		}  
		return isValid;
	}
	
	function validateMobileNumber(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		if(!/^[1-9][0-9]{9}$/.test(elemValue)){
			showErrorField(elemId, 'Mobile number should be a valid 10 digit number.');
			isValid = false;
		}else if(/^0{10}|1{10}|2{10}|3{10}|4{10}|5{10}|6{10}|7{10}|8{10}|9{10}$/.test(elemValue)){
			showErrorField(elemId, 'Mobile number should not have repeated digits.');
			isValid = false;
		}else{
			hideErrorField(elemId);
			isValid = true;
		}
		return isValid;
	}
	
	function validateStdCode(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		if(elemValue.length  && !/^[0-9]{3,5}$/.test(elemValue)){
			elem.addClass('hasError');
			showErrorField('landline', 'Please enter 3 to 5 digit number only.');
			isValid = false;
		}else{
			console.log(elem.html());
			elem.removeClass('hasError');
			hideErrorField('landline');
			isValid = true;
		}
		return isValid;
	}
	
	function validateLandline(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		if(elemValue.length && !/^[0-9]{6,10}$/.test(elemValue)){
			showErrorField(elemId, 'Please enter 6 to 10 digit number only.');
			isValid = false;
		}else if(/^0{10}|1{10}|2{10}|3{10}|4{10}|5{10}|6{10}|7{10}|8{10}|9{10}$/.test(elemValue)){
				showErrorField(elemId, 'Phone number should not have repeated digits.');
		}else{
			hideErrorField(elemId);
			isValid = true;
		}
		return isValid;
	}
	
	function validateDOB(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		if(elemValue.length && !/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/.test(elemValue)){
			//$('#age').attr('disabled', false);
			$(this).addClass('hasError');
			showErrorField(elemId, 'Please enter date in following format: dd-mm-yyyy');
		}else if(elemValue.length){
			dateParts = elemValue.split('-');
			var dd = parseInt(dateParts[0]);
			var mm = parseInt(dateParts[1]);
			var yy = parseInt(dateParts[2]);
			
			var validDayRanges = [31,28,31,30,31,30,31,31,30,31,30,31];
			
			if(dd  == 0 || mm == 0 || yy == 0){
				//$('#age').attr('disabled', false);
				showErrorField(elemId, 'Invalid date.');
				isValid = false;
			}
			
			if(mm > 12){
				//$('#age').attr('disabled', false);
				showErrorField(elemId, 'Invalid date.');
				isValid = false;
			}
			
			if (mm == 1 || mm > 2){
				if (dd > validDayRanges[mm - 1]){
					//$('#age').attr('disabled', false);
					showErrorField(elemId, 'Invalid date.');
					isValid = false;
				}
			}
			
			if (mm == 2){
				var lyear = false;
				if((!(yy % 4) && yy % 100) || !(yy % 400)){
					lyear = true;
				}
				if((lyear == false) && (dd >= 29)){
					//$('#age').attr('disabled', false);
					showErrorField(elemId, 'Invalid date.');
					isValid = false;
				}
				if((lyear == true) && (dd > 29)){
					//$('#age').attr('disabled', false);
					showErrorField(elemId, 'Invalid date.');
					isValid = false;
				}
			}
			
			dobDateObj = new Date(yy, mm-1, dd);
			currentDateObj = new Date();
			currentDateObj.setHours('0');
			currentDateObj.setMinutes('0');
			currentDateObj.setSeconds('0');
			
			//console.log(currentDateObj);
			//console.log(dobDateObj);
			
			diffInMiliSecs = currentDateObj.getTime() - dobDateObj.getTime();
			if(diffInMiliSecs > 0){
				var ageDate = new Date(diffInMiliSecs);
				diffInYears = Math.abs(ageDate.getUTCFullYear() - 1970);
				console.log('calculated age', diffInYears);
				//$('#age').val(diffInYears);
				if(diffInYears < 18 || diffInYears > 60){
					//$('#age').attr('disabled', false);
					showErrorField(elemId, 'Age can not be less than 18 or greater than 60 years.');
					isValid = false;
				}else{
					$('#age').attr('disabled', true);
					hideErrorField(elemId);
					isValid = true;
					$('#gender1').focus();
				}
			}else{
				//$('#age').attr('disabled', false);
				showErrorField(elemId, 'Age can not be less than 18 years.');
				isValid = false;
			}
		}else{
			//console.log('disable attribute');
			$('#age').val('').attr('disabled', false);
			$('#age').trigger('change');
			hideErrorField(elemId);
			isValid = true;
		   
		}
		return isValid;
	}
	
	function assignDOB(dobElemId, ageValue){
		currentDate = new Date();
		dobYear = currentDate.getFullYear() - ageValue;
		
		dobObj = new Date();
		dobObj.setYear(dobYear);
		dobObj.setSeconds(0);
		dobObj.setHours(0);
		dobObj.setMinutes(0);
		
		datePart = dobObj.getDate().toString().length==1 ? "0"+dobObj.getDate() : dobObj.getDate();
		monthPart = dobObj.getMonth().toString().length==1 ? "0"+(dobObj.getMonth()+1) : (dobObj.getMonth()+1);
		yearPart = dobObj.getFullYear();
		
		format = datePart + '-' + monthPart + '-' + yearPart;
		$('#' + dobElemId).val(format);
	}
	
	function validateAge(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		var dob = $('#dateofbirth').val();
		console.log(elemValue);
		
		/* if(!elemValue){
			$('#dateofbirth').val('').attr('disabled', false);
		} */
		
		if(!dob.length && !elemValue.length){
			showErrorField('dateofbirth', '');
			$('#dateofbirth').val('').attr('disabled', false);
			showErrorField(elemId, 'Both Date of Birth & Age can not be blank.');
			isValid = false;
		}else{
			if(elemValue.length){
				assignDOB('dateofbirth', elemValue);
				//$('#dateofbirth').attr('disabled', true);
				hideErrorField('dateofbirth');
				isValid = true;
			}else if(dob.length){
				//$('#dateofbirth').attr('disabled', true);
			}else{
				$('#dateofbirth').val('').attr('disabled', false);
			}
			
			isValid = true;
			hideErrorField(elemId);
		}
		return isValid;
	}
	
	function validateGender(){
		var isValid = false;
		var selected = false;
		$('.gender').each(function(){
			if($(this).is(':checked')){
				selected = true;
			}
		});
		if(!selected){
			isValid = false;
			showErrorField('gender', 'Please choose one option.');
		}else{
			hideErrorField('gender');
			isValid = true;
		}
		return isValid;
	}
	
	function validateMarriage(){
		var selected = false;
		var isValid = false;
		
		$('.married').each(function(){
			if($(this).is(':checked')){
				selected = true;
			}
		});
		if(!selected){
			showErrorField('married', 'Please select one option.');
			isValid = false;
		}else{
			hideErrorField('married');
			isValid = true;
		}
		return isValid;
	}
	
	function validateDegree(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		
		if(!elemValue){
			showErrorField(elemId, 'This is a requried value.');
			isValid = false; 
		}else{
			hideErrorField(elemId);
			isValid = true; 
		}
		return isValid;
	}
	
	function validateZipcode(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		
		if(!/^[1-9][0-9]{5}$/.test(elemValue)){
			showErrorField(elemId, 'Please enter valid zip code.');
			isValid = false;
		}else{
			hideErrorField(elemId);
			isValid = true;
		}
		
		return isValid;
	}
	
	function validateSkillYear(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var year = elem.val();
		var dob = $('#dateofbirth').val();
		var birthParts = dob.split('-');
		var birthYear = parseInt(birthParts[2]);
		var hasErrors = false;
		if(year.length){
			if(!/^[1-9][0-9]{3}$/.test(year)){
				hasErrors = true;
				showErrorField(elemId, 'Please enter valid year.');
			}

			if(birthYear >= parseInt(year)){
				hasErrors = true;
				showErrorField(elemId, 'Year completion can not be less than Date of Birth.');
			}

			if(year < 1940){
				hasErrors = true;
				showErrorField(elemId, 'Year completion can not be less than 1940.');
			}
			if(year > 2020){
				hasErrors = true;
				showErrorField(elemId, 'Year completion can not be greater than 2020.');
			}

			if(!hasErrors){
				hideErrorField(elemId);
				isValid = true;
			}else{
				isValid = false;
			}
		}else{
			isValid = true;
			hideErrorField(elemId);
		}
		
		return isValid;
	}
	
	function validateTrade(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		
		if(!elemValue.length){
			isValid = false;
			showErrorField(elemId, 'This is a required field.');
		}else{
			isValid = true;
			hideErrorField(elemId);
		}
		return isValid;
	}
	
	function validateSkills(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var elemValue = elem.val();
		if(!elemValue.length){
			showErrorField(elemId, 'This is a required field.');
			isValid = false;
		}else{
			hideErrorField(elemId);
			isValid = true;			
		}
		return isValid;
	}
	
	function validateNoOfYears(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var yearVal = elem.val();
		
		var experienceFieldYes = $('#experience1').is(':checked');
		if(experienceFieldYes){
			var noOfYears = yearVal;
			if(!noOfYears.length && !$('#noMonths').val().length){
				elem.addClass('hasError');
				$('#noMonths').addClass('hasError');
				showErrorField('experience', 'Please fill at least one field.');
				isValid = false;
			}else if(!/^[0-9]*$/.test(noOfYears)){
				elem.addClass('hasError');
				showErrorField('experience', 'Year must be a numeric value.');
				isValid = false;
			}else{
				elem.removeClass('hasError');
				hideErrorField('experience');
				$('#noMonths').removeClass('hasError');
				isValid = true;
			}
			
		}else{
			isValid = true;
		}
		
		return isValid;
	}
	
	function validateNoOfMonths(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var monthsVal = elem.val();
		
		var experienceFieldYes = $('#experience1').is(':checked');
		if(experienceFieldYes){
			var noOfMonths = monthsVal;
			if(noOfMonths.length){
			   if(!/^[0-9]*$/.test(noOfMonths)){
				    elem.addClass('hasError');
					showErrorField('experience', 'Months must be a numeric value.');
					isValid = false;
				}else if(noOfMonths >= 12){
					elem.addClass('hasError');
					showErrorField('experience', 'Months value can not be greater than 11.');
					isValid = false;
				}else if(noOfMonths <= 0){
					elem.addClass('hasError');
					showErrorField('experience', 'Months value can not be  0.');
					isValid = false;
				}else{
					elem.removeClass('hasError');
					hideErrorField('experience');
					isValid = validateNoOfYears($('#noYears').attr('id'));;
				} 
			}else{
				isValid = validateNoOfYears($('#noYears').attr('id'));
			}
		}else{
			isValid = true;
		}
		
		return isValid;
	}
	
	function validateIncome(elemId){
		isValid = false;
		var elem = $('#' + elemId);
		var income = elem.val();
		if(income.length){
			if(!/^[1-9][0-9]{0,6}$/.test(income)){
				showErrorField(elemId, 'Please enter valid income.');
				isValid = false;
			}else{
				isValid = true;
				hideErrorField(elemId);
			}
		}else{
			isValid = true;
			hideErrorField(elemId);
		}
		return isValid;
	}
	
	function validateSalary(elemId, showError){
		var isValid = false;
		var elem = $('#' + elemId);
		var salary = elem.val();
		
		if(typeof showError == 'undefined'){
			showError = true;
		}
                                                        
		if(salary.length){
			if(!/^[1-9][0-9]{0,6}$/.test(salary)){
				if(showError){
					showErrorField(elemId, 'Please enter valid expected salary.');
				}
				isValid = false;
			}else{
				hideErrorField(elemId);
				isValid = true;
			}
		}else{
			if(showError){
				showErrorField(elemId, 'Expected salary is a required field.');
			}
			isValid = false;
		}
		return isValid;
	}
	
	function validateIdProof(){
		isValid = false;
		isChecked = false;
		$('.idproof').each(function(){
			if($(this).is(':checked')){
				isChecked = true;
			}
		});
		if(!isChecked){
			isValid = false;
			showErrorField('idproof', 'Please select at least one Id Proof.');
		}else{
			isValid = true;
			hideErrorField('idproof');
		}
		return isValid;
	}
	
	function validateJoinAfter(elemId){
		var isValid = false;
		var elem = $('#' + elemId);
		var joinafter = elem.val();
		
		joinChoice = $('#whenjoin2').is(':checked');
		
		if(joinafter.length && !/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/.test(joinafter)){
			showErrorField(elemId, 'Joining date should be after today in format (dd-mm-yyyy).');
			isValid = false;
		}else if(joinafter.length){
			dateParts = joinafter.split('-');
			var dd = parseInt(dateParts[0]);
			var mm = parseInt(dateParts[1]);
			var yy = parseInt(dateParts[2]);

			var validDayRanges = [31,28,31,30,31,30,31,31,30,31,30,31];

			if(dd  == 0 || mm == 0 || yy == 0){
				showErrorField(elemId, 'Invalid date.');
				isValid = false;
			}
			
			if(mm > 12){
				showErrorField(elemId, 'Invalid date.');
				isValid = false;
			}

			if (mm == 1 || mm > 2){
				if (dd > validDayRanges[mm - 1]){
					showErrorField(elemId, 'Invalid date.');
					isValid = false;
				}
			}

			if (mm == 2){
				var lyear = false;
				if((!(yy % 4) && yy % 100) || !(yy % 400)){
					lyear = true;
				}
				if((lyear == false) && (dd >= 29)){
					showErrorField(elemId, 'Invalid date.');
					isValid = false;
				}
				if((lyear == true) && (dd > 29)){
					showErrorField(elemId, 'Invalid date.');
					isValid = false;
				}
			}

			joinDateObj = new Date(yy, mm-1, dd);
			currentDateObj = new Date();
			diffInMiliSecs = joinDateObj.getTime() - currentDateObj.getTime();
			//console.log('join after value', diffInMiliSecs);
			//console.log('join after', (parseInt(diffInMiliSecs) > 0));
			if(diffInMiliSecs < 0){
				showErrorField(elemId, 'Joining date should be after today in format (dd-mm-yyyy).');
				isValid = false;
			}else{
				hideErrorField(elemId);
				isValid = true;
			}
			
		}else if(joinChoice && joinafter.length <= 0){
			showErrorField(elemId, 'This is a required field.');
			isValid = false;
			
		}else{
			hideErrorField(elemId);
			isValid = true;
		}
		
		return isValid;
	}
	
	function validateWhereWilling(elemId, showError){
		var isValid = false;
		var elem = $('#' + elemId);
		var willingVal = elem.val();
		if(typeof showError == 'undefined'){
			showError = true;
		}
			
		if(!willingVal.length){
			if(showError){
				showErrorField(elemId, 'This is a required field.');
			}
			isValid = false;
		}else{
			hideErrorField(elemId);
			isValid = true;
		}
		return isValid;
	} 