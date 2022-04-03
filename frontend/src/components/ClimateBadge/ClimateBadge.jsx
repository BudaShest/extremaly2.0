import React from 'react';
import style from "./ClimateBadge.module.css";
import {useDispatch} from 'react-redux';
import {Row} from 'react-materialize';
import {fetchPlacesByClimat} from "../../asyncActions/places/fetchPlaces";

const ClimateBadge = ({climates}) => {
    const dispatch = useDispatch();

    function clickHandler(e) {
        dispatch(fetchPlacesByClimat(e.currentTarget.dataset.climatCode));
    }

    return (
        <>
            <h4 className="white-text">Климаты:</h4>
            <Row>
                {
                    climates.map(climate => {
                        return (
                            <a onClick={clickHandler} data-climat-code={climate.code} className="col s12"><
                                img className={`${style.climateIcon} hoverable`} src={climate.icon} alt="Климат"/>
                            </a>
                        )
                    })
                }
            </Row>
        </>
    );
};

export default ClimateBadge;