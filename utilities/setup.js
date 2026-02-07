const readline = require('readline-sync');
const fs = require('node:fs');

const settings_file_name = "settings.php";

console.log("This script will set up your settings.php file so that you can start testing. You'll need some info about your mail server handy. Consult the documentation about how to find this information.\n\n");

// Assume we should run the script unless we fail a condition.
let proceed = true

// Handle scenario where file exists.
if (fs.existsSync(settings_file_name)) {
    let replace = readline.question("It looks like you already have a settings.php file. Would you like to replace it? [y/n]");

    if ((replace == "") || (replace[0].toLowerCase() != "y")) {
        proceed = false;
        console.log("Abort.");
    }
}

if (proceed) {
    let smtp_hostname = readline.question("Input your SMTP server address: ");
    let smtp_username = readline.question("Input your mail server username: ");
    let smtp_password = readline.question("Input your mail server password: ");
    let smtp_destination = readline.question("Input the destination email address where automated emails should be sent: ");

    let file_content = `<?php
    return array(
        'mail' => array(
            "smtp_server" => "${smtp_hostname}",
            "smtp_username" => "${smtp_username}",
            "smtp_password" => "${smtp_password}",
            "destination" => "${smtp_destination}"
        ),
        "in_progress" => FALSE,
        "show_location" => FALSE,
        "zoom_location" => FALSE,
        "debug_showOutlines" => FALSE,
        "debug_showPoints" => FALSE,
        "debug_logNames" => FALSE
    );
    `;

    fs.writeFileSync("./settings.php", file_content);
    console.log("settings.php created.");
}
