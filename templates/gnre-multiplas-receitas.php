<?php
/**
 * @var \Sped\Gnre\Sefaz\GuiaMultiplasReceitas $guia
 * @var \Sped\Gnre\Sefaz\GuiaResposta|null $guiaResposta
 * @var \Sped\Gnre\Render\Barcode128 $barcode
 * @var array<int, string> $guiaViaInfo
 */
?>
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
        <?php foreach ($guiaViaInfo as $key => $via): ?>
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
                                    <?= $guia->contribuinteEmitente?->razaoSocial ?? '' ?>
                                </td>
                                <td class="borderright">
                                    <?= $guia->contribuinteEmitente?->identificacao->cnpj ?? $guia->contribuinteEmitente?->identificacao->cpf ?? '' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="notop nobottom" colspan="2">
                                    Endereço: <?= $guia->contribuinteEmitente?->endereco ?? '' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="borderleft">
                                    Município: <?= $guia->contribuinteEmitente?->municipio ?? '' ?>
                                </td>
                                <td class="borderright">
                                    UF: <?= $guia->contribuinteEmitente?->uf ?? '' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="noright notop">
                                    CEP: <?= $guia->contribuinteEmitente?->cep ?? '' ?>
                                </td>
                                <td class="noleft notop">
                                    DDD/Telefone: <?= $guia->contribuinteEmitente?->telefone ?? '' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="center nobrdtb" colspan="2">
                                    Informações à Fiscalização
                                </td>
                            </tr>
                            <tr>
                                <td class="nobrdtb" colspan="2" style="height:64px" valign="top">
                                    Informações Complementares: <?= $guiaResposta?->retornoInformacoesComplementares ?? '' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="notop" colspan="2">
                                    Receitas:
                                    <?php foreach ($guia->itens as $itemIdx => $itemRec): ?>
                                        <?= $itemRec->receita ?? '' ?><?= $itemIdx < count($guia->itens) - 1 ? ', ' : '' ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="noborder" valign="top">
                        <table cellspacing="0" cellpadding="1" style="width:100%; margin-left: -1px;">
                            <tr>
                                <td class="nobottom" colspan="3">UF Favorecida</td>
                            </tr>
                            <tr>
                                <td class="notop" align="right" colspan="3"><?= $guia->ufFavorecida->value ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Nº de Controle</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop"><?= $guiaResposta?->retornoNumeroDeControle ?? '' ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Data de Vencimento</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right" class="notop"><?= $guia->itens[0]?->dataVencimento ?? '' ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Atualização Monetária</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="notop" align="right">R$ <?= $guiaResposta?->retornoAtualizacaoMonetaria ?? '' ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Juros</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="notop" align="right">R$ <?= $guiaResposta?->retornoJuros ?? '' ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="nobottom">Multa</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="notop" align="right">R$ <?= $guiaResposta?->retornoMulta ?? '' ?></td>
                            </tr>
                            <tr>
                                <td class="noborder" colspan="3" style="text-align:right;"><?= $via ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="noborder" style="padding-left:140px;">
                        <?= $guiaResposta?->retornoRepresentacaoNumerica ?? '' ?>
                    </td>
                </tr>
                <tr>
                    <td class="noborder" style="padding-left:90px;" >
                        <img src="data:image/jpeg;base64,<?= $barcode->getCodigoBarrasBase64() ?>"/>
                    </td>
                </tr>
            </table>
            <br/>
        <?php endforeach; ?>
    </body>
</html>
