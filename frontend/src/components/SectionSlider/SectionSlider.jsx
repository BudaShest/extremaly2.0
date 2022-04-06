import React from 'react';
import {Carousel, Container} from "react-materialize";
import {NavLink} from 'react-router-dom';
import style from './SectionSlider.module.css';

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
                    <div className={`valign-wrapper hoverable ${style.sliderElem}`} style={{backgroundImage:"url('/img/link-slider/place.jpg')"}}>
                        <p style={{backgroundColor:"rgba(0,0,0,0.6)", textAlign:'center', fontSize:"2em", width:'100%', padding:'14px'}}><NavLink className={style.sliderElemLink} to="/places">Места</NavLink></p>
                    </div>
                    <div className={`valign-wrapper hoverable ${style.sliderElem}`} style={{backgroundImage:"url('/img/link-slider/persons.jpg')"}}>
                        <p style={{backgroundColor:"rgba(0,0,0,0.6)", textAlign:'center', fontSize:"2em", width:'100%', padding:'14px'}}><NavLink className={style.sliderElemLink} to="/persons">Личности</NavLink></p>
                    </div>
                    <div className={`valign-wrapper hoverable ${style.sliderElem}`} style={{backgroundImage:"url('/img/link-slider/events.jpeg')"}}>
                        <p style={{backgroundColor:"rgba(0,0,0,0.6)", textAlign:'center', fontSize:"2em", width:'100%', padding:'14px'}}><NavLink className={style.sliderElemLink} to="/events">События</NavLink></p>
                    </div>
                </Carousel>
            </Container>

            <hr/>
        </section>
    )
};

export default SectionSlider;