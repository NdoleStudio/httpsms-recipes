httpsms-express
===============

[![Build](https://github.com/NdoleStudio/httpsms-recipes/actions/workflows/ci.yml/badge.svg)](https://github.com/NdoleStudio/httpsms-recipes/actions/workflows/ci.yml)
[![GitHub contributors](https://img.shields.io/github/contributors/NdoleStudio/httpsms-recipes)](https://github.com/NdoleStudio/httpsms-recipes/graphs/contributors)
[![GitHub license](https://img.shields.io/github/license/NdoleStudio/httpsms-recipes?color=brightgreen)](https://github.com/NdoleStudio/httpsms-recipes/blob/master/LICENSE)

This recipe contains an example express.js application to receive incoming webhook events from the  httpsms.com API. 
You can use this code as inspiration for creating a consumer for webhook events from httpsms.com.

## Documentation

httpSMS webhook documentation: https://docs.httpsms.com/webhooks/introduction

## Dependencies

- [express 4.x](https://expressjs.com/) - Express framework
- [jsonwebtoken](https://github.com/auth0/node-jsonwebtoken) - Used to authenticate webhook requests.


## Architecture

The `/httpsms/webhook` endpoint authenticates webhook requests from httpSMS using the `Bearer` JWT token.
You can optionally set your webhook signing key in the `HTTPSMS_WEBHOOK_SIGNING_KEY` environment variable. This key is used to validate the bearer token in the webhook request.

## Local Setup

Run the node JS application to listen to events using the command below

```bash
docker run -p 3000:3000 --env HTTPSMS_WEBHOOK_SIGNING_KEY="/* your webhook signing key */"  ndolestudio/httpsms-express
```

In-order to receive events from httpsms.com to the application running on your local computer, you have to setup
[ngrok.io](https://ngrok.io) to listen on localhost:3000

```bash
ngrok http localhost:3000
```

Now configure your webhook endpoint https://httpsms.com/settings to point to the URL provided by ngrok.
When you receive an SMS, you will see the logs in your terminal as shown in the image below.


## Security Vulnerabilities

If you discover a security vulnerability within the dompdf-api service, please send an e-mail to Acho Arnold via 
[arnold@ndolestudio.com](mailto:arnold@ndolestudio.com). All security vulnerabilities will be promptly addressed.

## License

This recipe is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
