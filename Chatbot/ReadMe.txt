NOTE: Nothing needs to be done with the files for using the chatbot, everything is already 
hosted on heroku, and embeded into the chatbot.php page. This was done as due to the server 
being Apache, after experimentation on a practice clone, I could not guarantee that trying 
to integrate the chatbot (which is node.js based) would not interfere with the work of 
everyone else that is primarily in php. The repository on github also comes with out the 
files that are added through the installation of node.js and git.

/index.js
Acts as the entry point for the backend app.

/.gitignore
Used to prevent git from committing chosen files.

/routes/dialogFlowRoutes.js
Route handler for Dialogflow api endpoints.

/config/keys.js
Exports configuration keys dependant on production or development.

/config/dev.js
Stores configuration keys for devevlopment.

/config/production.js
Stores configuration keys for production.

/chatbot/chatbot.js
Chatbot logic for backend app, sends parameters to Dialogflow.

/client/src/index.js
Acts as the entry point for the frontend app.

/client/src/components/App.js
This is the file for App Component. App Component is the main component in React which 
acts as a container for all other components.

/client/src/components/chatbot/Card.js
The frontend Card component, renders individual cards for use in the chatbot window, 
such as when recommending societies.

/client/src/components/chatbot/Chatbot.js
The frontend Chatbot component, includes the chatbot window itself.

/client/src/components/chatbot/Message.js
The frontend Message component, renders and styes the messages, and creates the chatbot icons for 
the user and chatbot.

Dialogflow
Dialogflow is used as a Natural Language Processor for the chatbot, integrating a conversational 
user interface which allows the it to communicate friendly and effectively with the user. 

Heroku
The chatbot application is deployed on Heroku, so that it can be embedded in the site without the 
risk of node.js potentially interfering with the php. The url for the Heroku site is: 
https://l-u-c-i.herokuapp.com/