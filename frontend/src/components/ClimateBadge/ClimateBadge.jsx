import React from 'react';
import style from "./ClimateBadge.module.css";
import {useDispatch} from 'react-redux';
import {Row, Col} from 'react-materialize';
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
                            <Col>
                                <a onClick={clickHandler} className={`${style.climatLink} filter-icon`} data-climat-code={climate.code}><
                                    img className={`${style.climateIcon} hoverable`} src={climate.icon} alt="Климат"/>
                                    <span>{climate.name}</span>
                                </a>
                            </Col>
                        )
                    })
                }
            </Row>
        </>
    );
};

export default ClimateBadge;