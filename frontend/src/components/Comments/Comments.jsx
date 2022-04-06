import React from 'react';
import style from './Comments.module.css';
import {Row, Col, Button} from "react-materialize";
import {NavLink} from 'react-router-dom';
import Comment from "../Comment/Comment";
import {Pagination, Icon} from "react-materialize";
import {fetchUser} from "../../asyncActions/user/fetchUser";


const Comments = ({comments, children}) => {

    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));

    return (
        <Row style={{margin:0,padding:"30px 0px"}}>
            <Col l={5} className={style.commentsText}>
                {
                    currentUser?.isAuth ? children : <div>
                        <h4><NavLink to="/login">Авторизуйтесь</NavLink>, для того, чтобы оставить комментарий</h4>
                    </div>
                }
            </Col>
            <Col l={7} className={style.commentsContainer}>
                {
                    comments.map(comment=><Comment key={comment.id} {...comment}/>)
                }
                <Row>
                    <Col offset={"s3"} s={6}>
                        <Pagination
                            className={style.pagination}
                            activePage={3}
                            items={5}
                            leftBtn={<Icon>chevron_left</Icon>}
                            rightBtn={<Icon>chevron_right</Icon>}
                        />
                    </Col>
                </Row>
            </Col>
        </Row>
    );
};

export default Comments;