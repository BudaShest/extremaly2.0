import React from 'react';
import {Container} from 'react-materialize';
import {useSelector} from 'react-redux';


const Application = () => {
    const tickets = useSelector(state => state.applicationsReducer.tickets);
    console.log(tickets)

    return (
        <main>
            <Container>
                <h2>Неподтверждённые заявки</h2>
                {
                    tickets.map(ticket=>{
                        return (<div>{ticket.price}</div>);
                    })
                }
            </Container>
        </main>
    );
};

export default Application;