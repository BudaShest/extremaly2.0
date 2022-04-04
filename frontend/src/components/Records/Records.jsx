import React, {useEffect} from 'react';
import {Row, Col, Select, Icon, DatePicker, Card, CardTitle, Pagination, Button} from 'react-materialize';
import {NavLink} from 'react-router-dom';
import {useDispatch, useSelector} from 'react-redux';
import {
    fetchEventsByAge,
    fetchEvents,
    fetchEventsForOlds,
    fetchEventsForKids
} from "../../asyncActions/events/fetchEvents";
import {fetchPlaces} from "../../asyncActions/places/fetchPlaces";
import {fetchClimates} from "../../asyncActions/places/fetchClimates";
import {fetchCountries} from "../../asyncActions/places/fetchCountries";
import style from './Records.module.css';
import NoRecords from "../NoRecords/NoRecords";

const Records = ({records}) => {
    const dispatch = useDispatch();
    const climates = useSelector(state => state.placesReducer.climates);
    const countries = useSelector(state => state.placesReducer.countries);
    const places = useSelector(state => state.placesReducer.places);

    useEffect(() => {
        dispatch(fetchClimates());
        dispatch(fetchCountries());
        dispatch(fetchPlaces());
    }, [])

    const ageClickHandler = (e) => {
        if (e.currentTarget.classList.contains(style.filterBadge_active)) {
            dispatch(fetchEvents());
        } else {
            dispatch(fetchEventsByAge(e.currentTarget.dataset.age));
        }
        e.currentTarget.classList.toggle(style.filterBadge_active);
    }

    const kidsClickHandler = (e) => {
        if (e.currentTarget.classList.contains(style.filterBadge_active)) {
            e.currentTarget.classList.remove(style.filterBadge_active);
            dispatch(fetchEvents());
        } else {
            e.currentTarget.classList.add(style.filterBadge_active);
            dispatch(fetchEventsForKids());
        }
    }

    const oldsClickHandler = (e) => {
        if (e.currentTarget.classList.contains(style.filterBadge_active)) {
            e.currentTarget.classList.remove(style.filterBadge_active);
            dispatch(fetchEvents());
        } else {
            e.currentTarget.classList.add(style.filterBadge_active);
            dispatch(fetchEventsForOlds());
        }
    }

    const badgeClickHandler = (e) => {
        e.currentTarget.classList.toggle(style.filterBadge_active);
    }

    const changeFilterHandler = (e) => {
        console.log(e.currentTarget);
        e.currentTarget.classList.add(style.filterBlock_input_active);
    }

    return (
        <Row style={{margin: 0}}>
            <Col l={4}>
                <form className={style.filterBlock}>
                    <h4 className={style.filterBlock_headlines}>Фильтры: </h4>
                    <h5 className={style.filterBlock_headlines}>Место: </h5>

                    <Select
                        onChange={changeFilterHandler}
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
                            Выберите климат
                        </option>
                        {
                            climates.map(climate => (<option value={climate.code}>{climate.name}</option>))
                        }
                    </Select>

                    <Select
                        className={style.filterBlock_input}
                        icon={<Icon>cloud</Icon>}
                        id="Select-15"
                        multiple={false}
                        label="Страна проведения"
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
                            Выберите страну
                        </option>
                        {
                            countries.map(country => (<option value={country.code}>{country.name}</option>))
                        }
                    </Select>

                    <Select
                        className={style.filterBlock_input}
                        icon={<Icon>cloud</Icon>}
                        id="Select-15"
                        multiple={false}
                        label="Локация проведения"
                        options={{
                            classes: "white-text light",
                            dropdownOptions: {
                                alignment: 'left',
                                autoTrigger: true,
                                closeOnClick: true,
                                constrainWidth: true,
                                coverTrigger: true,
                                inDuration: 150,
                                outDuration: 250
                            }
                        }}
                        value=""
                    >
                        <option disabled value="">
                            Выберите локацию
                        </option>
                        {
                            places.map(place => (<option value={place.id}>{place.name}</option>))
                        }
                    </Select>
                    <h5 className={style.filterBlock_headlines}>Период: </h5>
                    <DatePicker
                        id="DatePicker-7"
                        label="Дата начала: "
                        options={{
                            autoClose: false,
                            disableWeekends: false,
                            events: [],
                            firstDay: 0,
                            format: 'mmm dd, yyyy',
                            i18n: {
                                cancel: 'Cancel',
                                clear: 'Clear',
                                done: 'Ok',
                                months: [
                                    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                                ],
                                monthsShort: [
                                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                ],
                                nextMonth: '›',
                                previousMonth: '‹',
                                weekdays: [
                                    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
                                ],
                                weekdaysAbbrev: ['S', 'M', 'T', 'W', 'T', 'F', 'S'
                                ],
                                weekdaysShort: [
                                    'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
                                ]
                            },
                            isRTL: false,
                            setDefaultDate: false,
                            showClearBtn: false,
                            showDaysInNextAndPreviousMonths: false,
                            showMonthAfterYear: false,
                            yearRange: 10
                        }}
                    />
                    <DatePicker
                        id="DatePicker-7"
                        label="Дата конца: "
                        options={{
                            autoClose: false,
                            disableWeekends: false,
                            events: [],
                            firstDay: 0,
                            format: 'mmm dd, yyyy',
                            i18n: {
                                cancel: 'Cancel',
                                clear: 'Clear',
                                done: 'Ok',
                                months: [
                                    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                                ],
                                monthsShort: [
                                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                ],
                                nextMonth: '›',
                                previousMonth: '‹',
                                weekdays: [
                                    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
                                ],
                                weekdaysAbbrev: [
                                    'S', 'M', 'T', 'W', 'T', 'F', 'S'
                                ],
                                weekdaysShort: [
                                    'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
                                ]
                            },
                            isRTL: false,
                            setDefaultDate: false,
                            showClearBtn: false,
                            showDaysInNextAndPreviousMonths: false,
                            showMonthAfterYear: false,
                            yearRange: 10
                        }}
                    />
                    <Button style={{backgroundColor: "#EE6E73"}} type="reset">Стереть фильтры</Button>
                </form>
            </Col>
            <Col l={8}>
                <Row>
                    <Col l={4}>
                        <div onClick={kidsClickHandler} data-age="18" className={`${style.filterBadge} hoverable`}>
                            Для детей
                        </div>
                    </Col>
                    <Col l={4}>
                        <div onClick={oldsClickHandler} data-age="100" className={`${style.filterBadge} hoverable`}>
                            Для взрослых
                        </div>
                    </Col>
                    <Col l={4}>
                        <div onClick={badgeClickHandler} className={`${style.filterBadge} hoverable`}>
                            Природные
                        </div>
                    </Col>
                </Row>
                <Col>
                    {
                        records ?
                            records.map(record => {
                                return (
                                    <Card
                                        key={record.id}
                                        actions={[
                                            <NavLink to={`/events/${record.id}`}>Перейти</NavLink>,
                                            <NavLink to={`/events/${record.id}`}>Заказть билеты</NavLink>,
                                        ]}
                                        closeIcon={<Icon>close</Icon>}
                                        header={<CardTitle image={record.images[0]}/>}
                                        horizontal
                                        revealIcon={<Icon>more_vert</Icon>}
                                        className={`small hoverable ${style.record}`}
                                    >
                                        <h5>{record.name}</h5>
                                        {/*<span>{record.offer}</span>*/}
                                        <p dangerouslySetInnerHTML={{__html: record.offer.slice(0, 255)}}></p>
                                    </Card>
                                );
                            })
                            :
                            <NoRecords/>
                    }
                    <Pagination
                        className={style.pagination}
                        activePage={3}
                        items={5}
                        leftBtn={<Icon>chevron_left</Icon>}
                        rightBtn={<Icon>chevron_right</Icon>}
                    />
                </Col>
            </Col>
        </Row>
    );
};

export default Records;