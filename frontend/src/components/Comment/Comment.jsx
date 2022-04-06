import React from 'react';
import style from './Comment.module.css';
import {Chip} from 'react-materialize';
//Badge materialize

const Comment = ({user_login, avatar, text, created_at}) => {
    return (
        <div className={style.comment}>
            <img className={style.commentAvatar} src={avatar} alt=""/>
            <div className={style.commentText}>
                <h5>{user_login}</h5>
                <p>{text}</p>
                <Chip className={style.commentDate}>{created_at}</Chip>
            </div>
        </div>
    );
};

export default Comment;