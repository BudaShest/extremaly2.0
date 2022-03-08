import React, {useState} from 'react';
import {Caption, Slide, Slider} from "react-materialize";


const slidesInfo = [
    {img:"img/top-slider/image_1.jpg", title:"Уникальный отдых", text:"Гаранитруем, вам точно не будет скучно"},
    {img:"img/top-slider/image_2.jpeg", title:"Первый в мире", text:"У данного сервиса нет аналогов в мире"},
    {img:"img/top-slider/image_3.jpg", title:"Отсутсвие наценки", text:"Чо то чо то"},
    {img:"img/top-slider/image_4.jpg", title:"Ещё чо то", text:"Какая разница, всё равно потом уберу этот текст"},
]

const MainSlider = () => {
    const [slides] = useState(slidesInfo);

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
                slides.map((slide,index)=>(
                    <Slide key={index} image={<img alt="" src={slide.img}/>}>
                        <Caption style={{backgroundColor:"rgba(0,0,0,0.8)",padding:"80px 0"}} placement="center">
                            <h3>
                                {slide.title}
                            </h3>
                            <h5 className="light white-text text-lighten-3">
                                {slide.text}
                            </h5>
                        </Caption>
                    </Slide>
                ))
            }

        </Slider>
    );
};

export default MainSlider;