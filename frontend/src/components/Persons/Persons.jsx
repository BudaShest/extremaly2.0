import React, {useState, useEffect} from 'react';
import {Col, Row, Preloader} from "react-materialize";
import style from './Persons.module.css';
import Person from "../Person/Person";
import SocialLinks from "../SocialLinks/SocialLinks";

/**
 * Компонент "Личности"
 * @param persons
 * @returns {JSX.Element}
 * @constructor
 */
const Persons = ({persons}) => {
    const [activeIndex, setActiveIndex] = useState(1);
    const [personList, setPersonList] = useState(persons);
    const [activePerson, setActivePerson] = useState(personList[1]);

    useEffect(()=>{
        setPersonList(persons);
        let currentPerson = persons.filter((person, index) => index == activeIndex)[0]
        setActivePerson(currentPerson);
    }, [persons])

    useEffect(() => {
        let currentPerson = persons.filter((person, index) => index == activeIndex)[0]
        setActivePerson(currentPerson);
    }, [activeIndex])

    const clickHandler = (e) => {
        if (e.target.closest('div').dataset.number) {
            let index = e.target.closest('div').dataset.number;
            setActiveIndex(index);
        }
    }

    return (
        <Col className={style.persons}>
            <div className={style.personsRow}>
                {
                    personList.map((person, index) => <Person key={person.id} index={index} isActive={index == activeIndex}
                                                           clickHandler={clickHandler} person={person}/>)
                }
            </div>
            <div className={style.activePersonTextContent_row}>
                <Col l={6} className={`${style.activePersonTextContent} `}>
                    <h3>{activePerson?.firstname} {activePerson?.surname}</h3>
                    <h4>{activePerson?.role}</h4>
                    <p style={{fontSize: '1.2em'}} dangerouslySetInnerHTML={{__html: activePerson?.description}}></p>
                    <SocialLinks links={activePerson?.links ?? []}/>
                </Col>
            </div>
        </Col>
    );
};

export default Persons;
