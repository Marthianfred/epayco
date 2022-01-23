<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/soap/epayco/server',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:oper="http://localhost/soap/epayco/server">
    <soapenv:Header/>
    <soapenv:Body>
        <oper:Auth>
            <oper:user>soapsvr@epaycotest.com</oper:user>
            <oper:password>soaptestPass</oper:password>
        </oper:Auth>
    </soapenv:Body>
</soapenv:Envelope>',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/xml'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
