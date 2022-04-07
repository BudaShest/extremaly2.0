import React, {useRef, useState} from 'react';
import {NavLink} from 'react-router-dom';
import {Container} from 'react-materialize';
import {useSelector} from 'react-redux';
import {Row, Col, TextInput, Button} from 'react-materialize';
import {createApplication} from "../../asyncActions/applications/createApplication";

const Application = () => {
    const tickets = useSelector(state => state.applicationsReducer.tickets);

    const [ticketCnt, setTicketCnt] = useState(1);
    const [resMessage, setResMessage] = useState();
    console.log(tickets)

    function changeCntHandler(e) {
        setTicketCnt(e.currentTarget.value);
        console.log(ticketCnt);
        let price = document.querySelector('.'+e.currentTarget.dataset.priceId).value;
        console.log(document.querySelector('.'+e.currentTarget.dataset.sumId));
        document.querySelector('.'+e.currentTarget.dataset.sumId).textContent = ticketCnt * price;
    }

    function handleSubmit(e){
        e.preventDefault();
        let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
        let application = {"user_id": currentUser.id, "num": ticketCnt, "ticket_id": e.currentTarget.dataset.ticketId}
        createApplication(application).then(res => {
            setResMessage(res.message)
            if(res.status == 200){
                e.target.style.display = 'none';
                setTimeout(()=>{setResMessage('')}, 10000);
            }
        })
        console.log(application);
    }

    return (
        <main>
            <Container>
                <h2 className="white-text">Неподтверждённые заявки</h2>
                <Row>
                    <Col className="white-text " s={2} style={{fontSize:'1.3em'}}>Событие:</Col>
                    <Col className="white-text " s={2} style={{fontSize:'1.3em'}}>Цена билета:</Col>
                    <Col className="white-text " s={2} style={{fontSize:'1.3em'}}>Кол-во: </Col>
                    <Col className="white-text " s={2} style={{fontSize:'1.3em'}}>Суммарно: </Col>
                    <Col className="white-text " s={4} style={{fontSize:'1.3em'}}>Подтверждение </Col>
                </Row>
                <Row>
                    <h4 className="white-text">{resMessage}</h4>
                </Row>

                    {
                        tickets.map(ticket => {
                            return (<form data-ticket-id={ticket.id} onSubmit={handleSubmit}><Row>
                                <Col s={2}><NavLink className="white-text " style={{textDecoration:'underline'}} to={`/events/${ticket.event_id}`}>{ticket.event_name}</NavLink></Col>
                                <Col s={2}><TextInput className={'ticketPrice' + ticket.id} disabled value={ticket.price}/></Col>
                                <Col s={2}><TextInput style={{fontSize:'1.3em'}} data-price-id={'ticketPrice' + ticket.id} data-sum-id={'ticketSum' + ticket.id} onChange={changeCntHandler}
                                                      name="cnt" value={ticketCnt} type="number"/></Col>
                                <Col s={2}><div style={{fontSize:'1.3em',color:'white',padding:10}} className={'white-text ticketSum' + ticket.id}></div></Col>
                                <Col s={4}><Button>Подтвердить</Button></Col>
                            </Row></form>);
                        })
                    }
            </Container>
        </main>
    );
};

export default Application;