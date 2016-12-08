//Validation.
validation = {
	//Server side validation rule.
	sRule : {},
	//Client side validation rule.
	cRule : {},

	//Client validation rule.
	addCRule : function(oVald) {

		//If not empty then add rule.
		if (oVald.field.length !== 0 && oVald.label.length !== 0) {
			this.cRule[oVald.field] = {};
			this.cRule[oVald.field]["label"] = oVald.label;
			this.cRule[oVald.field]["rule"] = oVald.rule;
		}

	},
	//Server validation rule.
	addSRule : function(oVald) {
		//If not empty then add rule.
		if (oVald.field.length !== 0 && oVald.label.length !== 0 && oVald.rule.length !== 0) {
			this.sRule[oVald.field] = {};
			this.sRule[oVald.field]["label"] = oVald.label;
			this.sRule[oVald.field]["rule"] = oVald.rule;

		}
	},
	bind : function() {

                //Bind each element having rule to client side validate.
		$.each(this.cRule, function(field) {
			var elementType = $("#" + field).prop('type');
			//get type of element
			if (elementType == 'checkbox') {
				$("#" + field).click(function(eve) {
					validation.cValidate(eve);
				});
			} else {
				$("#" + field).blur(function(eve) {
					validation.cValidate(eve);
				});
			}
		});

		//Bind each element having rule to server side validate.
		$.each(this.sRule, function(field) {

			$("#" + field).blur(function(eve) {
				validation.sValidate(eve);
			});

		});

	},
	//Client side validation.
	cValidate : function(eve) {

		//Get element property.
		var oEle = {};
		oEle.id = eve.target.id;
		oEle.val = $("#" + oEle.id).val();
		oEle.label = this.cRule[oEle.id]['label'];
		oEle.rule = this.cRule[oEle.id]['rule'];

		//Break into parts.
		var rule = oEle.rule.split("|");
		//Traver through all cRules for particular field.
		for (x in rule) {
			//Remove if any previous error.
			if ($("#err_" + oEle.id)) {
				$("#err_" + oEle.id).html('');
			}
			//Get argument from match rule : match[argument]
			if (rule[x].indexOf("match") !== -1) {
				oEle.match_id = rule[x].substring(rule[x].indexOf("[") + 1, rule[x].indexOf("]"));
				rule[x] = rule[x].substring(0, rule[x].indexOf("["));
			}

			//Call validation function.
			//If error found then do not call next validation.
			if (this[rule[x]](oEle) === true) {
				break;
			}
		}//for
	},
	get_err : function(oMsg) {
		if (oMsg.str.length !== 0) {
			return '<small class="error" >' + oMsg.str + '</small>';
			//return '<small class="error">' + oMsg.str + '.</small>';
		}
	},
	required : function(oEle) {
            
		if (!oEle.val || !oEle.val.trim() || oEle.val.trim().length === 0) {

			var oMsg = {};
			//oMsg.str = oEle.label + " is required"; // running
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;

			if (oEle.id == 'accept_agreement' || oEle.id == 'accept_terms' || oEle.id == 'sp_terms') {
				$("#err_" + oEle.id).html(this.get_err(oMsg));
				//$("#" + oEle.id).next().after(this.get_err(oMsg));
			} else {

				$("#err_" + oEle.id).html(this.get_err(oMsg));
			}

			//$("#err_" + oEle.id).html(this.get_err(oMsg));

			return true;
		}
	},
	firstAlpha : function(oEle) {

		var exp = /^[a-zA-Z][^0-9]+$/;
		//First character must be a letter & no number in between
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only alphabet";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}

	},
	ukPostCodeValid : function(oEle) {

		var exp = /^([A-PR-UWYZ0-9][A-HK-Y0-9][AEHMNPRTVXY0-9]?[ABEHMNPRVWXY0-9]? {1,2}[0-9][ABD-HJLN-UW-Z]{2}|GIR 0AA)$/;
		//- Max length will be 11 characters. (or 13 with two spaces.)
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only alphabet";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	ukPhoneValid : function(oEle) {

		var exp = /^[0-9 ]{11,13}$/;
		//- Max length will be 11 characters. (or 13 with two spaces.)
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only alphabet";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	maxTextlength : function(oEle) {

		var exp = /^[\s\S]{0,50}$/;
		//Maxlength & Regular Expressions for text boxes 50 char
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only alphabet";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	validCity : function(oEle) {

		var exp = /^[a-zA-Z '-A-Z '-]/;
		//allow Hyphens & Apostrophes  e.g. D’Souza
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only alphabet";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},

	alphabetName : function(oEle) {

		var exp = /^[a-zA-Z '-A-Z '-]/;
		//allow Hyphens & Apostrophes  e.g. D’Souza
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only alphabet";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},

	alphabet : function(oEle) {

		var exp = /^[a-zA-Z]+$/;
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only alphabet";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	alphabetLastname : function(oEle) {

		var exp = /^[a-zA-Z ']+$/;
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only alphabet";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	numeric : function(oEle) {

		var exp = /^[0-9]*$/;
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only numbers";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	numericWithDecimal : function(oEle) {

		var exp = /^[1-9]\d*(\.\d+)?$/;
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have only numbers";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	alphaNumeric : function(oEle) {

		var exp = /^[a-zA-Z0-9_]*$/;
		//alpshnumeric with no space
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have aplha numeric only";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	alphaNumericHouseNumber : function(oEle) {

		var exp = /^[a-zA-Z0-9_ ,'-]*$/;
		//alpshnumeric with no space
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have aplha numeric only";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	alphaNumericWithSpace : function(oEle) {

		var exp = /^[a-zA-Z0-9_ ]*$/;
		//alpshnumeric with no space
		if (!oEle.val.match(exp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have aplha numeric only";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	match : function(oEle) {

		if ($("#" + oEle.id).val().toLowerCase() !== $("#" + oEle.match_id).val().toLowerCase()) {
			oMsg = {};
			//oMsg.str = oEle.label + " do not match " + this.cRule[oEle.match_id]["label"];
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
		}

	},
	validEmail : function(oEle) {

		//var numExp =
		// /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		// // not allow + sign
		//allow + sign between email
		var numExp = /^([\w-\.+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if (!oEle.val.match(numExp)) {

			var oMsg = {};
			oMsg.str = oEle.label + " must have valid email address";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	//Added by ndalwadi-itaction on Apr 7,2014 Start
	validPassword : function(oEle) {

		/*
		 * Password validation
		 * at least one number, one lowercase and one uppercase letter
		 * at least six characters that are letters, numbers or the underscore
		 */
		var numExp = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
		if (!oEle.val.match(numExp)) {
			var oMsg = {};
			//oMsg.str = oEle.label + " must have valid password";
			oMsg.str = oEle.label;
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}
	},
	//End
	validBirthdate : function(oEle) {

		// get all field of date
		var birth_date_dd = $("#birth_date_dd").val();
		var birth_date_mm = $("#birth_date_mm").val();
		var birth_date_year = $("#" + oEle.id).val();

		/**
		 * To check valid date from selection of drop down
		 */
		if (!checkValidDate(birth_date_year, birth_date_mm, birth_date_dd)) {
			var oMsg = {};
			//oMsg.str = "Birth date should be valid";
			oMsg.str = "Please select your date of birth";
			oMsg.id = oEle.id;
			$("#err_" + oEle.id).html(this.get_err(oMsg));
			return true;
		}

		/**
		 * check valid date
		 * return: boolean
		 */
		function checkValidDate(yr, mmx, dd) {
			mm = mmx - 1;
			// remember that in Javascript date objects the months are 0-11
			var nd = new Date();
			nd.setFullYear(yr, mm, dd);
			// format YYYY,MM(0-11),DD

			var ndmm = nd.getMonth();
			if (ndmm != mm) {
				return false;
			} else {
				//alert (dd + "/" + mmx + "/" + yr  + " is a Valid Date");
			}

			// date is valid - is it after today?
			var now = new Date().getTime();
			var selectedDate = nd.getTime();
			if (selectedDate > now) {// not before today's date
				//alert ("Invalid date - must not be after today");
				return false;
			} else {
				//alert ("Date is valid - before today's date");
				return true;
			}

			var dayobj = new Date(yr, mmx - 1, dd);
			if ((dayobj.getMonth() + 1 != mmx) || (dayobj.getDate() != dd) || (dayobj.getFullYear() != yr)) {
				//alert("Invalid Day, Month, or Year range detected. Please correct and submit
				// again.")
				return false;
			} else {
				returnval = true;
			}
		}

	},
	//Server side validation.
	sValidate : function(eve) {

		//Post Data.
		pData = {
			field : eve.target.id,
			label : this.sRule[eve.target.id]['label'],
			rule : this.sRule[eve.target.id]['rule'],
		};
		pData[eve.target.id] = $.trim($("#" + eve.target.id).val());
				
		var jqxhr = $.ajax({
			url : "/application/ajax/validate",
			type : "post",
			data : pData,
			dataType : 'json',
		}).done(function(respo) {
			
			//error found.
			if (respo.error) {
				var oMsg = {};
				oMsg.str = respo.error;
				$("#err_" + pData.field).html(validation.get_err(oMsg));
			} else if (respo.right) {
				$("#err_" + pData.field).html("");
			}
		}).fail(function(respo) {
			console.log(respo);
		});

	},

};
