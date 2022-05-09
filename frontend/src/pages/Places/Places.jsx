import React, {useEffect, useState} from 'react';
import {Container, Row, Col, Pagination, Icon} from 'react-materialize';
import CountryBadge from "../../components/CountryBadge/CountryBadge";
import {useDispatch, useSelector} from 'react-redux';
import {fetchCountries} from "../../asyncActions/places/fetchCountries";
import {fetchClimates} from "../../asyncActions/places/fetchClimates";
import {fetchNumOfPages, fetchPlaces, fetchPlacesWithPagination} from '../../asyncActions/places/fetchPlaces';
import ClimateBadge from "../../components/ClimateBadge/ClimateBadge";
import Place from "../../components/Place/Place";
import NoRecords from "../../components/NoRecords/NoRecords";
import style from './Places.module.css';

/**
 * Страница "Места"
 * @returns {JSX.Element}
 * @constructor
 */
const Places = () => {
    const dispatch = useDispatch();

    useEffect(async () => {

        dispatch(fetchCountries());
        dispatch(fetchClimates());
        dispatch(fetchNumOfPages());
        dispatch(fetchPlacesWithPagination(1));

    }, [])

    const numOfPage = useSelector(state => state.placesReducer.numOfPages);

    const countries = useSelector(state => state.placesReducer.countries);

    const climates = useSelector(state => state.placesReducer.climates);

    const places = useSelector(state => state.placesReducer.places);

    function paginationHandler(page){
        dispatch(fetchPlacesWithPagination(page));
    }

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
                        <img className={style.offerImage} src="img/advantages/safety.png" alt="Безопасность"/>
                    </div>
                    <div className={style.offerCol}>
                        <h5>Комфорт</h5>
                        <p>Наверняка, вам не захочется провести ночь в палатке под дождём. Администрация проекта
                            "Extremly" гарантирует, что все все заявленные условия будут соблюдены. Будьте спокойны и
                            наслаждайтесь активным отдыхом!</p>
                        <img className={`${style.offerImage} ${style.centerImage}`} src="img/advantages/comfort.png"
                             alt="Комфорт"/>
                    </div>
                    <div className={style.offerCol}>
                        <h5>Простота</h5>
                        <p>Не думаем, что Вам самостоятельно хочется искать билеты на самолёт, организовывать транспорт,
                            искать отель и т.д. Это не беда! Команда Extremly всё сделает за вас! Вам остаётся лишь
                            приобрести билет!</p>
                        <img className={style.offerImage} src="img/advantages/goodwork.png" alt="Простота"/>
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
                            onSelect={paginationHandler}
                            className={style.pagination}
                            activePage={1}
                            items={numOfPage + 1}
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