import React, {useState, useEffect} from 'react';
import {Row, Card} from 'react-materialize';
import Service from "../Service/Service";

const design =[
    {id: 1, s: 12, l: 5, is_horizontal: false},
    {id: 2, s: 12, l: 7, is_horizontal: true},
    {id: 3, s: 12, l: 7, is_horizontal: true},
];

const Services = ({topEvents}) => {
    const [events, setEvents] = useState(topEvents);

    useEffect(()=>{
        let currentEvents = [];
        for(let i = 0;i<topEvents.length;i++){
            currentEvents.push({...topEvents[i], ...design[i]});
        }
        setEvents(currentEvents)
    },[topEvents])


    return (
        <Row style={{margin: 0}}>
            {
                events.map(service => <Service key={service.id} {...service}/>)
            }
        </Row>
    );
};

export default Services;