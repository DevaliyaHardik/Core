<?php
$countryList = array(
        "Afghanistan",
        "Albania",
        "Algeria",
        "American Samoa",
        "Andorra",
        "Angola",
        "Anguilla",
        "Antarctica",
        "Antigua and Barbuda",
        "Argentina",
        "Armenia",
        "Aruba",
        "Australia",
        "Austria",
        "Azerbaijan",
        "Bahamas (the)",
        "Bahrain",
        "Bangladesh",
        "Barbados",
        "Belarus",
        "Belgium",
        "Belize",
        "Benin",
        "Bermuda",
        "Bhutan",
        "Bolivia (Plurinational State of)",
        "Bonaire, Sint Eustatius and Saba",
        "Bosnia and Herzegovina",
        "Botswana",
        "Bouvet Island",
        "Brazil",
        "British Indian Ocean Territory (the)",
        "Brunei Darussalam",
        "Bulgaria",
        "Burkina Faso",
        "Burundi",
        "Cabo Verde",
        "Cambodia",
        "Cameroon",
        "Canada",
        "Cayman Islands (the)",
        "Central African Republic (the)",
        "Chad",
        "Chile",
        "China",
        "Christmas Island",
        "Cocos (Keeling) Islands (the)",
        "Colombia",
        "Comoros (the)",
        "Congo (the Democratic Republic of the)",
        "Congo (the)",
        "Cook Islands (the)",
        "Costa Rica",
        "Croatia",
        "Cuba",
        "Curaçao",
        "Cyprus",
        "Czechia",
        "Côte d'Ivoire",
        "Denmark",
        "Djibouti",
        "Dominica",
        "Dominican Republic (the)",
        "Ecuador",
        "Egypt",
        "El Salvador",
        "Equatorial Guinea",
        "Eritrea",
        "Estonia",
        "Eswatini",
        "Ethiopia",
        "Falkland Islands (the) [Malvinas]",
        "Faroe Islands (the)",
        "Fiji",
        "Finland",
        "France",
        "French Guiana",
        "French Polynesia",
        "French Southern Territories (the)",
        "Gabon",
        "Gambia (the)",
        "Georgia",
        "Germany",
        "Ghana",
        "Gibraltar",
        "Greece",
        "Greenland",
        "Grenada",
        "Guadeloupe",
        "Guam",
        "Guatemala",
        "Guernsey",
        "Guinea",
        "Guinea-Bissau",
        "Guyana",
        "Haiti",
        "Heard Island and McDonald Islands",
        "Holy See (the)",
        "Honduras",
        "Hong Kong",
        "Hungary",
        "Iceland",
        "India",
        "Indonesia",
        "Iran (Islamic Republic of)",
        "Iraq",
        "Ireland",
        "Isle of Man",
        "Israel",
        "Italy",
        "Jamaica",
        "Japan",
        "Jersey",
        "Jordan",
        "Kazakhstan",
        "Kenya",
        "Kiribati",
        "Korea (the Democratic People's Republic of)",
        "Korea (the Republic of)",
        "Kuwait",
        "Kyrgyzstan",
        "Lao People's Democratic Republic (the)",
        "Latvia",
        "Lebanon",
        "Lesotho",
        "Liberia",
        "Libya",
        "Liechtenstein",
        "Lithuania",
        "Luxembourg",
        "Macao",
        "Madagascar",
        "Malawi",
        "Malaysia",
        "Maldives",
        "Mali",
        "Malta",
        "Marshall Islands (the)",
        "Martinique",
        "Mauritania",
        "Mauritius",
        "Mayotte",
        "Mexico",
        "Micronesia (Federated States of)",
        "Moldova (the Republic of)",
        "Monaco",
        "Mongolia",
        "Montenegro",
        "Montserrat",
        "Morocco",
        "Mozambique",
        "Myanmar",
        "Namibia",
        "Nauru",
        "Nepal",
        "Netherlands (the)",
        "New Caledonia",
        "New Zealand",
        "Nicaragua",
        "Niger (the)",
        "Nigeria",
        "Niue",
        "Norfolk Island",
        "Northern Mariana Islands (the)",
        "Norway",
        "Oman",
        "Pakistan",
        "Palau",
        "Palestine, State of",
        "Panama",
        "Papua New Guinea",
        "Paraguay",
        "Peru",
        "Philippines (the)",
        "Pitcairn",
        "Poland",
        "Portugal",
        "Puerto Rico",
        "Qatar",
        "Republic of North Macedonia",
        "Romania",
        "Russian Federation (the)",
        "Rwanda",
        "Réunion",
        "Saint Barthélemy",
        "Saint Helena, Ascension and Tristan da Cunha",
        "Saint Kitts and Nevis",
        "Saint Lucia",
        "Saint Martin (French part)",
        "Saint Pierre and Miquelon",
        "Saint Vincent and the Grenadines",
        "Samoa",
        "San Marino",
        "Sao Tome and Principe",
        "Saudi Arabia",
        "Senegal",
        "Serbia",
        "Seychelles",
        "Sierra Leone",
        "Singapore",
        "Sint Maarten (Dutch part)",
        "Slovakia",
        "Slovenia",
        "Solomon Islands",
        "Somalia",
        "South Africa",
        "South Georgia and the South Sandwich Islands",
        "South Sudan",
        "Spain",
        "Sri Lanka",
        "Sudan (the)",
        "Suriname",
        "Svalbard and Jan Mayen",
        "Sweden",
        "Switzerland",
        "Syrian Arab Republic",
        "Taiwan",
        "Tajikistan",
        "Tanzania, United Republic of",
        "Thailand",
        "Timor-Leste",
        "Togo",
        "Tokelau",
        "Tonga",
        "Trinidad and Tobago",
        "Tunisia",
        "Turkey",
        "Turkmenistan",
        "Turks and Caicos Islands (the)",
        "Tuvalu",
        "Uganda",
        "Ukraine",
        "United Arab Emirates (the)",
        "United Kingdom of Great Britain and Northern Ireland (the)",
        "United States Minor Outlying Islands (the)",
        "United States of America (the)",
        "Uruguay",
        "Uzbekistan",
        "Vanuatu",
        "Venezuela (Bolivarian Republic of)",
        "Viet Nam",
        "Virgin Islands (British)",
        "Virgin Islands (U.S.)",
        "Wallis and Futuna",
        "Western Sahara",
        "Yemen",
        "Zambia",
        "Zimbabwe",
        "Åland Islands");
?>
<?php 
$customer = $this->getCustomer();
$address = $this->getAddress();
?> 
<form action="<?php echo $this->getUrl('save','customer',['id'=>$customer->customer_id],true) ?>" method="POST">
        <table border="1" width="100%" cellspacing="4">
                <tr>
                        <td colspan="2"><b>Personal Information</b></td>
                </tr>
                <tr>
                        <td width="10%">First Name</td>
                        <td><input type="text" name="customer[firstName]" value=<?php echo $customer->firstName ?>></td>
                </tr>
                
                <tr>
                        <td width="10%">Last Name</td>
                        <td><input type="text" name="customer[lastName]" value=<?php echo $customer->lastName ?>></td>
                </tr>
                <tr>
                        <td width="10%">Email</td>
                        <td><input type="text" name="customer[email]" value=<?php echo $customer->email ?>></td>
                </tr>
                <tr>
                        <td width="10%">Mobile</td>
                        <td><input type="text" name="customer[mobile]" value=<?php echo $customer->mobile ?>></td>
                </tr>
                <tr>
                        <td width="10%">Status</td>
			<td>
				<select name="customer[status]">
					<option value="1" <?php echo ($this->getStatus($customer->status)=='Enabel')?'selected':'' ?>>Enabel</option>
					<option value="2" <?php echo ($this->getStatus($customer->status)=='Disabled')?'selected':'' ?>>Disabled</option>
				</select>			
			</td>
                </tr>
                <tr>
                        <td colspan="2"><b>Address Information</b></td>
                </tr>
                <tr>
                        <td width="10%">Address</td>
                        <td><input type="text" name="address[address]" value=<?php echo $address->address; ?>></td>
                </tr>
                
                <tr>
                        <td width="10%">City</td>
                        <td><input type="text" name="address[city]" value=<?php echo $address->city; ?>></td>
                </tr>
                <tr>
                        <td width="10%">State</td>
                        <td><input type="text" name="address[state]" value=<?php echo $address->state; ?>></td>
                </tr>
                <tr>
                        <td width="10%">Postal Code</td>
                        <td><input type="text" name="address[postalCode]" value=<?php echo $address->postalCode; ?>></td>
                </tr>
                <tr>
                        <td width="10%">Country</td>
                        <td>
                                <select  name="address[country]">
                                        <option>select</option>
                                        <?php for($i=0;$i<=count($countryList)-1;$i++){ ?>
                                                <?php $select = ($countryList[$i] == $address->country) ? 'selected' : ''; ?>
                                                <option value=<?php echo $countryList[$i]; ?> <?php echo $select; ?>><?php echo $countryList[$i]; ?></option>
                                        <?php } ?>
                                </select>
                        </td>
                </tr>
                <tr>
                        <td width="10%">Biling</td>
                        <?php $checked = ($address->biling == 1) ? 'checked' : ''; ?>
                        <td><input type="checkbox" name="address[biling]" value="1" <?php echo $checked; ?>> is Biling</td>
                </tr>
                <tr>
                        <td width="10%">Shiping</td>
                        <?php $checked1 = ($address->shiping == 1) ? 'checked' : ''; ?>
                        <td><input type="checkbox" name="address[shiping]" value="1" <?php echo $checked1; ?>> is Shiping</td>
                </tr>
                <tr>
                        <td width="10%">&nbsp;</td>
                        <td>
                                <input type="submit" name="submit" value="save">
                                <button type="button"><a href="<?php echo $this->getUrl('grid','customer'); ?>">Cancel</a></button>
                        </td>
                </tr>
                
        </table>	
</form>