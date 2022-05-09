import React from 'react';
import {useSelector, useDispatch} from 'react-redux';
import {Row} from 'react-materialize';
import {fetchPlacesByCountry} from "../../asyncActions/places/fetchPlaces";
import style from './Country.module.css';

/**
 * Компонента-плашка фильтров по странам
 * @param countries
 * @returns {JSX.Element}
 * @constructor
 */
const CountryBadge = ({countries}) => {
    const dispatch = useDispatch();

    function clickHandler(e) {
        resetActiveClasses();
        let badgeIcon = e.currentTarget.children[0];
        badgeIcon.classList.add(style.countryIconActive);
        dispatch(fetchPlacesByCountry(e.currentTarget.dataset.countryCode));
    }

    function resetActiveClasses() {
        let badgeIcons = document.querySelectorAll("." + style.countryIconActive);
        badgeIcons.forEach(badgeIcon => badgeIcon.classList.remove(style.countryIconActive));
    }

    return (
        <>
            <h4 className="white-text">Страны:</h4>
            <Row>
                {
                    countries.map(country => {
                        return (
                            <a onClick={e => clickHandler(e)} data-country-code={country.code}
                               className={`col ${style.countryLink}`}>
                                <img className={`${style.countryIcon} hoverable`} src={country.flag}
                                     alt={country.name}/>
                                <span>{country.name}</span>
                            </a>)
                    })
                }
            </Row>
        </>
    );
};

export default CountryBadge;