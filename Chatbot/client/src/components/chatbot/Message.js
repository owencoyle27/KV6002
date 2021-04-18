import React from 'react';
//Style of the messages and creates the icons within the chatbot that represent the user's messages and that of the chatbot
const Message = (props) => (
    <div className="col s12 m8 offset-m2 offset-l3">
        <div className=" card-panel grey lighten-5 z-depth-1">
            <div className="row valign-wrapper">
                {props.speaks==='L.U.C.I.' &&
                <div className="col s2">
                    <a className="btn-floating btn-large waves-effect waves-light black">{props.speaks}</a>
                </div>
                }
                <div className="col s10">
                    <span className="black-text">
                        {props.text}
                    </span>
                </div>
                {props.speaks==='me' &&
                <div className="col s2">
                    <a className="btn-floating btn-large waves-effect waves-light black">{props.speaks}</a>
                </div>
                }
            </div>
        </div>
    </div>
);

export default Message;