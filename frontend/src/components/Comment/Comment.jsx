import React from 'react';
import style from './Comment.module.css';
import {Chip} from 'react-materialize';
//Badge materialize

const Comment = ({user_login, avatar, text, created_at}) => {
    return (
        <div className={style.comment}>
            <img className={style.commentAvatar} src={avatar??'https://us.123rf.com/450wm/tuktukdesign/tuktukdesign1608/tuktukdesign160800043/61010830-user-icon-man-profile-businessman-avatar-person-glyph-vector-illustration.jpg?ver=6'} alt=""/>
            <div className={style.commentText}>
                <h5>{user_login??'test'}</h5>
                <p>{text}</p>
                <Chip className={style.commentDate}>{created_at}</Chip>
            </div>
        </div>
    );
};

export default Comment;