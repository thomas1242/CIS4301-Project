var sortCount = 0;
function increment() {
	sortCount += 1;
	document.getElementById("sort_number").value = "" + sortCount;
}




function addFlightSort() {

	// create span clause to house each sorting condition
	var sortSpan = document.createElement("span");

	/// create the individual elements that are put into each span (not value yet)
	var sortLabel = document.createElement("label");
	var sortAttribute = document.createElement("select");
	var sortOrder = document.createElement("select");

	// increment the counter for dynamic ids
	increment();

	// set all individual select condition fields to proper ids and names
	sortLabel.setAttribute("for","sortAttribute_" + sortCount);
	sortLabel.innerHTML = "Sorting condition " + sortCount + ":  ";

	sortAttribute.setAttribute("name","sortAttribute_" + sortCount);
	sortAttribute.setAttribute("id","sortAttribute_" + sortCount);

	sortOrder.setAttribute("name","sortOrder_" + sortCount);
	sortOrder.setAttribute("id","sortOrder_" + sortCount);

	// add options to all select condition fields
	var a = document.createElement("option");
	a.setAttribute("value","distance");
	a.innerHTML = "distance";
	var b = document.createElement("option");
	b.setAttribute("value","price");
	b.innerHTML = "price";
	var c = document.createElement("option");
	c.setAttribute("value","flight_id");
	c.innerHTML = "flight id";
	var d = document.createElement("option");
	d.setAttribute("value","arrival_city_state");
	d.innerHTML = "arrival city";
	var e = document.createElement("option");
	e.setAttribute("value","arrival_airport");
	e.innerHTML = "arrival airport";
	var f = document.createElement("option");
	f.setAttribute("value","arrival_state");
	f.innerHTML = "arrival state";
	var g = document.createElement("option");
	g.setAttribute("value","seat_capacity");
	g.innerHTML = "seats left";
	var h = document.createElement("option");
	h.setAttribute("value","departure_city_state");
	h.innerHTML = "departure city";
	var i = document.createElement("option");
	i.setAttribute("value","departure_airport");
	i.innerHTML = "departure airport";
	var j = document.createElement("option");
	j.setAttribute("value","departure_state");
	j.innerHTML = "departure state";
	var k = document.createElement("option");
	k.setAttribute("value","departure_date");
	k.innerHTML = "date";

	// ordering
	var l =  document.createElement("option");
	l.setAttribute("value","asc");
	l.innerHTML = "ascending";
	var m = document.createElement("option");
	m.setAttribute("value","desc");
	m.innerHTML = "descending";

	sortAttribute.appendChild(a);
	sortAttribute.appendChild(b);
	sortAttribute.appendChild(g);
	sortAttribute.appendChild(k);
	sortAttribute.appendChild(c);
	sortAttribute.appendChild(d);
	sortAttribute.appendChild(e);
	sortAttribute.appendChild(f);
	sortAttribute.appendChild(h);
	sortAttribute.appendChild(i);
	sortAttribute.appendChild(j);

	sortOrder.appendChild(l);
	sortOrder.appendChild(m);

	// append to the span
	sortSpan.setAttribute("id","sort_" + sortCount);
	sortSpan.appendChild(sortLabel);
	sortSpan.appendChild(sortAttribute);
	sortSpan.appendChild(sortOrder);

	// add the sort condition to the DOM under sortField
	document.getElementById("sortField").appendChild(sortSpan);
	document.getElementById("sortField").appendChild(document.createElement("br"));
	document.getElementById("sortField").appendChild(document.createElement("br"));
}

function addCustSort() {

	// create span clause to house each sorting condition
	var sortSpan = document.createElement("span");

	/// create the individual elements that are put into each span (not value yet)
	var sortLabel = document.createElement("label");
	var sortAttribute = document.createElement("select");
	var sortOrder = document.createElement("select");

	// increment the counter for dynamic ids
	increment();

	// set all individual select condition fields to proper ids and names
	sortLabel.setAttribute("for","sortAttribute_" + sortCount);
	sortLabel.innerHTML = "Sorting condition " + sortCount + ":  ";

	sortAttribute.setAttribute("name","sortAttribute_" + sortCount);
	sortAttribute.setAttribute("id","sortAttribute_" + sortCount);

	sortOrder.setAttribute("name","sortOrder_" + sortCount);
	sortOrder.setAttribute("id","sortOrder_" + sortCount);

	// add options to all select condition fields
	var a = document.createElement("option");
	a.setAttribute("value","first_name");
	a.innerHTML = "first name";
	var b = document.createElement("option");
	b.setAttribute("value","last_name");
	b.innerHTML = "last name";
	var c = document.createElement("option");
	c.setAttribute("value","customer_id");
	c.innerHTML = "customer id";

	// ordering
	var l =  document.createElement("option");
	l.setAttribute("value","asc");
	l.innerHTML = "ascending";
	var m = document.createElement("option");
	m.setAttribute("value","desc");
	m.innerHTML = "descending";

	sortAttribute.appendChild(a);
	sortAttribute.appendChild(b);
	sortAttribute.appendChild(c);

	sortOrder.appendChild(l);
	sortOrder.appendChild(m);

	// append to the span
	sortSpan.setAttribute("id","sort_" + sortCount);
	sortSpan.appendChild(sortLabel);
	sortSpan.appendChild(sortAttribute);
	sortSpan.appendChild(sortOrder);

	// add the sort condition to the DOM under sortField
	document.getElementById("sortField").appendChild(sortSpan);
	document.getElementById("sortField").appendChild(document.createElement("br"));
	document.getElementById("sortField").appendChild(document.createElement("br"));

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

