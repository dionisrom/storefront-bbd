function formValidator()
{
	// set up array to hold error messages
	this.errorList = new Array;

	// set up object methods
	this.isEmpty = isEmpty;	
	this.isNumber = isNumber;	
	this.isAlphabetic = isAlphabetic;	
	this.isAlphaNumeric = isAlphaNumeric;	
	this.isWithinRange = isWithinRange;	
	this.isEmailAddress = isEmailAddress;	
	this.isChecked = isChecked;	

	this.raiseError = raiseError;	
	this.numErrors = numErrors;	
	this.displayErrors = displayErrors;	
}

// check to see if input is whitespace only or empty
function isEmpty(val)
{
	if (val.match(/^s+$/) || val == "")
	{
		return true;
	}
	else
	{
		return false;
	}	
}

// check to see if input is number
function isNumber(val)
{
	if (isNaN(val))
	{
		return false;
	}
	else
	{
		return true;
	}	
}

// check to see if input is alphabetic
function isAlphabetic(val)
{
	if (val.match(/^[a-zA-Z]+$/))
	{
		return true;
	}
	else
	{
		return false;
	}	
}

// check to see if input is alphanumeric
function isAlphaNumeric(val)
{
	if (val.match(/^[a-zA-Z0-9]+$/))
	{
		return true;
	}
	else
	{
		return false;
	}	
}

// check to see if value is within range
function isWithinRange(val, min, max)
{
	if (val >= min && val <= max)
	{
		return true;
	}
	else
	{
		return false;
	}	
}

// check to see if input is a valid email address
function isEmailAddress(val)
{
	if (val.match(/^([a-zA-Z0-9])+([.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-]+)+/))
	{
		return true;
	}
	else
	{
		return false;
	}	
}

// check to see if form value is checked
function isChecked(obj)
{
	if (obj.checked)
	{
		return true;
	}
	else
	{
		return false;
	}	
}


// display all errors
// iterate through error array and print each item
function displayErrors()
{
	for (x=0; x<this.errorList.length; x++)
	{
		alert("Error: " + this.errorList[x]);
	}
}

// add an error to error list
function raiseError(msg)
{
	this.errorList[this.errorList.length] = msg;
}

// return number of errors in error array
function numErrors()
{
	return this.errorList.length;
}
