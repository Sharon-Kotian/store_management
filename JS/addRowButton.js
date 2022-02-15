function addField(n)
{
    var tr = n.parentNode.parentNode.cloneNode(true);
    document.getElementById('tableContent').appendChild(tr);
}

function deleteField(n)
{
	var td = event.target.parentNode; 
    var tr = td.parentNode; // the row to be removed
    tr.parentNode.removeChild(tr);
}