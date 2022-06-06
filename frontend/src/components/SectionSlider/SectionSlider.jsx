import React from 'react';
import {Carousel, Container} from "react-materialize";
import {NavLink} from 'react-router-dom';
import style from './SectionSlider.module.css';

/**
 * Компонент "Слайдер-меню"
 * @returns {JSX.Element}
 * @constructor
 */
const SectionSlider = () => {
    return (
        <section className={style.sliderSection}>
            <Container>
                <h2 className="white-text">Наше предложение</h2>
                <Carousel
                    carouselId="Carousel-35"
                    className="white-text center"
                    options={{
                        fullWidth: false,
                        indicators: false
                    }}
                >
                    <div className={`valign-wrapper hoverable ${style.sliderElem}`}
                         style={{backgroundImage: "url('/img/link-slider/place.jpg')"}}>
                        <p className={style.sliderElemText}><NavLink className={style.sliderElemLink} to="/places">Места</NavLink></p>
                    </div>
                    <div className={`valign-wrapper hoverable ${style.sliderElem}`}
                         style={{backgroundImage: "url('/img/link-slider/persons.jpg')"}}>
                        <p className={style.sliderElemText}><NavLink className={style.sliderElemLink} to="/persons">Личности</NavLink></p>
                    </div>
                    <div className={`valign-wrapper hoverable ${style.sliderElem}`}
                         style={{backgroundImage: "url('/img/link-slider/events.jpeg')"}}>
                        <p className={style.sliderElemText}><NavLink className={style.sliderElemLink} to="/events">События</NavLink></p>
                    </div>
                </Carousel>
            </Container>

            <hr/>
        </section>
    )
};

export default SectionSlider;