# Custom Payment Gateway for WHMCS

This is a custom payment gateway module for WHMCS. It allows you to integrate a payment gateway with unique features into your WHMCS installation.

## Installation

1. **Download:**
   - Download [RTCustom.zip](https://github.com/rtraselbd/WHMCSCustomGateway/releases/download/v1.0.0/RTCustom.zip) file from the Release section of this repository.

2. **Extract:**
   - Unzip the downloaded file (`RTCustom.zip`) to the root directory of your WHMCS installation. The module is now ready to be configured.

3. **Activate:**
   - Log in to your WHMCS admin panel.
   - Go to `Setup` > `Payments` > `Payment Gateways`.
   - Find "Custom Payment Gateway" in the list and click `Activate`.

4. **Configuration:**
   - After activation, go to `Setup` > `Payments` > `Payment Gateways`.
   - Click on "Manage Existing Gateways" next to "Custom Payment Gateway".
   - Enter the required configuration settings, including `Payment Wallet` and any other settings relevant to your gateway.

5. **Save Changes:**
   - Click `Save Changes` to apply your configuration.

## Usage

1. **Create an Invoice:**
   - Create a new invoice for a client in your WHMCS admin panel.

2. **Select Payment Method:**
   - On the invoice view, select "Custom Payment Gateway" as the payment method.

3. **Payment Details:**
   - The payment details, including the payment wallet and instructions, will be displayed to the client.

4. **Submit Transaction ID:**
   - The client can submit the transaction ID via the provided form.

5. **Review and Confirm:**
   - Once submitted, the transaction information will be available for review.

## Support

If you encounter any issues or have questions, please open an issue in the [GitHub repository](https://github.com/rtraselbd/WHMCSCustomGateway/issues).

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.