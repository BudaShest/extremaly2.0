import React, {useEffect} from 'react';
import {Container, Row, Col} from 'react-materialize';
import {useSelector, useDispatch} from 'react-redux';
import {fetchPersons} from '../../asyncActions/persons/fetchPersons';
import style from './Persons.module.css';

const Persons = () => {
    const persons = useSelector(state => state.personsReducer.persons);
    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(fetchPersons());
    }, [])

    return (
        <main>
            <Container>
                <h1>Все личности</h1>
                <Row>
                    <Col s={3}>
                        <form action="">
                            <h4>Фильтры: </h4>

                        </form>
                    </Col>
                    <Col s={9}>
                        {
                            persons.map(person => {
                                return (
                                    <Row className={style.personRow}  key={person.id}>
                                        <Col s={4}>
                                            <img className={style.personImage} src={person.images[0]} alt=""/>
                                        </Col>
                                        <Col s={8}>
                                            <div className={style.personInfoBadge}>
                                                <h5>{person.firstname} {person.lastname}</h5>
                                                <p>{person.description}</p>
                                                <span>Профессия: {person.profession}</span>
                                            </div>
                                        </Col>
                                    </Row>
                                );
                            })
                        }
                    </Col>
                </Row>
            </Container>
        </main>
    );
};

export default Persons;