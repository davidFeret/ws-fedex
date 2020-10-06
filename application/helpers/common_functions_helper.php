<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('Newline',"<br />");
// Copyright 2009, FedEx Corporation. All rights reserved.

/**
 * This section provides a convenient place to setup many commonly used variables
 * needed for the php sample code to function.
 */
function getProperty($var) {

    if($var == 'key') Return 'rscqm75MLampLUuV'; 
    if($var == 'password') Return '8rTZHQ6vbyOsGOgtwMXrZ1kIU'; 

    if($var == 'parentkey') Return 'Hb1TfWMygUh7bbHP'; 
    if($var == 'parentpassword') Return 'u0mnYl8d6FRQK5Ot8SyxMXVqq'; 

    if($var == 'shipaccount') Return '510087267';
    if($var == 'billaccount') Return '510087267';
    if($var == 'dutyaccount') Return '510087267'; 
    if($var == 'freightaccount') Return '510087267';  
    if($var == 'trackaccount') Return '510087267'; 
    if($var == 'dutiesaccount') Return '510087267';
    if($var == 'importeraccount') Return '510087267';
    if($var == 'brokeraccount') Return '510087267';
    if($var == 'distributionaccount') Return '510087267';

    if($var == 'meter') Return '118511895';
    if($var == 'locationid') Return 'PLBA';
    if($var == 'printlabels') Return true;
    if($var == 'printdocuments') Return true;
    if($var == 'packagecount') Return '4';
    if($var == 'validateaccount') Return 'XXX';

    if($var == 'shiptimestamp') Return mktime(10, 0, 0, date("m"), date("d")+1, date("Y"));

    if($var == 'spodshipdate') Return '2018-05-08';
    if($var == 'serviceshipdate') Return '2018-05-07';
    if($var == 'shipdate') Return '2018-05-08';

    if($var == 'readydate') Return '2014-12-15T08:44:07';
    //if($var == 'closedate') Return date("Y-m-d");
    if($var == 'closedate') Return '2016-04-18';
    if($var == 'pickupdate') Return date("Y-m-d", mktime(8, 0, 0, date("m")  , date("d")+1, date("Y")));
    if($var == 'pickuptimestamp') Return mktime(8, 0, 0, date("m")  , date("d")+1, date("Y"));
    if($var == 'pickuplocationid') Return 'SQLA';
    if($var == 'pickupconfirmationnumber') Return '1';

    if($var == 'dispatchdate') Return date("Y-m-d", mktime(8, 0, 0, date("m")  , date("d")+1, date("Y")));
    if($var == 'dispatchlocationid') Return 'NQAA';
    if($var == 'dispatchconfirmationnumber') Return '4';		

    if($var == 'tag_readytimestamp') Return mktime(10, 0, 0, date("m"), date("d")+1, date("Y"));
    if($var == 'tag_latesttimestamp') Return mktime(20, 0, 0, date("m"), date("d")+1, date("Y"));	

    if($var == 'expirationdate') Return date("Y-m-d", mktime(8, 0, 0, date("m"), date("d")+15, date("Y")));
    if($var == 'begindate') Return '2014-10-16';
    if($var == 'enddate') Return '2014-10-16';	

    if($var == 'trackingnumber') Return 'XXX';

    if($var == 'hubid') Return '5531';

    if($var == 'jobid') Return 'XXX';

    if($var == 'searchlocationphonenumber') Return '5555555555';
    if($var == 'customerreference') Return '39589';

    /** Direcciones: Se pueden borrar */
    if($var == 'shipper') Return array(
		'StreetLines' => array('Una calle cualquiera'),
		'City' => 'Escuinapa',
		'StateOrProvinceCode' => 'SI',
		'PostalCode' => '82400',
		'CountryCode' => 'MX'
	);
    if($var == 'recipient') Return array(
		'StreetLines' => array('Portales del Sol'),
		'City' => 'Mazatlán',
		'StateOrProvinceCode' => 'SI',
		'PostalCode' => '82154',
		'CountryCode' => 'MX'
	);	
    if($var == 'shipper_2') Return array(
        'Contact' => array(
            'PersonName' => 'Sender Name',
            'CompanyName' => 'Sender Company Name',
            'PhoneNumber' => '1234567890'
        ),
        'Address' => array(
            'StreetLines' => array('Addres \r  s Line 1'),
            'City' => 'Escuinapa',
            'StateOrProvinceCode' => 'QQ',
            'PostalCode' => '82127',
            'CountryCode' => 'MX',
            'Residential' => 1
        )
    );
    if($var == 'recipient_2') Return array(
        'Contact' => array(
            'PersonName' => 'Recipient Name',
            'CompanyName' => 'Recipient Company Name',
            'PhoneNumber' => '1234567890'
        ),
        'Address' => array(
            'StreetLines' => array('Portales'),
            'City' => 'Mazatlán',
            'StateOrProvinceCode' => 'QQ',
            'PostalCode' => '82154',
            'CountryCode' => 'MX'
        )
    );
    
    if($var == 'address1') Return array(
        'StreetLines' => array('10 Fed Ex Pkwy'),
        'City' => 'Memphis',
        'StateOrProvinceCode' => 'TN',
        'PostalCode' => '38115',
        'CountryCode' => 'US'
    );
    if($var == 'address2') Return array(
        'StreetLines' => array('13450 Farmcrest Ct'),
        'City' => 'Herndon',
        'StateOrProvinceCode' => 'VA',
        'PostalCode' => '20171',
        'CountryCode' => 'US'
    );					  
    if($var == 'address3') Return array(
        'StreetLines' => array('13450 Tsavo Street'),
        'City' => 'Herndon',
        'StateOrProvinceCode' => 'VA',
        'PostalCode' => '20170',
        'CountryCode' => 'US'
    );
    /** Direcciones: Se pueden borrar */		

    if($var == 'searchlocationsaddress') Return array(
        'StreetLines'=> array('240 Central Park S'),
        'City'=>'Austin',
        'StateOrProvinceCode'=>'TX',
        'PostalCode'=>'78701',
        'CountryCode'=>'US'
        );

    if($var == 'shippingchargespayment') Return array(
        'PaymentType' => 'SENDER',
        'Payor' => array(
            'ResponsibleParty' => array(
                'AccountNumber' => getProperty('billaccount'),
                'Contact' => null,
                'Address' => array('CountryCode' => 'US')
            )
        )
    );	
    if($var == 'freightbilling') Return array(
        'Contact'=>array(
            'ContactId' => 'freight1',
            'PersonName' => 'Big Shipper',
            'Title' => 'Manager',
            'CompanyName' => 'Freight Shipper Co',
            'PhoneNumber' => '1234567890'
        ),
        'Address'=>array(
            'StreetLines'=>array(
                '1202 Chalet Ln', 
                'Do Not Delete - Test Account'
            ),
            'City' =>'Harrison',
            'StateOrProvinceCode' => 'AR',
            'PostalCode' => '72601-6353',
            'CountryCode' => 'US'
        )
    );
    if($var == 'version') Return array(
        'ServiceId' => 'crs', 
        'Major' => '28', 
        'Intermediate' => '0', 
        'Minor' => '0'
    );
}

function getAddressFormat($address, $country = 'MX') {
    $addressObject['Address']['StreetLines']         = $address['street'];
    $addressObject['Address']['City']                = $address['city'];
    $addressObject['Address']['StateOrProvinceCode'] = getStateCode($address['state']);
    $addressObject['Address']['PostalCode']          = $address['cp'];
    $addressObject['Address']['CountryCode']         = $country;

    return $addressObject;
}

function setEndpoint($var){
	if($var == 'changeEndpoint') Return true;
	if($var == 'endpoint') Return 'https://wsbeta.fedex.com:443/web-services/dgds';
}

function getStateCode($state) {
    if    ($state == 'Aguascalientes')        { return 'AG'; }
    elseif($state == 'Baja California Norte') { return 'BC'; }
    elseif($state == 'Baja California Sur')   { return 'BS'; }
    elseif($state == 'Campeche')              { return 'CM'; }
    elseif($state == 'Chiapas')               { return 'CS'; }
    elseif($state == 'Chihuahua')             { return 'CH'; }
    elseif($state == 'Coahuila')              { return 'CO'; }
    elseif($state == 'Colima')                { return 'CL'; }
    elseif($state == 'Distrito Federal')      { return 'DF'; }
    elseif($state == 'Durango')               { return 'DG'; }
    elseif($state == 'Guanajuato')            { return 'GT'; }
    elseif($state == 'Guerrero')              { return 'GR'; }
    elseif($state == 'Hidalgo')               { return 'HG'; }
    elseif($state == 'Jalisco')               { return 'JA'; }
    elseif($state == 'Mexico')                { return 'MX'; }
    elseif($state == 'Michoacán')             { return 'MI'; }
    elseif($state == 'Morelos')               { return 'MO'; }
    elseif($state == 'Nayarit')               { return 'NA'; }
    elseif($state == 'Nuevo Leon')            { return 'NL'; }
    elseif($state == 'Oaxaca')                { return 'OA'; }
    elseif($state == 'Puebla')                { return 'PU'; }
    elseif($state == 'Querétaro')             { return 'QT'; }
    elseif($state == 'Quintana Roo')          { return 'QR'; }
    elseif($state == 'San Luis Potosi')       { return 'SL'; }
    elseif($state == 'Sinaloa')               { return 'SI'; }
    elseif($state == 'Sonora')                { return 'SO'; }
    elseif($state == 'Tabasco')               { return 'TB'; }
    elseif($state == 'Tamaulipas')            { return 'TM'; }
    elseif($state == 'Tlaxcala')              { return 'TL'; }
    elseif($state == 'Veracruz')              { return 'VE'; }
    elseif($state == 'Yucatan')               { return 'YU'; }
    elseif($state == 'Zacatecas')             { return 'ZA'; }
}