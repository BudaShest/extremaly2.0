import React, {useEffect, useState} from 'react';
import {Container, Row, Col, Pagination, Icon} from 'react-materialize';
import CountryBadge from "../../components/CountryBadge/CountryBadge";
import {useDispatch, useSelector} from 'react-redux';
import {fetchCountries} from "../../asyncActions/places/fetchCountries";
import {fetchClimates} from "../../asyncActions/places/fetchClimates";
import {fetchPlaces} from '../../asyncActions/places/fetchPlaces';
import ClimateBadge from "../../components/ClimateBadge/ClimateBadge";
import Place from "../../components/Place/Place";
import NoRecords from "../../components/NoRecords/NoRecords";
import style from './Places.module.css';

const Places = () => {
    const dispatch = useDispatch();

    useEffect(async () => {
        // const script = document.createElement('script');
        // script.src = "https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A06a5bc8124e28a3155582c309a0319fdca6a0d1a807d8a73e2880b0a30a015e3&amp;width=100%25&amp;height=600&amp;lang=ru_RU&amp;scroll=true";
        // script.charSet = "utf-8";
        // script.async = true;
        //
        // document.querySelector('#mapContainer').append(script);
        dispatch(fetchCountries());
        dispatch(fetchClimates());
        dispatch(fetchPlaces());

    }, [])

    const countries = useSelector(state => state.placesReducer.countries);

    const climates = useSelector(state => state.placesReducer.climates);

    const places = useSelector(state => state.placesReducer.places);

    return (
        <main>
            <div className={style.topOffer}>
                <h3 className="center-align">Места</h3>
                <p className={style.topOfferText}>На данной странице отображены места, в которых и происходят различного
                    рода развлекательные события. Для быстрого поиска можете воспользоваться фильтрами стран и климата.
                    Мы надеемся, что Вы обязательно найдете интересующее вас место</p>
                <h4 className="center-align">Наши преимущества</h4>
                <div className={style.offerRow}>
                    <div className={style.offerCol}>
                        <h5>Безопасность</h5>
                        <p>Наш огромный мир полон различных опасных мест, куда лучше не соваться. Но можете быть
                            спокойны. на нашей плоащдке не будет ни одного такого места! Все локации, отобранные нами и
                            происходящие в них события полностью соответствуют всем нормативам безопасности</p>
                        <img className={style.offerImage} src="img/advantages/safety.png" alt=""/>
                    </div>
                    <div className={style.offerCol}>
                        <h5>Комфорт</h5>
                        <p>Наверняка, вам не захочется провести ночь в палатке под дождём. Администрация проекта
                            "Extremly" гарантирует, что все все заявленные условия будут соблюдены. Будьте спокойны и
                            наслаждайтесь активным отдыхом!</p>
                        <img className={style.offerImage} src="img/advantages/comfort.png" alt=""/>
                    </div>
                    <div className={style.offerCol}>
                        <h5>Простота</h5>
                        <p>Не думаем, что Вам самостоятельно хочется искать билеты на самолёт, организовывать транспорт,
                            искать отель и т.д. Это не беда! Команда Extremly всё сделает за вас! Вам остаётся лишь
                            приобрести билет!</p>
                        <img className={style.offerImage} src="img/advantages/goodwork.png" alt=""/>
                    </div>
                </div>
            </div>
            <Container>
                <CountryBadge countries={countries}/>
                <Row>
                    <Col s={12} m={2}>
                        <ClimateBadge climates={climates}/>
                    </Col>
                    <Col s={12} m={10}>
                        {
                            places.length ?
                                places.map(place => <Place {...place}/>)
                                :
                                <NoRecords/>
                        }
                        <Pagination
                            className={style.pagination}
                            activePage={1}
                            items={5}
                            leftBtn={<Icon>chevron_left</Icon>}
                            rightBtn={<Icon>chevron_right</Icon>}
                        />
                    </Col>
                </Row>

            </Container>
        </main>
    );
};

export default Places;