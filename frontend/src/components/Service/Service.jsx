import React from 'react';
import {Card, Col, Icon, CardTitle} from "react-materialize";

const Service = ({l,s,title, image, description, link, size, is_horizontal}) => {
    return (
        <Col
            l={l}
            s={s}
            style={{padding:"20px"}}
        >

            <Card
                actions={[
                    <a style={{color:"#F27436"}} key="1" href="#">This is a Link</a>
                ]}
                style={{backgroundColor:"#111"}}
                header={<CardTitle image={image} reveal waves="light"/>}
                textClassName="white-text"
                title={title}
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