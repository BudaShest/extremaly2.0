import React from 'react';
import {Row, Col, MediaBox} from "react-materialize";
import style from './Gallery.module.css';


const Gallery = ({photos}) => {
    if (photos) {
        return (
            <Row className={style.galleryWrapper}>
                {
                    photos.map((photo, index) => {
                        return (
                            <Col key={index} l={4} m={4} s={12} style={{margin: "10px 0"}}>
                                <MediaBox
                                    id="MediaBoxGallery"
                                    options={{
                                        inDuration: 275,
                                        outDuration: 200
                                    }}
                                >
                                    <img
                                        alt="Изображение галереи"
                                        src={photo}
                                        style={{width: "100%"}}
                                    />
                                </MediaBox>
                            </Col>
                        )
                    })
                }
            </Row>
        );
    } else {
        return (<Row>
            Фотографии отсутствуют
        </Row>);
    }

};

export default Gallery;