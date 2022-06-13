import React, {useEffect} from 'react';
import {useDispatch, useSelector} from 'react-redux';
import SectionSlider from "../../components/SectionSlider/SectionSlider";
import {Container, Row} from "react-materialize";
import SectionAbout from "./SectionAbout";
import Services from "../../components/Services/Services";
import MainSlider from "../../components/MainSlider/MainSlider";
import {fetchTopSlides} from "../../asyncActions/main/fetchTopSlides";
import {fetchAboutUs} from "../../asyncActions/main/fetchAboutUs";
import {fetchTopPersons} from "../../asyncActions/persons/fetchPersons";
import {fetchNumOfPages, fetchReviews, fetchReviewWithPagination} from "../../asyncActions/main/fetchReviews";
import {fetchAdvantages} from "../../asyncActions/main/fetchAdvantages";
import {fetchEventsByPriority} from "../../asyncActions/events/fetchEvents";
import {fetchSocialLinks} from "../../asyncActions/main/fetchSocialLinks";
import style from './Main.module.css';

/**
 * Главная страница
 * @returns {JSX.Element}
 * @constructor
 */
const Main = () => {
    const dispatch = useDispatch();

    const aboutUs = useSelector(state => state.mainReducer.aboutUs);
    const advantages = useSelector(state => state.mainReducer.advantages);
    const topSlides = useSelector(state => state.mainReducer.topSlides);
    const topEvents = useSelector(state => state.eventsReducer.topEvents);
    const reviews = useSelector(state => state.mainReducer.reviews);
    const persons = useSelector(state => state.personsReducer.topPersons);
    const socialLinks = useSelector(state => state.mainReducer.socialLinks);
    const numOfPages = useSelector(state => state.mainReducer.numOfPages);

    useEffect(() => {

        dispatch(fetchTopPersons())
        dispatch(fetchTopSlides())
        dispatch(fetchAboutUs())
        dispatch(fetchAdvantages())
        dispatch(fetchEventsByPriority())
        dispatch(fetchReviewWithPagination(1))
        dispatch(fetchSocialLinks())
        dispatch(fetchNumOfPages(1))
    }, [])


    return (
        <>
            <MainSlider slides={topSlides ?? []}/>
            <SectionSlider/>
            <Row className={style.parallaxBlock}></Row>
            <SectionAbout socialLinks={socialLinks} advantages={advantages} persons={persons} reviews={reviews}
                          numOfPages={numOfPages} aboutUs={aboutUs}/>
            <Row className={style.parallaxBlock}></Row>
            <section className={style.sectionAbout}>
                <Container>
                    <h2 className="white-text" style={{margin: 0, padding: 30}}>Популярное</h2>
                    <Services topEvents={topEvents}/>
                </Container>
            </section>
        </>
    );
};

export default Main;