import React, {useState} from 'react';
import {Col, Row, Button} from 'react-materialize';
import BasketItem from "../BaketItem/BasketItem";
import style from './Basket.module.css'

/**
 * Компонент "Корзина"
 * @param applications
 * @returns {JSX.Element}
 * @constructor
 */
const Basket = ({applications}) => {
    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
    const [totalValue, setTotalValue] = useState(0);

    const getTotal = (value) => {
        setTotalValue(prevState => prevState + value);
    }

    return (
        <div>
            <h2 className={`white-text ${style.header}`}>Неподтверждённые заявки</h2>
            {/*todo url*/}
            <form style={{margin: '40px 0'}} method="post" action="http://extremly.ru:8000/application/create-application">
                <Row>
                    <Col s={12} m={9}>
                        <Row style={{backgroundColor: 'rgba(0, 0, 0, 0.5)'}}>
                            <Col className="white-text " s={6} l={3}  style={{fontSize: '1.3em'}}>Событие:</Col>
                            <Col className="white-text " s={6} l={3} style={{fontSize: '1.3em'}}>Цена билета:</Col>
                            <Col className="white-text " s={6} l={3} style={{fontSize: '1.3em'}}>Кол-во: </Col>
                            <Col className="white-text " s={6} l={3} style={{fontSize: '1.3em'}}>Суммарно: </Col>
                        </Row>
                        {
                            applications.map(application => <BasketItem countChange={getTotal} key={application.id}
                                                                        item={application}/>)
                        }
                    </Col>
                    <Col className={style.summaryBlock} s={12} m={9}>
                        <h4 className="white-text">Итого:</h4>
                        <span className={style.totalSpan}>{totalValue} руб.</span>
                        <Button className={style.submitForm} large>Подтвердить</Button>
                    </Col>
                </Row>
                <input type="hidden" name={"user_id"} value={currentUser.id}/>
            </form>
        </div>
    );
};

export default Basket;