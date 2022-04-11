import React from 'react';
import {Row, Col} from "react-materialize";
import style from './SocialLinks.module.css';

const SocialLinks = ({links}) => {
    return (
        <div style={{display:'flex',justifyContent:'center'}} className={style.linksRow}>
            {
                links.map(link=>{
                    return (
                        <Col push={"s1"} key={link.id}>
                            <a target="_blank" href={link.url}>
                                <img className={`${style.linkImg} hoverable`} src={link.icon} alt="Соц. сеть"/>
                            </a>
                        </Col>
                    );
                })
            }
        </div>
    );
};

export default SocialLinks;