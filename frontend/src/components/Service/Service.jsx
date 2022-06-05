import React from 'react';
import {Card, Col, Icon, CardTitle} from "react-materialize";
import {NavLink} from 'react-router-dom';
import style from './Service.module.css';

/**
 * Компонент сервисной карточки
 * @param id - ID
 * @param l - Как выглядит пли large брекпоинте
 * @param s - Как выглядит пли small брекпоинте
 * @param title - Заголовок
 * @param images - Изображения
 * @param name - Название
 * @param description - Описание
 * @param link - Ссылка
 * @param size - Размер
 * @param is_horizontal - Горизонтальная ли?
 * @returns {JSX.Element}
 * @constructor
 */
const Service = ({id, l, s, title, images, name, description, link, size, is_horizontal}) => {
    return (
        <Col
            l={l}
            s={s}
            className={style.serviceCardCol}
        >

            <Card
                actions={[
                    <NavLink key={1} to={`/events/${id}`}>Перейти</NavLink>
                ]}
                className={`${style.serviceCard} ${size}`}
                header={<CardTitle image={images[0]} reveal waves="light"/>}
                textClassName="white-text"
                title={name}
                horizontal={is_horizontal}
                reveal={undefined}
            >
                <p className={style.serviceCardText} dangerouslySetInnerHTML={{__html: description}}></p>
            </Card>
        </Col>
    );
};

export default Service;