<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

/**
 * Get configuration settings for the custom payment gateway.
 *
 * @return array
 */
function RTCustom_config()
{
    return [
        'FriendlyName' => [
            'Type' => 'System',
            'Value' => 'Custom Payment Gateway',
        ],
        'paymentWallet' => [
            'FriendlyName' => 'Payment Wallet',
            'Type' => 'text',
            'Size' => '40'
        ],
        'instruction' => [
            'FriendlyName' => 'Instruction',
            'Type' => 'textarea'
        ]
    ];
}

/**
 * Generate payment details display.
 *
 * @param array $params WHMCS parameters
 * @return string HTML markup
 */
function RTCustom_link($params)
{
    $response = RTCustom_handlePost($params);
    $name = $params['name'];
    $paymentWallet = $params['paymentWallet'];
    $amount = $params['amount'];
    $invoiceId = $params['invoiceid'];
    $instruction = $params['instruction'];
    $notes = trim(RTCustom_getNote($params['invoiceid']));

    $markup = <<<HTML
<div class="panel panel-default" style="margin-top: 10px;">
    <div style="padding-top:10px;">
        <h3 class="panel-title"><strong>Payment Details</strong></h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="margin-bottom: 10px;">
                <tbody>
                    <tr>
                        <td><b>Gateway:</b></td>
                        <td class="text-center">$name</td>
                    </tr>
                    <tr>
                        <td><b>Wallet:</b></td>
                        <td class="text-center">$paymentWallet</td>
                    </tr>
                    <tr>
                        <td><b>Amount:</b></td>
                        <td class="text-center">$amount</td>
                    </tr>
                    <tr>
                        <td><b>Reference:</b></td>
                        <td class="text-center">$invoiceId</td>
                    </tr>
                </tbody>
            </table>

            <p>$instruction</p>
            <form method="post" action="#" class="form-inline">
                <input type="text" name="trx_id" value="$notes" class="form-control" placeholder="TRX ID...">
                <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                $response
            </form>
        </div>
    </div>
</div>
HTML;

    return $markup;
}

/**
 * Handle form submission for transaction ID.
 *
 * @param array $params WHMCS parameters
 * @return string Success message
 */
function RTCustom_handlePost($params)
{
    if (isset($_REQUEST['trx_id'])) {
        RTCustom_updateNote($params['invoiceid'], $_REQUEST['trx_id']);
        return '<p style="margin-top: 5px;color: green;">Your transaction info submitted for review.</p>';
    }

    return '';
}

/**
 * Get transaction notes for an invoice.
 *
 * @param int $invoiceId Invoice ID
 * @return string Transaction notes
 */
function RTCustom_getNote($invoiceId)
{
    $invoice = localAPI('GetInvoice', ['invoiceid' => $invoiceId]);
    return @str_replace('TRX ID:', '', $invoice['notes']);
}

/**
 * Update transaction notes for an invoice.
 *
 * @param int $invoiceId Invoice ID
 * @param string $note Transaction ID
 */
function RTCustom_updateNote($invoiceId, $note)
{
    $modifiedNote = 'TRX ID: ' . $note;
    localAPI('UpdateInvoice', ['invoiceid' => $invoiceId, 'notes' => $modifiedNote]);
}