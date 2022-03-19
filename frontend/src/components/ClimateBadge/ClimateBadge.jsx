import React from 'react';
import style from "./ClimateBadge.module.css";
import {Row} from 'react-materialize';

const ClimateBadge = ({climates}) => {
    return (
        <>
            <h4 className="white-text">Климаты:</h4>
            <Row>
                {
                    climates.map(climate=>{
                        return <a className="col s12"><img className={`${style.climateIcon} hoverable`} src={climate.icon} alt="Климат"/></a>
                    })
                }
            </Row>
        </>
    );
};

export default ClimateBadge;