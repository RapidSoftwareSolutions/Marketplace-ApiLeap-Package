<?php

$app->post('/api/ApiLeap/getImageFromHtml', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessKey','html']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['accessKey'=>'access_key','html'=>'html'];
    $optionalParams = ['ttl'=>'ttl','fresh'=>'fresh','fullPage'=>'full_page','width'=>'width','height'=>'height','delay'=>'delay','format'=>'format','css'=>'css'];
    $bodyParams = [
       'form_params' => ['access_key','html','ttl','fresh','full_page','width','height','delay','format','css']
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    

    $client = $this->httpClient;
    $query_str = "https://apileap.com/api/screenshot/v1/htmltoimage";

    

    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $requestParams['headers'] = [];

    $format = (!empty($data['format'])) ? $data['format'] : $format = 'jpeg';
    try {
        $resp = $client->get($query_str, $requestParams);
        $responseBody = $resp->getBody()->getContents();

        if ($resp->getStatusCode() == 200) {
            $size = $resp->getHeader('Content-Length')[0];

            $uploadServiceResponse = $client->post($settings['uploadServiceUrl'], [
                'multipart' => [
                    [
                        'name' => 'length',
                        'contents' => $size
                    ],
                    [
                        "name" => "file",
                        "filename" => "capture.$format",
                        "contents" => $responseBody
                    ]
                ]
            ]);
            $uploadServiceResponseBody = $uploadServiceResponse->getBody()->getContents();
            if ($uploadServiceResponse->getStatusCode() == 200) {
                $result['callback'] = 'success';
                $result['contextWrites']['to'] = json_decode($uploadServiceResponse->getBody());
            }
            else {
                $result['callback'] = 'error';
                $result['contextWrites']['to']['status_code'] = 'API_ERROR';
                $result['contextWrites']['to']['status_msg'] = is_array($uploadServiceResponseBody) ? $uploadServiceResponseBody : json_decode($uploadServiceResponseBody);
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }
    } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $exception->getResponse()->getBody()->getContents();
    }
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});