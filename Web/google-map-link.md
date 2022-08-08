#Linking to a location (No directions)
https://www.google.com/maps?q=760+West+Genesee+Street+Syracuse+NY+13204

#No starting point (User input required to generate directions).
https://www.google.com/maps?daddr=760+West+Genesee+Street+Syracuse+NY+13204

#With a set location as starting point (Automatically generates directions with no user input required).
https://www.google.com/maps?saddr=760+West+Genesee+Street+Syracuse+NY+13204&daddr=314+Avery+Avenue+Syracuse+NY+13204

#With "My Location" as starting point (Automatically generates directions with no user input required).
https://www.google.com/maps?saddr=My+Location&daddr=760+West+Genesee+Street+Syracuse+NY+13204

#Current Location to Latitude and Longitude
https://www.google.com/maps?saddr=My+Location&daddr=43.12345,-76.12345

#Query search of a Latitude and Longitude. Also shows setting a default zoom level.
https://www.google.com/maps?ll=43.12345,-76.12345&q=food&amp;z=14

#String search as destination
https://www.google.com/maps?saddr=My+Location&daddr=Pinckney+Hugo+Group



function getLatLong($district)
{
	$address = $district; //here we can get the name of the district
	$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($district) . '&sensor=false&key=AIzaSyDwb3N34D-V3uayueVVZKL6sSgePwkmDfU');
	// We convert the JSON to an array
	$geo = json_decode($geo, true);
	// If everything is cool
	if ($geo['status'] == 'OK') {
		// We set our values
		$latitude = $geo['results'][0]['geometry']['location']['lat'];
		$longitude = $geo['results'][0]['geometry']['location']['lng'];
		return ['latitude' => $latitude, 'longtitude' => $longitude];
	}
}
