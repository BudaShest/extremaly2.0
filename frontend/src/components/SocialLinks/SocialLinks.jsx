import React from 'react';
import {Row, Col} from "react-materialize";
import style from './SocialLinks.module.css';

const SocialLinks = ({links}) => {
    return (
        <Row className={style.linksRow}>
            {
                links.map(link=>{
                    return (
                        <Col push={"s1"} key={link.id}>
                            <a target="_blank" href={link.src}>
                                <img className={`${style.linkImg} hoverable`} src={link.img} alt=""/>
                            </a>
                        </Col>
                    );
                })
            }
        </Row>
    );
};

export default SocialLinks;