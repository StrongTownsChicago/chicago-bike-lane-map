/*
 * Author: Matt Hendrick
 */

/* Dependencies */
const fs = require('fs');
const { ArgumentParser } = require('argparse');
const { version } = require('../package.json');

/* Parse command line arguments */
const parser = new ArgumentParser({
  description: "Script for calculating optimal color-patterning for a collection of GeoJSON polygons."
});

parser.add_argument("-m", "--mapdata", {
  help: ".geojson file containing ward boundary data.",
  required: "true"
});

parser.add_argument("-a", "--alderdata", {
  help: ".json file containing biographic info for alders.",
  required: "true"
});

parser.add_argument("-o", "--output", {
  help: "Output file to be written.",
  required: "true"
});

const args = parser.parse_args();

// Load the ward GeoJSON file (See Ward Overlay section in README.md for details)
const wardsGeoJson = JSON.parse(fs.readFileSync(args["mapdata"], 'utf-8'));

// Load the aldermanic data (See Ward Overlay section in README.md for details)
const aldermanData = JSON.parse(fs.readFileSync(args["alderdata"], 'utf-8'));

// Create a lookup object for fast access to alderman data by ward number
const aldermanByWard = {};

// Function to better parse alderman names from various formats
function parseAldermanName(fullName) {
  var firstName = "";
  var lastName = "";

  if (fullName) {
    if (fullName.includes(',')) {
      // <Last, First> format
      const nameParts = fullName.split(",").map(part => part.trim())

      console.log(nameParts)

      firstName = nameParts[nameParts.length - 1] // First name is the last element of the array
      lastName = nameParts.slice(0, -1).join(", ")
    }
    else {
      // <First Last> format
      const nameParts = fullName.split(" ").map(part => part.trim())

      firstName = nameParts[0]
      lastName = nameParts.slice(1).join(" ")
    }
  }

  return {firstName, lastName}
}

// Build the lookup table
aldermanData.forEach(item => {
  // Make sure ward is treated as a string for consistent comparison
  const wardId = item["ward"].toString();
  const {firstName, lastName} = parseAldermanName(item["alderman"]);

  aldermanByWard[wardId] = {
    fullName: item.alderman,
    firstName: firstName,
    lastName: lastName,
    email: item.email,
    wardPhone: item.ward_phone,
    address: item.address
  };
});

console.log(aldermanByWard);

// Enrich the GeoJSON features with alderman information
wardsGeoJson["features"].forEach(feature => {
  const wardId = feature["properties"]["ward_id"];
  const aldermanInfo = aldermanByWard[wardId];

  if (aldermanInfo) {
    // Add alderman information to the feature's properties
    feature["properties"]["alderman"]   = aldermanInfo.fullName;
    feature["properties"]["firstName"]  = aldermanInfo.firstName;
    feature["properties"]["lastName"]   = aldermanInfo.lastName;
    feature["properties"]["email"]      = aldermanInfo.email;
    feature["properties"]["wardPhone"]  = aldermanInfo.wardPhone;
    feature["properties"]["address"]    = aldermanInfo.address;
  }
  else {
    console.warn(`No alderman information could be found for Ward ${wardId}`);
  }
});

// Write the enriched GeoJSON back to a file

fs.writeFileSync(args["output"], JSON.stringify(wardsGeoJson, null, 2));

console.log(`Successfully created ${args["output"]} with aldermen data`);
