<?php

$client = new SoapClient('http://dmmr.ddns.com.br:82/dmm_teste/AmbiOneWebService.asmx?WSDL'); //endere�o principal do WebService (obs: "?WSDL" no final deste endere�o.)
$function = 'WS_Download_Mobile_Tecnico'; //p�gina da fun��o (?op=PaginaDaFuncao)
$arguments= array('WS_Download_Mobile_Tecnico' => array(
'_xstrLogin' => 'AMBIONE',
'_xstrSenha' => 'DMM',
'_xstrEmpresaCNPJ' => '08899526000167',
'_xintRegistroInicial' => 0,
'_xintRegistroFinal' => 100
));
$options = array('location' => 'http://dmmr.ddns.com.br:82/dmm_teste/AmbiOneWebService.asmx');
$result = $client->__soapCall($function, $arguments, $options);
echo 'Response: ';
print_r($result);

?>