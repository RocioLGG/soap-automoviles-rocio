<?php
// Clase para el cliente SOAP de automóviles
class ClientAutomoviles {
    private $instance;

    public function __construct() {
        $params = array(
            'location' => 'http://localhost/soap-automoviles/service-automoviles.php',
            'uri' => 'urn://localhost/soap-automoviles/service-automoviles.php',
            'trace' => 1
        );

        $this->instance = new SoapClient(null, $params);

        $auth_params = new stdClass();
        $auth_params->username = 'ies';
        $auth_params->password = 'daw';

        $header_params = new SoapVar($auth_params, SOAP_ENC_OBJECT);
        $header = new SoapHeader('http://localhost/soap-automoviles/', 'authenticate', $header_params, false);
        $this->instance->__setSoapHeaders(array($header));
    }

}
?>