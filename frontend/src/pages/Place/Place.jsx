import React from 'react';
import {useEffect} from 'react';
import {useSelector, useDispatch} from 'react-redux';
import {fetchPlace} from "../../asyncActions/places/fetchPlace";
import {useParams} from 'react-router-dom';
import {Row, Col, Container} from 'react-materialize';
import Gallery from "../../components/Gallery/Gallery";
import style from './Place.module.css';
import places from "../Places/Places";

const Place = () => {
    const dispatch = useDispatch();
    const requestParams = useParams();
    const id = requestParams.id;

    useEffect(async () => {
        // const script = document.createElement('script');
        // script.src = "https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A06a5bc8124e28a3155582c309a0319fdca6a0d1a807d8a73e2880b0a30a015e3&amp;width=100%25&amp;height=600&amp;lang=ru_RU&amp;scroll=true";
        // script.charSet = "utf-8";
        // script.async = true;
        //
        // document.querySelector('#mapContainer').append(script);
        dispatch(fetchPlace(id));

    }, [])

    const place = useSelector(state => state.placesReducer.place);
    console.log(place);
    return (
        <>
            <div className={style.placeHeader}>

            </div>
            <main>
                <Container>
                    <h1 className="white-text">{place.name}</h1>
                    <Row>
                        <Col className={style.placeBadge} s={4}>
                            <h5 className="white-text center-align">Характеристики</h5>
                            <Row className={style.placeBadgeRow}>
                                <Col s={4}><b>Климат:</b></Col>
                                <Col s={8} className={style.placeBadgeRow}><img className={style.badgeIcon} src={place.climat_icon} alt=""/>{place.climat_name}</Col>
                            </Row>
                            <Row className={style.placeBadgeRow}>
                                <Col s={4}><b>Страна:</b></Col>
                                <Col s={8} className={style.placeBadgeRow}><img className={style.badgeIcon} src={place.country_flag} alt=""/>{place.country_name}</Col>
                            </Row>
                            <Row>
                                <Col s={4}><b>Адрес: </b></Col>
                                <Col s={8}>{place.address}</Col>
                            </Row>
                        </Col>
                        <Col s={8}>
                            <p className="white-text">{place.description}</p>
                        </Col>
                    </Row>
                    {/*<Gallery photos=""/>*/}
                </Container>
            </main>
        </>
    );
};

export default Place;