import React, {useEffect} from 'react';
import {Container} from 'react-materialize';
import Services from "../../components/Services/Services";
import Records from '../../components/Records/Records';
import {useSelector, useDispatch} from 'react-redux';
import {fetchEvents, fetchEventsByPriority} from "../../asyncActions/events/fetchEvents";

const Events = () => {
    const events = useSelector(state => state.eventsReducer.events);
    const topEvents= useSelector(state => state.eventsReducer.topEvents);

    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(fetchEvents());
        dispatch(fetchEventsByPriority());
    }, [])

    return (
        <main style={{backgroundColor: "#222"}}>
            <Container>
                <h2 className="white-text" style={{margin: 0, padding: 30}}>Популярное</h2>
                <Services topEvents={topEvents}/>
                <h3 className="white-text" style={{padding: 30}}>Все услуги</h3>
                <Records records={events}/>
            </Container>
        </main>
    );
};

export default Events;