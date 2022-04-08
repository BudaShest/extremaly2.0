import React,{useState, useEffect} from 'react';
import {Col, Row, Preloader} from "react-materialize";
import style from './Persons.module.css';
import Person from "../Person/Person";
import SocialLinks from "../SocialLinks/SocialLinks";

import {socialLinks} from "../../pages/Event/Event";


const Persons = ({persons}) => {
    const [activeIndex, setActiveIndex] = useState(1);
    const [activePerson, setActivePerson] = useState(persons[1]);

    const clickHandler = (e)=>{
        console.log(e.currentTarget.dataset)
        if(e.target.closest('div').dataset.number){
            let index = e.target.closest('div').dataset.number;
            setActiveIndex(index);
            console.log(activeIndex);
        }
    }

    useEffect(()=>{

        let currentPerson = persons.filter((person, index)=>index == activeIndex)
        currentPerson = currentPerson[0]
        setActivePerson(currentPerson);

    }, [activeIndex])



    return (
        <Col className={style.persons}>
            <div className={style.personsRow}>
                {
                    persons.map((person,index)=><Person index={index} isActive={index == activeIndex} clickHandler={clickHandler} person={person} />)
                }
            </div>
            <div className={style.activePersonTextContent_row}>
                <Col l={6} className={`${style.activePersonTextContent} `}>
                    <h3>{activePerson?.firstname} {activePerson?.surname}</h3>
                    <h4>{activePerson?.role}</h4>
                    <p style={{fontSize:'1.2em'}} dangerouslySetInnerHTML={{__html:activePerson?.description}}></p>
                    <SocialLinks links={activePerson?.links ?? []}/>
                </Col>
            </div>
        </Col>
    );



};

export default Persons;