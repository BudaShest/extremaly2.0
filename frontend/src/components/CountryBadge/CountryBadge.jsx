import React from 'react';
import {Row} from 'react-materialize';
import style from './Country.module.css';

const CountryBadge = ({countries}) => {
    return (
        <>
        <h4 className="white-text">Страны:</h4>
        <Row>
            {
                countries.map(country=>{
                    return <a className="col hoverable"><img className={style.countryIcon} src={country.flag} alt=""/></a>
                })
            }
        </Row>
        </>
    );
};

export default CountryBadge;