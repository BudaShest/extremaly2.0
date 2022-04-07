import React, {useState, useEffect} from 'react';
import {Row, Card} from 'react-materialize';
import Service from "../Service/Service";

const Services = ({topEvents}) => {

    // const [design, setDesign]= useState([
    //     {id: 1, s: 12, l: 5, is_horizontal: false},
    //     {id: 2, s: 12, l: 7, is_horizontal: true},
    //     {id: 3, s: 12, l: 7, is_horizontal: true},
    // ]);
    // const [services, setServices]= useState(topEvents);
    //
    // useEffect(() => {
    //     setServices(topEvents)
    // }, [])



    return (
        <Row style={{margin: 0}}>
            {
                topEvents.map(service => <Service key={service.id} {...service}/>)
            }
        </Row>
    );
};

export default Services;