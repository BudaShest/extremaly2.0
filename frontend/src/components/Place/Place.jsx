import React from 'react';
import {NavLink} from 'react-router-dom';

import {Card, Icon, CardTitle} from 'react-materialize';

const Place = ({id,name, address, country_code, description, images}) => {
    console.log(images);
    return (
        <Card
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
            <p>
                <NavLink to={`/places/${id}`}>Перейти</NavLink>
            </p>
        </Card>
    );
};

export default Place;