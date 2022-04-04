import React from 'react';
import {NavLink} from 'react-router-dom';
import style from './Place.module.css';
import {Card, Icon, CardTitle} from 'react-materialize';

const Place = ({id, name, address, climat_name, country_code, country_name, description, images}) => {
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
            horizontal={true}
        >
            <ul>
                <li><b>Страна: </b>{country_name}</li>
                <li><b>Адрес: </b>{address}</li>
                <li><b>Климат: </b>{climat_name}</li>
            </ul>
            <span><b>Описание</b></span>
            <p className={style.placeRowText} dangerouslySetInnerHTML={{__html: description.slice(0, 255)}}></p>
        </Card>
    );
};

export default Place;