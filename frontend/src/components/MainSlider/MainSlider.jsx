import React, {useState} from 'react';
import {Caption, Slide, Slider} from "react-materialize";

const MainSlider = ({slides}) => {
    return (
        <Slider
            fullscreen={false}
            options={{
                duration: 500,
                height: 600,
                indicators: false,
                interval: 6000
            }}
        >
            {
                slides.map((slide, index) => {
                    return (
                        <Slide key={index} image={<img alt="Слайд" src={slide.image}/>}>
                            <Caption style={{backgroundColor: "rgba(0,0,0,0.8)", padding: "80px 0"}} placement="center">
                                <h3>
                                    {slide.title}
                                </h3>
                                <h5 className="light white-text text-lighten-3"
                                    dangerouslySetInnerHTML={{__html: slide.text}}></h5>
                            </Caption>
                        </Slide>)
                })
            }

        </Slider>
    );
};

export default MainSlider;