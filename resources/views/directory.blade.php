<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Regional Directory</title>

  <!-- Include Roboto Font from Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Roboto', sans-serif; /* Apply Roboto font */
      margin: 0;
      padding: 0;
      background-color: #f0f2f5;
    }


        body {
            display: flex;
            flex-direction: column;
            background: url('{{ asset('images/bg_3.png') }}') no-repeat center center fixed;
            background-size: cover;
        }

    .container {
      max-width: 100%; /* Make the container width 100% */
      margin: 10px auto;
      padding: 10px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .search-container {
      margin-bottom: 20px;
      text-align: center;
    }

    .search-input {
      padding: 10px;
      width: 60%;
      font-size: 16px;
      border-radius: 4px;
      border: 1px solid #ddd;
      box-sizing: border-box;
    }

    table {
      width: 100%; /* Shrink the table width */
      margin: 0 auto; /* Center the table */
      border-collapse: collapse;
      margin-top: 20px;
      table-layout: auto; /* Allow table to take full width */
      padding-left: 1in; /* Add 1 inch padding from the left */
      padding-right: 1in; /* Add 1 inch padding from the right */
      box-sizing: border-box;
    }

    table th, table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      word-wrap: break-word; /* Wrap long text in the table cells */
      white-space: normal; /* Allow text to wrap normally */
    }

    table th {
      background-color: #001F5B;
      color: white;
    }

    table td {
      background-color: #f9f9f9;
    }

    table tr:hover {
      background-color: #f1f1f1;
    }

    .add-button {
      display: block;
      width: 200px;
      margin: 20px auto;
      padding: 10px;
      text-align: center;
      background-color: #001F5B;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .add-button:hover {
      background-color: #45a049;
    }

    .edit-button {
      background-color: #ffa500;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 5px 10px;
      cursor: pointer;
      font-size: 14px;
    }

    .edit-button:hover {
      background-color: #ff8c00;
    }

    /* Fixed the table to align well when editing */
    table td[contenteditable="true"] {
      background-color: #e6f7ff;
      border: 1px solid #ddd;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
      .search-input {
        width: 80%; /* More space for the search bar on smaller screens */
      }

      table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }

      table th, table td {
        padding: 10px;
        font-size: 14px;
      }

      .container {
        padding: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>RDRRMC MIMAROPA Member Agencies Directory</h1>

    <!-- Search Box -->
    <div class="search-container">
      <input type="text" class="search-input" id="search-box" onkeyup="searchDirectory()" placeholder="Search for contacts...">
    </div>

    <table>
      <thead>
        <tr>
          <th>Office / Agency Name</th>
          <th>Address</th>
          <th>Official Email Address</th>
          <th>Hot Line Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="directory-list">
        <!-- Sample Entries, these will be dynamically generated from localStorage -->
      </tbody>
    </table>

    <button class="add-button" onclick="addNewEntry()">Add New Entry</button>
  </div>

  <script>
    // Check if data is already in localStorage and populate the table
    window.onload = function() {
      const directoryList = document.getElementById('directory-list');
      const data = JSON.parse(localStorage.getItem('directoryData')) || [];

      data.forEach(item => {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
          <td>${item.office}</td>
          <td>${item.address}</td>
          <td>${item.email}</td>
          <td>${item.phone}</td>
          <td><button class="edit-button" onclick="editEntry(this)">Edit</button></td>
        `;
        directoryList.appendChild(newRow);
      });
    }

    // Save new entry to localStorage
    function saveToLocalStorage() {
      const directoryList = document.getElementById('directory-list');
      const rows = directoryList.getElementsByTagName('tr');
      const data = [];

      for (let row of rows) {
        const cells = row.getElementsByTagName('td');
        const office = cells[0].textContent;
        const address = cells[1].textContent;
        const email = cells[2].textContent;
        const phone = cells[3].textContent;

        data.push({ office, address, email, phone });
      }

      localStorage.setItem('directoryData', JSON.stringify(data));
    }

    // Search function
    function searchDirectory() {
      const input = document.getElementById('search-box');
      const filter = input.value.toLowerCase();
      const table = document.getElementById('directory-list');
      const rows = table.getElementsByTagName('tr');

      // Loop through the rows and hide those that don't match the search
      for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0) {
          let match = false;
          for (let j = 0; j < cells.length - 1; j++) { // Exclude the Action column
            if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
              match = true;
              break;
            }
          }
          rows[i].style.display = match ? "" : "none";
        }
      }
    }

    // Edit functionality
    function editEntry(button) {
      const row = button.parentElement.parentElement;
      const cells = row.getElementsByTagName("td");

      // Make the table cells editable
      for (let i = 0; i < cells.length - 1; i++) {
        cells[i].setAttribute("contenteditable", true);
      }

      // Change the button to 'Save'
      button.textContent = "Save";
      button.setAttribute("onclick", "saveEntry(this)");
    }

    function saveEntry(button) {
      const row = button.parentElement.parentElement;
      const cells = row.getElementsByTagName("td");

      // Make the table cells non-editable
      for (let i = 0; i < cells.length - 1; i++) {
        cells[i].setAttribute("contenteditable", false);
      }

      // Change the button back to 'Edit'
      button.textContent = "Edit";
      button.setAttribute("onclick", "editEntry(this)");

      saveToLocalStorage(); // Save to localStorage after editing
    }

    // Add new entry
    function addNewEntry() {
      const directoryList = document.getElementById('directory-list');

      // Create a new row (tr) for the new entry
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
        <td contenteditable="true">New Office Name</td>
        <td contenteditable="true">New Address</td>
        <td contenteditable="true">newemail@example.com</td>
        <td contenteditable="true">(02) 000-0000</td>
        <td><button class="edit-button" onclick="editEntry(this)">Edit</button></td>
      `;

      // Append the new row to the table
      directoryList.appendChild(newRow);

      saveToLocalStorage(); // Save to localStorage after adding new entry
    }
  </script>

</body>
</html>
