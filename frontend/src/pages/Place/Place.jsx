import React from 'react';
import {useEffect} from 'react';
import {useSelector, useDispatch} from 'react-redux';
import {fetchPlace} from "../../asyncActions/places/fetchPlace";
import {useParams, NavLink} from 'react-router-dom';
import {Row, Col, Container, Carousel} from 'react-materialize';
import Gallery from "../../components/Gallery/Gallery";
import style from './Place.module.css';
import places from "../Places/Places";
import {fetchEventsByPlace} from "../../asyncActions/places/fetchEventsByPlace";

const Place = () => {
    const dispatch = useDispatch();
    const requestParams = useParams();
    const id = requestParams.id;

    const place = useSelector(state => state.placesReducer.place);
    const placeEvents = useSelector(state => state.placesReducer.placeEvents);
    console.log(place)

    useEffect(() => {
        const script = document.createElement('script');
        if (place.map) {
            script.src = `https://api-maps.yandex.ru/services/constructor/1.0/js/?um=${place.map}&amp;width=100%25&amp;height=600&amp;lang=ru_RU&amp;scroll=true`;
            script.charSet = "utf-8";
            script.async = true;

            document.querySelector('#mapContainer').append(script);
        }
        dispatch(fetchPlace(id));
        dispatch(fetchEventsByPlace(place.id))

    }, [place.map])


    return (
        <>
            <Carousel
                className={style.placeSlider}
                carouselId="Carousel-37"
                images={place.images ?? ['https://www.culturepartnership.eu/upload/news/5d5bd65b804b5.jpg']}
                options={{
                    fullWidth: true,
                    indicators: true,
                }}
            />
            <main>
                <Container>
                    <h1 className="white-text">{place.name}</h1>
                    <Row>
                        <Col className={style.placeBadge} s={4}>
                            <h5 className="white-text center-align">Характеристики</h5>
                            <Row className={style.placeBadgeRow}>
                                <Col s={4}><b>Климат:</b></Col>
                                <Col s={8} className={style.placeBadgeRow}><img className={style.badgeIcon}
                                                                                src={place.climat_icon}
                                                                                alt={place.climat_name}/>{place.climat_name}
                                </Col>
                            </Row>
                            <Row className={style.placeBadgeRow}>
                                <Col s={4}><b>Страна:</b></Col>
                                <Col s={8} className={style.placeBadgeRow}><img className={style.badgeIcon}
                                                                                src={place.country_flag}
                                                                                alt={place.country_name}/>{place.country_name}
                                </Col>
                            </Row>
                            <Row>
                                <Col s={4}><b>Адрес: </b></Col>
                                <Col s={8}>{place.address}</Col>
                            </Row>
                        </Col>
                        <Col s={8}>
                            <h4 className="white-text">Описание</h4>
                            <p className="white-text" dangerouslySetInnerHTML={{__html: place.description}}></p>
                        </Col>
                    </Row>
                    <h3 className="white-text">Карта</h3>
                    <Row>
                        <Col push={'s1'} s={10}>
                            <div style={{minHeight: 600, backgroundColor: '#101010'}} id="mapContainer"></div>
                        </Col>
                    </Row>
                    <h3 className="white-text">Галерея изображений</h3>
                    <Gallery photos={place.images}/>
                    <h4 className="white-text">События в этом месте</h4>
                    {
                        placeEvents.length ?
                            <Carousel
                                carouselId="Carousel-35"
                                className="white-text center"
                                options={{
                                    fullWidth: false,
                                    indicators: false
                                }}
                            >
                                {
                                    placeEvents.map(placeEvent => {
                                        return (
                                            <div className={`valign-wrapper hoverable ${style.sliderElem}`}
                                                 style={{backgroundImage: `url(${placeEvent.images[0]})`}}>
                                                <p style={{
                                                    backgroundColor: "rgba(0,0,0,0.6)",
                                                    textAlign: 'center',
                                                    fontSize: "2em",
                                                    width: '100%',
                                                    padding: '14px'
                                                }}><NavLink className={style.sliderElemLink}
                                                            to={`/events/${placeEvent.id}`}>{placeEvent.name}</NavLink>
                                                </p>
                                            </div>
                                        )
                                    })
                                }
                            </Carousel> : ''
                    }
                </Container>
            </main>
        </>
    );
};

export default Place;