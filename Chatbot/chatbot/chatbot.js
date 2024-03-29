'use strict';
const dialogflow = require('dialogflow');
const structjson = require('./structjson');
const config = require('../config/keys'); 
const { struct }  = require('pb-util');

const projectID = config.googleProjectID;
const sessionID = config.dialogFlowSessionID;

const credentials = {
  client_email: config.googleClientEmail,
  private_key: config.googlePrivateKey
};

const sessionClient = new dialogflow.SessionsClient({projectID, credentials});

module.exports = {
  //Text input for dialogflow
    textQuery: async function(text, userID, parameters = {}) {
        let sessionPath = sessionClient.sessionPath(projectID, sessionID + userID);
        let self = module.exports;
        const request = {
            session: sessionPath,
            queryInput: {
              text: {
                text: text,
                // The language used by the client (en-US)
                languageCode: config.dialogFlowSessionLanguageCode,
              },
            },
            queryParams: {
                payload: {
                    data: parameters
                }
            }
          };
        let responses = await sessionClient.detectIntent(request);
        responses = await self.handleAction(responses);
        return responses;
    },
  //Event input for dialogflow
    eventQuery: async function(event, userID, parameters = {}) {
      let sessionPath = sessionClient.sessionPath(projectID, sessionID + userID);
      let self = module.exports;
      const request = {
          session: sessionPath,
          queryInput: {             
            event: {                
            name: event,                
            parameters: struct.encode(parameters),
              // The language used by the client (en-US)
              languageCode: config.dialogFlowSessionLanguageCode,
            },
          },
        };
      let responses = await sessionClient.detectIntent(request);
      responses = await self.handleAction(responses);
      return responses;
  },

    handleAction: function(responses){
        return responses;
    }
}