
function changeColor(icon) {
  var svg = document.getElementById(icon).contentDocument;
  var path = svg.querySelector("path");
  var computedStyle = getComputedStyle(path);
  var grandparentDiv = document.getElementById(icon).parentElement.parentElement;

  if (computedStyle.fill === "rgb(21, 21, 21)") {
    path.style.transition = "fill 0.5s ease";
    path.style.fill = "#3BC773";
    grandparentDiv.style.transition = "border-color 0.5s ease";
    grandparentDiv.style.border = "1px solid #3BC773";

  } else if (computedStyle.fill === "rgb(59, 199, 115)") {
    path.style.transition = "fill 0.5s ease";
    path.style.fill = "#DC3535";
    grandparentDiv.style.transition = "border-color 0.5s ease";
    grandparentDiv.style.border = "1px solid #DC3535";

  } else {
    path.style.transition = "fill 0.5s ease";
    path.style.fill = "#151515";
    grandparentDiv.style.transition = "border-color 0.5s ease";
    grandparentDiv.style.border = "1px solid #151515";
  }

}



function refreshPage() {
  location.reload();
}

function deleteRows() {
  var table = document.getElementById("table");
  var rowCount = table.rows.length;

  // Start from the last row and delete each row in reverse order
  for (var i = rowCount - 1; i > 0; i--) {
    table.deleteRow(i);
  }

}

function loadTable() {


}

function reloadTable() {

  //deleteRows();
  //loadTable();
  refreshPage();

}


//function for saving all the table rows to a json file
function updateDB() {
  // Get the table element
  var table = document.getElementById('table');

  // Create an array to hold the table data
  var tableData = [];

  // Iterate over the table rows, starting from index 1 to skip the first row
  var rows = table.getElementsByTagName('tr');
  for (var i = 1; i < rows.length; i++) {
    var row = rows[i];
    var rowData = {};

    // Iterate over the row cells
    var cells = row.getElementsByTagName('td');
    for (var j = 0; j < cells.length; j++) {
      var cell = cells[j];
      var columnHeader = table.rows[0].cells[j].textContent;
      rowData[columnHeader] = cell.textContent;
    }

    // Add the row data to the table data array
    tableData.push(rowData);
  }

  // Convert the table data to JSON
  var jsonData = JSON.stringify(tableData);

  // Log the JSON data being sent to the server
  console.log('JSON data being sent to PHP:', jsonData);

  // Send the JSON data to the server using a fetch POST request
  fetch('fetch/items_fetch.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: jsonData
  })
    .then(response => {
      if (response.ok) {
        // Data saved successfully
        console.log('Table data saved to MySQL.');
      } else {
        // Error occurred while saving data
        console.error('Failed to save table data to MySQL.');
      }
    })
    .catch(error => {
      // Error occurred during the request
      console.error('An error occurred during the request:', error);
    });
}




// Format the date string in the desired format (yyyy-mm-dd)
function formatDate(dateString) {
  var date = new Date(dateString);
  var year = date.getFullYear();
  var month = ('0' + (date.getMonth() + 1)).slice(-2);
  var day = ('0' + date.getDate()).slice(-2);
  console.log(dateString);
  console.log(year + '-' + month + '-' + day);
  return year + '-' + month + '-' + day;

}


function add_th(tr, header, i, size) {
  //creare element th
  var th = document.createElement('th');
  th.classList.add("items-th-" + size);

  var span = document.createElement('span');
  span.classList.add("items-htext-" + size);

  span.textContent = header[i];

  th.appendChild(span);
  tr.appendChild(th);
}

function add_td(tr, rowData, i, size, isDateColumn = false) {
  var td = document.createElement('td');
  td.classList.add("items-td-" + size);

  var span = document.createElement('span');
  span.classList.add("items-text-" + size);

  if (isDateColumn) {
    dateData = formatDate(rowData[i]);
    span.textContent = dateData;
    
  }
  else {
    span.textContent = rowData[i];
  }

  td.appendChild(span);
  tr.appendChild(td);
}

function updateTable(data) {
  // Get the table element
  var table = document.getElementById('table');

  // Clear the table contents
  table.innerHTML = '';

  // Get the table header
  var header = data[0];


  // Create a new row for the table header
  var thead = document.createElement('thead');
  thead.classList.add("items-thead");

  var htr = document.createElement('tr');
  htr.classList.add("items-tr");

  add_th(htr, header, 0, "small");
  add_th(htr, header, 1, "big");
  add_th(htr, header, 2, "medium");
  add_th(htr, header, 3, "medium");
  add_th(htr, header, 4, "medium", true);
  add_th(htr, header, 5, "medium");
  add_th(htr, header, 6, "medium");

  // Add the header row to the table
  thead.appendChild(htr);
  table.appendChild(thead);

  var tbody = document.createElement('tbody');
  tbody.classList.add("items-tbody");

  // Create a new row for each data row
  for (var i = 1; i < data.length; i++) {
    // Get the current row
    var rowData = data[i];

    // Create a new row
    var btr = document.createElement('tr');
    btr.classList.add("items-tr1");
    btr.setAttribute("onclick", "selectRow(this)");

    // Add the cells to the row

    add_td(btr, rowData, 0, "small");
    add_td(btr, rowData, 1, "big");
    add_td(btr, rowData, 2, "medium");
    add_td(btr, rowData, 3, "medium");
    add_td(btr, rowData, 4, "medium");
    add_td(btr, rowData, 5, "medium");
    add_td(btr, rowData, 6, "medium");

    // Add the row to the table
    tbody.appendChild(btr);
  }
  table.appendChild(tbody);
}



//function for importing rows from an XLS file and replacing the data from the table
function importRows() {
  // Create a file input element
  var fileInput = document.createElement('input');
  fileInput.type = 'file';

  // Listen for the onchange event
  fileInput.addEventListener('change', function (e) {
    // Get the selected file
    var file = e.target.files[0];

    // Use the FileReader API to read the file
    var reader = new FileReader();
    reader.readAsBinaryString(file);

    reader.onload = function (e) {
      // Create a workbook object
      var workbook = XLSX.read(e.target.result, { type: 'binary' });

      // Get the first worksheet
      var worksheet = workbook.Sheets[workbook.SheetNames[0]];

      // Convert the worksheet to an array of objects
      var data = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

      // Update the table with the new data
      updateTable(data);
    };

    reader.onerror = function (e) {
      console.error('File reading error');
    };
  });

  // Dispatch a click event to open the file dialog
  fileInput.dispatchEvent(new MouseEvent('click'));
}
//function for exporting rows to an XLS file
function exportRows() {
  var table = document.getElementById('table');

  // Create an empty workbook
  var wb = XLSX.utils.book_new();

  // Convert the table to a worksheet
  var ws = XLSX.utils.table_to_sheet(table);

  // Add the worksheet to the workbook
  XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

  // Generate the XLS file
  var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'array' });

  // Save the XLS file using the file-saver library
  saveAs(new Blob([wbout], { type: 'application/octet-stream' }), 'items.xlsx');
}

function searchTable() {
  var input = document.getElementById('search-input').value;
  var regex = new RegExp(input, 'i');
  var rows = document.getElementsByClassName('items-tr1');

  for (var i = 0; i < rows.length; i++) {
    var rowData = rows[i].textContent.toLowerCase();
    if (rowData.match(regex)) {
      rows[i].style.display = '';
    } else {
      rows[i].style.display = 'none';
    }
  }
}







function selectRow(row) {
  // Deselect all rows
  var rows = document.getElementsByClassName('items-tr1');
  for (var i = 0; i < rows.length; i++) {
    rows[i].classList.remove('selected');
  }

  // Select the clicked row
  row.classList.add('selected');

  // Get the data cells of the selected row
  var cells = row.getElementsByTagName('td');

  // Extract the values from the cells
  var id_i = cells[0].innerText;
  var title = cells[1].innerText;
  var type = cells[2].innerText;
  var genre = cells[3].innerText;
  var release_date = cells[4].innerText;
  var price = cells[5].innerText;
  var rating = cells[6].innerText;

  // Set the values in the textboxes
  document.getElementById('id_i').value = id_i;
  document.getElementById('title').value = title;
  document.getElementById('type').value = type;
  document.getElementById('genre').value = genre;
  document.getElementById('release_date').value = release_date;
  document.getElementById('price').value = price;
  document.getElementById('rating').value = rating;

  appendLogString("Row " + id_i + " selected.");
}

function clearLabels() {

  // Deselect all rows
  var rows = document.querySelector('.selected');

  if (rows) {
    rows.classList.remove('selected');
    // Set the values in the textboxes
    document.getElementById('id_i').value = "";
    document.getElementById('title').value = "";
    document.getElementById('type').value = "";
    document.getElementById('genre').value = "";
    document.getElementById('release_date').value = "";
    document.getElementById('price').value = "";
    document.getElementById('rating').value = "";

    appendLogString("Inputs Cleared!");

  }

}

function addRow() {

  var table = document.getElementById('table');

  var id_i = document.getElementById('id_i');
  var title = document.getElementById('title');
  var type = document.getElementById('type');
  var genre = document.getElementById('genre');
  var release_date = document.getElementById('release_date');
  var price = document.getElementById('price');
  var rating = document.getElementById('rating');


  var id_iValue = id_i.value;
  var titleValue = title.value;
  var typeValue = type.value;
  var genreValue = genre.value;
  var release_dateValue = release_date.value;
  var priceValue = price.value;
  var ratingValue = rating.value;


  var row = '<tr onclick=selectRow(this) class="items-tr1"><td class="items-td-small"><span class="items-text-small"><span>'
    + id_iValue + '</span></span></td><td class="items-td-big"><span class="items-text-big"><span>'
    + titleValue + '</span></span></td><td class="items-td-medium"><span class="items-text-medium"><span>'
    + typeValue + '</span></span></td><td class="items-td-medium"><span class="items-text-medium"><span>'
    + genreValue + '</span></span></td><td class="items-td-medium"><span class="items-text-medium"><span>'
    + release_dateValue + '</span></span></td><td class="items-td-medium"><span class="items-text-medium"><span>'
    + priceValue + '</span></span></td><td class="items-td-medium"><span class="items-text-medium"><span>'
    + ratingValue + '</span></span></td></tr>';

  table.getElementsByTagName('tbody')[0].insertAdjacentHTML('beforeend', row);

  appendLogString("Row Added!");

}

function deleteRow() {

  var selectedRow = document.querySelector('.items-tr1.selected');

  if (selectedRow) {
    // Remove the selected row
    selectedRow.parentNode.removeChild(selectedRow);
  }

  appendLogString("Row Deleted!");

}



function appendLogString(stringToAdd) {
  var myDiv = document.getElementById("log");
  var htmlString = '<div class="items-divrow"><div class="items-divrow11"><span class="items-text74">' + stringToAdd + '</span></div></div>';
  myDiv.insertAdjacentHTML('afterbegin', htmlString);
}






