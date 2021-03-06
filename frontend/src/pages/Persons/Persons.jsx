import React, {useEffect, useRef} from 'react';
import {Container, Row, Col, Pagination, Icon, Select, TextInput, Button} from 'react-materialize';
import {useSelector, useDispatch} from 'react-redux';
import {
    fetchNumOfPaginatedPages,
    fetchPersons,
    fetchPersonsByAge,
    fetchPersonsByFounded,
    fetchPersonsByProfession,
    fetchPersonsWithPagination
} from '../../asyncActions/persons/fetchPersons';
import {fetchProfessions} from "../../asyncActions/persons/fetchProfession";
import style from './Persons.module.css';
import NoRecords from "../../components/NoRecords/NoRecords";

const Persons = () => {
    const persons = useSelector(state => state.personsReducer.persons);
    const numOfPages = useSelector(state => state.personsReducer.numOfPages);
    const professions = useSelector(state => state.personsReducer.professions);
    const dispatch = useDispatch();
    const requestedStringRef = useRef();

    useEffect(() => {
        dispatch(fetchPersonsWithPagination(1));
        dispatch(fetchProfessions());
        dispatch(fetchNumOfPaginatedPages());
    }, [])

    function professionChangeHandler(e) {
        dispatch(fetchPersonsByProfession(e.currentTarget.value))
    }

    function ageChangeHandler(e) {
        dispatch(fetchPersonsByAge(e.currentTarget.value))
    }

    /** Поиск */
    function search(e) {
        e.preventDefault();
        dispatch(fetchPersonsByFounded(requestedStringRef.current.value))
    }

    /** Сброс фильтров */
    function resetFiltersHandler() {
        dispatch(fetchPersonsWithPagination(1));
    }

    /** Обработчик пагинации */
    function paginationHandler(page) {
        dispatch(fetchPersonsWithPagination(page))
    }

    return (
        <main>
            <div className={style.topOffer}>
                <h3 className="center-align">Личности</h3>
                <p className={`${style.topOfferText} center-align`}>Вы можете сказать большое спасибо всем тем, кто помогает нам в организации различных событий. Именно благодаря этим людям вы можете наслаждаться отдыхом в полной мере!</p>
            </div>
            <Container>
                <h1 className="white-text">Все личности</h1>
                <Row>
                    <Col s={12} m={12} l={4}>
                        <form action="" className={style.filterBlock} onSubmit={e => e.preventDefault()}>
                            <h4 className="white-text">Фильтры: </h4>
                            <Select
                                s={12}
                                onChange={professionChangeHandler}
                                className={style.filterBlock_input}
                                icon={<Icon>cloud</Icon>}
                                id="Select-15"
                                multiple={false}
                                label="Климат"
                                options={{
                                    classes: "white-text light",
                                    dropdownOptions: {
                                        alignment: 'left',
                                        autoTrigger: true,
                                        closeOnClick: true,
                                        constrainWidth: true,
                                        coverTrigger: true,
                                        hover: false,
                                        inDuration: 150,
                                        outDuration: 250
                                    }
                                }}
                                value=""
                            >
                                <option disabled value="">
                                    Выберите роль в событии
                                </option>
                                {
                                    professions.map(profession => (
                                        <option key={profession.id} value={profession}>{profession}</option>))
                                }
                            </Select>
                            <Button style={{backgroundColor: "#EE6E73"}} onClick={resetFiltersHandler}>Стереть фильтры</Button>
                            <h5 className="white-text">Поиск: </h5>
                            <TextInput
                                ref={requestedStringRef}
                                s={12}
                                icon="login"
                                id="TextInput-33"
                                label="Имя или фамилия"
                            />
                           <Button onClick={search}>Поиск</Button>
                        </form>
                    </Col>
                    <Col s={12} m={12} l={8}>
                        {
                            persons.length ?
                                persons.map(person => {
                                return (
                                    <Row className={style.personRow} key={person.id}>
                                        <Col s={12} m={12} l={6} xl={4}>
                                            <img className={style.personImage} src={person.images[0]} alt="Аватар"/>
                                        </Col>
                                        <Col s={12} m={12} l={6} xl={8}>
                                            <div className={style.personInfoBadge}>
                                                <h5>{person.firstname} {person.lastname}</h5>
                                                <p className={style.personDescription} dangerouslySetInnerHTML={{__html: person.description}}></p>
                                                <span><b>Роль в событии: </b>{person.role}</span>
                                                <hr/>
                                                <span>Соц. сети</span>
                                                <div>
                                                    {
                                                        person.links.map(link => {
                                                            return (<a href={link.url} key={link.id} title={link.title} target="_blank"><img style={{width:30, height:30, borderRadius:'50%', objectFit: 'contain', margin:10}} src={link.icon} alt={link.title}/></a>);
                                                        })
                                                    }
                                                </div>
                                            </div>
                                        </Col>
                                    </Row>
                                );
                            })
                            :
                            <NoRecords/>
                        }
                        <Pagination
                            onSelect={paginationHandler}
                            className={style.pagination}
                            activePage={1}
                            items={numOfPages}
                            leftBtn={<Icon>chevron_left</Icon>}
                            rightBtn={<Icon>chevron_right</Icon>}
                        />
                    </Col>
                </Row>
            </Container>
        </main>
    );
};

export default Persons;