httpsms-laravel
===============

[![Build](https://github.com/NdoleStudio/httpsms-recipes/actions/workflows/ci.yml/badge.svg)](https://github.com/NdoleStudio/httpsms-recipes/actions/workflows/ci.yml)
[![GitHub contributors](https://img.shields.io/github/contributors/NdoleStudio/httpsms-recipes)](https://github.com/NdoleStudio/httpsms-recipes/graphs/contributors)
[![GitHub license](https://img.shields.io/github/license/NdoleStudio/httpsms-recipes?color=brightgreen)](https://github.com/NdoleStudio/httpsms-recipes/blob/master/LICENSE)

This recipe contains an example Laravel application to receive incoming webhook events from the  httpsms.com API. 
You can use this code as inspiration for creating a consumer for webhook events from httpsms.com.

## Documentation

httpSMS webhook documentation: https://docs.httpsms.com/webhooks/introduction

## Dependencies

- [Laravel 10.x](https://laravel.com/docs/10.x) - PHP Framework used
- [CloudEvents](https://github.com/cloudevents/sdk-php) - Used to deserialize CloudEvents from httpsms.com.
- [php-jwt](https://github.com/firebase/php-jwt) - Used to authenticate webhook requests.


## Architecture

The `AuthenticateHttpSmsWebhook` middleware to authenticates webhook requests from httpSMS using the `Bearer` JWT token.
You have to set your webhook signing key in the config `httpsms.webhook.signing_key`. This key is used to validate the 
bearer token in the webhook request. 

The `HttpSmsWebhookController` processes webhook requests and transforms the payload to a `CloudEvent` since the payload 
of webhook requests from httpSMS are valid [CloudEvents](https://cloudevents.io/).


## Local Setup

Run the laravel application to listen to events using the command below

```bash
docker run -p 8000:80 --env HTTPSMS_WEBHOOK_SIGNING_KEY="/* your webhook signing key */"  ndolestudio/httpsms-laravel
```

In-order to receive events from httpsms.com to the application running on your local computer, you have to setup
[ngrok.io](https://ngrok.io) to listen on localhost:8000

```bash
ngrok http localhost:8000
```

Now configure your webhook endpoint https://httpsms.com/settings to point to the URL provided by ngrok.
When you receive an SMS, you will see the logs in your terminal as shown in the image below.


## Security Vulnerabilities

If you discover a security vulnerability within the dompdf-api service, please send an e-mail to Acho Arnold via 
[arnold@ndolestudio.com](mailto:arnold@ndolestudio.com). All security vulnerabilities will be promptly addressed.

## License

dompdf-api is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
