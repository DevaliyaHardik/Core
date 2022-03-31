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

$bilingAddress = $this->getBilingAddress();
$shipingAddress = $this->getShipingAddress();
?>

<table border="1" width="100%" cellspacing="4">
    <tr>
        <td colspan="2"><b>Biling Address</b></td>
    </tr>
    <tr>
        <td width="10%">Address</td>
        <td><input type="text" id = "address" name="bilingAddress[address]" value=<?php echo $bilingAddress->address; ?>></td>
    </tr> 
    <tr>
        <td width="10%">City</td>
        <td><input type="text" id="city" name="bilingAddress[city]" value=<?php echo $bilingAddress->city; ?>></td>
    </tr>
    <tr>
        <td width="10%">State</td>
        <td><input type="text" id="state" name="bilingAddress[state]" value=<?php echo $bilingAddress->state; ?>></td>
    </tr>
    <tr>
        <td width="10%">Postal Code</td>
        <td><input type="text" id="postalCode" name="bilingAddress[postalCode]" value=<?php echo $bilingAddress->postalCode; ?>></td>
        <input type="hidden" name="bilingAddress[biling]" value="1">
        <input type="hidden" name="bilingAddress[shiping]" value="2">
    </tr>
    <tr>
        <td width="10%">Country</td>
        <td>
            <select  id="country" name="bilingAddress[country]">
                <option>select</option>
                <?php for($i=0;$i<=count($countryList)-1;$i++){ ?>
                        <?php $select = ($countryList[$i] == $bilingAddress->country) ? 'selected' : ''; ?>
                        <option value=<?php echo $countryList[$i]; ?> <?php echo $select; ?>><?php echo $countryList[$i]; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><input type="checkbox" id="hardik" onclick="same()">same as Biling</td>
    </tr>
    
    <tr>
        <td colspan="2"><b>Shiping Address</b></td>
    </tr>
    <tr>
            <td width="10%">Address</td>
            <td><input type="text" id = "address1" name="shipingAddress[address]" value=<?php echo $shipingAddress->address; ?>></td>
    </tr>
    
    <tr>
            <td width="10%">City</td>
            <td><input type="text" id="city1" name="shipingAddress[city]" value=<?php echo $shipingAddress->city; ?>></td>
    </tr>
    <tr>
            <td width="10%">State</td>
            <td><input type="text" id="state1" name="shipingAddress[state]" value=<?php echo $shipingAddress->state; ?>></td>
    </tr>
    <tr>
            <td width="10%">Postal Code</td>
            <td><input type="text" id="postalCode1" name="shipingAddress[postalCode]" value=<?php echo $shipingAddress->postalCode; ?>></td>
            <input type="hidden" name="shipingAddress[shiping]" value="1">
            <input type="hidden" name="shipingAddress[biling]" value="2">
    </tr>
    <tr>
            <td width="10%">Country</td>
            <td>
                    <select id="country1" name="shipingAddress[country]">
                            <option>select</option>
                            <?php for($i=0;$i<=count($countryList)-1;$i++){ ?>
                                    <?php $select = ($countryList[$i] == $shipingAddress->country) ? 'selected' : ''; ?>
                                    <option value=<?php echo $countryList[$i]; ?> <?php echo $select; ?>><?php echo $countryList[$i]; ?></option>
                            <?php } ?>
                    </select>
            </td>
    </tr>
    <tr>
        <td width="10%">&nbsp;</td>
        <td>
            <input type="button" id="customerAddressSubmitBtn" name="submit" value="save">
            <button type="button" id="customerGridBlockBtn">Cancel</button>
        </td>
    </tr>
</table>	
<script type="text/javascript">
    function same() {
            var checkedBox = document.getElementById("hardik");
            if(checkedBox.checked == true){
                    var address = document.getElementById("address").value;
                    var city = document.getElementById("city").value;
                    var state = document.getElementById("state").value;
                    var postalCode = document.getElementById("postalCode").value;
                    var country = document.getElementById("country").value;

                    document.getElementById("address1").value = address; 
                    document.getElementById("city1").value = city; 
                    document.getElementById("state1").value = state; 
                    document.getElementById("postalCode1").value = postalCode; 
                    document.getElementById("country1").value = country; 
            }
            else{
                    document.getElementById("address1").value = null; 
                    document.getElementById("city1").value = null; 
                    document.getElementById("state1").value = null; 
                    document.getElementById("postalCode1").value = null; 
                    document.getElementById("country1").value = null; 
            }
    }
</script>
<script>
    $("#customerAddressSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#customerGridBlockBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>

