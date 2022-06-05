import React, {useState} from 'react';
import {Textarea, Button} from 'react-materialize';
import style from './Chat.module.css';
import { io } from "socket.io-client";

const Chat = () => {

    const [isActive, setActive] = useState(false);
    const [messageText, setMessageText] = useState('');
    const socket = io('http://localhost:8082');

    socket.on('news', function (data){
        console.log(data);
        socket.emit('hi', {response:"hi"});
    })

    function sendMessage() {

    }

    return (
        <div className={`${style.chatBadge} ${isActive && style.chatBadgeActive}`}>
            <header onClick={() => setActive(!isActive)} className={style.chatHeader}>
                <span className={`${style.chatOffer} text-white`}>Онлайн консультант по сайту</span>
            </header>
            <div className={`${style.messageContainer} ${isActive && style.messageContainerActive}`}>

            </div>
            <Textarea
                onChange={(e) => setMessageText(e.currentTarget.value)}
                value={messageText}
                id="Textarea-31"
                l={12}
                m={12}
                s={12}
                xl={12}
            />
            <Button onClick={sendMessage} className={style.chatSendButton}>
                Отправить
            </Button>
        </div>
    );
};

export default Chat;