import React from 'react';
import {Chip} from 'react-materialize';
import style from './Message.module.css'

/**
 * Компонент "Сообщение"
 * @param message
 * @returns {JSX.Element}
 * @constructor
 */
const Message = ({message, fromAuthor}) => {
    return (
        <div className={`${style.message} ${fromAuthor ? style.myMessage : style.hisMessage}`}>
            <p className={style.messageText}>{message.text}</p>
            <Chip className={style.messageDatetime}>{message.created_at}</Chip>
        </div>
    );
};

export default Message;