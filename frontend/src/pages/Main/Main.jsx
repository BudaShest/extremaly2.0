import React, {useEffect} from 'react';
import {useDispatch, useSelector} from 'react-redux';
import SectionSlider from "../../components/SectionSlider/SectionSlider";
import {Container, Row} from "react-materialize";
import SectionAbout from "./SectionAbout";
import Services from "../../components/Services/Services";
import MainSlider from "../../components/MainSlider/MainSlider";
import {fetchTopSlides} from "../../asyncActions/main/fetchTopSlides";
import {fetchAboutUs} from "../../asyncActions/main/fetchAboutUs";
import {fetchRandomPersons} from "../../asyncActions/persons/fetchPersons";
import {fetchReviews} from "../../asyncActions/main/fetchReviews";
import {fetchAdvantages} from "../../asyncActions/main/fetchAdvantages";
import {fetchEventsByPriority} from "../../asyncActions/events/fetchEvents";
import style from './Main.module.css';

const Main = () => {
    const dispatch = useDispatch();

    const aboutUs = useSelector(state => state.mainReducer.aboutUs);
    const advantages = useSelector(state => state.mainReducer.advantages);
    const persons = useSelector(state => state.personsReducer.randomPersons);
    const topSlides = useSelector(state => state.mainReducer.topSlides);
    const topEvents= useSelector(state => state.eventsReducer.topEvents);
    const reviews = useSelector(state => state.mainReducer.reviews);

    useEffect(()=>{
        dispatch(fetchRandomPersons())
        dispatch(fetchTopSlides())
        dispatch(fetchAboutUs())
        dispatch(fetchAdvantages())
        dispatch(fetchEventsByPriority())
        dispatch(fetchReviews())
    },[])

    return (
        <>
            <MainSlider slides={topSlides? topSlides:[]}/>
            <SectionSlider/>
            <Row className={style.parallaxBlock}></Row>
            <SectionAbout advantages={advantages} persons={persons} reviews={reviews} aboutUs={aboutUs}/>
            <Row className={style.parallaxBlock}></Row>
            <section style={{backgroundColor:"#222"}}>
                <Container>
                    <h2 className="white-text" style={{margin:0,padding:30}}>Популярное</h2>
                    <Services topEvents={topEvents}/>
                </Container>
            </section>
        </>
    );
};

export default Main;