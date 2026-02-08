const readline = require('readline-sync');
const fs = require('node:fs');

const settings_file_name = "settings.php";

// Check if running non-interactively (e.g., in Docker)
const isNonInteractive = !process.stdin.isTTY || process.env.NON_INTERACTIVE === 'true';

if (!isNonInteractive) {
    console.log("This script will set up your settings.php file so that you can start testing. You'll need some info about your mail server handy. Consult the documentation about how to find this information.\n\n");
}

// Assume we should run the script unless we fail a condition.
let proceed = true

// Handle scenario where file exists (skip check in non-interactive mode)
if (!isNonInteractive && fs.existsSync(settings_file_name)) {
    let replace = readline.question("It looks like you already have a settings.php file. Would you like to replace it? [y/n]");

    if ((replace == "") || (replace[0].toLowerCase() != "y")) {
        proceed = false;
        console.log("Abort.");
    }
}

if (proceed) {
    let smtp_hostname, smtp_username, smtp_password, smtp_destination;

    if (isNonInteractive) {
        // Use default placeholder values for non-interactive mode (e.g., Docker)
        smtp_hostname = "smtp.example.com";
        smtp_username = "noreply@example.com";
        smtp_password = "placeholder-password";
        smtp_destination = "admin@example.com";
        console.warn("Running in non-interactive mode. Creating settings.php with placeholder values...");
    } else {
        // Use interactive prompts
        smtp_hostname = readline.question("Input your SMTP server address: ");
        smtp_username = readline.question("Input your mail server username: ");
        smtp_password = readline.question("Input your mail server password: ");
        smtp_destination = readline.question("Input the destination email address where automated emails should be sent: ");
    }

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
