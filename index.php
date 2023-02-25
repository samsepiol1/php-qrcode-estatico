<?php
    require __DIR__. '/vendor/autload.php';


    use \App\Pix\Payload;
    use Mpdf\QrCode\QrCode;
    use Mpdf\QrCode\Output;

    //Instância Principal


    //Codigo de Pagamento

    $obPayload = (new Payload) -> setPixKey('1234567890');

    $payloadQrCode = $obPayload -> getPayload();

    $obQrCode = new Qrcode($payloadQrCode);

    $image = (new Output\Png) -> output($obQrCode, 400);

    header('Content-Type: image/png');

?>