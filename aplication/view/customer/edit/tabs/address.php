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

<section class="content">
    <div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Biling Address</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                <label for="exampleInputAddress1">Address</label>
                <input type="text" name="bilingAddress[address]" id="address" value="<?php echo $bilingAddress->address ?>" class="form-control" id="exampleInputAddress1" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                <label for="exampleInputCity1">City</label>
                <input type="text" name="bilingAddress[city]" id="city" value="<?php echo $bilingAddress->city ?>" class="form-control" id="exampleInputCity1" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                <label for="exampleInputState1">State</label>
                <input type="text" name="bilingAddress[state]" id="state" value="<?php echo $bilingAddress->state ?>" class="form-control" id="exampleInputState1" placeholder="Enter Email">
                </div>
                <div class="form-group">
                <label for="exampleInputPosatalCode1">Postal Code</label>
                <input type="number" name="bilingAddress[postalCode]" id="postalCode" value="<?php echo $bilingAddress->postalCode ?>" class="form-control" id="exampleInputPosatalCode1" placeholder="Enter Email">
                </div>
                <div class="row">
                <div class="col-sm-12">
                    <!-- select -->
                    <div class="form-group">
                    <label>Country</label>
                    <select class="form-control" name="bilingAddress[country]" id="country">
                    <option>select</option>
                    <?php for($i=0;$i<=count($countryList)-1;$i++): ?>
                        <?php $select = ($countryList[$i] == $bilingAddress->country) ? 'selected' : ''; ?>
                        <option value=<?php echo $countryList[$i]; ?> <?php echo $select; ?>><?php echo $countryList[$i]; ?></option>
                    <?php endfor; ?>
                    </select>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body">
                <input type="checkbox" name="hardik" id="hardik" onclick="same()">Same as Biling Address
            </div>
            <div class="card-header">
            <h3 class="card-title">Shiping Address</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                <label for="exampleInputAddress1">Address</label>
                <input type="text" name="shipingAddress[address]" id="address1" value="<?php echo $shipingAddress->address ?>" class="form-control" id="exampleInputAddress1" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                <label for="exampleInputCity1">City</label>
                <input type="text" name="shipingAddress[city]" id="city1" value="<?php echo $shipingAddress->city ?>" class="form-control" id="exampleInputCity1" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                <label for="exampleInputState1">State</label>
                <input type="text" name="shipingAddress[state]" id="state1" value="<?php echo $shipingAddress->state ?>" class="form-control" id="exampleInputState1" placeholder="Enter Email">
                </div>
                <div class="form-group">
                <label for="exampleInputPosatalCode1">Postal Code</label>
                <input type="number" name="shipingAddress[postalCode]" id="postalCode1" value="<?php echo $shipingAddress->postalCode ?>" class="form-control" id="exampleInputPosatalCode1" placeholder="Enter Email">
                </div>
                <div class="row">
                <div class="col-sm-12">
                    <!-- select -->
                    <div class="form-group">
                    <label>Country</label>
                    <select class="form-control" name="shipingAddress[country]" id="country1">
                    <option>select</option>
                    <?php for($i=0;$i<=count($countryList)-1;$i++): ?>
                        <?php $select = ($countryList[$i] == $shipingAddress->country) ? 'selected' : ''; ?>
                        <option value=<?php echo $countryList[$i]; ?> <?php echo $select; ?>><?php echo $countryList[$i]; ?></option>
                    <?php endfor; ?>
                    </select>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="button" id="customerAddressSubmitBtn" class="btn btn-primary" name="submit" value="save">
                <button type="button" id="customerGridBlockBtn" class="btn btn-primary" >Cancel</button>
            </div>
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

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

