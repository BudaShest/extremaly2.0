import React, {useState, useRef, useEffect} from 'react';
import {Textarea, Button} from 'react-materialize';
import style from './Chat.module.css';
import {io} from "socket.io-client";
import Message from "../Message/Message"

const Chat = () => {
    const textRef = useRef();
    const [isActive, setActive] = useState(false);
    const [messages, setMessages] = useState([]);
    const socket = io('http://localhost:8082');

    //todo вынести наверх
    socket.on('getMessage', function (data) {
        setMessages([...messages, data])
    })

    let currentUser = sessionStorage.getItem('userInfo');
    currentUser = currentUser ? JSON.parse(currentUser) : {};

    function sendMessage() {
        if (currentUser.isAuth) {
            socket.emit('sendMessage', {
                "from_id": currentUser.id,
                "text": textRef.current.value,
            });
        } else {
            alert('Пользователь должен быть авторизован!');
        }
    }

    return (
        <div className={`${style.chatBadge} ${isActive && style.chatBadgeActive}`}>
            <header onClick={() => setActive(!isActive)} className={style.chatHeader}>
                <span className={`${style.chatOffer} text-white`}>Онлайн консультант по сайту</span>
            </header>
            {
                currentUser.isAuth ? <>
                        <div className={`${style.messageContainer} ${isActive && style.messageContainerActive}`}>
                            {
                                messages.map(message => <Message fromAuthor={currentUser.id === message.from_id} key={message.id} message={message}/>)
                            }
                        </div>
                        <textarea className={`materialize-textarea`} style={{color: 'white'}} ref={textRef} name="messageText" id="messageTextInput" cols="30" rows="10"></textarea>
                        <Button onClick={sendMessage} className={style.chatSendButton}>
                            Отправить
                        </Button>
                    </>
                    :
                    <div>
                        <div className={style.chatUnavailableBadge}>Для использования онлайн-помощника пользователь
                            должен быть авторизован!
                        </div>
                    </div>
            }
        </div>

    );
};

export default Chat;