<html>
    <meta charset="UTF-8"/>
    <style type="text/css">
        @page {
            margin: 5px;
            padding:0px;
        }
        body{
            margin:5px;
            padding:0px;
            font-size: 0.54rem;
        }
        table tr td{
            border: 1px solid #000;
        }
        .columnone{
            width: 500px;
        }
        .gnre{
            font-size: 14px;
            height:25px;
            font-weight:bold;
            text-align: center;
        }
        .noborder{
            border-top: 0px;
            border-bottom: 0px;
            border-left: 0px;
            border-right: 0px;
        }
        .center{
            text-align: center;
        }
        .nobrdtb{
            border-top: 0px;
            border-bottom: 0px;
        }
        .noleft{
            border-left: 0px;
        }

        .nobottom{
            border-bottom: 0px;
        }
        .notop{
            border-top: 0px;
        }

        .noright{
            border-right: 0px;
        }

        .borderleft{
            border-top: 0px;
            border-bottom: 0px;
            border-right: 0px;
        }

        .borderbottom{
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
        }

        .borderright{
            border-top: 0px;
            border-bottom: 0px;
            border-left: 0px;
        }

    </style>
    <body>
        <?php foreach ($guiaViaInfo as $key => $via) { ?>
            <table cellspacing="0" cellpadding="1" style="width:100%;">
                <tr>
                    <td style="width: 65%;" valign="top" class="noborder">
                        <table cellspacing="0" cellpadding="1" style="width:100%">
                            <tr>
                                <td class="columnone gnre" colspan="2">
                                    Guia Nacional de Recolhimento de Tributos Estaduais - GNRE
                                </td>
                            </tr>
                            <tr>
                                <td class="center nobrdtb" colspan="2">
                                    Dados do emitente
                                </td>
                            </tr>
                            <tr>
                                <td class="borderleft">
                                    Razão Social
                                </td>
                                <td class="borderright" style="width: 50px">
                                    CNPJ/CPF/Insc. Est.
                                </td>
                            </tr>
                            <tr>
                                <td class="borderleft">
                                    <?php echo $guia->c16_razaoSocialEmitente; ?>
                                </td>
                                <td class="borderright">
                                    <?php echo $guia->c03_idContribuinteEmitente; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="notop nobottom" colspan="2">
                                    Endereço: <?php echo $guia->c18_enderecoEmitente; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="borderleft">
                                    Município: <?php echo $guia->c19_municipioEmitente; ?>
                                </td>
                                <td class="borderright">
                                    UF: <?php echo $guia->c20_ufEnderecoEmitente; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="noright notop">
                                    CEP: <?php echo $guia->c21_cepEmitente; ?>
                                </td>
                                <td class="noleft notop">
                                    DDD/Telefone: <?php echo $guia->c22_telefoneEmitente; ?>
                                </td>
                            </tr>
                            <tr >
                                <td class="center nobrdtb" colspan="2">
                                    Dados do Destinatário
                                </td>
                            </tr>
                            <tr>
                                <td class="notop nobottom" colspan="2">
                                    CNPJ/CPF/Insc. Est.: <?php echo $guia->c35_idContribuinteDestinatario; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="notop" colspan="2">
                                    Município: <?php echo $guia->c38_municipioDestinatario; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="center nobrdtb" colspan="2">
                                    Informações à Fiscalização
                                </td>
                            </tr>
                            <tr>
                                <td class="notop nobottom" colspan="2">
                                    Convênio/Protocolo: <?php echo $guia->c15_convenio; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="notop" colspan="2">
                                    Produto: <?php echo $guia->c26_produto; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="nobrdtb" colspan="2" style="height:64px" valign="top">
                                    Informações Complementares: <?php echo $guia->retornoInformacoesComplementares; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="notop" colspan="2">
                                    Documento válido para pagamento até <?php echo $guia->c14_dataVencimento; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="noborder" valign="top">
                        <table cellspacing="0" cellpadding="1" style="width:100%; margin-left: -1px;">
                            <tr>
                                <td class="nobottom">UF Favorecida</td>
                                <td style="width: 120px" colspan="2" class="nobottom">Código da Receita</td>
                            </tr>
                            <tr>
                                <td class="notop" align="right"><?php echo $guia->c01_UfFavorecida; ?></td>
                                <td class="notop" align="right" colspan="2"><?php echo $guia->c02_receita; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Nº de Controle</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop"><?php echo $guia->retornoNumeroDeControle; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Data de Vencimento</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop"><?php echo $guia->c14_dataVencimento; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Nº do Documento de Origem</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop"><?php echo $guia->c04_docOrigem; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="nobottom">Período de Referência</td>
                                <td class="nobottom" align="left">Nº Parcela</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="notop" align="right"><?php echo $guia->mes; ?>/<?php echo $guia->ano; ?></td>
                                <td class="notop" align="right"><?php echo $guia->parcela; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Valor Principal</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop">R$ <?php echo $guia->c06_valorPrincipal; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Atualização Monetária</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop">R$ <?php echo $guia->retornoAtualizacaoMonetaria; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Juros</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop">R$ <?php echo $guia->retornoJuros; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Multa</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop">R$ <?php echo $guia->retornoMulta; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Total a Recolher</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop"><?php echo $guia->c10_valorTotal; ?></td>
                            </tr>
                            <tr>
                                <td class="noborder" colspan="3" style="text-align:right;"><?php echo $via; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="noborder" style="padding-left:140px;">
                        <?php echo $guia->retornoRepresentacaoNumerica; ?>
                    </td>
                </tr>
                <tr>
                    <td class="noborder" style="padding-left:90px;" >
                        <img src="data:image/jpeg;base64,<?php echo $barcode->getCodigoBarrasBase64(); ?>"/>
                    </td>
                </tr>
            </table>
            <br/>
        <?php } ?>
    </body>
</html>
