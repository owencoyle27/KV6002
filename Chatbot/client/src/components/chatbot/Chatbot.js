import React, { Component } from 'react';
import axios from 'axios/index';
import Cookies from 'universal-cookie';
import { v4 as uuid } from 'uuid';

import Message from './Message';
import Card from './Card';
//Cookies
const cookies = new Cookies();

class Chatbot extends Component {
    messagesEnd;
    talkInput;
    constructor(props) {
        super(props);
        this._handleInputKeyPress = this._handleInputKeyPress.bind(this);
        this.hide = this.hide.bind(this);
        this.show = this.show.bind(this);
        this.state = {
            messages: [],
            showChatbot: true
        };
        
        if (cookies.get('userID') === undefined) {
        cookies.set('userID', uuid(), { path: '/' });
        }
        console.log(cookies.get('userID'));
    }
    //Text query
    async df_text_query(text) {
        let says = {
            speaks: 'me', 
            mesg: {
                text: {
                    text: text
                }
            }
        };

        this.setState({messages: [...this.state.messages, says]});
        const res = await axios.post('/api/df_text_query', {text, userID: cookies.get('userID')});
        
        for (let mesg of res.data.fulfillmentMessages) {
            says = {
                speaks: 'L.U.C.I.',
                mesg: mesg
            }
            this.setState({ messages: [...this.state.messages, says] });
        }
    
    }
    //Event query
    async df_event_query(event) {
        const res = await axios.post('/api/df_event_query', {event, userID: cookies.get('userID')});

        for (let mesg of res.data.fulfillmentMessages) {
            let says = {
                speaks: 'L.U.C.I.',
                mesg: mesg
            }
            this.setState({ messages: [...this.state.messages, says] })
        }
    }
    
    async componentDidMount() {
        this.df_event_query('Welcome');
    }

    componentDidUpdate() {
        this.messagesEnd.scrollIntoView({ behaviour: "smooth" }); 
        if ( this.talkInput ) {
            this.talkInput.focus();
        }    
    }
    //Show ability
    show(event) {
        event.preventDefault();
        event.stopPropagation();
        this.setState({showChatbot: true});
    }
    //Hide ability
    hide(event) {
        event.preventDefault();
        event.stopPropagation();
        this.setState({showChatbot: false});
    }

    renderCards(cards) {
        return cards.map((card, i) => <Card key={i} payload={card.structValue}/>);
    }
    // Renders a message, including the card panel for societies
    renderOneMessage(message, i) {
        if (message.mesg && message.mesg.text && message.mesg.text.text) {
            return <Message key={i} speaks={message.speaks} text={message.mesg.text.text} />;
        } else if (message.mesg && message.mesg.payload && message.mesg.payload.fields && message.mesg.payload.fields.cards) {
            return <div key={i}>
                <div className="card-panel grey lighten-5 z-depth-1">
                    <div style={{overflow: 'hidden'}}>
                        <div className="col s2">
                            <a className="btn-floating btn-large waves-effect waves-light black">{message.speaks}</a>   
                        </div>
                        <div style={{overflow: 'auto', overflowY: 'auto'}}>
                            <div style={{ height: 300, width: message.mesg.payload.fields.cards.listValue.values.length * 270 }}>
                                {this.renderCards(message.mesg.payload.fields.cards.listValue.values)}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        }
    }

    renderMessages(stateMessages) {
        if (stateMessages) {
            return stateMessages.map((message, i) => {          
                return this.renderOneMessage(message, i);   
            });
        } else {
            return null;
        }
    }
    //Handles the input of key press
    _handleInputKeyPress(e) {
        if (e.key === 'Enter') {
            this.df_text_query(e.target.value);
            e.target.value = '';
        }
    }
    // This renders the overall chatbot window, minimised and maximised
    render() {
        if (this.state.showChatbot) {    
            return (
                <div style={{height: '90%', position: 'absolute', left: '14%', right: '14%', bottom: '7%', border: '1px solid lightgrey'}}>
                    <div id="chatbot" style={{ height: '100%', width: '100%', overflow: 'auto' }}>
                        <nav>
                            <div className="nav-wrapper black">
                                <a className="brand-logo">L.U.C.I.</a>
                                {/*<ul id="nav-mobile" className="right">
                                  <li><a href="/" onClick={this.hide}>Close</a></li>
                                </ul> */}
                            </div>
                        </nav>
                        <div id="chatbot" style={{ height: '85%', width: '100%', overflow: 'auto'}}>
                            {this.renderMessages(this.state.messages)}
                            <div ref ={(el) => { this.messagesEnd = el; }} style={{ float: 'left', clear: "both" }}></div>
                        
                        </div>
                    </div>
                    <div className="col s12">
                    <input placeholder="Ask a question" type="text" ref={(input) => { this.talkInput = input; }} onKeyPress={this._handleInputKeyPress} />
                    </div>
                </div>
            );
        } else{
            return (
                <div style={{ minHeight: 40, maxHeight: 500, width: 250, position: 'absolute', bottom: '1%', right: 0, border: '1px solid lightgrey'}}>
                    <div id="chatbot" style={{ height: '100%', width: '100%', overflow: 'auto' }}>
                        <nav>
                            <div className="nav-wrapper black">
                                <a className="brand-logo left">L.U.C.I.</a>
                                {/*<ul id="nav-mobile" className="right">
                                    <li><a href="/" onClick={this.show}> Open</a></li>
                                </ul>*/}
                            </div>
                        </nav>
                    </div> 
                    <div ref={(el) => { this.messagesEnd = el; }} style={{ float:"left", clear: "both"}}>

                    </div>    
                </div>
            );
        }
            

    }    
};

export default Chatbot;
