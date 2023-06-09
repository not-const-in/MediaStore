
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

function updateDB() {

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
  saveAs(new Blob([wbout], { type: 'application/octet-stream' }), 'customer.xlsx');
}

function searchTable() {
  var input = document.getElementById('search-input').value;
  var regex = new RegExp(input, 'i');
  var rows = document.getElementsByClassName('customers-tr1');

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
  var rows = document.getElementsByClassName('customers-tr1');
  for (var i = 0; i < rows.length; i++) {
    rows[i].classList.remove('selected');
  }

  // Select the clicked row
  row.classList.add('selected');

  // Get the data cells of the selected row
  var cells = row.getElementsByTagName('td');

  // Extract the values from the cells
  var id_c = cells[0].innerText;
  var nume = cells[1].innerText;
  var email = cells[2].innerText;

  // Set the values in the textboxes
  document.getElementById('id_c').value = id_c;
  document.getElementById('name').value = nume;
  document.getElementById('email').value = email;

  appendLogString("Row " + id_c + " selected.");

}

function clearLabels() {

  // Deselect all rows
  var rows = document.querySelector('.selected');

  if (rows) {
    rows.classList.remove('selected');
    // Set the values in the textboxes
    document.getElementById('id_c').value = "";
    document.getElementById('name').value = "";
    document.getElementById('email').value = "";

    appendLogString("Inputs Cleared!");
  }

  

}

function addRow() {

  var table = document.getElementById('table');

  var id = document.getElementById('id_c');
  var name = document.getElementById('name');
  var email = document.getElementById('email');


  var idValue = id.value;
  var nameValue = name.value;
  var emailValue = email.value;

  var row = '<tr onclick="selectRow(this)" class="customers-tr1"><td class="customers-td"><span class="customers-text28">'
    + idValue + '</span></td><td class="customers-td1"><span class="customers-text30">'
    + nameValue + '</span></td><td class="customers-td2"><span class="customers-text32">'
    + emailValue + '</span></td></tr>';

  table.getElementsByTagName('tbody')[0].insertAdjacentHTML('beforeend', row);

  appendLogString("Row Added!");

}

function deleteRow() {

  var selectedRow = document.querySelector('.customers-tr1.selected');

  if (selectedRow) {
    // Remove the selected row
    selectedRow.parentNode.removeChild(selectedRow);
  }

  appendLogString("Row Deleted!");

}


function appendLogString(stringToAdd) {
  var myDiv = document.getElementById("log");
  var htmlString = '<div class="customers-divrow"><div class="customers-divrow11"><span class="customers-text42"><span>' + stringToAdd + '</span></span></div></div>';
  myDiv.insertAdjacentHTML('afterbegin', htmlString);
}

