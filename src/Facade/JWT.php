<?php


namespace App\Facade;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class JWT
{

    public static function encode(?UserInterface $user)
    {
        $header = [
            "type" => "JWT",
            "alg" => "HS256"
        ];

        $headerString = str_replace('==', '', base64_encode(utf8_encode(json_encode($header))));

        $payload = ["test" => "test"];
        $payload = json_encode($payload);

        $payloadString = str_replace('==', '', base64_encode(utf8_encode(json_encode($payload))));

        $secret = "APPLICATION_SECRET";

        $signatureString = hash_hmac('sha256', $headerString . '.' . $payloadString, $secret);
        return $headerString . '.' . $payloadString . '.' . $signatureString;
    }

    public static function decode(string $jwtToken)
    {
        $parts = explode('.', $jwtToken);

        $header = utf8_decode(json_decode($parts[0], true));

        $payload = utf8_decode(json_decode($parts[1], true));

        return [
            "header" => $header,
            "payload" => $payload
        ];

    }
}