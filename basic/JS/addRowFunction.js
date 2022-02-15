function addFieldWithoutAddition(n)
{
    var tr = n.parentNode.parentNode.cloneNode(true);
    document.getElementById('tableContent').appendChild(tr);
}

function addField(n) {
    var getTotalRows = document.getElementById('tableContent').rows.length;
    console.log(getTotalRows.toString());
    for (var i = getTotalRows; i < getTotalRows+1; i++) {
        var row = document.getElementById("row"); // find row to copy
        var table = document.getElementById("table"); // find table to append to
        var clone = row.cloneNode(true); // copy children too
        clone.id = "newRow" + (getTotalRows); // change id or other attributes/contents
        table.appendChild(clone); // add new row to end of table
        var children = document.getElementById('newRow' + (getTotalRows)).children;
        for (var j = 0; j < children.length; j++) {
            try{
                var tableChild = children[j].children;
                console.log(tableChild);
                tableChild[0].setAttribute('id', tableChild[0].getAttribute('id') + (getTotalRows));
            }
            catch(err){
                console.log(err.message);
            }
        }        
    }
}

function addField_BOM(n) {
    var getTotalRows = document.getElementById('tableContent').rows.length;
    console.log(getTotalRows.toString());
    for (var i = getTotalRows; i < getTotalRows+1; i++) {
        var row = document.getElementById("row"); // find row to copy
        var table = document.getElementById("table"); // find table to append to
        var clone = row.cloneNode(true); // copy children too
        clone.id = "newRow" + (getTotalRows); // change id or other attributes/contents
        table.appendChild(clone); // add new row to end of table
        var children = document.getElementById('newRow' + (getTotalRows)).children;
        for (var j = 0; j < children.length; j++) {
            try{
                var tableChild = children[j].children;
                console.log(tableChild);
                tableChild[0].setAttribute('id', tableChild[0].getAttribute('id') + (getTotalRows));
            }
            catch(err){
                console.log(err.message);
            }
        }
		document.getElementById('fpd_id_edit'+(getTotalRows)).setAttribute('value', 99999);
    }
}

function deleteField(n)
{
	var td = event.target.parentNode; 
    var tr = td.parentNode; // the row to be removed
    tr.parentNode.removeChild(tr);
}

