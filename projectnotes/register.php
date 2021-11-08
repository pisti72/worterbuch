<?php
/*
 * 
 * 
 *  |\__/,|   (`\
 *  |_ _  |.--.) )
 *  ( T   )     /
 * (((^_(((/(((_/
 * 
 * 
 * 
 */


$title = $_POST['title'];
$name = $_POST['name'];
$middle = $_POST['middle'];
$family = $_POST['family'];
$gender = $_POST['gender'];
$affiliation = $_POST['affiliation'];
$department = $_POST['department'];
$website = $_POST['website'];
$position = $_POST['position'];
$country = $_POST['country'];
$state = $_POST['state'];
$street = $_POST['street'];
$house = $_POST['house'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$county = $_POST['county'];
$email = $_POST['email'];
$alternative = $_POST['alternative'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$hotel = $_POST['hotel'];
$accompanying = $_POST['accompanying'];
$level = $_POST['level'];
$special = $_POST['special'];

$created = $_POST['created'];

$fullname = $title . " " . $name . " " . $middle . " " . $family;

$db = new SQLite3('participants.db');

$db->exec("CREATE TABLE IF NOT EXISTS persons (id integer primary key, title text,"
        . " name text NOT NULL,middle text, family text NOT NULL, gender, text, affiliation text,"
        . " department text, website text, position text, country text NOT NULL,"
        . " state text, street text NOT NULL, house text NOT NULL, city text NOT NULL, zip text,"
        . " county text, email text NOT NULL, alternative text, phone text, mobile text,"
        . " hotel text NOT NULL, accompanying text NOT NULL, level text NOT NULL,"
        . " special text, created text NOT NULL, comment text, isvisible text);");

$success = false;
if ($name != "" and $family != "" and $email != "") {
    $success = $db->exec("INSERT INTO persons (title,name,middle,family,gender,affiliation,department,"
            . "website,position,country,state,street,house,city,zip,county,email,alternative,"
            . "phone,mobile,hotel,accompanying,level,special,created)"
            . " VALUES('{$title}','{$name}','{$middle}','{$family}','{$gender}','{$affiliation}'"
            . ",'{$department}','{$website}','{$position}','{$country}'"
            . ",'{$state}','{$street}','{$house}','{$city}','{$zip}'"
            . ",'{$county}','{$email}','{$alternative}','{$phone}','{$mobile}'"
            . ",'{$hotel}','{$accompanying}','{$level}','{$special}'"
            . ",'{$created}');");
}
$nl = "\r\n";
$dnl = $nl . $nl;

$subject = "ESSC - EURECYS 2021 Conference confirmation of registration ";

$txt = "Dear " . $fullname . "," . $dnl;
$txt .= "It is our great pleasure to welcome you to our Conference of Sustainable "
        . "Management of Cultural Landscapes in the context of the European Green Deal, "
        . "the 1st International Joint Congress of European Society for Soil "
        . "Conservation and the European Ecocycles Society." . $dnl
        . "This is a confirmation letter about your registration." . $dnl
        . "Location: Santo Stefano di Camastra (Italy)" . $nl
        . "Date: between 10 and 14 November 2021" . $nl
        . "Hotel reservation requested: " . $hotel . $nl
        . "Accompanying person: " . $accompanying . $nl
        . "Level of participation: " . $level . $nl
        . "Special request: " . $special . $dnl
        . "The Conference is a worldwide international forum to present and discuss "
        . "problems, progress, future solutions and possible strategies in research, "
        . "development, standards, and applications of the topics related to conservation "
        . "of cultural landscapes in a changing environment and climate change, protection "
        . "of ecosystems and sustainable use of ecosystem services, transition to "
        . "multifunctional, organic agriculture, conservation of cultural heritage, "
        . "new governance structures based on an inclusive, participatory approach "
        . "to stakeholders and education reforms to ensure the right competences of "
        . "future generations. The Conference will offer high quality research "
        . "sessions, poster sessions, workshops, field excursion and a Ph.D. symposium "
        . "followed by an International Press Conference." . $dnl
        . "A great conference is being arranged for sharing the latest insights of "
        . "applied scientific research on a wide interdisciplinary field as well "
        . "as to experience the unique environment of Sicily, in a city which has "
        . "been at the heart of a unique culture and crafts and stunning natural "
        . "environment since many centuries." . $dnl
        . "We thank you for your participation and look forward to seeing you in "
        . "Santo Stefano di Camastra, Sicily, Italy." . $dnl
        . "Yours Sincerely," . $dnl . "Giuseppe Lo Papa" . $nl
        . "President of the Organizing Committee";

$headers = "";
$headers .= 'Content-Type: text/plain; charset=utf-8' . $nl;
//$headers .= 'Content-Transfer-Encoding: base64' . $nl;
$headers .= "From: noreply@ecocycles.net" . $nl;
if ($alternative != "") {
    $headers .= 'Cc: ' . $alternative . $nl;
}
//$headers .= "Reply-To: noreply@ecocycles.net" . $nl;
$headers .= "X-Mailer: PHP/" . phpversion();

//$trick = "-f jly4rzgkh0uj@n3plcpnl0241.prod.ams3.secureserver.net";
$trick = "-f noreply@ecocycles.net";

require 'header.php';

if ($success) {
    mail($email, $subject, $txt, $headers, $trick);
    ?>
    <body>
        <div class="container mt-4">
            <div class="alert alert-success" role="alert">
                <h1 class="alert-heading">Well Done! Your registration is done!</h1>
                <p>Dear <? echo $fullname; ?>!</p>
                <p>We sent the invitation letter to your 
                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a> 
                    email account about this registration. Please check your mailbox!</p>
                <form action="./index.php" method="post">
                    <button type="submit" class="btn btn-primary">Back to the site</button>
                </form>
            </div>
        </div>
    </body>
    </html>

    <?php
} else {
    ?>
    <body>
        <div class="container mt-4">
            <div class="alert alert-danger" role="alert">
                <h1 class="alert-heading">Oops! Something went wrong!</h1>
                <p>Please fill all the required fields!</p>
                <form action="./index.php" method="post">
                    <button type="submit" class="btn btn-primary">Back to the site</button>
                </form>
            </div>
        </div>
    </body>
    </html>
<?php } ?>

