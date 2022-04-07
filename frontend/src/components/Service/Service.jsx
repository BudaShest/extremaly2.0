import React from 'react';
import {Card, Col, Icon, CardTitle} from "react-materialize";
import {NavLink} from 'react-router-dom';

const Service = ({id,l,s,title, images,name, description, link, size, is_horizontal}) => {
    return (
        <Col
            l={l}
            s={s}
            style={{padding:"20px"}}
        >

            <Card
                actions={[
                    <NavLink to={`/events/${id}`}>Перейти</NavLink>
                ]}
                style={{backgroundColor:"#111"}}
                header={<CardTitle image={images[0]} reveal waves="light"/>}
                textClassName="white-text"
                title={name}
                className={size}
                horizontal={is_horizontal}
                reveal={undefined}
            >
                Here is the standard card with an image thumbnail.
            </Card>
        </Col>
    );
};

export default Service;