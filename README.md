<center><h2>Pix QRCode Estático - PHP</h2></center>
<p align="center"><a href="https://nintendo.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo%E2%80%94pix_powered_by_Banco_Central_%28Brazil%2C_2020%29.svg/2560px-Logo%E2%80%94pix_powered_by_Banco_Central_%28Brazil%2C_2020%29.svg.png" width="400" alt="Pix Logo"></a></p>

## PIX
Pix é um modo de transferência monetária instantâneo e de pagamento eletrônico instantâneo em real brasileiro, oferecido pelo Banco Central do Brasil a pessoas físicas e jurídicas, que funciona 24 horas, ininterruptamente, sendo o mais recente meio de pagamento do Sistema de Pagamentos Brasileiro.

## PIX e QRCode
O QR Code dinâmico e o QR Code estático, enquanto mecanismos para envio ou disponibilização prévia
de informações para fins de iniciação de um Pix, seguirão o padrão do BR Code, nos termos do Manual
do BR Code1. Nesses casos, o usuário recebedor disponibiliza os dados de pagamento em um QR Code, para ser capturado por imagem pelo usuário pagador.
Podem atuar na emissão de QR Code o prestador de serviços de pagamento (PSP) do recebedor, a
Secretaria do Tesouro Nacional (STN) e, em casos de uso específicos, órgãos do governo federal2
,
enquanto usuários finais do Pix, desde que possuam contrato firmado com o BCB para fins de utilização
do Sisbacen e que apresentem a certificação de segurança requerida para essa finalidade3
.
O aplicativo do PSP do usuário pagador, que deve estar instalado em seu dispositivo móvel e que é
utilizado para a leitura do QR Code, acessará o backend4 do PSP do pagador, que gera a ordem de
pagamento.

## Definições Gerais do BRCode

Conforme especificado no Manual do BR Code, o Pix precisa definir seu GUI (identificador único do
arranjo) para ser utilizado ao longo dos IDs 

| GUI Do Pix | Valor | Tamanho
|------|-----------|-----------
| GUI - Globally Unique Identifier |   br.gov.bcb.pix     | 14 Caracteres

O QR Code estático no Pix conterá o seguinte conjunto de informações:
| ID | Nome BR Code | Tamanho | Valor
|------|-----------|-----------|-----------
| 00|  Payload Format Indicator   | 02 | 01
| 26|  Merchant Account Information   | 58 | GUI + Chave
| 52|  Merchant Category Code  | 04 | 0000
| 53|  Transaction Currency   | 03 | 986
| 58|  Country Code  | 02 | BR
| 59|  Merchant Name  | 13 | Fulano de Tal
| 60|  Merchant City  | 08 | Brasilia
| 62|  Aditional Field Data Template  | 07 | ID + nome + tamanho + valor
|63|  CRC 16  | 04 | 0x1D3D – incluindo “6304” (ID 63 e tamanho 04)

Em nosso código PHP adicionamos o ID em constantes:
```php
    const ID_PAYLOAD_FORMAT_INDICATOR = '00';
    const ID_MERCHANT_ACCOUNT_INFORMATION = '26';
    const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
    const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
    const ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';
    const ID_MERCHANT_CATEGORY_CODE = '52';
    const ID_TRANSACTION_CURRENCY = '53';
    const ID_TRANSACTION_AMOUNT = '54';
    const ID_COUNTRY_CODE = '58';
    const ID_MERCHANT_NAME = '59';
    const ID_MERCHANT_CITY = '60';
    const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
    const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';
    const ID_CRC16 = '63';
```

## CRC16
O CRC16 é usado para verificar se os dados enviados na transação foram corrompidos ou alterados durante a transmissão. Se houver alguma discrepância no código CRC16 recebido, a transação é considerada inválida e não é processada. em nosso código utilizamos o seguinte metódo para Calculo do CRC16 com constantes hexadecimal que são definidas pela documentação do PIX

```php
 private function getCRC16($payload) {
        //ADICIONA DADOS GERAIS NO PAYLOAD
        $payload .= self::ID_CRC16.'04';
  
        //DADOS DEFINIDOS PELO BACEN
        $polinomio = 0x1021;
        $resultado = 0xFFFF;
  
        //CHECKSUM
        if (($length = strlen($payload)) > 0) {
            for ($offset = 0; $offset < $length; $offset++) {
                $resultado ^= (ord($payload[$offset]) << 8);
                for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                    if (($resultado <<= 1) & 0x10000) $resultado ^= $polinomio;
                    $resultado &= 0xFFFF;
                }
            }
        }
  
        //RETORNA CÓDIGO CRC16 DE 4 CARACTERES
        return self::ID_CRC16.'04'.strtoupper(dechex($resultado));
    }
```



