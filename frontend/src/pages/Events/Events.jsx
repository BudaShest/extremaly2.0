import React, {useEffect} from 'react';
import {Container} from 'react-materialize';
import Services from "../../components/Services/Services";
import Records from '../../components/Records/Records';
import {useSelector, useDispatch} from 'react-redux';
import {
    fetchEvents,
    fetchEventsByPriority,
    fetchEventsWithPagination,
    fetchNumOfPages
} from "../../asyncActions/events/fetchEvents";
import {fetchPersonsWithPagination} from "../../asyncActions/persons/fetchPersons";

/**
 * Странииа "События"
 * @returns {JSX.Element}
 * @constructor
 */
const Events = () => {
    const events = useSelector(state => state.eventsReducer.events);
    const topEvents = useSelector(state => state.eventsReducer.topEvents);
    const numOfPages = useSelector(state => state.eventsReducer.numOfPages);

    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(fetchNumOfPages());
        dispatch(fetchEventsByPriority());
        dispatch(fetchEventsWithPagination(1));
    }, [])

    return (
        <main style={{backgroundColor: "#222"}}>
            <Container>
                <h2 className="white-text" style={{margin: 0, padding: 30}}>Популярное</h2>
                <Services topEvents={topEvents}/>
                <h3 className="white-text" style={{padding: 30}}>Все услуги</h3>
                <Records numOfPages={numOfPages} records={events}/>
            </Container>
        </main>
    );
};

export default Events;