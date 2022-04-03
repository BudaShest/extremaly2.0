import React from 'react';
import {NavLink} from 'react-router-dom';
import style from './Place.module.css';
import {Card, Icon, CardTitle} from 'react-materialize';

const Place = ({id,name, address, country_code, description, images}) => {
    console.log(images);
    return (
        <Card
            className={style.placeRow}
            actions={
                <NavLink to={`/places/${id}`}>Перейти</NavLink>
            }
            closeIcon={<Icon>close</Icon>}
            header={<CardTitle image={images[0]} reveal
                               waves="light"/>}
            title={name}
            horizontal = {true}
        >
            <ul>
                <li><b>Страна: </b>{country_code}</li>
                <li><b>Адрес: </b>{address}</li>
            </ul>
            <span><b>Описание</b></span>
            <p>
                {description}
            </p>
        </Card>
    );
};

export default Place;