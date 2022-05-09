import React from 'react';
import style from './Comments.module.css';
import {Row, Col, Button} from "react-materialize";
import {useDispatch} from 'react-redux';
import {NavLink} from 'react-router-dom';
import Comment from "../Comment/Comment";
import {Pagination, Icon} from "react-materialize";
import {fetchReviewWithPagination} from "../../asyncActions/main/fetchReviews";

/**
 * Комментарии (компонент)
 * @param numOfPages
 * @param comments
 * @param children
 * @returns {JSX.Element}
 * @constructor
 */
const Comments = ({numOfPages, comments, children}) => {

    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));

    const dispatch = useDispatch();

    function paginationHandler(page) {
        dispatch(fetchReviewWithPagination(page));
    }

    return (
        <Row style={{margin: 0, padding: "30px 0px"}}>
            <Col s={12} l={5} className={style.commentsText}>
                {
                    currentUser?.isAuth ? children : <div>
                        <h4><NavLink to="/login">Авторизуйтесь</NavLink>, для того, чтобы оставить комментарий</h4>
                    </div>
                }
            </Col>
            <Col s={12} l={7} className={style.commentsContainer}>
                {
                    comments.map(comment => <Comment key={comment.id} {...comment}/>)
                }
                <Row>
                    <Col offset={"s3"} s={12} m={6}>
                        <Pagination
                            onSelect={paginationHandler}
                            className={style.pagination}
                            activePage={1}
                            items={numOfPages}
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