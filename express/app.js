const express = require("express");
const logger = require("morgan");
const httpsms = require("fix-esm").require("httpsms");
const jwt = require("jsonwebtoken");

const app = express();

app.use(logger("dev"));
app.use(express.json());

app.get("/", (request, response) => {
  response.status(200).json({ status: "ok" });
});

// Webhook endpoint to receive incoming messages
app.post("/httpsms/webhook", (request, response) => {
  // Verify auth token
  if (process.env.HTTPSMS_WEBHOOK_SIGNING_KEY) {
    try {
      const token = request.header("Authorization").replace("Bearer ", "");
      const claims = jwt.verify(token, process.env.HTTPSMS_WEBHOOK_SIGNING_KEY);
      console.info("Authorization token verified from httpsms.com");
      console.debug(JSON.stringify(claims, null, 2));
    } catch (error) {
      console.error("Invalid Authorization token", error);
      return response.status(401).json({ error: "Unauthorized" });
    }
  }

  const event = request.body;
  console.info(
    `httpsms.com webhook event received with type [${request.header("X-Event-Type")}]`,
  );
  console.info(`decoded [${event.type}] with id [${event.id}`);
  console.debug(JSON.stringify(event.data, null, 2));

  response.json({ status: "success" });
});

// Send a sample text message
app.get("/httpsms/send", async (request, response) => {
  const httpsmsClient = new httpsms(
    "" /* Get the API Key from https://httpsms.com/settings */,
  );

  const message = await httpsmsClient.messages.postSend({
    content: "This is a sample text message",
    from: "+18005550199", // Put the correct phone number here
    to: "+18005550100", // Put the correct phone number here
    encrypted: false,
  });

  console.info(`message sent successfully with ID [${message.id}]`);
  response.status(200).json({ status: "ok" });
});

module.exports = app;
