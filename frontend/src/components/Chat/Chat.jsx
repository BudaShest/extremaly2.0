import React, {useState, useRef, useEffect} from 'react';
import {Textarea, Button} from 'react-materialize';
import style from './Chat.module.css';
import {io} from "socket.io-client";
import Message from "../Message/Message"

const Chat = () => {
    const textRef = useRef();
    const [isActive, setActive] = useState(false);
    // const [messageText, setMessageText] = useState('');
    const [messages, setMessages] = useState([]);;
    const socket = io('http://localhost:8082');

    socket.on('getMessage', function (data) {
        setMessages([...messages, data])
    })

    let currentUser = sessionStorage.getItem('userInfo');
    currentUser = currentUser ? JSON.parse(currentUser) : {};

    function sendMessage() {
        if (currentUser.isAuth) {
            socket.emit('sendMessage', {
                "from_id": currentUser.id,
                // "text": messageText,
                "text": textRef.current.value,
            });
            // setMessageText('');
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
                                messages.map(message => <Message key={message.id} message={message}/>)
                            }
                        </div>
                        {/*<Textarea*/}
                        {/*    // onChange={(e) => setMessageText(e.currentTarget.value)}*/}
                        {/*    // value={messageText}*/}
                        {/*    ref={textRef}*/}
                        {/*    id="Textarea-31"*/}
                        {/*    l={12}*/}
                        {/*    m={12}*/}
                        {/*    s={12}*/}
                        {/*    xl={12}*/}
                        {/*/>*/}
                        <textarea style={{color: 'white'}} ref={textRef} name="" id="" cols="30" rows="10"></textarea>
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