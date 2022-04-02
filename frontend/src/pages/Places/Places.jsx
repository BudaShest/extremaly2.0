import React, {useEffect, useState} from 'react';
import {Container, Row, Col} from 'react-materialize';
import CountryBadge from "../../components/CountryBadge/CountryBadge";
import {useDispatch, useSelector} from 'react-redux';
import {fetchCountries} from "../../asyncActions/places/fetchCountries";
import {fetchClimates} from "../../asyncActions/places/fetchClimates";
import {fetchPlaces} from '../../asyncActions/places/fetchPlaces';
import ClimateBadge from "../../components/ClimateBadge/ClimateBadge";
import Place from "../../components/Place/Place";
import Records from "../../components/Records/Records";

const Places = () => {
    const dispatch = useDispatch();

    useEffect(async () => {
        const script = document.createElement('script');
        script.src = "https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A06a5bc8124e28a3155582c309a0319fdca6a0d1a807d8a73e2880b0a30a015e3&amp;width=100%25&amp;height=600&amp;lang=ru_RU&amp;scroll=true";
        script.charSet = "utf-8";
        script.async = true;

        document.querySelector('#mapContainer').append(script);
        dispatch(fetchCountries());
        dispatch(fetchClimates());
        dispatch(fetchPlaces());

    }, [])

    const countries = useSelector(state => state.placesReducer.countries);

    const climates = useSelector(state => state.placesReducer.climates);

    const places = useSelector(state => state.placesReducer.places);

    return (
        <main>
            <div id="mapContainer">

            </div>
            <Container>
                <p>test</p>
                <CountryBadge countries={countries}/>
                <Row>
                    <Col s={2}>
                        <ClimateBadge climates={climates}/>
                    </Col>
                    <Col s={10}>
                        {
                            places.map(place => <Place {...place}/> )
                        }
                    </Col>
                </Row>
            </Container>
        </main>
    );
};

export default Places;