<?php
/*
 * 
 *     __      _
 *   o'')}____//
 *    `_/      )
 *    (_(_/-(_/
 *
 * 
 */

function array_to_csv_download($array, $filename = "export.csv", $delimiter = ";") {
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    // open the "output" stream
    // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
    $f = fopen('php://output', 'w');

    foreach ($array as $line) {
        fputcsv($f, $line, $delimiter);
    }
}

$db = new SQLite3('participants.db');

$action = '';
if (isset($_POST['action'])) {
    $action = $_POST['action'];
}


if ($action == "edit") {
    $id = $_POST['id'];
    $comment = $_POST['comment'];
    $db->exec("UPDATE persons SET comment=\"{$comment}\" WHERE id=\"{$id}\";");
}

$rows = array();

$res = $db->query('SELECT * FROM persons');
$table = "<table class=\"table table-striped table-bordered\">\n";
$table .= "<thead>\n";
$table .= "<tr><th>Title</th><th>Given name</th><th>Middle name</th><th>Family name</th>"
        . "<th>Gender</th><th>Affiliation</th><th>Department</th><th>Website</th>"
        . "<th>Position</th><th>Country</th><th>State</th>"
        . "<th>Street</th><th>House nr</th><th>City</th><th>ZIP</th><th>County</th><th>Email</th>"
        . "<th>Alternative</th><th>Telephone</th><th>Mobile</th><th>Hotel</th><th>Accompanying</th>"
        . "<th>Level</th><th>Special</th><th>Created</th><th>Comment</th></tr>\n";
$table .= "</thead>\n";
$table .= "<tbody>\n";

$row = array('Title', 'Given name', 'Middle name', 'Family name', 'Gender', 'Affiliation', 'Department', 'Website',
    'Position', 'Country', 'State', 'Street', 'House nr', 'City', 'ZIP', 'County', 'Email',
    'Alternative', 'Telephone', 'Mobile', 'Hotel', 'Accompanying', 'Level', 'Special', 'Created', 'Comment');

array_push($rows, $row);

while ($row = $res->fetchArray()) {
    $table .= "<tr><td>{$row['title']}</td><td>{$row['name']}</td><td>{$row['middle']}</td>"
            . "<td>{$row['family']}</td><td>{$row['gender']}</td><td>{$row['affiliation']}</td><td>{$row['department']}</td>"
            . "<td>{$row['website']}</td><td>{$row['position']}</td><td>{$row['country']}</td>"
            . "<td>{$row['state']}</td><td>{$row['street']}</td><td>{$row['house']}</td>"
            . "<td>{$row['city']}</td><td>{$row['zip']}</td><td>{$row['county']}</td><td>{$row['email']}</td>"
            . "<td>{$row['alternative']}</td><td>{$row['phone']}</td><td>{$row['mobile']}</td><td>{$row['hotel']}</td>"
            . "<td>{$row['accompanying']}</td><td>{$row['level']}</td><td>{$row['special']}</td>"
            . "<td>{$row['created']}</td>"
            . "<td><form action=\"\" method=\"post\"><input type=\"text\" name=\"comment\" value=\"{$row['comment']}\">"
            . "<input type=\"submit\" value=\"Edit\">"
            . "<input type=\"hidden\" name=\"action\" value=\"edit\">"
            . "<input type=\"hidden\" name=\"id\" value=\"{$row['id']}\">"
            . "</form></td></tr>\n";

    $row = array($row['title'], $row['name'], $row['middle'], $row['family'], $row['gender'], $row['affiliation'],
        $row['department'], $row['website'], $row['position'], $row['country'], $row['state'],
        $row['street'], $row['house'], $row['city'], $row['zip'], $row['county'], $row['email'],
        $row['alternative'], $row['phone'], $row['mobile'], $row['hotel'], $row['accompanying'],
        $row['level'], $row['special'], $row['created'], $row['comment']);

    array_push($rows, $row);
}
$table .= "</tbody>\n";
$table .= "</table>\n";

if (isset($_GET['action']) && $_GET['action'] == 'download') {
    array_to_csv_download($rows);
    die();
}

require 'header.php';
?>
<body>
    <div class="container mt-4 pb-4">
        <h2 class="bg-lightgreen rounded">Participants</h2>
    </div>
    <a href="?action=download"><img src="assets/csv.png"></a>
    <? echo $table; ?>
</body>
</html>
