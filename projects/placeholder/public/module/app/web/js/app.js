function filterTable(table, element) {

    var val = element.value.toString().toUpperCase().trim();
    rows = table.getElementsByTagName("tr");

    for (count = 0; count < rows.length; count++) {

        // console.log('id: ' + rows[count].id);
        if (rows[count].id.indexOf('search_row_') == 0) {
            continue;
        }

        var cells = rows[count].getElementsByTagName('td');
        if (cells && cells.length) {
            for (var cell  in cells) {
                var aCell = cells[cell];

                if (!val) {
                    rows[count].style.display = "";
                }


                if (aCell && aCell.innerHTML) {
                    if (aCell.innerHTML.toString().toUpperCase().indexOf(val) == 0) {
                        rows[count].style.display = "";
                        break;
                    } else {
                        rows[count].style.display = "none";
                    }
                }

            }
        }
    }

}

// simple ajax request
function ajaxCall(url,callback,method,data) {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //the callback function to be callled when AJAX request comes back
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            callback(xmlhttp);
        }else if(xmlhttp.readyState == 4 && xmlhttp.status != 200){
            console.log(xmlhttp);
        }
    }
    method = (method)?method: 'get';
    xmlhttp.open(method, url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    var dataString = '';
    if(data){
        for(aField in data){
            dataString +=aField + '='+ data[aField];
        }
    }
    xmlhttp.send(dataString);
}