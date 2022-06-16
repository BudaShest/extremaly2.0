import React, {useEffect, useState} from 'react';
import {useSelector, useDispatch} from 'react-redux';
import {Container} from 'react-materialize';
import {useParams, NavLink, useNavigate} from 'react-router-dom';
import {fetchApplication} from "../../asyncActions/applications/fetchApplication";
import style from './CurrentApplication.module.css';
import app from "../../App";


const CurrentApplication = () => {
    const dispatch = useDispatch();
    const requestParams = useParams();

    const application = useSelector(state => state.applicationsReducer.currentApplication);

    useEffect(()=>{
        dispatch(fetchApplication(requestParams.id));
    }, [])


    return (
        <main>
            <Container>
                <h1 className="white-text center-align">Просмотр информации о заявке</h1>
                <NavLink style={{fontSize: '1.3em', textDecoration: 'underline'}} className="white-text" to={'/user'}>Назад</NavLink>
                <div className={style.tableWrapper}>
                    <table className={style.applicationTable}>
                        <tr>
                            <th>Номер заявки: </th>
                            <td>{application.id}</td>
                        </tr>
                        <tr>
                            <th>Статус: </th>
                            <td>{application.status_name}</td>
                        </tr>
                        <tr>
                            <th>Дата создания: </th>
                            <td>{application.created_at}</td>
                        </tr>
                        <tr className={style.applicationTicketsTable}>Билеты</tr>
                        <tr>
                            <th>Событие:</th>
                            <th>Привилегии:</th>
                            <th>Цена:</th>
                            <th>Кол-во: </th>
                        </tr>
                        {
                            application.tickets && application.tickets.map(ticket => {
                                // console.log(ticket.ticket_applications)
                                let currentTicket = ticket?.ticket_applications.filter(item => item.application_id == application.id)[0];
                                return (<tr>
                                    <th>{ticket.event_name}</th>
                                    <th>{ticket.privilege}</th>
                                    <th>{ticket.price}</th>
                                    <th>{currentTicket?.num}</th>
                                </tr>)
                            })
                        }
                    </table>
                </div>
            </Container>
        </main>
    );
};

export default CurrentApplication;