<script type="text/javascript" src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/file-saver"></script>
<script type="text/javascript" src="functions_customer.js"></script>

<?php
$host = "aws.connect.psdb.cloud";
$username = "8j9k5cbylwf5jihjypvb";
$password = "pscale_pw_5tB0oqoYuujZ3meYcciAIxtD8tFBQGIfrKIa2q4EE0K";
$database = "proiectbd";
$tableName = "customer";

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
  <title>Customers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />

  <style data-tag="reset-style-sheet">
    php {
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

    php {
      scroll-behavior: smooth
    }
  </style>
  <style data-tag="default-style-sheet">
    php {
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
    <link href="./customers.css" rel="stylesheet" />

    <div class="customers-container">
      <div class="customers-body">
        <div class="customers-menu">
          <img alt="divlogosvg3217" src="public/external/divlogosvg3217-1d3.svg" class="customers-divlogosvg" />
          <a href="index.html" class="customers-divbuttonlogout button">
            <span class="customers-text"><span>LOGOUT</span></span>
          </a>
          <div class="customers-div">
            <a href="items.php" class="customers-navlink">
              <div class="menuitem">
                <img alt="diviconsvg3218" src="public/external/diviconsvg3218-4o1w.svg" class="customers-diviconsvg" />
                <span class="customers-text02"><span>Items</span></span>
              </div>
            </a>
            <a href="transactions.php" class="customers-navlink1">
              <div class="customers-transactions menuitem">
                <img alt="diviconsvg3218" src="public/external/diviconsvg3218-sw6.svg" class="customers-diviconsvg01" />
                <span class="customers-text04">
                  <span>Transactions</span>
                </span>
              </div>
            </a>
            <a href="customers.php" class="customers-navlink2">
              <div class="customers-customers menuitem">
                <img alt="diviconsvg3219" src="public/external/diviconsvg3219-03uo.svg"
                  class="customers-diviconsvg02" />
                <span class="customers-text06"><span>Customers</span></span>
              </div>
            </a>
          </div>
        </div>
        <div class="customers-section">
          <div class="customers-header">
            <div class="customers-divtitle">
              <span class="customers-text08"><span>Dashboard</span></span>
              <img alt="divicon3219" src="public/external/divicon3219-ubzq.svg" class="customers-divicon" />
              <span class="customers-text10"><span>Customers</span></span>
            </div>

            <!--
            <div class="customers-divsearch">
              <input type="search" name="search" id="search" class="searchdiv" placeholder="Search...">
              <img alt="Iconsvg3220" src="public/external/iconsvg3220-bg6.svg" class="customers-iconsvg" />
            </div>
            -->

            <div class="items-divsearch">
              <input onkeyup="searchTable()" type="search" name="search-input" id="search-input" class="searchdiv"
                placeholder="Search...">
              <img alt="Iconsvg3220" src="public/external/iconsvg3220-bg6.svg" class="customers-iconsvg" />
            </div>

            <div class="customers-div1">
              <button onclick="importRows()" class="customers-divbuttonimport iconbutton">
                <img alt="diviconsvg3220" src="public/external/diviconsvg3220-br65.svg"
                  class="customers-diviconsvg03" />
              </button>
              <button onclick="exportRows()" class="customers-divbuttonexport iconbutton">
                <img alt="diviconsvg3220" src="public/external/diviconsvg3220-updr.svg"
                  class="customers-diviconsvg04" />
              </button>
              <button onclick="reloadTable()" class="customers-divbuttonreload iconbutton">
                <img alt="diviconsvg3221" src="public/external/diviconsvg3221-gtp.svg" class="customers-diviconsvg05" />
              </button>
            </div>
            <button onclick="updateDB()" class="customers-divbuttonupdate iconbutton">
              <img alt="diviconsvg3221" src="public/external/diviconsvg3221-72dc.svg" class="customers-diviconsvg06" />
            </button>
          </div>
          <div class="customers-content">
            <div class="customers-settings">
              <div class="customers-editor">
                <div class="customers-divhead">
                  <span class="customers-text14"><span>Editor</span></span>
                </div>
                <div class="customers-divcontent">
                  <div class="customers-divinputs">
                    <input id="id_c" name="id_c" type="text" placeholder="ID" class="customers-divinput" />
                    <input id="name" name="name" type="text" placeholder="Name" class="customers-divinput1" />
                    <input id="email" name="email" type="text" placeholder="Email" class="customers-divinput2" />
                  </div>
                  <button class="customers-divbuttons"></button>
                  <button onclick="clearLabels()" class="customers-divbuttonclear button">
                    <img alt="diviconsvg3247" src="public/external/diviconsvg3247-ltkj.svg"
                      class="customers-diviconsvg07" />
                    <span class="customers-text16"><span>Clear</span></span>
                  </button>
                  <button onclick="addRow()" class="customers-divbuttonadd button">
                    <img alt="diviconsvg3247" src="public/external/diviconsvg3247-taeq.svg"
                      class="customers-diviconsvg08" />
                    <span class="customers-text18"><span>Add Row</span></span>
                  </button>
                  <button onclick="deleteRow()" class="customers-divbuttonremove button">
                    <img alt="diviconsvg3248" src="public/external/diviconsvg3248-zk5s.svg"
                      class="customers-diviconsvg09" />
                    <span class="customers-text20">
                      <span>Remove Row</span>
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="customers-content1">

              <table id="table" class="customers-table">

                <thead class="customers-thead">
                  <tr class="customers-tr">
                    <th class="customers-th">
                      <span class="customers-text22"><span>ID</span></span>
                    </th>
                    <th class="customers-th1">
                      <span class="customers-text24"><span>Name</span></span>
                    </th>
                    <th class="customers-th2">
                      <span class="customers-text26"><span>Email</span></span>
                    </th>
                  </tr>
                </thead>

                <tbody class="customers-tbody">

                  <?php
                  if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo '<tr onclick=selectRow(this) class="customers-tr1">';

                      echo '<td class="customers-td">';
                      echo '<span class="customers-text28">' . $row['id_c'] . '</span>';
                      echo '</td>';

                      echo '<td class="customers-td1">';
                      echo '<span class="customers-text30">' . $row['name'] . '</span>';
                      echo '</td>';

                      echo '<td class="customers-td2">';
                      echo '<span class="customers-text32">' . $row['email'] . '</span>';
                      echo '</td>';

                      echo '</tr>';
                    }
                  }

                  ?>

                  <!--BACKUP
                  <tr class="customers-tr1">
                    <td class="customers-td">
                      <span class="customers-text28">
                        Number
                      </span>
                    </td>
                    <td class="customers-td1">
                      <span class="customers-text30">
                        Row Text
                      </span>
                    </td>
                    <td class="customers-td2">
                      <span class="customers-text32">
                        Row Text
                      </span>
                    </td>
                  </tr>
                  -->

                </tbody>

              </table>
              <div class="customers-log">
                <div class="customers-head">
                  <span class="customers-text40"><span>Log</span></span>
                </div>

                <div id="log" class="customers-div2">

                  <!--
                  <div class="customers-divrow">
                    <div class="customers-divrow11">
                      <span class="customers-text42"><span>Text</span></span>
                    </div>
                  </div>
                  -->

                </div>


              </div>
            </div>
          </div>
          <div class="customers-footer">
            <span class="customers-text46">
              <span>2023 UGAL University Project. All right reserved to</span>
            </span>
            <span class="customers-text48"><span>@const_in.</span></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>