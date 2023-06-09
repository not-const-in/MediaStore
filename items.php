<script type="text/javascript" src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/file-saver"></script>
<script type="text/javascript" src="functions_item.js"></script>

<?php
$host = "aws.connect.psdb.cloud";
$username = "8j9k5cbylwf5jihjypvb";
$password = "pscale_pw_5tB0oqoYuujZ3meYcciAIxtD8tFBQGIfrKIa2q4EE0K";
$database = "proiectbd";
$tableName = "item";

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
  <title>Items</title>
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
    <link href="./items.css" rel="stylesheet" />

    <div class="items-container">
      <div class="items-body">
        <div class="items-menu">
          <img alt="divlogosvg3217" src="public/external/divlogosvg3217-1d3.svg" class="items-divlogosvg" />
          <a href="index.html" class="items-divbuttonlogout button">
            <span class="items-text"><span>LOGOUT</span></span>
          </a>
          <div class="items-divmenu">
            <a href="items.php" class="items-navlink">
              <div class="items-divtabitems menuitem">
                <img alt="diviconsvg3218" src="public/external/diviconsvg3218-4o1w.svg" class="items-diviconsvg" />
                <span class="items-text02"><span>Items</span></span>
              </div>
            </a>
            <a href="transactions.php" class="items-navlink1">
              <div class="items-divtabtransactions menuitem">
                <img alt="diviconsvg3218" src="public/external/diviconsvg3218-sw6.svg" class="items-diviconsvg01" />
                <span class="items-text04"><span>Transactions</span></span>
              </div>
            </a>
            <a href="customers.php" class="items-navlink2">
              <div class="items-divtabcustomers menuitem">
                <img alt="diviconsvg3219" src="public/external/diviconsvg3219-03uo.svg" class="items-diviconsvg02" />
                <span class="items-text06"><span>Customers</span></span>
              </div>
            </a>
          </div>
        </div>
        <div class="items-section">
          <div class="items-header">
            <div class="items-divtitle">
              <span class="items-text08"><span>Dashboard</span></span>
              <img alt="divicon3118" src="public/external/divicon3118-paes.svg" class="items-divicon" />
              <span class="items-text10"><span>Items</span></span>
            </div>

            <!-- BACKUP
            <div class="items-divsearch">
              <input type="search" name="search" id="search" class="searchdiv" placeholder="Search...">
              <img alt="Iconsvg3220" src="public/external/iconsvg3220-bg6.svg" class="customers-iconsvg" />
            </div>
            -->

            <div class="items-divsearch">
              <input onkeyup="searchTable()" type="search" name="search-input" id="search-input" class="searchdiv"
                placeholder="Search...">
              <img alt="Iconsvg3220" src="public/external/iconsvg3220-bg6.svg" class="customers-iconsvg" />
            </div>

            <div class="items-div">
              <button onclick="importRows()" class="items-divbuttonimport iconbutton">
                <img alt="diviconsvg1163" src="public/external/diviconsvg1163-yvuh.svg" class="items-diviconsvg03" />
              </button>
              <button onclick="exportRows()" class="items-divbuttonexport iconbutton">
                <img alt="diviconsvg3195" src="public/external/diviconsvg3195-d03d.svg" class="items-diviconsvg04" />
              </button>
              <button onclick="reloadTable()" class="items-divbuttonreload iconbutton">
                <img alt="diviconsvg3196" src="public/external/diviconsvg3196-6ibo.svg" class="items-diviconsvg05" />
              </button>
            </div>
            <button onclick="updateDB()" class="items-divbuttonupdate iconbutton">
              <img alt="diviconsvg3200" src="public/external/diviconsvg3200-rga.svg" class="items-diviconsvg06" />
            </button>
          </div>
          <div class="items-content">
            <div class="items-settings">
              <div class="items-divfilter">
                <div class="items-divhead">
                  <span class="items-text14"><span>Filters</span></span>
                </div>
                <div class="items-divcontent">

                  <div onclick="changeColor('filtericon1')" class="items-divitemgames">

                    <div>
                      <object id="filtericon1" class="filtericon1" type="image/svg+xml" data="public/external/diviconsvg1262-u658.svg"></object>
                    </div>

                    <span class="items-text16"><span>Games</span></span>
                  </div>
                  <div onclick="changeColor('filtericon2')" class="items-divitemmusic">

                    <div>
                      <object id="filtericon2" class="filtericon2" type="image/svg+xml" data="public/external/diviconsvg1266-xaqb.svg"></object>
                    </div>

                    <span class="items-text18"><span>Music</span></span>
                  </div>
                  <div onclick="changeColor('filtericon3')" class="items-divitemmovies">

                    <div>
                      <object id="filtericon3" class="filtericon3" type="image/svg+xml" data="public/external/diviconsvg1270-w0t6.svg"></object>
                    </div>

                    <span class="items-text20"><span>Movies</span></span>
                  </div>

                  <!--BACKUP
                  <div onclick="changeColor()" class="items-divitemgames">
                    <img alt="diviconsvg1262" src="public/external/diviconsvg1262-u658.svg"
                      class="items-diviconsvg07" id="filtericon"/>
                    <span class="items-text16"><span>Games</span></span>
                  </div>
                  <div onclick="changeColor()" class="items-divitemmusic">
                    <img alt="diviconsvg1266" src="public/external/diviconsvg1266-xaqb.svg"
                      class="items-diviconsvg08" id="filtericon"/>
                    <span class="items-text18"><span>Music</span></span>
                  </div>
                  <div onclick="changeColor()" class="items-divitemmovies">
                    <img alt="diviconsvg1270" src="public/external/diviconsvg1270-w0t6.svg"
                      class="items-diviconsvg09" id="filtericon"/>
                    <span class="items-text20"><span>Movies</span></span>
                  </div>
                  -->
                </div>
              </div>
              <div class="items-diveditor">
                <div class="items-divhead1">
                  <span class="items-text22"><span>Editor</span></span>
                </div>
                <div class="items-divcontent1">
                  <div class="items-divinputs">
                    <input id="id_i" name="id_i" type="text" placeholder="ID" class="items-divinput" />
                    <input id="title" name="title" type="text" placeholder="Title" class="items-divinput1" />
                    <input id="type" name="type" type="text" placeholder="Type" class="items-divinput2" />
                    <input id="genre" name="genre" type="text" placeholder="Genre" class="items-divinput3" />
                    <input id="release_date" name="release_date" type="text" placeholder="Release date"
                      class="items-divinput4" />
                    <input id="price" name="price" type="text" placeholder="Price" class="items-divinput5" />
                    <input id="rating" name="rating" type="text" placeholder="Rating" class="items-divinput6" />
                  </div>
                  <button class="items-divbuttons"></button>
                  <button onclick="clearLabels()" class="items-divbuttonclear button">
                    <img alt="diviconsvg1171" src="public/external/diviconsvg1171-7eib.svg"
                      class="items-diviconsvg10" />
                    <span class="items-text24"><span>Clear</span></span>
                  </button>
                  <button onclick="addRow()" class="items-divbuttonadd button">
                    <img alt="diviconsvg1173" src="public/external/diviconsvg1173-1fwh.svg"
                      class="items-diviconsvg11" />
                    <span class="items-text26"><span>Add Row</span></span>
                  </button>
                  <button onclick="deleteRow()" class="items-divbuttonremove button">
                    <img alt="diviconsvg1175" src="public/external/diviconsvg1175-tqlo.svg"
                      class="items-diviconsvg12" />
                    <span class="items-text28"><span>Remove Row</span></span>
                  </button>
                </div>
              </div>
            </div>
            <div class="items-section1">


              <table id="table" class="items-table">
                <thead class="items-thead">
                  <tr class="items-tr">
                    <th class="items-th-small">
                      <span class="items-htext-small"><span>ID</span></span>
                    </th>
                    <th class="items-th-big">
                      <span class="items-htext-big"><span>Title</span></span>
                    </th>
                    <th class="items-th-medium">
                      <span class="items-htext-medium"><span>Type</span></span>
                    </th>
                    <th class="items-th-medium">
                      <span class="items-htext-medium"><span>Genre</span></span>
                    </th>
                    <th class="items-th-medium">
                      <span class="items-htext-medium">
                        <span>Release date</span>
                      </span>
                    </th>
                    <th class="items-th-medium">
                      <span class="items-htext-medium"><span>Price</span></span>
                    </th>
                    <th class="items-th-medium">
                      <span class="items-htext-medium"><span>Rating</span></span>
                    </th>
                  </tr>
                </thead>
                <tbody class="items-tbody">
                  <?php
                  if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo '<tr onclick=selectRow(this) class="items-tr1">';
                      echo '<td class="items-td-small">';
                      echo '<span class="items-text-small"><span>' . $row['id_i'] . '</span></span>';
                      echo '</td>';
                      echo '<td class="items-td-big">';
                      echo '<span class="items-text-big"><span>' . $row['title'] . '</span></span>';
                      echo '</td>';
                      echo '<td class="items-td-medium">';
                      echo '<span class="items-text-medium"><span>' . $row['type'] . '</span></span>';
                      echo '</td>';
                      echo '<td class="items-td-medium">';
                      echo '<span class="items-text-medium"><span>' . $row['genre'] . '</span></span>';
                      echo '</td>';
                      echo '<td class="items-td-medium">';
                      echo '<span class="items-text-medium"><span>' . $row['release_date'] . '</span></span>';
                      echo '</td>';
                      echo '<td class="items-td-medium">';
                      echo '<span class="items-text-medium"><span>' . $row['price'] . '</span></span>';
                      echo '</td>';
                      echo '<td class="items-td-medium">';
                      echo '<span class="items-text-medium"><span>' . $row['rating'] . '</span></span>';
                      echo '</td>';
                      echo '</tr>';
                    }
                  }

                  ?>

                  <!--
                    <tr class="items-tr1">
                      <td class="items-td">
                        <span class="items-text44"><span>Number</span></span>
                      </td>
                      <td class="items-td01">
                        <span class="items-text46"><span>Row Text</span></span>
                      </td>
                      <td class="items-td02">
                        <span class="items-text48"><span>Type</span></span>
                      </td>
                      <td class="items-td03">
                        <span class="items-text50"><span>Genre</span></span>
                      </td>
                      <td class="items-td04">
                        <span class="items-text52"><span>Row Text</span></span>
                      </td>
                      <td class="items-td05">
                        <span class="items-text54"><span>Row Text</span></span>
                      </td>
                      <td class="items-td06">
                        <span class="items-text56"><span>Row Text</span></span>
                      </td>
                    </tr>
                    -->
                </tbody>
              </table>



              <div class="items-log">
                <div class="items-head">
                  <span class="items-text72"><span>Log</span></span>
                </div>

                <div id="log" class="items-div1">


                  <!-- BACKUP
                  <div class="items-divrow">
                    <div class="items-divrow11">
                      <span class="items-text74"><span>Text</span></span>
                    </div>
                  </div>
                  -->

                </div>

              </div>
            </div>
          </div>
          <div class="items-divfooter">
            <span class="items-text78">
              <span>2023 UGAL University Project. All right reserved to</span>
            </span>
            <span class="items-text80"><span>@const_in.</span></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>