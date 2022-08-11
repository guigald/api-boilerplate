@php
    $whiteBackground = 'https://storage.googleapis.com/liontax-assets/email/general/white-background.png';
    $lionLogo = 'https://storage.googleapis.com/liontax-assets/email/logo/logo-lion.png';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-mail Lion</title>

    <style>
        .title-container {
            padding: 0 24px 16px 24px;
            font-weight: bold;
        }

        .inner-table-title-container {
            padding: 0 0 26px 0;
            font-weight: bold;
            font-size: 16px;
        }

        .text-container {
            padding: 0 24px 16px 24px;
            font-size: 16px;
        }

        .subtitle-container {
            padding: 0;
            font-weight: bold;
        }

        .title {
            color: #323339;
            font-size: 24px;
            font-weight: 600;
            line-height: 40px;
        }

        .subtitle-text-container {
            padding: 0 0 0 20px;
        }

        .subtitle-text {
            font-size: 14px;
        }

        body {
            font-size: 14px;
            color: #40474f;
        }

        .btn-container {
            width: 100%;
            height: 48px;
            padding: 40px 24px 16px 24px;
        }

        .btn {
            padding: 12px 24px;
            background-color: #FF7A39;
            border-radius: 8px;
            cursor: pointer;
            color: #fff !important;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 12px;
            text-decoration: none;
        }

        .btn-secondary {
            padding: 13px 93px;
            background-color: #fff;
            border-radius: 4px;
            cursor: pointer;
            color: #40474f !important;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 12px;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #c4c4c4;
        }

        .btn:hover {
            background-color: #FF4F00;
        }

        .table-pricing {
            width: 100%;
        }

        .table-pricing > thead > tr > td {
            font-weight: bold;
            font-size: 16px;
        }

        .align-right {
            text-align: right;
        }

        .total {
            border-top: #b4bfc4 solid 1px;
        }

        .total > tbody > tr {
            line-height: 24px;
        }

        .subtitle {
            color: #0F0F0F;
            font-size: 16px;
            line-height: 24px;
            font-weight: normal;

        }

        .answer-tbody:last-child {
            padding-bottom: 10px;
        }

        .text-container-bottom {
            padding: 134px 24px 0 24px;
        }

        .text-bottom {
            font-size: 12px;
            line-height: 150%;
            font-weight: normal;
        }

        .text-center {
            text-align: center;
        }

        .info-container {
            padding: 11.5px 24px;
            border-radius: 8px;
            background-color: rgba(255, 244, 230, 0.7);
            font-size: 12px;
        }

        .icon {
            font-size: 18px;
        }

        .inner-table {
            width: 100%;
            border: 1px solid #FF8A0066;
            border-radius: 16px;
            padding: 21px 21px 12px 21px;
            background-color: #FFF4E6;
        }

        .border-top {
            border-top: 1px solid #F57E2022;
            padding-top: 26px;

        }

        .total-pricing > td {
            color: #FF8A00;
            font-weight: bold;
        }

        .status {
            background-color: #FFF4E6;
            padding-top: 16px;
            border-radius: 8px;
            border: 1px solid #FF8A0066;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div style="background: url('{{ $whiteBackground }}'); border-radius: 16px; font-family: 'Arial', sans-serif; max-width: 600px; margin: 0 auto; font-size: 16px">
    <div style="background: url('{{ $whiteBackground }}'); padding: 40px 32px; border-radius: 16px 16px 0 0; border-top: 1px solid #E8EAEC; border-left: 1px solid #E8EAEC; border-right: 1px solid #E8EAEC">
        <table style="width: 100%;">
            <tr>
                <td>
                    <a href="https://lion.tax" target="_blank" rel="noopener noreferrer">
                        <img src="{{ $lionLogo }}" alt="Logo Lion Tax">
                    </a>
                </td>
            </tr>
        </table>

        <table style="border-radius: 4px; background: url('{{ $whiteBackground }}'); width: 100%; margin: 72px 0px 20px 0px;">
