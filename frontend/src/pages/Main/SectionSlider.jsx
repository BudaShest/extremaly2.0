import React from 'react';
import {Carousel, Container} from "react-materialize";

const SectionSlider = () => {
    return (
        <section style={{backgroundColor: '#222222', padding:'24px 0'}}>
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
                    <div className="valign-wrapper hoverable" style={{backgroundImage:"url('https://look.com.ua/pic/201904/1366x768/look.com.ua-342699.jpg')",width:"400px", height:"300px", backgroundSize:"cover", backgroundPosition:"center"}}>
                        <p style={{backgroundColor:"rgba(0,0,0,0.6)", textAlign:'center', fontSize:"2em", width:'100%', padding:'14px'}}>Места</p>
                    </div>
                    <div className="valign-wrapper hoverable" style={{backgroundImage:"url('https://img5.goodfon.ru/original/1366x768/4/db/actor-dwayne-johnson-smile-dwayne-the-rock-johnson.jpg')",width:"400px", height:"300px", backgroundSize:"cover", backgroundPosition:"center"}}>
                        <p style={{backgroundColor:"rgba(0,0,0,0.6)", textAlign:'center', fontSize:"2em", width:'100%', padding:'14px'}}>Персонажи</p>
                    </div>
                    <div className="valign-wrapper hoverable" style={{backgroundImage:"url('https://styleinsider.com.ua/wp-content/uploads/2019/09/Bezymyannyj-kollazh-2019-09-03T153149.451.jpg')",width:"400px", height:"300px", backgroundSize:"cover", backgroundPosition:"center"}}>
                        <p style={{backgroundColor:"rgba(0,0,0,0.6)", textAlign:'center', fontSize:"2em", width:'100%', padding:'14px'}}>События</p>
                    </div>
                </Carousel>
            </Container>

            <hr/>
        </section>
    )
};

export default SectionSlider;