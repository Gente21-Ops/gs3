<?php

//fecha 2014-03-29T13:50:10

function makexml(
    $fecha,
    $forpago,
    $metpago,
    $subtotal,
    $total,
    $lugarexp,
    $sello,
    $em_nombre,
    $em_rfc,
    $em_calle,
    $em_numext,
    $em_col,
    $em_loc,
    $em_ref,
    $em_mun,
    $em_estado,
    $em_pais,
    $em_cp,
    $em_regimen,
    $re_nombre,
    $re_rfc,
    $re_calle,
    $re_numext,
    $re_col,
    $re_loc,
    $re_ref,
    $re_mun,
    $re_estado,
    $re_pais,
    $re_cp,
    $conc,
    $im_trans,
    $im_transimp,
    $u_user,
    $u_pass
    ){

    $sweet = '<?xml version="1.0" encoding="UTF-8"?>
    <SOAP-ENV:Envelope xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="wis.soap.stamp" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
        <SOAP-ENV:Header/>
        <ns0:Body>
            <ns1:stamp>
                <ns1:xml><cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd   " version="3.2" folio="1" fecha="'.$fecha.'" formaDePago="'.$forpago.'" noCertificado="20001000000200000293" certificado="MIIE2jCCA8KgAwIBAgIUMjAwMDEwMDAwMDAyMDAwMDAyOTMwDQYJKoZIhvcNAQEFBQAwggFcMRowGAYDVQQDDBFBLkMuIDIgZGUgcHJ1ZWJhczEvMC0GA1UECgwmU2VydmljaW8gZGUgQWRtaW5pc3RyYWNpw7NuIFRyaWJ1dGFyaWExODA2BgNVBAsML0FkbWluaXN0cmFjacOzbiBkZSBTZWd1cmlkYWQgZGUgbGEgSW5mb3JtYWNpw7NuMSkwJwYJKoZIhvcNAQkBFhphc2lzbmV0QHBydWViYXMuc2F0LmdvYi5teDEmMCQGA1UECQwdQXYuIEhpZGFsZ28gNzcsIENvbC4gR3VlcnJlcm8xDjAMBgNVBBEMBTA2MzAwMQswCQYDVQQGEwJNWDEZMBcGA1UECAwQRGlzdHJpdG8gRmVkZXJhbDESMBAGA1UEBwwJQ295b2Fjw6FuMTQwMgYJKoZIhvcNAQkCDCVSZXNwb25zYWJsZTogQXJhY2VsaSBHYW5kYXJhIEJhdXRpc3RhMB4XDTEyMTAyNjE5MjI0M1oXDTE2MTAyNjE5MjI0M1owggFTMUkwRwYDVQQDE0BBU09DSUFDSU9OIERFIEFHUklDVUxUT1JFUyBERUwgRElTVFJJVE8gREUgUklFR08gMDA0IERPTiBNQVJUSU4gMWEwXwYDVQQpE1hBU09DSUFDSU9OIERFIEFHUklDVUxUT1JFUyBERUwgRElTVFJJVE8gREUgUklFR08gMDA0IERPTiBNQVJUSU4gQ09BSFVJTEEgWSBOVUVWTyBMRU9OIEFDMUkwRwYDVQQKE0BBU09DSUFDSU9OIERFIEFHUklDVUxUT1JFUyBERUwgRElTVFJJVE8gREUgUklFR08gMDA0IERPTiBNQVJUSU4gMSUwIwYDVQQtExxBQUQ5OTA4MTRCUDcgLyBIRUdUNzYxMDAzNFMyMR4wHAYDVQQFExUgLyBIRUdUNzYxMDAzTURGUk5OMDkxETAPBgNVBAsTCFNlcnZpZG9yMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDlrI9loozd+UcW7YHtqJimQjzX9wHIUcc1KZyBBB8/5fZsgZ/smWS4Sd6HnPs9GSTtnTmM4bEgx28N3ulUshaaBEtZo3tsjwkBV/yVQ3SRyMDkqBA2NEjbcum+e/MdCMHiPI1eSGHEpdESt55a0S6N24PW732Xm3ZbGgOp1tht1wIDAQABox0wGzAMBgNVHRMBAf8EAjAAMAsGA1UdDwQEAwIGwDANBgkqhkiG9w0BAQUFAAOCAQEAuoPXe+BBIrmJn+IGeI+m97OlP3RC4Ct3amjGmZICbvhI9BTBLCL/PzQjjWBwU0MG8uK6e/gcB9f+klPiXhQTeI1YKzFtWrzctpNEJYo0KXMgvDiputKphQ324dP0nzkKUfXlRIzScJJCSgRw9ZifKWN0D9qTdkNkjk83ToPgwnldg5lzU62woXo4AKbcuabAYOVoC7owM5bfNuWJe566UzD6i5PFY15jYMzi1+ICriDItCv3S+JdqyrBrX3RloZhdyXqs2Htxfw4b1OcYboPCu4+9qM3OV02wyGKlGQMhfrXNwYyj8huxS1pHghEROM2Zs0paZUOy+6ajM+Xh0LX2w==" condicionesDePago="Sera marcada como pagada en cuanto el receptor haya cubierto el pago." subTotal="'.$subtotal.'" Moneda="pesos" total="'.$total.'" metodoDePago="'.$metpago.'" tipoDeComprobante="ingreso" LugarExpedicion="'.$lugarexp.'" sello="'.$sello.'">
        <cfdi:Emisor nombre="'.$em_nombre.'" rfc="'.$em_rfc.'">
            <cfdi:DomicilioFiscal calle="'.$em_calle.'" noExterior="'.$em_numext.'" colonia="'.$em_col.'" localidad="'.$em_loc.'" referencia="'.$em_ref.'" municipio="'.$em_mun.'" estado="'.$em_estado.'" pais="'.$em_pais.'" codigoPostal="'.$em_cp.'" />
            <cfdi:ExpedidoEn calle="'.$em_nombre.'" referencia="'.$em_ref.'" noExterior="'.$em_numext.'" colonia="'.$em_col.'" localidad="'.$em_loc.'" municipio="'.$em_mun.'" estado="'.$em_estado.'" pais="'.$em_pais.'" codigoPostal="'.$em_cp.'" />
            <cfdi:RegimenFiscal Regimen="'.$em_regimen.'" />
        </cfdi:Emisor>
        <cfdi:Receptor nombre="'.$re_nombre.'" rfc="'.$re_rfc.'">
            <cfdi:Domicilio calle="'.$re_calle.'" noExterior="'.$re_numext.'" colonia="'.$re_col.'" localidad="'.$re_loc.'" referencia="'.$re_ref.'" municipio="'.$re_mun.'" estado="'.$re_estado.'" pais="'.$re_pais.'" codigoPostal="'.$re_cp.'" />
        </cfdi:Receptor>
        <cfdi:Conceptos>
            <cfdi:Concepto cantidad="2" unidad="Pieza" noIdentificacion="SUN" descripcion="Prada Sunglasses-Prada Sun Glasses Aviator" valorUnitario="5500.00" importe="11000.00">
                <cfdi:ComplementoConcepto />
            </cfdi:Concepto>
        </cfdi:Conceptos>
        <cfdi:Impuestos totalImpuestosTrasladados="'.$im_trans.'">
            <cfdi:Traslados>
                <cfdi:Traslado importe="'.$im_transimp.'" tasa="16.00" impuesto="IVA" />
            </cfdi:Traslados>
        </cfdi:Impuestos>
        <cfdi:Complemento />
    </cfdi:Comprobante>
                </ns1:xml>
                <ns1:username>'.$u_user.'</ns1:username>
                <ns1:password>'.$u_pass.'</ns1:password>
            </ns1:stamp>
        </ns0:Body>
    </SOAP-ENV:Envelope>
    ';
}

makexml(
    $_POST['fecha'],
    $_POST['forpago'],
    $_POST['metpago'],
    $_POST['subtotal'],
    $_POST['total'],
    $_POST['lugarexp'],
    $_POST['sello'],
    $_POST['em_nombre'],
    $_POST['em_rfc'],
    $_POST['em_calle'],
    $_POST['em_numext'],
    $_POST['em_col'],
    $_POST['em_loc'],
    $_POST['em_ref'],
    $_POST['em_mun'],
    $_POST['em_estado'],
    $_POST['em_pais'],
    $_POST['em_cp'],
    $_POST['em_regimen'],
    $_POST['re_nombre'],
    $_POST['re_rfc'],
    $_POST['re_calle'],
    $_POST['re_numext'],
    $_POST['re_col'],
    $_POST['re_ref'],
    $_POST['re_mun'],
    $_POST['re_estado'],
    $_POST['re_pais'],
    $_POST['re_cp'],
    $_POST['conc'],
    $_POST['im_trans'],
    $_POST['im_transimp'],
    $_POST['u_user'],
    $_POST['u_pass']
    );
?>