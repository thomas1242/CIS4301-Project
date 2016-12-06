/*
	javascript file for manager search ui, adds intuitive functionality
	and limited selections (less user error prone)

	TO ADD: integrity checking on all fields before submit
	TO ADD: delete buttons on conditions
*/

var states = [
    { name: 'ALABAMA', abbreviation: 'AL'},
    { name: 'ALASKA', abbreviation: 'AK'},
    { name: 'ARIZONA', abbreviation: 'AZ'},
    { name: 'ARKANSAS', abbreviation: 'AR'},
    { name: 'CALIFORNIA', abbreviation: 'CA'},
    { name: 'COLORADO', abbreviation: 'CO'},
    { name: 'CONNECTICUT', abbreviation: 'CT'},
    { name: 'DELAWARE', abbreviation: 'DE'},
    { name: 'FLORIDA', abbreviation: 'FL'},
    { name: 'GEORGIA', abbreviation: 'GA'},
    { name: 'HAWAII', abbreviation: 'HI'},
    { name: 'IDAHO', abbreviation: 'ID'},
    { name: 'ILLINOIS', abbreviation: 'IL'},
    { name: 'INDIANA', abbreviation: 'IN'},
    { name: 'IOWA', abbreviation: 'IA'},
    { name: 'KANSAS', abbreviation: 'KS'},
    { name: 'KENTUCKY', abbreviation: 'KY'},
    { name: 'LOUISIANA', abbreviation: 'LA'},
    { name: 'MAINE', abbreviation: 'ME'},
    { name: 'MARYLAND', abbreviation: 'MD'},
    { name: 'MASSACHUSETTS', abbreviation: 'MA'},
    { name: 'MICHIGAN', abbreviation: 'MI'},
    { name: 'MINNESOTA', abbreviation: 'MN'},
    { name: 'MISSISSIPPI', abbreviation: 'MS'},
    { name: 'MISSOURI', abbreviation: 'MO'},
    { name: 'MONTANA', abbreviation: 'MT'},
    { name: 'NEBRASKA', abbreviation: 'NE'},
    { name: 'NEVADA', abbreviation: 'NV'},
    { name: 'NEW HAMPSHIRE', abbreviation: 'NH'},
    { name: 'NEW JERSEY', abbreviation: 'NJ'},
    { name: 'NEW MEXICO', abbreviation: 'NM'},
    { name: 'NEW YORK', abbreviation: 'NY'},
    { name: 'NORTH CAROLINA', abbreviation: 'NC'},
    { name: 'NORTH DAKOTA', abbreviation: 'ND'},
    { name: 'OHIO', abbreviation: 'OH'},
    { name: 'OKLAHOMA', abbreviation: 'OK'},
    { name: 'OREGON', abbreviation: 'OR'},
    { name: 'PENNSYLVANIA', abbreviation: 'PA'},
    { name: 'PUERTO RICO', abbreviation: 'PR'},
    { name: 'RHODE ISLAND', abbreviation: 'RI'},
    { name: 'SOUTH CAROLINA', abbreviation: 'SC'},
    { name: 'SOUTH DAKOTA', abbreviation: 'SD'},
    { name: 'TENNESSEE', abbreviation: 'TN'},
    { name: 'TEXAS', abbreviation: 'TX'},
    { name: 'UTAH', abbreviation: 'UT'},
    { name: 'VERMONT', abbreviation: 'VT'},
    { name: 'VIRGIN ISLANDS', abbreviation: 'VI'},
    { name: 'VIRGINIA', abbreviation: 'VA'},
    { name: 'WASHINGTON', abbreviation: 'WA'},
    { name: 'WEST VIRGINIA', abbreviation: 'WV'},
    { name: 'WISCONSIN', abbreviation: 'WI'},
    { name: 'WYOMING', abbreviation: 'WY' }
];

var months = [
	{ name: 'JANUARY'},
	{ name: 'FEBRUARY'},
	{ name: 'MARCH'},
	{ name: 'SEPTEMBER'},
	{ name: 'OCTOBER'},
	{ name: 'NOVEMBER'},
	{ name: 'DECEMBER'},
]

var condCount = 0;
function increment() {
	condCount += 1;
	document.getElementById("condition_number").value = "" + condCount;
}

function preparePage() {
	if (document.getElementById("searchTable").options[0].value === "")
			document.getElementById("searchTable").options[0] = null;

	// change the attributes depending on selection of searchtable
	/* document.getElementById("searchTable").onchange = function() {
		var choice = document.getElementById("searchTable").value;
		document.getElementById("searchOperand").disabled = true;
		document.getElementById("searchAttribute").disabled = false;
		removeFormElement("searchField","searchValue");

		if (document.getElementById("searchTable").options[0].value === "")
			document.getElementById("searchTable").options[0] = null;

		if (choice === "customers")
		{
			removeSelectElements("searchAttribute");
			var def = document.createElement("option");
			def.setAttribute("value","");
			def.innerHTML = "attribute";
			var a = document.createElement("option");
			a.setAttribute("value","email");
			a.innerHTML = "email";
			var b = document.createElement("option");
			b.setAttribute("value","first_name");
			b.innerHTML = "first name";
			var c = document.createElement("option");
			c.setAttribute("value","last_name");
			c.innerHTML = "last name";
			document.getElementById("searchAttribute").appendChild(def);
			document.getElementById("searchAttribute").appendChild(a);
			document.getElementById("searchAttribute").appendChild(b);
			document.getElementById("searchAttribute").appendChild(c);
		}

		else if (choice === "flights")
		{
			removeSelectElements("searchAttribute");
			var def = document.createElement("option");
			def.setAttribute("value","");
			def.innerHTML = "attribute";			
			var a = document.createElement("option");
			a.setAttribute("value","flight_id_flights");
			a.innerHTML = "flight id";
			var b = document.createElement("option");
			b.setAttribute("value","arrival_code");
			b.innerHTML = "arrival airport";
			var c = document.createElement("option");
			c.setAttribute("value","departure_code");
			c.innerHTML = "departure airport";
			var d = document.createElement("option");
			d.setAttribute("value","distance");
			d.innerHTML = "distance";
			var e = document.createElement("option");
			e.setAttribute("value","arrival_city");
			e.innerHTML = "arrival city";
			var f = document.createElement("option");
			f.setAttribute("value","departure_city");
			f.innerHTML = "departure city";
			var g = document.createElement("option");
			g.setAttribute("value","departure_state");
			g.innerHTML = "departure state";
			var h = document.createElement("option");
			h.setAttribute("value","arrival_state");
			h.innerHTML = "arrival state";
			document.getElementById("searchAttribute").appendChild(def);
			document.getElementById("searchAttribute").appendChild(a);
			document.getElementById("searchAttribute").appendChild(b);
			document.getElementById("searchAttribute").appendChild(c);
			document.getElementById("searchAttribute").appendChild(d);
			document.getElementById("searchAttribute").appendChild(e);
			document.getElementById("searchAttribute").appendChild(f);
			document.getElementById("searchAttribute").appendChild(g);
			document.getElementById("searchAttribute").appendChild(h);
		}

		else if (choice === "orders")
		{
			removeSelectElements("searchAttribute");
			var def = document.createElement("option");
			def.setAttribute("value","");
			def.innerHTML = "attribute";			
			var a = document.createElement("option");
			a.setAttribute("value","customer_id");
			a.innerHTML = "customer id";
			var b = document.createElement("option");
			b.setAttribute("value","flight_id_orders");
			b.innerHTML = "flight id";
			document.getElementById("searchAttribute").appendChild(def);
			document.getElementById("searchAttribute").appendChild(a);
			document.getElementById("searchAttribute").appendChild(b);
		}
	};

	// change attributes based on the selection of search attribute
	document.getElementById("searchAttribute").onchange = function () {
		var choice = document.getElementById("searchAttribute").value;
		document.getElementById("searchOperand").disabled = false;
		removeFormElement("searchField","searchValue");

		if (document.getElementById("searchAttribute").options[0].value === "")
			document.getElementById("searchAttribute").options[0] = null;

		if (choice === "email" || choice === "first_name" || choice === "last_name" ||
			choice === "arrival_city" || choice === "departure_city" ||
			choice === "arrival_code" || choice === "departure_code")
		{
			removeSelectElements("searchOperand");
			var a = document.createElement("option");
			a.setAttribute("value","is");
			a.innerHTML = "is ";
			document.getElementById("searchOperand").appendChild(a);

			var b = document.createElement("input");
			b.setAttribute("type","text");
			b.setAttribute("name","searchValue");
			b.setAttribute("id","searchValue");

			// limit to 3 characters if airport code
			if (choice === "arrival_code" || choice === "departure_code")
			{
				b.setAttribute("maxlength","3");
			}

			document.getElementById("searchField").appendChild(b);
		}

		else if (choice === "flight_id_orders" || choice === "flight_id_flights" ||
				 choice === "customer_id" || choice === "distance")
		{
			removeSelectElements("searchOperand");
			var a = document.createElement("option");
			a.setAttribute("value","less_than");
			a.innerHTML = "<";
			var b = document.createElement("option");
			b.setAttribute("value","equals");
			b.innerHTML = "=";
			var c = document.createElement("option");
			c.setAttribute("value","greater_than");
			c.innerHTML = ">";
			document.getElementById("searchOperand").appendChild(a);
			document.getElementById("searchOperand").appendChild(b);
			document.getElementById("searchOperand").appendChild(c);

			var d = document.createElement("input");
			d.setAttribute("type","number");
			d.setAttribute("name","searchValue");
			d.setAttribute("id","searchValue");
			document.getElementById("searchField").appendChild(d);
		}

		else if (choice === "departure_state" || choice === "arrival_state")
		{
			removeSelectElements("searchOperand");
			var a = document.createElement("option");
			a.setAttribute("value","is");
			a.innerHTML = "is ";
			document.getElementById("searchOperand").appendChild(a);

			var b = document.createElement("select");
			b.setAttribute("id","searchValue");
			b.setAttribute("name","searchValue");
			for (var i = 0; i < states.length; i++)
			{
				var option = document.createElement("option");
				option.text = states[i].name;
				option.value = states[i].abbreviation;
				b.appendChild(option);
			}
			document.getElementById("searchField").appendChild(b);
		}
	}; */
}

// adds a condition clause
function addCondition() {

	// create a span clause to house each condition (comprised of table, attribute...)
	var condSpan = document.createElement("span");

	// create the individual elements that are put into each span (not value yet)
	var condLabel = document.createElement("label");
	var condTable = document.createElement("select");
	var condAttribute = document.createElement("select");
	var condOperand = document.createElement("select");

	// increment the counter for dynamic ids and 
	increment();

	// set all individual select condition fields to proper ids and names
	condLabel.setAttribute("for","conditionTable_" + condCount);
	condLabel.innerHTML = "Condition " + condCount + ":  ";
	condLabel.setAttribute("style", "margin-left: 14px");

	condTable.setAttribute("name","conditionTable_" + condCount);
	condTable.setAttribute("id","conditionTable_" + condCount);
	condTable.setAttribute("class", "btn btn-primary btn-sm dropdown-toggle");
	condTable.setAttribute("style", "margin-left: 10px");

	condAttribute.setAttribute("name","conditionAttribute_" + condCount);
	condAttribute.setAttribute("id","conditionAttribute_" + condCount);
	condAttribute.setAttribute("class", "btn btn-primary btn-sm dropdown-toggle");
	condAttribute.setAttribute("style", "margin-left: 10px");
	condAttribute.disabled = true;

	condOperand.setAttribute("name","conditionOperand_" + condCount);
	condOperand.setAttribute("id","conditionOperand_" + condCount);
	condOperand.setAttribute("class", "btn btn-primary btn-sm dropdown-toggle");
	condOperand.setAttribute("style", "margin-left: 10px");
	condOperand.disabled = true;

	// add default options to all select condition fields
	var a = document.createElement("option");
	a.setAttribute("value","");
	a.innerHTML = "Table";
	var b = document.createElement("option");
	b.setAttribute("value","customers");
	b.innerHTML = "Customers";
	var c = document.createElement("option");
	c.setAttribute("value","flights");
	c.innerHTML = "Flights";
	var d = document.createElement("option");
	d.setAttribute("value","orders");
	d.innerHTML = "Orders";

	var e = document.createElement("option");
	e.setAttribute("value","");
	e.innerHTML = "attribute";

	var f = document.createElement("option");
	f.setAttribute("value","");
	f.innerHTML = "operand";

	// append all static options to respective fields
	condTable.appendChild(a);
	condTable.appendChild(b);
	condTable.appendChild(c);
	condTable.appendChild(d);

	condAttribute.appendChild(e);

	condOperand.appendChild(f);

	// set the attributes of the condition span and append condition fields
	condSpan.setAttribute("id","condition_" + condCount);
	condSpan.appendChild(condLabel);
	condSpan.appendChild(condTable);
	condSpan.appendChild(condAttribute);
	condSpan.appendChild(condOperand);

	// add the condition to the DOM under conditionField
	document.getElementById("conditionField").appendChild(condSpan);
	document.getElementById("conditionField").appendChild(document.createElement("br"));
	document.getElementById("conditionField").appendChild(document.createElement("br"));

	// hold a variable for this specific iteration of condCount
	var thisCond = condCount;

	// add eventlistener for value change in conditionTable
	document.getElementById("conditionTable_" + thisCond).onchange = function() {
		var choice = document.getElementById("conditionTable_" + thisCond).value;
		document.getElementById("conditionOperand_" + thisCond).disabled = true;
		document.getElementById("conditionAttribute_" + thisCond).disabled = false;
		removeFormElement("condition_" + thisCond,"conditionValue_" + thisCond);

		if (document.getElementById("conditionTable_" + thisCond).options[0].value === "")
			document.getElementById("conditionTable_" + thisCond).options[0] = null;

		if (choice === "customers")
		{
			removeSelectElements("conditionAttribute_" + thisCond);
			var def = document.createElement("option");
			def.setAttribute("value","");
			def.innerHTML = "attribute";
			var a = document.createElement("option");
			a.setAttribute("value","email");
			a.innerHTML = "email";
			var b = document.createElement("option");
			b.setAttribute("value","first_name");
			b.innerHTML = "first name";
			var c = document.createElement("option");
			c.setAttribute("value","last_name");
			c.innerHTML = "last name";
			var d = document.createElement("option");
			d.setAttribute("value","customer_id");
			d.innerHTML = "customer id";
			document.getElementById("conditionAttribute_" + thisCond).appendChild(def);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(a);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(b);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(c);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(d);
		}

		else if (choice === "flights")
		{
			removeSelectElements("conditionAttribute_" + thisCond);
			var def = document.createElement("option");
			def.setAttribute("value","");
			def.innerHTML = "attribute";
			var a = document.createElement("option");
			a.setAttribute("value","flight_id");
			a.innerHTML = "flight id";
			var b = document.createElement("option");
			b.setAttribute("value","arrival_airport");
			b.innerHTML = "arrival airport";
			var c = document.createElement("option");
			c.setAttribute("value","departure_airport");
			c.innerHTML = "departure airport";
			var d = document.createElement("option");
			d.setAttribute("value","distance");
			d.innerHTML = "distance";
			var e = document.createElement("option");
			e.setAttribute("value","arrival_city_state");
			e.innerHTML = "arrival city";
			var f = document.createElement("option");
			f.setAttribute("value","departure_city_state");
			f.innerHTML = "departure city";
			var g = document.createElement("option");
			g.setAttribute("value","departure_state");
			g.innerHTML = "departure state";
			var h = document.createElement("option");
			h.setAttribute("value","arrival_state");
			h.innerHTML = "arrival state";
			var i = document.createElement("option");
			i.setAttribute("value","departure_date");
			i.innerHTML = "departure date";
			document.getElementById("conditionAttribute_" + thisCond).appendChild(def);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(a);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(b);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(c);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(d);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(e);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(f);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(g);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(h);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(i);
		}

		else if (choice === "orders")
		{
			removeSelectElements("conditionAttribute_" + thisCond);
			var def = document.createElement("option");
			def.setAttribute("value","");
			def.innerHTML = "attribute";			
			var a = document.createElement("option");
			a.setAttribute("value","distance");
			a.innerHTML = "distance";
			var b = document.createElement("option");
			b.setAttribute("value","price");
			b.innerHTML = "spent";
			var c = document.createElement("option");
			c.setAttribute("value","flight_count");
			c.innerHTML = "flight count";
			document.getElementById("conditionAttribute_" + thisCond).appendChild(def);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(a);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(b);
			document.getElementById("conditionAttribute_" + thisCond).appendChild(c);
		}
	};

	// add eventlistener for value change in conditionAttribute and create condValue
	document.getElementById("conditionAttribute_" + thisCond).onchange = function () {
		var choice = document.getElementById("conditionAttribute_" + thisCond).value;
		document.getElementById("conditionOperand_" + thisCond).disabled = false;
		removeFormElement("condition_" + thisCond,"conditionValue_" + thisCond);

		if (document.getElementById("conditionAttribute_" + thisCond).options[0].value === "")
			document.getElementById("conditionAttribute_" + thisCond).options[0] = null;

		if (choice === "customer_email" || choice === "first_name" || choice === "last_name" ||
			choice === "arrival_city_state" || choice === "departure_city_state" ||
			choice === "arrival_airport" || choice === "departure_airport" ||
			choice === "departure_date")
		{

			removeSelectElements("conditionOperand_" + thisCond);

			if (choice === "departure_date")
			{
				var a = document.createElement("option");
				a.setAttribute("value","<");
				a.innerHTML = "<";
				var b = document.createElement("option");
				b.setAttribute("value","=");
				b.innerHTML = "=";
				var c = document.createElement("option");
				c.setAttribute("value",">");
				c.innerHTML = ">";
				document.getElementById("conditionOperand_" + thisCond).appendChild(a);
				document.getElementById("conditionOperand_" + thisCond).appendChild(b);
				document.getElementById("conditionOperand_" + thisCond).appendChild(c);
			}
			else
			{
				var a = document.createElement("option");
				a.setAttribute("value","=");
				a.innerHTML = "is";
				document.getElementById("conditionOperand_" + thisCond).appendChild(a);
			}
			var d = document.createElement("input");
			d.setAttribute("type","text");
			d.setAttribute("name","conditionValue_" + thisCond);
			d.setAttribute("id","conditionValue_" + thisCond);

			// limit to 3 characters if airport code
			if (choice === "arrival_airport" || choice === "departure_airport")
			{
				d.setAttribute("maxlength","3");
			}
			if (choice === "departure_date")
			{
				d.setAttribute("placeholder","DY-MON-YR");
				d.setAttribute("maxlength","9");
			}

			document.getElementById("condition_" + thisCond).appendChild(d);
		}

		else if (choice === "flight_id" || choice === "distance" ||
				 choice === "price" || choice === "spent" ||
				 choice === "flight_count" || choice === "customer_id")
		{
			if (!document.getElementById("conditionOperand_" + thisCond))
			{
				document.createElement("conditionOperand_" + thisCond);
			}

			removeSelectElements("conditionOperand_" + thisCond);
			var a = document.createElement("option");
			a.setAttribute("value","<");
			a.innerHTML = "<";
			var b = document.createElement("option");
			b.setAttribute("value","=");
			b.innerHTML = "=";
			var c = document.createElement("option");
			c.setAttribute("value",">");
			c.innerHTML = ">";
			document.getElementById("conditionOperand_" + thisCond).appendChild(a);
			document.getElementById("conditionOperand_" + thisCond).appendChild(b);
			document.getElementById("conditionOperand_" + thisCond).appendChild(c);

			var d = document.createElement("input");
			d.setAttribute("type","number");
			d.setAttribute("name","conditionValue_" + thisCond);
			d.setAttribute("id","conditionValue_" + thisCond);
			document.getElementById("condition_" + thisCond).appendChild(d);
		}

		else if (choice === "departure_state" || choice === "arrival_state")
		{
			if (!document.getElementById("conditionOperand_" + thisCond))
			{
				document.createElement("conditionOperand_" + thisCond);
			}

			removeSelectElements("conditionOperand_" + thisCond);
			var a = document.createElement("option");
			a.setAttribute("value","=");
			a.innerHTML = "is ";
			document.getElementById("conditionOperand_" + thisCond).appendChild(a);

			var b = document.createElement("select");
			b.setAttribute("id","conditionValue_" + thisCond);
			b.setAttribute("name","conditionValue_" + thisCond);
			for (var i = 0; i < states.length; i++)
			{
				var option = document.createElement("option");
				option.text = states[i].name;
				option.value = states[i].name;
				b.appendChild(option);
			}
			document.getElementById("condition_" + thisCond).appendChild(b);
		}
		/*
		else if (choice === "date")
		{
			removeFormElement("condition_" + thisCond,"conditionOperand_" + thisCond);

			var a = document.createElement("select");
			a.setAttribute("id","condition_month_" + thisCond);
			a.setAttribute("name","condition_month_" + thisCond);

			// update options for selection month
			for (var i = 0; i<months.length; i++)
			{
				var option = document.createElement("option");
				option.text = months[i].name;
				option.value = months[i].name;
				a.appendChild(option);
			}

			document.getElementById("condition_" + thisCond).appendChild(a);

			// event listener to change number of days according to selection of month
			document.getElementById("condition_month_" + thisCond).onchange = function() {

				var choice = document.getElementById("condition_month_" + thisCond).value;

				var b = document.createElement("select");
				b.setAttribute("id","condition_day_" + thisCond);
				b.setAttribute("name","condition_day_" + thisCond);

				if (choice === "JANUARY" || choice === "MARCH" || choice === "MAY" ||
					choice === "JULY" || choice === "AUGUST" || choice === "OCTOBER" ||
					choice === "DECEMBER")
				{
					for (var i=1; i<32; i++)
					{
						var dayOption = document.createElement("option");
						dayOption.text = i;
						dayOption.value = i;
						b.appendChild(dayOption);
					}
				}
				else if (choice === "APRIL" || choice === "JUNE" || choice === "SEPTEMBER" ||
					     choice === "NOVEMBER")
				{
					for (var i=1; i<31; i++)
					{
						var dayOption = document.createElement("option");
						dayOption.text = i;
						dayOption.value = i;
						b.appendChild(dayOption);
					}
				}
				else
				{
					for (var i = 1; i<29; i++)
					{
						var dayOption = document.createElement("option");
						dayOption.text = i;
						dayOption.value = i;
						b.appendChild(dayOption);
					}
				}

				document.getElementById("condition_" + thisCond).appendChild(b);
			}
		} */
	};
}

// remove any generic form element
function removeFormElement(parentDiv,childDiv)
{
	if (document.getElementById(childDiv))
	{
		var child = document.getElementById(childDiv);
		var parent = document.getElementById(parentDiv);
		parent.removeChild(child);
	}
}

// removes all attribute elements of a certain select field form
function removeSelectElements(outerDiv) {
	var outer = document.getElementById(outerDiv);
	while (outer.options[0])
	{
		outer.options[0] = null;
	}
}

// removes everything related to date fields in conditions
function removeDateStuff() {
	var mon = document.getElementById("condition_month_" + thisCond);
	var day = document.getElementById("condition_day_" + thisCond);

	var cond = document.getElementById("condition_" + thisCond);

	removeFormElement(cond,mon);
	removeFormElement(cond,day);
}

window.onload = function() {
	preparePage();
};
