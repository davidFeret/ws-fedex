<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
// Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
// Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->load->view('welcome_message');
		$this->load->view('index');
	}

	public function getShippingCost()
	{
		$this->load->helper('credentials_helper');
		$this->load->helper('common_functions_helper');

		$this->load->library('ServiceType');

		$pathToWsdl = "http://localhost/fedex/ws/RateService.wsdl";
		
		// Create soap client
		$client = new SoapClient($pathToWsdl, array('trace' => 1)); 

		// Data for the request (info is on common-functions)
		$rateRequest['WebAuthenticationDetail'] = array(
			'UserCredential' => array(
				'Key' => FEDEX_KEY, 
				'Password' => FEDEX_PASSWORD
			)
		); 
		$rateRequest['ClientDetail'] = array(
			'AccountNumber' => FEDEX_ACCOUNT_NUMBER, 
			'MeterNumber' => FEDEX_METER_NUMBER
		);
		$rateRequest['TransactionDetail'] = array('CustomerTransactionId' => 'Detalles de la transacción');
		$rateRequest['Version'] = getProperty('version');
		$rateRequest['ReturnTransitAndCommit'] = true;

		// Valid values: REGULAR_PICKUP, REQUEST_COURIER, ...
		$rateRequest['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; 
		
		/** Search for only one kind service type */
		// $rateRequest['RequestedShipment']['ServiceType'] = ServiceType::FEDEX_GROUND;

		$rateRequest['RequestedShipment']['ShipTimestamp'] = date('c');

		$rateRequest['RequestedShipment']['Shipper'] = getAddressFormat($this->input->post('shipping'));
		$rateRequest['RequestedShipment']['Recipient'] = getAddressFormat($this->input->post('recipient'));
		// $rateRequest['RequestedShipment']['ShippingChargesPayment'] = array(
		// 	'PaymentType' => 'SENDER',
		// 	'Payor' => array(
		// 		'ResponsibleParty' => array(
		// 			'AccountNumber' => FEDEX_ACCOUNT_NUMBER,
		// 			'Contact' => null,
		// 			'Address' => getProperty('address3')
		// 		)
		// 	)
		// );
		$rateRequest['RequestedShipment']['PackageCount'] = '2';

		$rateRequest['RequestedShipment']['RequestedPackageLineItems'] = $this->input->post('data');
		
		$rateRequest['RequestedShipment']['PreferredCurrency'] = 'NMP';
		$rateRequest['RequestedShipment']['RateRequestTypes'] = 'PREFERRED';

		// echo json_encode($this->ServiceType->FEDEX_GROUND);
		try {
			if(setEndpoint('changeEndpoint')){
				$newLocation = $client->__setLocation(setEndpoint('endpoint'));
			}
			
			$response = $client->getRates($rateRequest);

			// SUCCESS: 0, NOTE: 441
			echo json_encode( array(
				'ok' => true,
				'data' => $response
			));
		} catch (SoapFault $exception) {
			echo json_encode(array(
				'ok' => false,
				'error' => $exception,
			));  
		}
	}
}
