<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**  *generated with [DocToc](https://github.com/thlorenz/doctoc)*

- [chicagobikelanes](#chicagobikelanes)
- [Updating this guide](#updating-this-guide)
- [This repository has moved from its original location.](#this-repository-has-moved-from-its-original-location)
- [About The Code](#about-the-code)
  - [Attributions](#attributions)
  - [Setup](#setup)
    - [Necessary Programs](#necessary-programs)
    - [Windows instructions](#windows-instructions)
    - [Linux instructions](#linux-instructions)
    - [Verifying your installation](#verifying-your-installation)
    - [Installing dependencies](#installing-dependencies)
  - [Creating a configuration file (settings.php)](#creating-a-configuration-file-settingsphp)
    - [Other Configuration Options](#other-configuration-options)
    - [Debug Configuration Options](#debug-configuration-options)
  - [style.json](#stylejson)
  - [paths.json](#pathsjson)
  - [Docker Setup](#docker-setup)
    - [Prerequisites](#prerequisites)
    - [Quick Start](#quick-start)
  - [Utility scripts](#utility-scripts)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

# chicagobikelanes

A map of all current and planned protected bicycle infrastructure in the city of Chicago.

This is a work-in-progress.

# Updating this guide

This README.md is meant for developers of this codebase.

Whenever you update this guide with a new section or heading, make sure to update the table of contents. There is an included NPM package to do this. Once you have installed dependencies, run the command below to update the table of contents:

```
node node_modules/doctoc/doctoc.js README.md
```

See [Setup Section](#setup) for details on installing dependencies. You must follow the instructions in that section to completion before you can run the table of contents update command.

# This repository has moved from its original location.

If you still have checked out the old location, use the following command to set the new location:

```
git remote set-url origin https://github.com/StrongTownsChicago/chicago-bike-lane-map.git
```

# About The Code

## Attributions

This website is built using Bootstrap CSS framework: [https://getbootstrap.com](https://getbootstrap.com)

The map is built with Leaflet.js ([https://leafletjs.com/](https://leafletjs.com/))
and uses OpenStreetMap map data ([https://www.openstreetmap.org](https://www.openstreetmap.org)).


## Setup

There are two methods for running this website locally - you can use PHP's built-in development server and install the needed programs to your machine manually, or you can set up a Docker container to run the site.

The instructions below will cover a manual installation. For information about installing via Docker, skip to [Docker Setup](#docker-setup)

### Necessary Programs

Before you can run this code locally, you must install the following programs:

- PHP
- Composer (a library manager for PHP)
- NodeJS
- Node Package Manager (NPM) (a library manager for NodeJS)

Installation instructions will vary based on your operating system.

### Windows instructions

On Windows, you'll have to go to the websites for each of the programs you need and download the installers.

- PHP: [https://www.php.net/downloads.php](https://www.php.net/downloads.php)
- Composer: [https://getcomposer.org/download/](https://getcomposer.org/download/)
- NodeJS and NPM: [https://nodejs.org/en/download](https://nodejs.org/en/download)

You might need to reboot after you finish the installations in order to use them from your terminal.

### Linux instructions

On Linux, you can install `php`, `composer`, `nodejs`, and `npm` from your package manager.

For example, on Debian-based systems, you can run the following command to get the four programs you need:

```
sudo apt install php composer nodejs npm
```

### Verifying your installation

After you've installed the needed programs, check the version of each one as shown below to verify that they are usable.

```
php --version
```

```
composer --version
```

```
node --version
```

```
npm --version
```

Versions of programs used in development of this code are shown below. In most cases, slight variance will not cause major issues, but if you encounter problems, that's something you can try to address.

Program  | Version
---------|---------
PHP      | 8.4.16
Composer | 2.8.8
NodeJS   | 22.17.0
NPM      | 10.9.2

### Installing dependencies

Open a terminal within the project directory.

Running `ls` or `dir` (depending on your operating system and terminal) should show the project files, i.e. composer.json, package.json, index.php, etc. If you do not see these files, you are in the wrong directory.

Run `composer install` to download all needed PHP libraries. These are needed to run the website.

Run `npm i` to download all needed NodeJS libraries. Right now, these are only needed for development and are not needed by the website itself.

## Creating a configuration file (settings.php)

In order for the contact form to work properly, you will need to create a `settings.php` file to store your information. This file is ignored by version control (git), and SHOULD NEVER BE SAVED ANYWHERE PUBLIC.

There is a provided script that will create the file for you. To run the script, run the following command in a terminal from within the project directory:

```
node utilities/setup.js
```

You will need to provide the script with the following information:

Field Name  | Description
------------|-------------
SMTP Server | The hostname of your mailing server (i.e. smtp.gmail.com, smtp.hostinger.com). You can usually find this in the documentation for your email hosting provider.
SMTP Username | The username you use to log in to the email from which Contact Form responses should be sent. You must have access to a valid email account that will be used to send the emails.
SMTP Password | The password you use to log in to the email from which Contact Form responses should be sent.You must have access to a valid email account that will be used to send the emails.
SMTP Destination | The destination address for Contact Form responses. This should be an email that can be checked by a human. This does not have to be the same as the SMTP username, but for simplicity, it often is. In our case, we use two different mailboxes - one provided by our hosting service, and a Gmail that can be more easily accessed by our staff.

**PLEASE NOTE:** You may be confused that the address *sending* the email is the one that you have access to. Shouldn't it be the other way around? The answer is no. You cannot send emails from someone else's email address, but what you *can* do is alter the "ReplyTo" property on the email. The automatically-generated email that shows up in your inbox will be both sent and received by you, but when you click "Reply", it will put in the email of the user who submitted the contact form.

### Other Configuration Options

The generated configuration file will have a number of options set to FALSE by default. Some of them alter the behavior of the map. Below is a table describing their usage.

Option          | Description
----------------|-------------
`in_progress`   | If true, a popup will be shown when the map loads, indicating that the map is still unfinished.
`show_location` | If true, the map will attempt to ask for the user's location. If the user allows location services for this website, a pin will be placed on the map showing their approximate position, as well as the estimated accuracy. This can be helpful, but also a bit annoying.
`zoom_location` | If true, and if `show_location` is also true, the map will zoom to the user's location once it loads.

### Debug Configuration Options

Plotting out all of the paths is tediuous, and it's easy to make mistakes. I've done my best to set up the `paths.json` in a way where you can easily break paths down into segments for ease of modification, but there are also a couple debug options you can enable in the configuration file to visualize what's going on.

Option               | Description
---------------------|-------------
`debug_showOutlines` | This will show you the "hitbox" of your lines. Since Leaflet line objects have single-pixel width, I had to create invisible bubbles around the paths to make clicking on them possible. Turning this option to `true` will make visible these bubbles. You'll have to modify `map.js` to tweak the size of them.
`debug_showPoints`   | This will place a dot on each individual coordinate present in `paths.json`. This makes it a little easier to identify which coordinates have already been plotted.
`debug_logNames`     | This will log each path's name to your browser's terminal (yes, your browser has a terminal output - on Firefox, the keyboard shortcut to open it is `ctrl`+`shift`+`J`.). If a path has an error and is breaking the map, this makes it easier to figure out which path has the error.

## style.json

This file describes the styling used for each type of path shown on the map. These are referenced by the map script, and should match with the types of paths used in `data/paths.json`.

As with the other JSON files, this is stored in the `data` directory.

Below is an example of the format used in this file:

```json
{
  "trail": {
    "layerObject": null,
    "displayName": "Trails",
    "dash": "0",
    "color": "red"
  },
  "pbl": {
    "layerObject": null,
    "displayName": "Protected Bike Lanes",
    "dash": "0",
    "color": "purple"
  },
  "ripbl": {
    "layerObject": null,
    "displayName": "Rapid-Implementation Protected Bike Lanes",
    "dash": "0",
    "color": "#24E"
  },
  "bikeway": {
    "layerObject": null,
    "displayName": "Neighborhood Bikeways ('Greenways')",
    "dash": "0",
    "color": "green"
  },
  "other": {
    "layerObject": null,
    "displayName": "Other connections",
    "dash": "0",
    "color": "gray"
  },
  "break": {
    "layerObject": null,
    "displayName": "------------------"
  },
  "trail_incomplete": {
    "layerObject": null,
    "displayName": "Future Trails",
    "dash": "7",
    "color": "red"
  },
  "pbl_incomplete": {
    "layerObject": null,
    "displayName": "Future Protected Bike Lanes",
    "dash": "7",
    "color": "purple"
  },
  "ripbl_incomplete": {
    "layerObject": null,
    "displayName": "Future Rapid-Implementation Protected Bike Lanes",
    "dash": "7",
    "color": "#24E"
  },
  "bikeway_incomplete": {
    "layerObject": null,
    "displayName": "Future Neighborhood Bikeways ('Greenways')",
    "dash": "7",
    "color": "green"
  }
}
```

## paths.json

paths.json will look something like this:

```json
{
  {
    "name": "Wellington Neighborhood Bikeway",
    "segments": [
      {
        "name": "Segment name here (optional)",
        "coordinates": [
          [41.93570733775486, -87.7123946150148],
          [41.935745740853555, -87.70759355004395]
        ],
      }
    ],
    "type": "bikeway_incomplete"
    "completion": "Between Summer 2022 and Fall 2024",
    "description": "Here is my description of this bike lane. This will appear in the popup.",
    "links": [
      {
        "name": "My test website",
        "address": "https://yourwebsitehere.com"
      }
    ]
  },
  {
    "name": "California Bike Lane, Schubert to George St",
    "segments": [
      {
        "name": "Segment name here (optional)",
        "type": "ripbl",
        "coordinates": [
          [41.934472760272094, -87.69769902281476],
          [41.93029561038914, -87.69757835449403]
        ],
      }
    ]
  },
  ...
  (continue for the rest of your paths)
  ...
}
```


Obviously you're going to have more than two bike lanes. Each bike lane will need to be its own object.

Note that only the `name`, `segments`, `coordinates`, `type`, and `completed` fields are necessary. All other fields will be detected dynamically if they are available, and that information will be formatted and added to the popup that appears when you click on that bike path.

## Docker Setup

You can easily run this application using Docker without installing PHP or other dependencies locally.

### Prerequisites

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/) (usually included with Docker Desktop)

### Quick Start

1. Clone this repository:
   ```bash
   git clone https://github.com/strongtownschicago/chicago-bike-lane-map.git
   cd chicago-bike-lane-map
   ```
2. Create a `config` directory in the root containing the json files that the application expects (`config.json`, `paths.json`, `style.json`, and `wards.geojson`).
  See [this previous commit](https://github.com/matt-hendrick/chicago-bike-lane-map/commit/e2cbfe335777f2e447f58499821044b88f598708) for one example of what those files could look like.
3. Run `docker-compose up`
4. Visit http://localhost:8080 in your browser

## Utility scripts

This repository includes a utility script folder, which includes a nodejs script used to assign colors to the ward boundaries polygons (if the file `wards.geojson` is present). This script should be run beforehand, on your local machine, to augment your `wards.geojson` file with hexcode color assignments that can be interpreted by the mapping script `map.js`.

The `map.js` will inspect the geojson file for the `color` property. If it is present, the associated polygon on the map will be assigned that color. If it is not present, the default color will be used.

Assigning colors makes it easier to differentiate ward boundaries.

In order to run the script, you must do the following:

1. Install NodeJS v20 or later on your development computer. *v18 will not work!*
2. Run `npm install` on your computer to get all of the required packages.
3. Run the script. Example usage shown below.

```bash
node ./utilities/generateColors.js ./data/wards_no_colors.geojson -c 8dd3c7 ffffb3 bebada fb8072 -o ./wards.geojson
```

Three arguments are required:
1. The input GeoJSON ward boundary file,
2. Hexcodes of four colors for the wards, and
3. An output file destination (this can be the same as the input file destination if you want to overwrite your original file. No warning will be issued.).

This updated GeoJSON file can then be provided to the website, and the colors will be used to fill the polygons of the ward boundaries on the map. This process can also be done manually, of course, but the script makes it easier.
