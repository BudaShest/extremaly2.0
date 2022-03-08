import React from 'react';
import style from './Comment.module.css';
import {Chip} from 'react-materialize';
//Badge materialize

const Comment = ({login, avatar, text, date}) => {
    return (
        <div className={style.comment}>
            <img className={style.commentAvatar} src={avatar} alt=""/>
            <div className={style.commentText}>
                <h5>{login}</h5>
                <p>{text}</p>
                <Chip className={style.commentDate}>{date}</Chip>
            </div>
        </div>
    );
};

export default Comment;