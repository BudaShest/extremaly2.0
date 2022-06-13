import React, {useState, useEffect} from 'react';
import {Row, Col} from 'react-materialize';
import {NavLink} from 'react-router-dom';
import style from './BasketItem.module.css';

/**
 * Компонент "Элемент корзину"
 * @param item
 * @param countChange
 * @returns {JSX.Element}
 * @constructor
 */
const BasketItem = ({item, countChange}) => {

    const [itemCount, setItemCount] = useState(1);
    const [summary, setSummary] = useState(item.price);

    useEffect(()=>{
        countChange(item.price);
    }, [])

    const minusHandler = (e) => {
        if (itemCount >= 2) {
            setItemCount(prevState => prevState - 1);
            setSummary(prevState => prevState - item.price);
            countChange(-item.price);
        } else {
            let result = window.confirm('Вы уверены, что хотите удалить данную позицию из корзины?');

            //todo удаление
        }
    }

    const plusHandler = (e) => {
        if (itemCount <= 9) {
            setItemCount(prevState => prevState + 1);
            setSummary(prevState => prevState + item.price);
            countChange(+item.price);
        } else {
            alert('Нельзя заказать более 10 билетов н а одно мероприятие!');
        }
    }

    return (
        <Row>
            <Col s={3}>
                <NavLink to={`/events/${item.event_id}`} className={`white-text ${style.itemLink}`} style={{textDecoration: 'underline'}}>{item.event_name}</NavLink>
                <input name={`tickets[ticket${item.id}][id]`} value={item.id} type="hidden"/>
            </Col>
            <Col s={3}><span className={style.itemPrice}>{item.price} руб.</span></Col>
            <Col s={3} className={style.countInputBlock}>
                <button type="button" onClick={minusHandler} className={`${style.controlBtn} ${style.minusBtn}`}>-</button>
                <input name={`tickets[ticket${item.id}][cnt]`} className={style.controlInput} min={0} max={10} value={itemCount} type="number"/>
                <button type="button" onClick={plusHandler} className={`${style.controlBtn} ${style.plusBtn}`}>+</button>
            </Col>
            <Col s={3}>
                <span className={`${style.itemPrice} summary`}>{summary} руб.</span>
            </Col>
        </Row>
    );
};

export default BasketItem;