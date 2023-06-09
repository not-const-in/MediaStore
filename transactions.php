<script type="text/javascript" src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/file-saver"></script>
<script type="text/javascript" src="functions_transaction.js"></script>


<?php
$host = "aws.connect.psdb.cloud";
$username = "8j9k5cbylwf5jihjypvb";
$password = "pscale_pw_5tB0oqoYuujZ3meYcciAIxtD8tFBQGIfrKIa2q4EE0K";
$database = "proiectbd";
$tableName = "transaction";

// Connection
$dsn = "mysql:host=$host;dbname=$database";
$options = array(
  PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/cacert.pem",
);

$pdo = new PDO($dsn, $username, $password, $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM $tableName";
$stmt = $pdo->query($sql);
?>




<!DOCTYPE html>
<html lang="english">

<head>
  <title>Transactions</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />

  <style data-tag="reset-style-sheet">
    html {
      line-height: 1.15;
    }

    body {
      margin: 0;
    }

    * {
      box-sizing: border-box;
      border-width: 0;
      border-style: solid;
    }

    p,
    li,
    ul,
    pre,
    div,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    figure,
    blockquote,
    figcaption {
      margin: 0;
      padding: 0;
    }

    button {
      background-color: transparent;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
      font-family: inherit;
      font-size: 100%;
      line-height: 1.15;
      margin: 0;
    }

    button,
    select {
      text-transform: none;
    }

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
      -webkit-appearance: button;
    }

    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
      border-style: none;
      padding: 0;
    }

    button:-moz-focus,
    [type="button"]:-moz-focus,
    [type="reset"]:-moz-focus,
    [type="submit"]:-moz-focus {
      outline: 1px dotted ButtonText;
    }

    a {
      color: inherit;
      text-decoration: inherit;
    }

    input {
      padding: 2px 4px;
    }

    img {
      display: block;
    }

    html {
      scroll-behavior: smooth
    }
  </style>
  <style data-tag="default-style-sheet">
    html {
      font-family: Inter;
      font-size: 16px;
    }

    body {
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      text-transform: none;
      letter-spacing: normal;
      line-height: 1.15;
      color: var(--dl-color-gray-black);
      background-color: var(--dl-color-gray-white);

    }
  </style>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    data-tag="font" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    data-tag="font" />
  <link rel="stylesheet" href="./style.css" />
</head>

<body>
  <div>
    <link href="./transactions.css" rel="stylesheet" />

    <div class="transactions-container">
      <div class="transactions-body">
        <div class="transactions-menu">
          <img alt="divlogosvg3217" src="public/external/divlogosvg3217-1d3.svg" class="transactions-divlogosvg" />
          <a href="index.html" class="transactions-divbuttonlogout button">
            <span class="transactions-text"><span>LOGOUT</span></span>
          </a>
          <div class="transactions-divmenu">
            <a href="items.php" class="transactions-navlink">
              <div class="transactions-divtabitems menuitem">
                <img alt="diviconsvg3218" src="public/external/diviconsvg3218-4o1w.svg"
                  class="transactions-diviconsvg" />
                <span class="transactions-text02"><span>Items</span></span>
              </div>
            </a>
            <a href="transactions.php" class="transactions-navlink1">
              <div class="transactions-divtabtransactions menuitem">
                <img alt="diviconsvg3218" src="public/external/diviconsvg3218-sw6.svg"
                  class="transactions-diviconsvg01" />
                <span class="transactions-text04">
                  <span>Transactions</span>
                </span>
              </div>
            </a>
            <a href="customers.php" class="transactions-navlink2">
              <div class="transactions-divtabcustomers menuitem">
                <img alt="diviconsvg3219" src="public/external/diviconsvg3219-03uo.svg"
                  class="transactions-diviconsvg02" />
                <span class="transactions-text06">
                  <span>Customers</span>
                </span>
              </div>
            </a>
          </div>
        </div>
        <div class="transactions-section">
          <div class="transactions-header">
            <div class="transactions-divtitle">
              <span class="transactions-text08"><span>Dashboard</span></span>
              <img alt="divicon3203" src="public/external/divicon3203-ooc4.svg" class="transactions-divicon" />
              <span class="transactions-text10">
                <span>Transactions</span>
              </span>
            </div>

            <!--
            <div class="transactions-divsearch">
              <input type="search" name="search" id="search" class="searchdiv" placeholder="Search...">
              <img alt="Iconsvg3220" src="public/external/iconsvg3220-bg6.svg" class="customers-iconsvg" />
            </div>
            -->

            <div class="items-divsearch">
              <input onkeyup="searchTable()" type="search" name="search-input" id="search-input" class="searchdiv"
                placeholder="Search...">
              <img alt="Iconsvg3220" src="public/external/iconsvg3220-bg6.svg" class="customers-iconsvg" />
            </div>

            <div class="transactions-div">
              <button onclick="importRows()" class="transactions-divbuttonimport iconbutton">
                <img alt="diviconsvg3204" src="public/external/diviconsvg3204-iaim.svg"
                  class="transactions-diviconsvg03" />
              </button>
              <button onclick="exportRows()" class="transactions-divbuttonexport iconbutton">
                <img alt="diviconsvg3205" src="public/external/diviconsvg3205-1od.svg"
                  class="transactions-diviconsvg04" />
              </button>
              <button onclick="reloadTable()" class="transactions-divbuttonreload iconbutton">
                <img alt="diviconsvg3205" src="public/external/diviconsvg3205-u6ng.svg"
                  class="transactions-diviconsvg05" />
              </button>
            </div>
            <button onclick="updateDB()" class="transactions-divbuttonupdate iconbutton">
              <img alt="diviconsvg3205" src="public/external/diviconsvg3205-7gb.svg"
                class="transactions-diviconsvg06" />
            </button>
          </div>
          <div class="transactions-content">
            <div class="transactions-settings">
              <div class="transactions-editor">
                <div class="transactions-divhead">
                  <span class="transactions-text14"><span>Editor</span></span>
                </div>
                <div class="transactions-divcontent">
                  <div class="transactions-divinputs">
                    <input id="id_t" name="id_t" type="text" placeholder="Transaction ID"
                      class="transactions-divinput" />
                    <input id="id_c" name="id_c" type="text" placeholder="Customer ID" class="transactions-divinput1" />
                    <input id="id_i" name="id_i" type="text" placeholder="Item ID" class="transactions-divinput2" />
                    <input id="rental_date" name="rental_date" type="text" placeholder="Rental Date"
                      class="transactions-divinput3" />
                    <input id="return_date" name="return_date" type="text" placeholder="Return Date"
                      class="transactions-divinput4" />
                  </div>
                  <button class="transactions-divbuttons"></button>
                  <button onclick="clearLabels()" class="transactions-divbuttonclear button">
                    <img alt="diviconsvg3236" src="public/external/diviconsvg3236-yvw.svg"
                      class="transactions-diviconsvg07" />
                    <span class="transactions-text16">
                      <span>Clear</span>
                    </span>
                  </button>
                  <button onclick="addRow()" class="transactions-divbuttonadd button">
                    <img alt="diviconsvg3237" src="public/external/diviconsvg3237-g5w.svg"
                      class="transactions-diviconsvg08" />
                    <span class="transactions-text18">
                      <span>Add Row</span>
                    </span>
                  </button>
                  <button onclick="deleteRow()" class="transactions-divbuttonremove button">
                    <img alt="diviconsvg3237" src="public/external/diviconsvg3237-pnr.svg"
                      class="transactions-diviconsvg09" />
                    <span class="transactions-text20">
                      <span>Remove Row</span>
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="transactions-section1">

              <table id="table" class="transactions-table">
                <thead class="transactions-thead">

                  <tr class="transactions-tr">
                    <th class="transactions-td">
                      <span class="transactions-text22">
                        <span>Transaction ID</span>
                      </span>
                    </th>
                    <th class="transactions-td01">
                      <span class="transactions-text24">
                        <span>Customer ID</span>
                      </span>
                    </th>
                    <th class="transactions-td02">
                      <span class="transactions-text26">
                        <span>Item ID</span>
                      </span>
                    </th>
                    <th class="transactions-td03">
                      <span class="transactions-text28">
                        <span>Rental Date</span>
                      </span>
                    </th>
                    <th class="transactions-td04">
                      <span class="transactions-text30">
                        <span>Return Date</span>
                      </span>
                    </th>
                  </tr>

                </thead>
                <tbody class="transactions-tbody">
                  <?php
                  if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo '<tr onclick=selectRow(this) class="transactions-tr1">';
                      echo '<td class="transactions-td05">';
                      echo '<span class="transactions-text32">';
                      echo '<span>' . $row['id_t'] . '</span>';
                      echo '</span>';
                      echo '</td>';
                      echo '<td class="transactions-td06">';
                      echo '<span class="transactions-text34">';
                      echo '<span>' . $row['id_c'] . '</span>';
                      echo '</span>';
                      echo '</td>';
                      echo '<td class="transactions-td07">';
                      echo '<span class="transactions-text36">';
                      echo '<span>' . $row['id_i'] . '</span>';
                      echo '</span>';
                      echo '</td>';
                      echo '<td class="transactions-td08">';
                      echo '<span class="transactions-text38">';
                      echo '<span>' . $row['rental_date'] . '</span>';
                      echo '</span>';
                      echo '</td>';
                      echo '<td class="transactions-td09">';
                      echo '<span class="transactions-text40">';
                      echo '<span>' . $row['return_date'] . '</span>';
                      echo '</span>';
                      echo '</td>';
                      echo '</tr>';
                    }
                  }

                  ?>

                  <!--Backup
                    <tr class="transactions-tr1">
                      <td class="transactions-td05">
                        <span class="transactions-text32">
                          <span>Number</span>
                        </span>
                      </td>
                      <td class="transactions-td06">
                        <span class="transactions-text34">
                          <span>Number</span>
                        </span>
                      </td>
                      <td class="transactions-td07">
                        <span class="transactions-text36">
                          <span>Number</span>
                        </span>
                      </td>
                      <td class="transactions-td08">
                        <span class="transactions-text38">
                          <span>Row Text</span>
                        </span>
                      </td>
                      <td class="transactions-td09">
                        <span class="transactions-text40">
                          <span>Row Text</span>
                        </span>
                      </td>
                    </tr>
                    -->
                </tbody>
              </table>

              <div class="transactions-log">
                <div class="transactions-head">
                  <span class="transactions-text52"><span>Log</span></span>
                </div>

                <div id="log" class="transactions-div1">

                  <!--
                  <div class="transactions-divrow">
                    <div class="transactions-divrow11">
                      <span class="transactions-text56"><span>Text</span></span>
                    </div>
                  </div>
                  -->

                </div>

              </div>
            </div>
          </div>
          <div class="transactions-footer">
            <span class="transactions-text58">
              <span>2023 UGAL University Project. All right reserved to</span>
            </span>
            <span class="transactions-text60"><span>@const_in.</span></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>