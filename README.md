<center><h2>Pix QRCode Estático - PHP</h2></center>
<p align="center"><a href="https://nintendo.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo%E2%80%94pix_powered_by_Banco_Central_%28Brazil%2C_2020%29.svg/2560px-Logo%E2%80%94pix_powered_by_Banco_Central_%28Brazil%2C_2020%29.svg.png" width="400" alt="Nintendo Logo"></a></p>

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
| GUI do PIX | Valor |Tamanho|
|------|-----------| 
| 0x0 | Source | |     14 caracteres   
